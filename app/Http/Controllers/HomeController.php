<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employe;
use App\Models\Departement;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    //la page home.blade.php
    public function home()
    {
        return view('accueil.index');
    }

    //la page about.blade.php
    public function about()
    {
        return view('home.about');
    }

    //la page dashboard.blade.php
    public function dashboard()
    {
    
       /* $employe= DB::table('posts')
        ->join('occupes','occupes.id_post',"=","posts.id_post")
        ->join('employes','occupes.id_p','=','employes.id_p')
        ->join('travails','travails.id_p','=','employes.id_p')
        ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
        ->join('departements','sous_departements.id_depart','=','departements.id_depart')
        ->select('employes.id_nin','employes.id_p','employes.Nom_emp','employes.Prenom_emp' ,'posts.Nom_post','sous_departements.Nom_sous_depart','departements.Nom_depart')
        ->distinct()
        ->get();

        $empdepart= DB::table('departements')
          ->get();
        
*/
        $employe=Employe::with([
    'occupeIdNin.post.contient.sous_departement.departement',
    'occupeIdP.post.contient.sous_departement.departement'
        ])->get();

    //le nbr total des employés
        $totalEmployes= $employe->count();

        $empdepart=Departement::get();

     //   dd($employe);
        return view('home.dashboard',compact('employe','totalEmployes','empdepart'));
    }

    public function switchLanguage($locale)
    {
        if (in_array($locale, ['fr','ar'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    }

}

