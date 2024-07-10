<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employe;
use DB;
class EmployeesController extends Controller
{
    public function ListeEmply()
    {
        /*$employe= DB::table('posts')

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
    'occupeIdP.post.contient.sous_departement.departement'])->get();
   //return $employe;
    // dd($employe);

   //le nbr total des employés
     $totalEmployes = $employe->count();

        $empdepart= DB::table('departements')
          ->get();
         

        return view('employees.liste',compact('employe','totalEmployes','empdepart'));
  
        }

    public function AddEmply()
    {
        return view('employees.add');
    }

    public function AbsenceEmply()
    {
       /* $employe= DB::table('employes')
        ->join('travails','employes.id_nin','=','travails.id_nin')
        ->join('sous_departements','travails.id_sous_depart','=','sous_departements.id_sous_depart')
        ->join('contients','sous_departements.id_sous_depart','=','contients.id_sous_depart')
        ->join('departements','sous_departements.id_depart','=','departements.id_depart')
        ->join('posts','contients.id_post','=','posts.id_post')
        ->select('employes.id_nin','employes.id_p','employes.Nom_emp','employes.Prenom_emp','sous_departements.id_sous_depart','sous_departements.Nom_sous_depart','departements.Nom_depart','posts.Nom_post')
        ->get();*/
        $employe=Employe::with([
            'occupeIdNin.post.contient.sous_departement.departement',
            'occupeIdP.post.contient.sous_departement.departement'
        ])->get();

        $empdepart= DB::table('departements')
          ->get();

//le nbr total des employés
        $totalEmployes = $employe->count();
        return view('employees.liste_abs',compact('employe','totalEmployes','empdepart'));
    }


    public function createF()
    {
        $dbempdepart = new Departement();
        $empdepart =$dbempdepart->get();
        return view('addTemplate.add',compact('empdepart'));
    }
    
    
    public function getall($id)
    {
       // dd($id);
       $dbempdepart = new Departement();
       $empdepart =$dbempdepart->get();
        $result=DB::table('employes')->distinct()
                                        ->join('travails','travails.id_nin','=','employes.id_nin')
                                        ->join('occupes','employes.id_nin',"=",'occupes.id_nin')
                                        ->join('sous_departements','travails.id_sous_depart',"=","sous_departements.id_sous_depart")
                                        ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                                        ->join('posts','posts.id_post','=','occupes.id_post')
                                        ->join('appartients','appartients.id_nin','=','employes.id_nin')
                                        ->join('niveaux','niveaux.id_niv','=','appartients.id_niv')
                                        ->where('employes.id_nin',$id)
                                        ->select('id_travail')
                                        ->groupBy('id_travail')
                                        ->get();
                                      //  return response()->json($detailemp);
                                    //   print_r(compact('detailemp'));
                                   // dd($detailemp);
        $nbr=$result->count();
        $detailemp=array();    
        foreach($result as $res)
        {
            $val=$res->id_travail;  
            $inter=DB::table('employes')->distinct()
                                        ->join('travails','travails.id_nin','=','employes.id_nin')
                                        ->join('occupes','employes.id_nin',"=",'occupes.id_nin')
                                        ->join('sous_departements','travails.id_sous_depart',"=","sous_departements.id_sous_depart")
                                        ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                                        ->join('posts','posts.id_post','=','occupes.id_post')
                                        ->join('appartients','appartients.id_nin','=','employes.id_nin')
                                        ->join('niveaux','niveaux.id_niv','=','appartients.id_niv')
                                        ->where('id_travail',$val)
                                        ->select('employes.Nom_emp',
                                        'employes.Prenom_emp',
                                        'employes.id_nin',
                                        'employes.Nom_ar_emp',
                                        'employes.Prenom_ar_emp',
                                        'employes.Date_nais',
                                        'employes.Lieu_nais_ar',
                                        'employes.adress',
                                        'employes.adress_ar',
                                        'employes.sexe',
                                        'employes.email',
                                        'employes.Phone_num',
                                        'posts.Nom_post',
                                        'departements.Nom_depart',
                                        'sous_departements.Nom_sous_depart',
                                        'travails.date_chang',
                                        'travails.date_installation',
                                        'travails.notation')
                                         ->first();
            array_push($detailemp,$inter)  ;                     
        }
      //  dd($detailemp);
        if($nbr>0){
            $nbr=$nbr-1;
        return view('BioTemplate.index',compact('detailemp','nbr','empdepart'));}
        else
        {
            return view('404');
        }
    }

}
