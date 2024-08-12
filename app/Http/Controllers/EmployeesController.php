<?php

    namespace App\Http\Controllers;

    use App\Models\Absence;
    use App\Models\Conge;
    use App\Models\Contient;
    use App\Models\Niveau;
    use App\Models\Occupe;
    use App\Models\Sous_departement;
    use Illuminate\Http\Request;
    use App\Models\Departement;
    use App\Models\Employe;
    use App\Models\Travail;
    use App\Models\Bureau;
    use App\Models\Post;
    use App\Models\Appartient;
    use App\Models\type_cong;
    use DB;
    use Carbon\Carbon;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;

    class EmployeesController extends Controller
    {
            public function ListeEmply(Request $request)
            {

                $champs = $request->input('champs', 'Nom_emp'); // Champ par défaut pour le tri
                $direction = $request->input('direction', 'asc'); // Ordre par défaut ascendant

                $employe = Employe::with([
                    'occupeIdNin.post',
                    'travailByNin.sous_departement.departement'
                ])
                ->get();
            // dd( $employe);

        //optional pour si ya null il envoi pas erreur il envoi null
        //SORT_REGULAR veut dire que les éléments doivent être triés en utilisant la comparaison des valeurs telles qu'elles sont, sans conversion spéciale.

        if ($champs === 'age') {
                $employe = $employe->sortBy(function($emp) {
                    return \Carbon\Carbon::parse($emp->Date_nais)->age;
                }, SORT_REGULAR, $direction === 'desc');

            } elseif ($champs === 'Nom_post') {
                $employe = $employe->sortBy(function($emp) {
                    return optional($emp->occupeIdNin->last())->post->Nom_post;
                }, SORT_REGULAR, $direction === 'desc');


            } elseif ($champs === 'Nom_depart') {
            $employe = $employe->sortBy(function($emp) {
                return optional(optional($emp->travailByNin->last())->sous_departement->departement)->Nom_depart;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'Nom_sous_depart') {
            $employe = $employe->sortBy(function($emp) {
                return optional($emp->travailByNin->last())->sous_departement->Nom_sous_depart;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'date_recrutement') {
            $employe = $employe->sortBy(function($emp) {
                return optional($emp->occupeIdNin->last())->date_recrutement;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'date_installation') {
            $employe = $employe->sortBy(function($emp) {
                return optional($emp->travailByNin->last())->date_installation;
            }, SORT_REGULAR, $direction === 'desc');
        } else {
            $employe = $employe->sortBy($champs, SORT_REGULAR, $direction === 'desc');
        }
            $employe = $employe->values(); // la collection résultante a des clés numériques consécutives.

            $empdepart=Departement::get();

            /*$empdepart= DB::table('departements')
            ->get();*/

  // Définir le nombre d'éléments par page
 // $perPage = 2;




        //le nbr total des employe pour chaque depart
        $totalEmployes = $employe->count();
// Définir le nombre d'éléments par page
$perPage = 2; // Par exemple, 2 éléments par page
$page = request()->get('page',
); // Page actuelle
$offset = ($page - 1) * $perPage;

// Extraire les éléments pour la page actuelle
$items = $employe->slice($offset, $perPage)->values();
//dd($items);
// Créer le paginator
$paginator = new LengthAwarePaginator(
    $items, // Items de la page actuelle
    $employe->count(), // Nombre total d'éléments
    $perPage, // Nombre d'éléments par page
    $page, // Page actuelle
    [
        'path' => request()->url(), // URL actuelle
        'query' => request()->query() // Paramètres de la requête
    ]
);
             return view('employees.liste',compact('paginator','employe','totalEmployes','empdepart','champs','direction'));


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
            $last=Occupe::join('employes','employes.id_nin','=','occupes.id_nin')
                           ->join('appartients','appartients.id_nin','=','employes.id_nin')
                           ->join('niveaux','niveaux.id_niv','=','appartients.id_niv')
                          ->join('travails','travails.id_nin','=','employes.id_nin')
                          ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                          ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                          ->join('posts','posts.id_post','=','occupes.id_post')
                          ->where('employes.id_nin',$id)
                          ->first();
           // dd($last);
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
                                       //  dd($result);
                $postwork=Occupe::where('Occupes.id_nin',$id)->distinct()
                                ->join('posts','posts.id_post','=','occupes.id_post')
                                ->join('contients','contients.id_post','=','posts.id_post')
                                ->select('id_occup','date_recrutement')->orderBy('date_recrutement')
                                ->get();
                          //      dd($postwork);
                $nbr=$result->count();
                $allemp=array();
                foreach($result as $res)
                {
                    $val=$res->id_travail;
                    $inter=DB::table('employes')->distinct()
                                                ->join('travails','travails.id_nin','=','employes.id_nin')
                                                ->join('occupes','employes.id_nin',"=",'occupes.id_nin')
                                                ->join('sous_departements','travails.id_sous_depart',"=","sous_departements.id_sous_depart")
                                                ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                                                ->join('contients','contients.id_sous_depart','=','sous_departements.id_sous_depart')
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
                                                'travails.date_chang',
                                                'travails.date_installation',
                                                'travails.notation')
                                                ->orderBy('travails.date_installation','desc')
                                           //     ->orderBy('occupes.date_recrutement','desc')
                                                ->first();
                    array_push($allemp,$inter)  ;

                }
                $postarr=array();
                foreach($postwork as $single){
                    $inter=DB::table('contients')->join('sous_departements','contients.id_sous_depart','=','sous_departements.id_sous_depart')
                                                ->join('posts','posts.id_post','=','contients.id_post')
                                                ->join('occupes','occupes.id_post','=','posts.id_post')
                                                ->join('employes','employes.id_nin','=','occupes.id_nin')
                                                ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                                                ->join('appartients','appartients.id_nin','=','employes.id_nin')
                                                ->join('niveaux','niveaux.id_niv','=','appartients.id_niv')
                                                ->where('id_occup',$single->id_occup)
                                                ->select(
                                                'niveaux.Nom_niv',
                                                'niveaux.Nom_niv_ar',
                                                'niveaux.Specialité',
                                                'niveaux.Specialité_ar',
                                                'posts.Grade_post',
                                                'posts.Nom_post',
                                                'posts.Nom_post_ar',
                                                'occupes.date_recrutement',
                                                'occupes.echellant',
                                                'departements.Nom_depart',
                                                'departements.Nom_depart_ar',
                                                'sous_departements.Nom_sous_depart',
                                                'sous_departements.Nom_sous_depart_ar',)
                                                ->orderBy('occupes.date_recrutement','desc')
                                                ->first();
                    array_push($postarr,$inter)  ;
                }
               // $carier=Travail::where('employes.id_nin',$id)
               $detailemp=array();
               for ($i=0; $i <count($postarr) ; $i++) {
                # code...
               // array_push($detailemp,$postarr[$i],$allemp[$i]);
                //dd($detailemp[$i]);
               }
               $detailemp=$allemp;
             //   dd($detailemp);
                if($nbr>0){
                    $nbr=$nbr-1;
                return view('BioTemplate.index',compact('detailemp','nbr','empdepart','last','postarr'));}
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
        $post=array();
        $id_sous=Sous_departement::where('id_depart',$id_dep)->get();

        foreach($id_sous as $sous_dep)
        {
            //print_r('sous_id '.$sous_dep);
            $id_post=Post::where('sous_departements.id_sous_depart',$sous_dep->id_sous_depart)->select('contients.id_contient')
                           ->join('contients','contients.id_post','=','posts.id_post')
                           ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                           ->get();
            foreach($id_post as $sas)
            array_push($post,$sas->id_contient);
        }
       //--------------------------------------------------------------------------- success ---/////
       $allwor=array();
        $emps=Employe::join('travails','travails.id_nin','=','employes.id_nin')
                       ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                       ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                       ->where('departements.id_depart',$id_dep)
                       ->orderBy('travails.date_installation','desc')
                       ->get();
        foreach($emps as $empl)
        {
            array_push($allwor,$empl);
        }
       // dd($allwor);
   
         $empdpart=array();
         $fis=array();
     foreach($allwor as $workig)
        {
            $travs=Travail::where('travails.id_nin',$workig->id_nin)
                            ->join('Employes','Employes.id_nin','=','travails.id_nin')
                            ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                            ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                           // ->where('departements.id_depart',$id_dep)
                            ->orderBy('date_installation','desc')
                            ->first();
          /* foreach($travs as $bind)
            {   */
            if($workig->date_installation <= $travs->date_installation && $travs->id_depart == $id_dep)
            {
                array_push($fis,$travs);
            }
       // }
        }
         //------------------------------------------------------------------until here -----------------------*/
        foreach($fis as $emp)
        {
            $idcnt=Occupe::where('id_nin',$emp->id_nin)->where('contients.id_sous_depart',$emp->id_sous_depart)->select('id_contient')
                    ->join('posts','posts.id_post','=','occupes.id_post')
                    ->join('contients','contients.id_post','=','posts.id_post')
                    ->orderBy('date_recrutement','desc')
                    ->first();

            $emps=Employe::join('occupes','occupes.id_nin','=','Employes.id_nin')
                           ->join('posts','posts.id_post','=','occupes.id_post')
                           ->join('contients','contients.id_post','=','posts.id_post')
                           ->join('sous_departements','contients.id_sous_depart','=','sous_departements.id_sous_depart')
                           ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                           ->where('contients.id_contient',$idcnt->id_contient)
                           ->where('Employes.id_nin',$emp->id_nin)
                           ->orderBy('date_recrutement','desc')
                           ->first();
                           $find=false;
                           if(count($empdpart) >0)
                           {$i=0;

                            while ( $i < count($empdpart) && $find == false) {
                                # code...
                                if($empdpart[$i]->id_nin == $emps->id_nin)
                                {

                                    $find = true;
                                   // print_r('------- insrt:::'.$emps->id_nin.'find');
                                }

                                $i++;
                            }
                            if($find != true)
                            {
                                //print_r('------- insrt:::'.$emps->id_nin.' ----- comparing to ::::');
                                $i=0;
                                array_push($empdpart,$emps);
                            }
                        }
                        else
                        {
                           // print_r('insrt null'.$emps->id_nin);
                            array_push($empdpart,$emps);
                        }
        }
                $empdepart=Departement::get();
            $nom_d = Departement::where('id_depart', $id_dep)->value('Nom_depart');
    return response()->json($empdpart);
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
            if($request->get('justifie') == 'F2')
            {
                    $justf="NoJustier";
            }
            if($request->get('justifie') == 'F1')
            {
                $justf="Justifie";
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


                $typecon=type_cong::select('titre_cong','ref_cong','titre_cong_ar')->get();



            // dd($typeconge);
            $today = Carbon::now();

            $emptypeconge = Employe::with([
                'occupeIdNin.post',
                'travailByNin.sous_departement.departement',
                'congeIdNin.type_conge'
            ])->whereHas('congeIdNin', function($query) use ($today) {
                $query->where('date_fin_cong', '>', $today);
            })->get();

          // dd($emptypeconge );

           $count = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
            'congeIdNin.type_conge'
        ])->whereHas('congeIdNin.type_conge', function($query) use ($today) {
            $query->where('date_fin_cong', '>', $today)
                ->whereIn('titre_cong', ['annuel']);
        })->count();

        $countExceptionnel= Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
            'congeIdNin.type_conge'
        ])->whereHas('congeIdNin.type_conge', function($query) use ($today) {
            $query->where('date_fin_cong', '>', $today)
                ->whereIn('titre_cong', ['exceptionnel']);
        })->count();
         // dd($typecon);

            return view('employees.list_cong',compact('empdepart','typecon','emptypeconge','today','count','countExceptionnel'));

            }

            public function filterByType($typeconge)

            {
                //dd($typeconge);
                $empcng=array();
                $today = Carbon::now()->format('Y-m-d');
                $conge_nin=Conge::select('id_nin')->distinct()->orderBy('date_fin_cong','desc')->get();
                //dd($conge_nin);
                foreach($conge_nin as $cong_emp)
                {
                $query = Employe::query()
                    ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                    ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                    ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
                    ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                    ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                    ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
                    ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
                    ->select(
                        'employes.*',
                        'conges.*',
                        'type_congs.*',
                        'sous_departements.*',
                        'posts.*',
                        DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE()) +1 AS joursRestants')
                    )
                    ->orderBy('date_recrutement','desc')
                    ->where('conges.id_nin',$cong_emp->id_nin);


                if ($typeconge) {
                    $query->where('type_congs.ref_cong', $typeconge)
                          ->where('date_fin_cong', '>', $today);
                }
                $emptypeconge=$query->first();
                array_push($empcng,$emptypeconge);
                }
             //   dd($empcng);

            return response()->json($empcng);

            }





            public function filterbydep($department)
            {



         /**  ------ Original pas suppression ------------------ */       
                //dd($department);
               /* $today = Carbon::now()->format('Y-m-d');
                $query = Employe::query()

                    ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                    ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                    ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
                    ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                    ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                    ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
                    ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
                    ->select(
                        'employes.*',
                        'conges.*',
                        'type_congs.*',
                        'sous_departements.*',
                        'posts.*',
                        DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE())+1  AS joursRestants')
                    );


                //dd($query);
                if ($department) {
                    $query->where('departements.id_depart', $department)
                    ->where('date_fin_cong', '>', $today);
                }
                $emptypeconge = $query->get();
            // dd($emptypeconge);
            return response()->json($emptypeconge);*/


  //dd($typeconge);
  /** ----------------------- jusqu'a la et Original Terminer pas de supperssion ---------------------------------- */




  /** ------------------------- Modification --------------------------------- */
  $today = Carbon::now()->format('Y-m-d');
  $result=array();
  $post=array();
  $id_sous=Sous_departement::where('id_depart',$department)->get();

  foreach($id_sous as $sous_dep)
  {
      //print_r('sous_id '.$sous_dep);
      $id_post=Post::where('sous_departements.id_sous_depart',$sous_dep->id_sous_depart)->select('contients.id_contient')
                     ->join('contients','contients.id_post','=','posts.id_post')
                     ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                     ->get();
      foreach($id_post as $sas)
      array_push($post,$sas->id_contient);
  }
 //--------------------------------------------------------------------------- success ---/////
 $allwor=array();
  $emps=Employe::join('travails','travails.id_nin','=','employes.id_nin')
                 ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                 ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                 ->where('departements.id_depart',$department)
                 ->orderBy('travails.date_installation','desc')
                 ->get();
  foreach($emps as $empl)
  {
      array_push($allwor,$empl);
  }
 // dd($allwor);

   $empdpartcng=array();
   $fis=array();
foreach($allwor as $workig)
  {
      $travs=Travail::where('travails.id_nin',$workig->id_nin)
                      ->join('Employes','Employes.id_nin','=','travails.id_nin')
                      ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                      ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                     // ->where('departements.id_depart',$id_dep)
                      ->orderBy('date_installation','desc')
                      ->first();
    /* foreach($travs as $bind)
      {   */
      if($workig->date_installation <= $travs->date_installation && $travs->id_depart == $department)
      {
          array_push($fis,$travs);
      }
 // }
  }
   //------------------------------------------------------------------until here -----------------------*/
  foreach($fis as $emp)
  {
      $idcnt=Occupe::where('id_nin',$emp->id_nin)->where('contients.id_sous_depart',$emp->id_sous_depart)->select('id_contient')
              ->join('posts','posts.id_post','=','occupes.id_post')
              ->join('contients','contients.id_post','=','posts.id_post')
              ->orderBy('date_recrutement','desc')
              ->first();
      $emps=Employe::join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                     ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                     ->join('occupes','occupes.id_nin','=','employes.id_nin')
                     ->join('posts','posts.id_post','=','occupes.id_post')
                     ->join('contients','contients.id_post','=','posts.id_post')
                     ->join('sous_departements','contients.id_sous_depart','=','sous_departements.id_sous_depart')
                     ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                     ->where('contients.id_contient',$idcnt->id_contient)
                     ->where('employes.id_nin',$emp->id_nin)
                     ->where('conges.date_fin_cong', '>', $today)   
                     ->orderBy('date_recrutement','desc')
                     ->select(
                        'employes.*',
                        'conges.*',
                        'type_congs.*',
                        'sous_departements.*',
                        'posts.*',
                        DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE())+1  AS joursRestants')
                    )
                     ->first();
                     $find=false;
                    // dd($emps);
                    if(isset($emps))
                    {
                     if(count($empdpartcng) >0)
                     {$i=0;

                      while ( $i < count($empdpartcng) && $find == false) {
                          # code...
                         
                          if($empdpartcng[$i]->id_nin == $emps->id_nin )
                          {

                              $find = true;
                             // print_r('------- insrt:::'.$emps->id_nin.'find');
                          }
                        

                          $i++;
                      }
                      if($find != true)
                      {
                          //print_r('------- insrt:::'.$emps->id_nin.' ----- comparing to ::::');
                          $i=0;
                          array_push($empdpartcng,$emps);
                      }
                  }
                  else
                  {
                     // print_r('insrt null'.$emps->id_nin);
                      array_push($empdpartcng,$emps);
                  }
                  }
  }
          $empdepart=Departement::get();
             //   dd($empdpartcng);
            return response()->json($empdpartcng);  
             /** ------------------------- Modification  Terminer--------------------------------- */
            }


        public function filtercongdep($typeconge,$department)
        {
            /** ------------------------ Original Start de la ---------------------------------- */
            /*
            $today = Carbon::now()->format('Y-m-d');
            $query = Employe::query()

                ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
                ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
                ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
                ->select(
                    'employes.*',
                    'conges.*',
                    'type_congs.*',
                    'sous_departements.*',
                    'posts.*',
                    DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE()) +1 AS joursRestants')
                );

                //dd($query);
                if ($typeconge && $department) {
                    $query->where('departements.id_depart', $department)
                        ->where('type_congs.ref_cong', $typeconge)
                        ->where('date_fin_cong', '>', $today);
                }
                $emptypeconge = $query->get();
            //dd($emptypeconge);
            return response()->json($emptypeconge);*/

/**  -------------------------------- Original Termin ici ------------------------------------ */


$today = Carbon::now()->format('Y-m-d');
  $result=array();
  $post=array();
  $id_sous=Sous_departement::where('id_depart',$department)->get();

  foreach($id_sous as $sous_dep)
  {
      //print_r('sous_id '.$sous_dep);
      $id_post=Post::where('sous_departements.id_sous_depart',$sous_dep->id_sous_depart)->select('contients.id_contient')
                     ->join('contients','contients.id_post','=','posts.id_post')
                     ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                     ->get();
      foreach($id_post as $sas)
      array_push($post,$sas->id_contient);
  }
 //--------------------------------------------------------------------------- success ---/////
 $allwor=array();
  $emps=Employe::join('travails','travails.id_nin','=','employes.id_nin')
                 ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                 ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                 ->where('departements.id_depart',$department)
                 ->orderBy('travails.date_installation','desc')
                 ->get();
  foreach($emps as $empl)
  {
      array_push($allwor,$empl);
  }
 // dd($allwor);

   $empdpartcng=array();
   $fis=array();
foreach($allwor as $workig)
  {
      $travs=Travail::where('travails.id_nin',$workig->id_nin)
                      ->join('Employes','Employes.id_nin','=','travails.id_nin')
                      ->join('sous_departements','sous_departements.id_sous_depart','=','travails.id_sous_depart')
                      ->join('departements','sous_departements.id_depart','=','departements.id_depart')
                     // ->where('departements.id_depart',$id_dep)
                      ->orderBy('date_installation','desc')
                      ->first();
    /* foreach($travs as $bind)
      {   */
      if($workig->date_installation <= $travs->date_installation && $travs->id_depart == $department)
      {
          array_push($fis,$travs);
      }
 // }
  }
   //------------------------------------------------------------------until here -----------------------*/
  foreach($fis as $emp)
  {
      $idcnt=Occupe::where('id_nin',$emp->id_nin)->where('contients.id_sous_depart',$emp->id_sous_depart)->select('id_contient')
              ->join('posts','posts.id_post','=','occupes.id_post')
              ->join('contients','contients.id_post','=','posts.id_post')
              ->orderBy('date_recrutement','desc')
              ->first();
      $emps=Employe::join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                     ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                     ->join('occupes','occupes.id_nin','=','employes.id_nin')
                     ->join('posts','posts.id_post','=','occupes.id_post')
                     ->join('contients','contients.id_post','=','posts.id_post')
                     ->join('sous_departements','contients.id_sous_depart','=','sous_departements.id_sous_depart')
                     ->join('departements','departements.id_depart','=','sous_departements.id_depart')
                     ->where('contients.id_contient',$idcnt->id_contient)
                     ->where('employes.id_nin',$emp->id_nin)
                     ->where('conges.date_fin_cong', '>', $today)  
                     ->where('type_congs.ref_cong', $typeconge) 
                     ->orderBy('date_recrutement','desc')
                     ->select(
                        'employes.*',
                        'conges.*',
                        'type_congs.*',
                        'sous_departements.*',
                        'posts.*',
                        DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE())+1  AS joursRestants')
                    )
                     ->first();
                     $find=false;
                    // dd($emps);
                    if(isset($emps))
                    {
                     if(count($empdpartcng) >0)
                     {$i=0;

                      while ( $i < count($empdpartcng) && $find == false) {
                          # code...
                         
                          if($empdpartcng[$i]->id_nin == $emps->id_nin )
                          {

                              $find = true;
                             // print_r('------- insrt:::'.$emps->id_nin.'find');
                          }
                        

                          $i++;
                      }
                      if($find != true)
                      {
                          //print_r('------- insrt:::'.$emps->id_nin.' ----- comparing to ::::');
                          $i=0;
                          array_push($empdpartcng,$emps);
                      }
                  }
                  else
                  {
                     // print_r('insrt null'.$emps->id_nin);
                      array_push($empdpartcng,$emps);
                  }
                  }
  }
          $empdepart=Departement::get();
             //   dd($empdpartcng);
            return response()->json($empdpartcng);  

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
                    if($request->get('date_dcg') < $cg->date_fin_cong  && $request->get('type_cg') == 'RF001')
                    {

                        return response()->json([
                            'type'=>$cg->type_cg,
                            'message'=>'Unsuccess verfier date du debut 1',
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
                if(Carbon::now()->year >= $cng[0]->annee  && $request->get('type_cg') == 'RF001')
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


            //  dd($cng[0]);
            if($cng[0]->date_fin_cong < $request->get('date_dcg'))
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
                    'message'=>'Unsuccess verfier la date du debut 2',
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


            function existToAdd($id)
            {
              $employe=Employe::where('id_nin', $id)->firstOrFail();
              $niv=new Niveau();
              $dbniv=$niv->SELECT('Nom_niv','Specialité','Specialité_ar','Nom_niv_ar')->distinct()->get();
              $dbempdepart = new Departement();
              $empdepart =$dbempdepart->get();
              if(app()->getLocale() == 'ar')
              {
             //   dd(app()->getLocale());
              }

              return view('addTemplate.travaill',compact('employe','dbniv','empdepart'));
            }
            function existApp($id)
            {
              $employe=Employe::where('id_nin', $id)->firstOrFail();
              $bureau=new Bureau();
              $Direction= new Departement();
              $SDirection=new Sous_departement();
              $dbsdirection=$SDirection->get();
              $dbdirection=$Direction->get();
              $dbbureau=$bureau->get();
              $dbdirection=$Direction->get();
              $Appartient=Appartient::where('id_nin', $id)->get();
              $post=New Post();
              $dbpost=$post->get();
              $dbempdepart = new Departement();
                  $empdepart =$dbempdepart->get();
                  //dd(app()->getLocale());
              return view('addTemplate.admin',compact('employe','dbbureau','dbdirection','dbpost','dbsdirection','empdepart'));
            }
            function find_emp($id)
            {
                $find=Employe::where('id_nin',$id)->first();
                if($find)
                {
                    return response()->json(['success'=>'exist','status'=>200,'data'=>$find]);
                }
                else
                {
                    return response()->json(['success'=>'not fund','status'=>302]);
                }
            }
            public function get_list_absemp($id)
            {
                $emp=Employe::where('id_nin',$id)->first();
                $list_abs=Absence::where('id_nin',$id)->orderBy('date_abs','desc')
                                  ->select('date_abs', 'heure_abs','statut', 'id_nin', 'id_p', 'id_sous_depart')
                                  ->distinct()
                                  ->get();
                $perPage = 5; // Par exemple, 2 éléments par page
                    $page = request()->get('page',
                                                ); // Page actuelle
                    $offset = ($page - 1) * $perPage;

                    // Extraire les éléments pour la page actuelle
                    $items = $list_abs->slice($offset, $perPage)->values();
                    //dd($items);
                    // Créer le paginator
                    $paginator = new LengthAwarePaginator(
                    $items, // Items de la page actuelle
                    $list_abs->count(), // Nombre total d'éléments
                    $perPage, // Nombre d'éléments par page
                    $page, // Page actuelle
                    [
                   'path' => request()->url(), // URL actuelle
                  'query' => request()->query() // Paramètres de la requête
                     ]
                    );
                    return response()->json(['emp'=>$emp,
                                              'list_abs'=>$paginator  
                                            ]);
            }

}
