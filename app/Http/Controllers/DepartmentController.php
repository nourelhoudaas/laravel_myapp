<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use DB;
use App\Models\Employe;
use App\Models\Departement;
use App\Models\Sous_departement;
use App\Models\Travail;
use App\Models\Post;
use App\Http\Requests\saveDepartementRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class DepartmentController extends Controller
{
    public function ListeDepart()
    {
        $departements = Departement::paginate(5);

       $empdepart=Departement::with('sous_departement')->get();


return view('department.liste', compact('empdepart','departements'));

    }
   /* public function edit(Departement $departement)
    {



return view('department.edit', compact('departement'));

    }*/


    public function dashboard_depart(Request $request,$dep_id)
    {

            // Récupérer les paramètres de tri depuis la requête
            $champs = $request->input('champs', 'Nom_emp'); // Champ de tri par défaut
            $direction = $request->input('direction', 'asc'); // Direction de tri par défaut

            $employes = Employe::with([
                'occupeIdNin.post',
                'travailByNin.sous_departement.departement'
            ])
            ->get();
            //dd( $empdep);
            //filter fct de laravel
            $empdep = $employes->filter(function($employe) use ($dep_id) {
                $post = $employe->occupeIdNin->last()->post ?? null;
                $travail = $employe->travailByNin->last();
                $sousDepartement = $travail->sous_departement ?? null;
                $departement = $sousDepartement->departement ?? null;

                // Vérifiez si le département de l'employé correspond à l'ID du département
                return $departement && $departement->id_depart == $dep_id;
            });

            //optional pour si ya null il envoi pas erreur il envoi null
            //SORT_REGULAR veut dire que les éléments doivent être triés en utilisant la comparaison des valeurs telles qu'elles sont, sans conversion spéciale.

            if ($champs === 'age') {
            $empdep = $empdep->sortBy(function($emp) {
                return \Carbon\Carbon::parse($emp->Date_nais)->age;
            }, SORT_REGULAR, $direction === 'desc');

            } elseif ($champs === 'Nom_post') {
            $empdep = $empdep->sortBy(function($emp) {
                return optional($emp->occupeIdNin->last())->post->Nom_post;
            }, SORT_REGULAR, $direction === 'desc');


            } elseif ($champs === 'Nom_depart') {
            $empdep = $empdep->sortBy(function($emp) {
            return optional(optional($emp->travailByNin->last())->sous_departement->departement)->Nom_depart;
            }, SORT_REGULAR, $direction === 'desc');

            } elseif ($champs === 'Nom_sous_depart') {
            $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->travailByNin->last())->sous_departement->Nom_sous_depart;
            }, SORT_REGULAR, $direction === 'desc');

            } elseif ($champs === 'date_recrutement') {
            $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->occupeIdNin->last())->date_recrutement;
            }, SORT_REGULAR, $direction === 'desc');

            } elseif ($champs === 'date_installation') {
            $empdep = $empdep->sortBy(function($emp) {
            return optional($emp->travailByNin->last())->date_installation;
            }, SORT_REGULAR, $direction === 'desc');
            } else {
            $empdep = $empdep->sortBy($champs, SORT_REGULAR, $direction === 'desc');
            }

            $empdep = $empdep->values();
            $locale = app()->getLocale();
            //dd($empdep);
                    $empdepart=Departement::get();

                    /*$empdepart= DB::table('departements')
                    ->get();*/
                        if ($locale == 'fr'){
                            $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart');
                        }

                        elseif ($locale == 'ar'){
                            $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart_ar');
                        }



                /* $nom_d = DB::table('departements')
                    ->where('id_depart', $dep_id)
                    ->value('Nom_depart');*/

            //le nbr total des employe pour chaque depart
                    $totalEmpDep = $empdep->count();
                // dd($totalEmpDep);

                    // Définir le nombre d'éléments par page
                $perPage = 5; // Par exemple, 2 éléments par page
                $page = 1; // Page actuelle
                                    if(request()->get('page') != null)
                                    {
                                        $page=   request()->get('page');
                                    }
                $offset = ($page - 1) * $perPage;

                // Extraire les éléments pour la page actuelle
                $items = $empdep->slice($offset, $perPage)->values();
                //dd($items);

                // Créer le paginator
                $paginator = new LengthAwarePaginator(
                    $items, // Items de la page actuelle
                    $empdep->count(), // Nombre total d'éléments
                    $perPage, // Nombre d'éléments par page
                    $page, // Page actuelle
                    [
                        'path' => request()->url(), // URL actuel
                        'query' => request()->query() // Paramètres de la requête
                    ]
                );
        /************************encadrement_maitris_executif*************** */
                $encadrement = Employe::
                join('occupe', 'employes.id_nin', '=', 'occupes.id_nin')
                ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
                ->where('posts.Grade_post', '>', 11)
                ->whereRaw('occupes.date_recrutement = (
                    SELECT MAX(o2.date_recrutement)
                    FROM occupes o2
                    WHERE o2.id_nin = employes.id_nin
                )') ->count();
               // dd( $encadrement);

               $maitrise = DB::table('employes')
               ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
               ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
               ->whereBetween('posts.Grade_post', [7, 11])
               ->whereRaw('occupes.date_recrutement = (
                   SELECT MAX(o2.date_recrutement)
                   FROM occupes o2
                   WHERE o2.id_nin = employes.id_nin
               )') ->count();
              //dd( $maitrise);

               $executif = DB::table('employes')
               ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
               ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
               ->where('posts.Grade_post', '<', 7)
               ->whereRaw('occupes.date_recrutement = (
                   SELECT MAX(o2.date_recrutement)
                   FROM occupes o2
                   WHERE o2.id_nin = employes.id_nin
               )') ->count();
             // dd( $executif);
            return view('department.dashboard_depart', compact('paginator','empdep','empdepart','totalEmpDep','nom_d','dep_id','champs','direction','encadrement','maitrise','executif'));
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

        return redirect()->back()->with('success', 'Direction créé avec succès.');
    }
    public function editer($nom)
    {
  $departement= Departement::where('id_depart',$nom)->firstOrFail();
  $empdepart=Departement::get();
       // dd( $departement);
        return view('department.editer', compact('departement','empdepart'));

    }

    public function update(Request $request, $id)
    {

        $departement= Departement::where('id_depart',$id)->update(['Nom_depart'=>$request->input('Nom_depart'),'Descriptif_depart'=>$request->input('Descriptif_depart'),
        'Nom_depart_ar'=>$request->input('Nom_depart_ar'),'Descriptif_depart_ar'=>$request->input('Descriptif_depart_ar')]);


        return redirect('/liste');

    }





