<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function ListeDepart()
    {
        return view('Department.list_depart');
    }

    //la page dashboard_depart.blade.php
    public function dashboard_depart($dep_id)
    {
        $empdep= DB::table('employes')
        ->join('departements','sous_departements.id_depart','=','departements.id_depart')
        ->join('travails','employe.id_nin','=','travails.id_nin')
        ->join('sous_departements','travails.id_sous_depart','=','sous_departements.id_sous_depart')
        ->join('contients','sous_departements.id_sous_depart','=','contients.id_sous_depart')
        ->join('post','contients.id_post','=','posts.id_post')
        ->where ('departements.id_depart','=',$dep_id)
        ->select('employes.id_nin','employes.id_p','employes.Nom_emp','employes.Prenom_emp','sous_departements.id_sous_depart','sous_departements.Nom_sous_depart','post.Nom_post')
        ->get();

        $empdepart= DB::table('departements')
        ->get();

        $nom_d = DB::table('departements')
        ->where('id_depart', $dep_id)
        ->value('Nom_depart');

//le nbr total des employe pour chaque depart
        $totalEmpDep = $empdep->count();

return view('Department.dashboard_depart', compact('empdep','totalEmpDep','empdepart','nom_d'));
    }
}
