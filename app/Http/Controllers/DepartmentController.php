<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employe;
use App\Models\Departement;
use App\Models\Sous_departement;
use App\Http\Requests\saveDepartementRequest;
use Illuminate\Support\Facades\Log;


class DepartmentController extends Controller
{
    public function ListeDepart()
    {

        $empdepart=Departement::get();


return view('department.liste', compact('empdepart'));

    }


    public function dashboard_depart(Request $request,$dep_id)
    {


   // Récupérer les paramètres de tri depuis la requête
   $champs = $request->input('champs', 'Nom_emp'); // Champ de tri par défaut
   $direction = $request->input('direction', 'asc'); // Direction de tri par défaut

   $empdep = Employe::with([
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
//le tri
    if ($champs === 'age') {
        $empdep = $empdep->sortBy(function($emp) {
            return \Carbon\Carbon::parse($emp->Date_nais)->age;
            }, SORT_REGULAR, $direction === 'desc');

    } elseif ($champs === 'Nom_post') {
        $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->occupeIdNin->first())->post->Nom_post;
            }, SORT_REGULAR, $direction === 'desc');

    } elseif ($champs === 'Nom_depart') {
        $empdep = $empdep->sortBy(function($emp) {
            return optional(optional($emp->travailByNin->first())->sous_departement->departement)->Nom_depart;
            }, SORT_REGULAR, $direction === 'desc');

    } elseif ($champs === 'Nom_sous_depart') {
        $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->travailByNin->first())->sous_departement->Nom_sous_depart;
            }, SORT_REGULAR, $direction === 'desc');

    } elseif ($champs === 'date_recrutement') {
        $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->occupeIdNin->first())->date_recrutement;
            }, SORT_REGULAR, $direction === 'desc');//optiinal evite l'erreur si la relatiion est abscente ,sort_regular:le tri est effectué de manière standard

        } elseif ($champs === 'date_installation') {
        $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->travailByNin->first())->date_installation;
            }, SORT_REGULAR, $direction === 'desc');

        } else {
        $empdep = $empdep->sortBy($champs, SORT_REGULAR, $direction === 'desc');
    }

    $empdep = $empdep->values();



/*
        $empdep = DB::table('employes')
        ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
        ->join('contients', 'posts.id_post', '=', 'contients.id_post')
        ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')

        ->join('travails','employes.id_nin','=','travails.id_nin')
        ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
        ->where('departements.id_depart', $dep_id)

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

        $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart');

       /* $nom_d = DB::table('departements')
        ->where('id_depart', $dep_id)
        ->value('Nom_depart');*/

//le nbr total des employe pour chaque depart
        $totalEmpDep = $empdep->count();

return view('department.dashboard_depart', compact('empdep','empdepart','nom_d','dep_id','champs','direction'));
    }


    public function AddDepart($dep_id)
    {
        $empdep = DB::table('employes')
        ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
        ->join('contients', 'posts.id_post', '=', 'contients.id_post')
        ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')

        ->join('travails','employes.id_nin','=','travails.id_nin')
        ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
        ->where('departements.id_depart', $dep_id)

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

        $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart');

       /* $nom_d = DB::table('departements')
        ->where('id_depart', $dep_id)
        ->value('Nom_depart');*/

//le nbr total des employe pour chaque depart
        $gi = $empdep->count();


        return view('department.add_depart', compact('empdep','empdepart','nom_d'));
    }
    public function store(saveDepartementRequest $request)

    {
        Departement::create($request->all());
       /* return back()->with("succes","la direction a ete créé");
            /* $request->validate([
            'id_depart' => 'required|unique:departements',
            /*'id_sous_depart' => 'required|unique:sous_departements',*/
         /*   'Nom_depart' => 'required',
            'Descriptif_depart' => 'required',
            'Nom_depart_ar' => 'required',
            'Descriptif_depart_ar' => 'required',
           /* 'Nom_sous_depart' => 'required',
            'Descriptif_sous_depart' => 'required',
            'Nom_sous_depart_ar' => 'required',
            'Descriptif_sous_depart_ar' => 'required',*/

       /* ]);
        Departement::create($request->all());

        return redirect('/departements')->with('success', 'direction ajouté avec succès.');
       /* dd($request);
        Departement::create([
            $request->get('id_depart'),
            $request->get('Nom_depart'),
            $request->get('Descriptif_depart'),
            $request->get('Nom_depart_ar'),
            $request->get('Descriptif_depart_ar'),

            ]);
            $deprt=Departement::get();
            if (re)
        return response()->json([
            'message'=>'success',
            'dert'=>$deprt,
            'code'=>200
        ]);*/
        /*select departement.id_depat from departement where nom_depart = $request*/
      /*  Sous_departement::create([
            $request->get('id_depart'),
            $request->get('Nom_depart'),
            $request->get('Descriptif_depart'),
            $request->get('Nom_depart_ar'),
            $request->get('Descriptif_depart_ar'),


            ]);
            $s_deprt=Sous_departement::get();
        return response()->json([
            'message'=>'success',
            's_dert'=>$s_deprt,
            'code'=>200
        ]);*/
    }


}