public function get_emp_dep($id)
{
    $employes = Employe::with([
        'occupeIdNin.post',
        'travailByNin.sous_departement.departement'
    ])
    ->get();
    //dd( $empdep);
    //filter fct de laravel
    $empdep = $employes->filter(function($employe) use ($id) {
        $post = $employe->occupeIdNin->last()->post ?? null;
        $travail = $employe->travailByNin->last();
        $sousDepartement = $travail->sous_departement ?? null;
        $departement = $sousDepartement->departement ?? null;

        // Vérifiez si le département de l'employé correspond à l'ID du département
        return $departement && $departement->id_depart == $id;
    });

                  return response()->json(
                    [
                        'nbr'=>$empdep->count(),
                        'success'=>200
                    ]
                    );
}

public function delete($id_depart)
    {

        $departement=new Departement();
            $departement->where('id_depart', '=', $id_depart)->delete(); ;


        return redirect()->back()->with('success_message','Direction Supprimé');

    }


    public function get_sdic($id_depart)
    {
        $sous_dep=Sous_departement::where('id_depart',$id_depart)->get();
        if($sous_dep)
        {
            return response()->json(['success'=>'exist','status'=>200,'data'=>$sous_dep]);
        }
        else
        {
            return response()->json(['success'=>'empty','status'=>302]);
        }
    }


}
