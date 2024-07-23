<?php

    namespace App\Http\Controllers;

    use App\Models\Absence;
    use App\Models\Conge;
    use App\Models\Occupe;
    use App\Models\Sous_departement;
    use Illuminate\Http\Request;
    use App\Models\Departement;
    use App\Models\Employe;
    use App\Models\type_cong;
    use DB;
    use Carbon\Carbon;

    class EmployeesController extends Controller
    {
        public function ListeEmply(Request $request)
        {
        
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
    
        $empdepart=Departement::get();

        /*$empdepart= DB::table('departements')
        ->get();*/

        
    //le nbr total des employe pour chaque depart
        $totalEmployes = $employe->count();
    
        //return $employe;
        // dd($employe);
    
    
    
            //   return view('employees.liste',compact('employe','totalEmployes','empdepart'));
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
                                    // dd($result);
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
            
            //dd($detailemp);
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
        $result=array();
        $ocp=Occupe::select('id_nin','date_recrutement','id_post')->orderBy('date_recrutement','desc')->get();
            foreach($ocp as $empc)
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
                    'posts.Nom_post',
                    'posts.id_post',
                    'occupes.date_recrutement')
            ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->join('contients', 'posts.id_post', '=', 'contients.id_post')
            ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
            ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart') 
            ->orderBy('date_recrutement','desc')
            ->where('employes.id_nin', $empc->id_nin)
            ->first();
            if($empdep->id_depart == $id_dep)
            {
                array_push($result,$empdep);
            }
            }
        
            $finalresul=array();
            if(count($result)>0){
            $id=$result[0]->id_nin;
        // dd($id);
            for ($i=1; $i < count($result) ;$i++) { 
                # code...
                if($id != $result[$i]->id_nin)
                {
                    if(count($finalresul) == 0)
                    {
                    array_push($finalresul,$result[$i]);
                    $id=$result[$i]->id_nin;
                    }
                    else
                    {
                        $find=false;
                        $j=0;
                        while($find == false && $j < count($finalresul))
                        {
                            if($finalresul[$j]->id_nin == $id)
                            {
                                $find=true;
                            }
                        }
                        if($find != true)
                        {
                            array_push($finalresul,$result[$i]);
                            $id=$result[$i]->id_nin;
                        }
                    }
                }
            }
            array_push($finalresul,$result[0]);
        }
        else
        {
            $finalresul=array();
        }
        // dd($finalresul);
                $empdepart=Departement::get();
            $nom_d = Departement::where('id_depart', $id_dep)->value('Nom_depart');
    return response()->json($finalresul);
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

                $typecon=type_cong::select('titre_cong','ref_cong')->get();
                

        
        // dd($typeconge);
        /*$emptypeconge=Employe::with([
                    'congeIdNin.type_conge',
                    'congeIdNin.sous_departement.departement',
                    'congeIdNin.sous_departement.contient.post'
                ])->get();
        */
            
        $query=DB::table('employes')
        ->join('conges','employes.id_nin','=','conges.id_nin')
        ->join('type_congs','conges.ref_cong','=','type_congs.ref_cong')
        ->join('sous_departements','conges.id_sous_depart','=','sous_departements.id_sous_depart')
        ->join('contients','sous_departements.id_sous_depart','=','contients.id_sous_depart')
        ->join('posts','contients.id_post','=','posts.id_post')
        ->select(
            'employes.*',
            'conges.*',
            'type_congs.*',
            'sous_departements.*',
            'posts.*',
            DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE()) AS joursRestants')
        );
        /*Lorsqu'une requête est modifiée par une méthode comme where,
         count, ou get, elle est modifiée pour inclure ces changements. 
         Si vous avez besoin d'utiliser la requête de base pour une autre opération,
          sans les modifications, cloner la requête permet de conserver une version 
          intacte.*/
        $countAnnuelQuery = clone $query;
        $count = $countAnnuelQuery->where('type_congs.titre_cong', 'Annuel')->count();
    
        // Cloner la requête pour compter les congés autres que annuels
        $countExceptionnelQuery = clone $query;
        $countExceptionnel = $countExceptionnelQuery->where('type_congs.titre_cong', '!=', 'Annuel')->count();
    
        // Récupérer les détails des employés avec des congés
        $emptypeconge = $query->get();

          
                //dd($emptypeconge);
            // return response()->json($emptypeconge);
            return view('employees.list_cong',compact('empdepart','typecon','emptypeconge','count','countExceptionnel'));
            }

        public function filterByType($typeconge)
        {   
            //dd($typeconge);
            $query = Employe::query()
        
            ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
            ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
            ->join('sous_departements', 'conges.id_sous_depart', '=', 'sous_departements.id_sous_depart')
            ->join('departements','sous_departements.id_depart','=','departements.id_depart')
            ->join('contients', 'sous_departements.id_sous_depart', '=', 'contients.id_sous_depart')
            ->join('posts', 'contients.id_post', '=', 'posts.id_post')
            ->select(
                'employes.*',
                'conges.*',
                'type_congs.*',
                'sous_departements.*',
                'posts.*',
                DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE()) AS joursRestants')
            );
            //dd($query);
            if ($typeconge) {
                $query->where('type_congs.ref_cong', $typeconge);
            }
         
            //dd($query->toSql(), $query->getBindings());
            $emptypeconge = $query->get();
        // dd($emptypeconge);
        return response()->json($emptypeconge);
        
        }

        public function filterbydep($department)
        {
            //dd($department);
            $query = Employe::query()
        
            ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
            ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
            ->join('sous_departements', 'conges.id_sous_depart', '=', 'sous_departements.id_sous_depart')
            ->join('departements','sous_departements.id_depart','=','departements.id_depart')
            ->join('contients', 'sous_departements.id_sous_depart', '=', 'contients.id_sous_depart')
            ->join('posts', 'contients.id_post', '=', 'posts.id_post')
            ->select(
                'employes.*',
                'conges.*',
                'type_congs.*',
                'sous_departements.*',
                'posts.*',
                DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE()) AS joursRestants')
            );
        
            //dd($query);
            if ($department) {
                $query->where('departements.id_depart', $department);
            }
            $emptypeconge = $query->get();
        // dd($emptypeconge);
        return response()->json($emptypeconge);
        }

    public function filtercongdep($typeconge,$department)
    {
        $query = Employe::query()
        
            ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
            ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
            ->join('sous_departements', 'conges.id_sous_depart', '=', 'sous_departements.id_sous_depart')
            ->join('departements','sous_departements.id_depart','=','departements.id_depart')
            ->join('contients', 'sous_departements.id_sous_depart', '=', 'contients.id_sous_depart')
            ->join('posts', 'contients.id_post', '=', 'posts.id_post')
            ->select(
                'employes.*',
                'conges.*',
                'type_congs.*',
                'sous_departements.*',
                'posts.*',
                DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE()) AS joursRestants')
            );
        
            //dd($query);
            if ($typeconge && $department) {
                $query->where('departements.id_depart', $department)
                    ->where('type_congs.ref_cong', $typeconge);
            }
            $emptypeconge = $query->get();
        //dd($emptypeconge);
        return response()->json($emptypeconge);
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
        
            if($cng->count() > 0)
            {

            //   dd($cng[0]->nbr_jours);
                foreach($cng as $cg)
                {
                    $totaljour+=$cg->nbr_jours;
                }
                return response()->json(
                    [
                        'employe'=>$emp,
                        'Jour_congé'=> $cng[0]->nbr_jours   ,
                        'date_congé'=>$cng[0]->date_fin_cong
                    ]
                );

            }
            else
            {
                //dd($emp);
                
            $startDate = Carbon::parse($emp->date_recrutement);

            
            $endDate = Carbon::parse('01-06-' . Carbon::now()->year);

            // Calculate the number of months between the two dates
            $monthsDifference = $startDate->diffInMonths($endDate);
            if($monthsDifference > 0 )
            {
                $totaljour = $monthsDifference*2.5;
                
            
            }
            return response()->json(
                [
                    'employe'=>$emp,
                    'Jour_congé'=>round($totaljour),
                ]
            );
            }

        
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
            $cng=Conge::where('id_nin',$request->get('ID_NIN'))
            ->select('id_nin','ref_cong','nbr_jours','date_debut_cong','id_cong','date_fin_cong',DB::raw('YEAR(date_debut_cong) as annee'))
            ->orderBy('date_debut_cong','desc')
            ->get();
            $delai=0;
            $right=false;
            foreach($cng as $cg)
            {
                if($request->get('date_dcg') < $cg->date_fin_cong  && $request->get('type_cg') == 'REF0608')
                {
                
                    return response()->json([
                        'message'=>'Unsuccess verfier date du debut',
                        'status'=> 404
                    ]);
                    }
                $startDate = Carbon::parse($request->get('date_dcg'));

            
                $endDate = Carbon::parse($request->get('date_fcg'));
        
                // Calculate the number of months between the two dates
                $monthsDifference = $startDate->diffInMonths($endDate);
                $len=$cng->count()-1;
                $all=$request->get('total_cgj');
                $all=intval($all);
                $date=intval($monthsDifference*30);
            
                if( $all > $date)
                {
                    $nbrcng= $all - $date;
                }
                else
                {
                    $nbrcng=-1;
                }
            //  dd($nbrcng);
                if($nbrcng <= 0)    
                {
                    return response()->json([
                        'message'=>'Unsuccess deminuis le delai '.$nbrcng,
                        'status'=> 404
                    ]); 
                }else
                {
                // dd(intval($nbrcng));
                    $cong=new Conge([
                    'id_nin'=>$request->get('ID_NIN'),
                    'id_p'=>$request->get('ID_P'),
                    'date_debut_cong'=>$request->get('date_dcg'),
                    'date_fin_cong'=>$request->get('date_fcg'),
                    'nbr_jours'=>intval($nbrcng),
                    'ref_cong'=>$request->get('type_cg'),
                    'situation'=>'dans',
                    'id_sous_depart'=>$request->get('SDic')
                        ]);
                }
            

            }
            
           /*== if($delai > 31)
            {
               // dd($delai);
                return response()->json([
                    'message'=>'Unsuccess consume the years',
                    'status'=> 302
                ]); 
            }*/
            //dd($cng);
           

            if($cng->count() > 0)
        {
            if(Carbon::now()->year >= $cng[0]->annee  && $request->get('type_cg') == 'REF0608')
            {
                $right=true;
               // dd($cg->annee);
            }
            $startDate = Carbon::parse($request->get('date_dcg'));

        
            $endDate = Carbon::parse($request->get('date_fcg'));
    
            // Calculate the number of months between the two dates
            $monthsDifference = $startDate->diffInMonths($endDate);
            $len=$cng->count()-1;
            $all=$request->get('total_cgj');
            $all=intval($all);
            $date=intval($monthsDifference*30);
           
            if( $all > $date)
            {
                $nbrcng= $all - $date;
            }
            else
            {
                $nbrcng=-1;
            }
          //  dd($nbrcng);
            if($nbrcng <= 0 && $right == false)    
            {
                return response()->json([
                    'message'=>'Unsuccess deminuis le delai '.$nbrcng,
                    'status'=> 404
                ]); 
            }else
            {
               // dd(intval($nbrcng));
                  $cong=new Conge([
                'id_nin'=>$request->get('ID_NIN'),
                'id_p'=>$request->get('ID_P'),
                'date_debut_cong'=>$request->get('date_dcg'),
                'date_fin_cong'=>$request->get('date_fcg'),
                'nbr_jours'=>intval($nbrcng),
                'ref_cong'=>$request->get('type_cg'),
                'situation'=>'dans',
                'id_sous_depart'=>$request->get('SDic')
                     ]);
            }
           

          //  dd($cong);
          if($cng[0]->date_fin_cong > $request->get('date_dcg'))
           { 
            if($cong->save() )
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
        else
        {
            return response()->json([
                'message'=>'Unsuccess verfier la date du debut',
                'status'=> 404
            ]);
        }
        }
        else
        {
            $startDate = Carbon::parse($request->get('date_dcg'));

            
                $endDate = Carbon::parse($request->get('date_fcg'));
        
                // Calculate the number of months between the two dates
                $monthsDifference = $startDate->diffInMonths($endDate);
                $cong=new Conge([
                    'id_nin'=>$request->get('ID_NIN'),
                    'id_p'=>$request->get('ID_P'),
                    'date_debut_cong'=>$request->get('date_dcg'),
                    'date_fin_cong'=>$request->get('date_fcg'),
                    'nbr_jours'=>intval($monthsDifference * 30),
                    'ref_cong'=>$request->get('type_cg'),
                    'situation'=>'dans',
                    'id_sous_depart'=>$request->get('SDic')
                        ]);
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
    
    }


