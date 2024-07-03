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

    public function AbsenceEmply()
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
        return view('employees.liste_abs',compact('employe','totalEmployes','empdepart'));
    }
    public function createF()
    {
        return view('addTemplate.add');
    }public function getall($id)
    {
       // dd($id);
        $detailemp=DB::table('employes')->join('travails','travails.id_nin','=','employes.id_nin')
                                        ->join('occupes','employes.id_nin',"=",'occupes.id_nin')
                                       ->join('sous_departements','travails.id_sous_depart',"=","sous_departements.id_sous_depart")
                                       ->join('posts','posts.id_post','=','occupes.id_post')
                                       ->join('appartients','appartients.id_nin','=','employes.id_nin')
                                        ->join('niveaux','niveaux.id_niv','=','appartients.id_niv')
                                        ->where('employes.id_nin',$id)
                                        ->get();
                                      //  return response()->json($detailemp);
                                    //   print_r(compact('detailemp'));
                                   // dd($detailemp);
        $nbr=$detailemp->count();
        if($nbr>0){
            $nbr=$nbr-1;
        return view('BioTemplate.index',compact('detailemp','nbr'));}
        else
        {
            return view('404');
        }
    }

}
