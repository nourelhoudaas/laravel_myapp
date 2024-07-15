<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Sous_departement;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employe;
use DB;
use Carbon\Carbon;
class EmployeesController extends Controller
{
    public function ListeEmply(Request $request)
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
    ])
  ->get();

    
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
                                        'posts.Nom_post_ar',
                                        'niveaux.Nom_niv',
                                        'niveaux.Nom_niv_ar',
                                        'niveaux.Specialité',
                                        'niveaux.Specialité_ar',
                                        'posts.Grade_post',
                                        'occupes.date_recrutement',
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





    //list Employe par departement

    public function listabs_depart($id_dep)
    {
   
      
        $empdep = DB::table('employes')
        ->distinct()
        ->select('employes.Nom_emp',
                 'employes.Nom_ar_emp',
                 'employes.Prenom_emp',
                 'employes.Prenom_ar_emp',
                 'employes.id_nin',
                 'employes.id_p',
                 'departements.id_depart',
                 'departements.Nom_depart',
                 'sous_departements.id_sous_depart',
                 'sous_departements.Nom_sous_depart',
                 'posts.Nom_post')
        ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
        ->join('contients', 'posts.id_post', '=', 'contients.id_post')
        ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
        ->where('departements.id_depart', $id_dep)
        ->get();
    
    
    /*$empdep=Employe::with([
        'occupeIdNin.post.contient.sous_departement.departement',
        'occupeIdP.post.contient.sous_departement.departement',
        'travailByNin.sous_departement.departement',
        'travailByP.sous_departement.departement'
    ])->whereHas('travailByNin.sous_departement.departement', function ($query) use ($dep_id) {
        $query->where('id_depart', $dep_id);
 
    })->get();*/
//dd($empdep);
        $empdepart=Departement::get();

        /*$empdepart= DB::table('departements') 
        ->get();*/

        $nom_d = Departement::where('id_depart', $id_dep)->value('Nom_depart');

       /* $nom_d = DB::table('departements')
        ->where('id_depart', $dep_id)
        ->value('Nom_depart');*/

//le nbr total des employe pour chaque depart
        $totalEmpDep = $empdep->count();
return response()->json($empdep);
    }
    public function absens_date($date)
    {
       // dd($date);
        $abs=Absence::select('id_p','id_nin')
                     ->where('date_abs',$date)
                     ->distinct()
                     ->get();
        //dd($abs);
        return response()->json($abs);
    }
    public function add_absence(Request $request) 
    {
        $request->validate([
            'Date_ABS'=>'required|date',
            'jour'=>'required|string'
        ]);
        $soud_dic = Sous_departement::where('id_depart', $request->get('Dic'))->value('id_sous_depart');
        $id_nin=explode('n',$request->get('ID_NIN'));
       // dd(intval($id_nin[1]));
      //  $id_p=explode('n',$request->get('ID_P'));
      $id_p=intval($request->get('ID_P'));
      $id_nin=intval($id_nin[1]);
     //   dd(intval($request->get('ID_P')));
       // dd($request);
        $heur='13:00:00';
        $justf="Justifie";
        if($request->get('jour') == '21')
        {
            $heur='08:30:00';
        }
        if($request->get('jour') == '2')
        {
            $heur='16:30:00';
        }
        if($request->get('justfi')=== 'F2')
        {
                $justf="NoJustier";
        }
        $abs=new Absence([
            'id_nin'=>$id_nin,
            'id_p'=>$id_p,
            'id_sous_depart'=>$soud_dic,
            'statut'=>$justf,
            'heure_abs'=>$heur,
            'date_abs'=>$request->get('Date_ABS'),
        ]);
        if($abs->save())
        {
            return response()->json([
                'message'=>'success',
                'status'=>200
            ]);
        }
        else{
            return response()->json([
                'message'=>'unsuccess',
                'status'=>404
            ]);
        }
    }
    public function list_cong()
    {
        
        $empdepart= DB::table('departements')
        ->get();
        return view('employees.list_cong',compact('empdepart'));
    }
}


