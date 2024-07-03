<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class EmployeesController extends Controller
{
    public function ListeEmply()
    {
        $employe= DB::table('employes')
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
        return view('employees.liste',compact('employe','totalEmployes','empdepart'));
    }

    public function AddEmply()
    {
        return view('employees.add');
    }
}
