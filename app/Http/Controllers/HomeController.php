<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employe;
use App\Models\Departement;
use App\Models\Travail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    //la page home.blade.php
    public function home()
    {
        return view('home.home');
    }

    //la page about.blade.php
    public function about()
    {
        return view('home.about');
    }

    //la page dashboard.blade.php

    public function dashboard()
    {
        $lang=App::getLocale();
        $employe=Employe::with([
    'occupeIdNin.post.contient.sous_departement.departement',
    'occupeIdP.post.contient.sous_departement.departement'
        ])->get();

    //le nbr total des employés
  $totalEmployes=$employe->count();

   $empdept=array();
        $empdepart=Departement::get();
        foreach($empdepart as $deprt)
        {
            $id_dprt=$deprt->id_depart;
            $employes=Employe::with([
                'occupeIdNin.post.contient.sous_departement.departement',
                'occupeIdP.post.contient.sous_departement.departement'
                    ])->get();
                    $empdep = $employes->filter(function($employe) use ($id_dprt) {
                        $post = $employe->occupeIdNin->last()->post ?? null;
                        $travail = $employe->travailByNin->last();
                        $sousDepartement = $travail->sous_departement ?? null;
                        $departement = $sousDepartement->departement ?? null;

                        // Vérifiez si le département de l'employé correspond à l'ID du département
                        return $departement && $departement->id_depart == $id_dprt;
                    });
                    $totalEmployes=$empdep->count();
                    array_push($empdept,['id_depart'=>$id_dprt,
                                         'Nom_depart'=>$deprt->Nom_depart,
                                         'Nom_depart_ar'=>$deprt->Nom_depart_ar,
                                         'nbremp'=>$totalEmployes]);
        }
        //dd($empdept);
// Sélectionner la colonne de situation en fonction de la langue
$situationColumn = $lang === 'ar' ? 'situation_familliale_ar' : 'situation_familliale';

     // Définir les situations familiales possibles en fonction de la langue
     $situations = [
        'fr' => ['Célébataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)'],
        'ar' => ['أعزب/عزباء', '(ة)متزوج', '(ة)مطلق', '(ة)أرمل']
    ];

    // Sélectionner les situations familiales en fonction de la langue
    $situationList = $situations[$lang];
    //dd($situationList);


    // Compter le nombre d'employés pour chaque situation familiale
    $situationCounts = Employe::select($situationColumn)
        ->selectRaw('COUNT(*) as count')
        ->groupBy($situationColumn)
        ->pluck('count', $situationColumn)
        ->toArray();

    // Assurer que toutes les situations sont présentes dans les résultats
    $data = array_fill_keys($situationList, 0); // Initialise tous les éléments avec 0
    foreach ($situationCounts as $key => $count) {
        if (array_key_exists($key, $data)) {
            $data[$key] = $count;
        }
    }

   // dd($data);

     // Définir les libellés en français
     $genders = ['Homme', 'Femme'];

     // Compter le nombre d'employés pour chaque sexe
     $genderCounts = Employe::select('sexe')
         ->selectRaw('COUNT(*) as count')
         ->groupBy('sexe')
         ->pluck('count', 'sexe')
         ->toArray();

     // Assurer que toutes les situations sont présentes dans les résultats
     $dataGender = array_fill_keys($genders, 0); // Initialise tous les éléments avec 0
     foreach ($genderCounts as $key => $count) {
         if (array_key_exists($key, $dataGender)) {
             $dataGender[$key] = $count;
         }
     }
     //dd($dataGender);
        return view('home.dashboard',compact('employe','totalEmployes','empdepart','empdep','empdept','data','dataGender','lang'));
    }

    public function switchLanguage($locale)
    {
        if (in_array($locale, ['fr','ar'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
            //dd(App::getLocale());
        }
        return back();
    }

}

