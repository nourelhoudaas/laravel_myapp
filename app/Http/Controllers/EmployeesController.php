<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employe;
use DB;
use Carbon\Carbon;
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
    $employe = Employe::with([
        'occupeIdNin'=>function($query)
        {
            $query->orderBy('date_recrutement','desc')->take(1);
        },
         'occupeIdNin.post.contient.sous_departement.departement',
        'occupeIdP'=>function($query)
        {
            $query->orderBy('date_recrutement','desc')->take(1);
        },
        'occupeIdP.post.contient.sous_departement.departement',
        'travailByNin' => function ($query) {
            $query->orderBy('date_installation', 'desc')->take(1);
        },
        'travailByNin.sous_departement.departement',
        'travailByP' => function ($query) {
            $query->orderBy('date_installation', 'desc')->take(1);
        },
        'travailByP.sous_departement.departement'
    ])->get();
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
        $detailemp=DB::table('employes')->join('travails','travails.id_nin','=','employes.id_nin')
                                        ->join('occupes','employes.id_nin',"=",'occupes.id_nin')
                                       ->join('sous_departements','travails.id_sous_depart',"=","sous_departements.id_sous_depart")
                                       ->join('departements','departements.id_depart','=','sous_departements.id_depart')
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
        return view('BioTemplate.index',compact('detailemp','nbr','empdepart'));}
        else
        {
            return view('404');
        }
    }

    //chercher un  employe
    public function searchemp(Request $request)
    {
    $employe=Employe::with([
    'occupeIdNin.post.contient.sous_departement.departement',
    'occupeIdP.post.contient.sous_departement.departement',
    'travailByNin.sous_departement.departement',
    'travailByP.sous_departement.departement']);

      //chercher by id_nin
      if($request->id_nin)
      {
        $req ->where('id_nin','LIKE','%'.$request -> id_nin.'%');
        }
        $employes = $query->get();
    }
}
