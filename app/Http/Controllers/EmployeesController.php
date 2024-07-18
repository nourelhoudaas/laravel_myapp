<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Occupe;
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

     $champs = $request->input('champs', 'Nom_emp'); // Champ par défaut pour le tri
     $direction = $request->input('direction', 'asc'); // Ordre par défaut ascendant
    
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
        'travailByP.sous_departement.departement',
          
    ])->get();
 

    if ($champs === 'age') {
        $employe = $employe->sortBy(function($emp) {
            return \Carbon\Carbon::parse($emp->Date_nais)->age;
        }, SORT_REGULAR, $direction === 'desc');
    } elseif ($champs === 'Nom_post') {
        $employe = $employe->sortBy(function($emp) {
            return optional($emp->occupeIdNin->first())->post->Nom_post;
        }, SORT_REGULAR, $direction === 'desc');
        
   
 } elseif ($champs === 'Nom_depart') {
    $employe = $employe->sortBy(function($emp) {
        return optional(optional($emp->travailByNin->first())->sous_departement->departement)->Nom_depart;
    }, SORT_REGULAR, $direction === 'desc');
} elseif ($champs === 'Nom_sous_depart') {
    $employe = $employe->sortBy(function($emp) {
        return optional($emp->travailByNin->first())->sous_departement->Nom_sous_depart;
    }, SORT_REGULAR, $direction === 'desc');
} elseif ($champs === 'date_recrutement') {
    $employe = $employe->sortBy(function($emp) {
        return optional($emp->occupeIdNin->first())->date_recrutement;
    }, SORT_REGULAR, $direction === 'desc');
} elseif ($champs === 'date_installation') {
    $employe = $employe->sortBy(function($emp) {
        return optional($emp->travailByNin->first())->date_installation;
    }, SORT_REGULAR, $direction === 'desc');
} else {
    $employe = $employe->sortBy($champs, SORT_REGULAR, $direction === 'desc');
}
    $employe = $employe->values();

 
    
   //return $employe;
    // dd($employe);

   //le nbr total des employés
     $totalEmployes = $employe->count();

        $empdepart= DB::table('departements')
          ->get();
         

        return view('employees.liste',compact('employe','totalEmployes','empdepart','champs','direction'));
  
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
       // dd($empdep);  
       $occupemp=array();
        foreach ($empdep as $emp) {
            # code...
           
            $occup=Occupe::where('id_nin',$emp->id_nin)->select('id_nin','date_recrutement','occupes.id_post','departements.id_depart')->orderBy('date_recrutement','desc')
                                                       ->join('posts','occupes.id_post','=','posts.id_post')
                                                       ->join('contients','posts.id_post','=','contients.id_post') 
                                                       ->join('sous_departements','contients.id_sous_depart','=','sous_departements.id_sous_depart')
                                                       ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                                                       ->get();
                                                       foreach($occup as $empoc)
                                                       {
                                                     //  print_r('-->> id:'.$empoc->id_nin.' -- post :'.$empoc->id_post.' date de :'.$empoc->date_recrutement.' Dic :'.$empoc->id_depart.'<<--');
                                                       array_push($occupemp,$empoc);
                                                        }
        }  
       // dd($occupemp);
       $elem=array();
      foreach($occupemp as $empoc)
      {
        $post=Employe::where([['employes.id_nin','=',$empoc->id_nin],['departements.id_depart','=',$id_dep]])->select('employes.id_nin','departements.id_depart','date_recrutement')
        ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
        ->join('contients', 'posts.id_post', '=', 'contients.id_post')
        ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')->get();
        foreach($post as $empost)
        {
           // print_r('  |<----date reuc From  ---- '.$empost->date_recrutement.'----> Date form em -----'.$empoc->date_recrutement.'------of emp --'.$empoc->id_nin.'--- his depart----'.$empoc->id_depart);
            if($empoc->id_depart != $id_dep && $empoc->date_recrutement>=$empost->date_recrutement) 
            {
                //print_r('  |<----date reuc From  ---- '.$empost->date_recrutement.'----> Date form em -----'.$empoc->date_recrutement.'------of emp --'.$empoc->id_nin.'--- his depart----'.$empoc->id_depart);
                array_push($elem,$empost);  
            //print_r('-->> id:'.$empost->id_nin.' Dic :'.$empost->id_depart.'---'.$empoc->date_recrutement.'<<--');
            }
            else {
               // print_r('-->> id:'.$empost->id_nin.' Dic :'.$empost->id_depart.'---'.$empoc->date_recrutement.'<<--');
            }
        }
    }
    $exitemp=array();
    foreach($elem as $forbn)
    {
        $emp=Employe::where([['employes.id_nin','<>',$forbn->id_nin],['departements.id_depart','=',$id_dep]])
        ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
        ->join('contients', 'posts.id_post', '=', 'contients.id_post')
        ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
        ->get();
        array_push($exitemp,$emp);
    }
   // dd($exitemp[0]);
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
      //  dd($exitemp);
return response()->json($exitemp[0]);
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
    public function check_cg($id_p)
    {
        $totaljour=0;
        $emp=Employe::where('employes.id_emp','=',$id_p)
        ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
        ->join('contients', 'posts.id_post', '=', 'contients.id_post')
        ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
        ->orderBy('occupes.date_recrutement','desc')
        ->firstOrFail();
        $cng=Conge::where('id_nin',$emp->id_nin)->orderBy('date_fin_cong','desc')->get();
      //  dd($cng);
        if($cng->count() > 0 )
        {
            $totaljour=$cng->total_jour+30;
        }
        else
        {
          //  dd($emp);
         
        $startDate = Carbon::parse($emp->date_recrutement);

        
        $endDate = Carbon::parse('01-06-' . Carbon::now()->year);

        // Calculate the number of months between the two dates
        $monthsDifference = $startDate->diffInMonths($endDate);
        if($monthsDifference > 0)
        {
            $totaljour = $monthsDifference*2.5;
        }
        }

        return response()->json(
            [
                'employe'=>$emp,
                'Jour_congé'=>round($totaljour),
            ]
        );
    }
    public function add_cng(Request $request)
    {
        $request->validate(
            [
                'ID_NIN'=>'required|integer',
                'ID_P'=>'required|integer',
                'Dic'=>'required|integer',
                'date_dcg'=>'required|date',
                'date_fcg'=>'required|date',
                'type_cg'=>'required|string'
            ]
            );
            $cong=new Conge([
                'id_nin'=>$request->get('ID_NIN'),
                'id_p'=>$request->get('ID_P'),
                'date_debut_cong'=>$request->get('date_dcg'),
                'date_fin_cong'=>$request->get('date_fcg'),
                'total_jour'=>$request->get('totaljour'),
                'ref_cong'=>$request->get('type_cg')
            ]);
           // dd($request);
            if($cong->save())
            {
                return response()->json([
                    'message'=>'Success',
                    'status'=> 200
                ]);
            }else
            {
                return response()->json([
                    'message'=>'Unsuccess',
                    'status'=> 404
                ]);
            }
    }
}


