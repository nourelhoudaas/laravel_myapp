<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employe;
use App\Models\Departement;
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
        /*$employe= DB::table('employes')
        ->join('travails','employes.id_nin','=','travails.id_nin')
        ->join('sous_departements','travails.id_sous_depart','=','sous_departements.id_sous_depart')
        ->join('contients','sous_departements.id_sous_depart','=','contients.id_sous_depart')
        ->join('departements','sous_departements.id_depart','=','departements.id_depart')
        ->join('posts','contients.id_post','=','posts.id_post')
        ->select('employes.id_nin','employes.id_p','employes.Nom_emp','employes.Prenom_emp','sous_departements.id_sous_depart','sous_departements.Nom_sous_depart','departements.Nom_depart','posts.Nom_post')
        ->get();

        $empdepart= DB::table('departements')
          ->get();
        
//le nbr total des employés
        $totalEmployes = $employe->count();
*/
$employe=Employe::with([
    'occupeIdNin.post.contient.sous_departement.departement',
    'occupeIdP.post.contient.sous_departement.departement'
])->get();

//le nbr total des employés
$totalEmployes= $employe->count();

$empdepart=Departement::get();

        return view('home.dashboard',compact('employe','totalEmployes','empdepart'));
    }



}

