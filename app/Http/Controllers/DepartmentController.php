<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employe;
use App\Models\Departement;

class DepartmentController extends Controller
{
    public function ListeDepart()
    {
        return view('Department.list_depart');
    }

    //la page dashboard_depart.blade.php
    public function dashboard_depart($dep_id)
    {
       /* $empdep= DB::table('employes')
        ->join('travails','employes.id_nin','=','travails.id_nin')
        ->join('sous_departements','travails.id_sous_depart','=','sous_departements.id_sous_depart')
        ->join('departements','Sous_departements.id_depart','=','departements.id_depart')
        ->join('contients','sous_departements.id_sous_depart','=','contients.id_sous_depart')
        ->join('posts','contients.id_post','=','posts.id_post')
        ->where ('departements.id_depart','=',$dep_id)
        ->select('employes.id_nin','employes.id_p','employes.Nom_emp','employes.Prenom_emp','sous_departements.id_sous_depart','sous_departements.Nom_sous_depart','posts.Nom_post')
        ->get();*/

        $empdep=Employe::with([
            'occupeIdNin.posts.contients.sous_departements.departements',
            'occupeIdP.posts.contients.sous_departements.departements'
        ])->get();

        $empdepart=Departement::get();

        /*$empdepart= DB::table('departements') 
        ->get();*/

        $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart');

       /* $nom_d = DB::table('departements')
        ->where('id_depart', $dep_id)
        ->value('Nom_depart');*/

//le nbr total des employe pour chaque depart
        $totalEmpDep = $empdep->count();

return view('Department.dashboard_depart', compact('empdep','totalEmpDep','empdepart','nom_d'));
    }


    public function AddDepart()
    {
        return view('Department.add_depart');
    }
}
