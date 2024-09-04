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
    public function dashboard(Request $request)
    {

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

        return view('home.dashboard',compact('employe','totalEmployes','empdepart','empdep','empdept'));
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

