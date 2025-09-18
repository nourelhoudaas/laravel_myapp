<?php
namespace App\Http\Controllers;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Post;
use App\Models\Sous_departement;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response\render;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class DepartmentController extends Controller
{

//la page qui affiche la liste des départements avec ajax
    public function listDepartments(Request $request)
    {
       try {
            $empdepart = Departement::all();
            if ($request->ajax()) {
                // Correctly render the view's HTML for AJAX
                return view('department.list_departments', compact('empdepart'))->render();
            }
            // For non-AJAX requests
            return view('department.list_departments', compact('empdepart'));
        } catch (\Exception $e) {
            \Log::error('Error in listDepartments: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
            }
            throw $e;
        }
    }

    // Exporter la liste des employés d'un département en PDF
    public function exportDepartmentEmployees(Request $request, $dep_id)
    {
        try {
            // Récupérer le département avec la clé primaire correcte
            $department = Departement::where('id_depart', $dep_id)->firstOrFail();

            // Définir la locale
            $locale = Session::get('locale', 'fr');
            App::setLocale($locale);

            // Récupérer les sous-départements associés au département
            $sousDepartements = Sous_departement::where('id_depart', $dep_id)->pluck('id_sous_depart');

            // Récupérer les employés liés au département via la table travails
            $employe = Employe::with([
                'occupeIdNin' => function ($query) {
                    $query->with(['post', 'postsup', 'fonction']);
                },
                'travail' => function ($query) use ($sousDepartements) {
                    $query->whereIn('id_sous_depart', $sousDepartements)
                          ->with('sous_departement');
                }
            ])->whereHas('travail', function ($query) use ($sousDepartements) {
                $query->whereIn('id_sous_depart', $sousDepartements);
            })->get();

            Log::info('Employees fetched for department ID ' . $dep_id . ': ' . $employe->count());

            // Générer le PDF avec la vue liste_globale
            $pdf = PDF::loadView('impression.departement_liste', [
                'employe' => $employe,
                'locale' => $locale,
                'department' => $department
            ])->setPaper('a4')
              ->setOrientation('landscape')
              ->setOption('encoding', 'utf-8')
              ->setOption('enable-local-file-access', true)
              ->setOption('disable-smart-shrinking', false);

              return $pdf->stream('Liste des employés - globale_depart.pdf');
            //return view('impression.departement_liste', compact('employe', 'department'));
            
        } catch (\Exception $e) {
        Log::error('Échec de la génération PDF : ' . $e->getMessage());
        return response()->json(['error' => 'Échec de la génération du PDF'], 500);
    }
    }
    
    public function ListeDepart()
    {
        $departements = Departement::get();

        $empdepart = Departement::with('sous_departement')->get();

        return view('department.liste', compact('empdepart', 'departements'));

    }
    /* public function edit(Departement $departement)
    {

return view('department.edit', compact('departement'));

    }*/

    public function dashboard_depart(Request $request, $dep_id)
    {

                                                           // Récupérer les paramètres de tri depuis la requête
        $champs    = $request->input('champs', 'Nom_emp'); // Champ de tri par défaut
        $direction = $request->input('direction', 'asc');  // Direction de tri par défaut

        $employes = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
        ])->whereNotIn('id_nin', [1254953, 254896989])

            ->get();
        //dd( $empdep);
        //filter fct de laravel
        $empdep = $employes->filter(function ($employe) use ($dep_id) {
            $post            = $employe->occupeIdNin->last()->post ?? null;
            $travail         = $employe->travailByNin->last();
            $sousDepartement = $travail->sous_departement ?? null;
            $departement     = $sousDepartement->departement ?? null;

            // Vérifiez si le département de l'employé correspond à l'ID du département
            return $departement && $departement->id_depart == $dep_id;
        });

        //optional pour si ya null il envoi pas erreur il envoi null
        //SORT_REGULAR veut dire que les éléments doivent être triés en utilisant la comparaison des valeurs telles qu'elles sont, sans conversion spéciale.

        if ($champs === 'age') {
            $empdep = $empdep->sortBy(function ($emp) {
                return \Carbon\Carbon::parse($emp->Date_nais)->age;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'Nom_post') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional($emp->occupeIdNin->last())->post->Nom_post;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'Nom_depart') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional(optional($emp->travailByNin->last())->sous_departement->departement)->Nom_depart;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'Nom_sous_depart') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional($emp->travailByNin->last())->sous_departement->Nom_sous_depart;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'date_recrutement') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional($emp->occupeIdNin->last())->date_recrutement;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'date_installation') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional($emp->travailByNin->last())->date_installation;
            }, SORT_REGULAR, $direction === 'desc');
        } else {
            $empdep = $empdep->sortBy($champs, SORT_REGULAR, $direction === 'desc');
        }

        $empdep = $empdep->values();
        $locale = app()->getLocale();
        //dd($empdep);
        $empdepart = Departement::get();

        /*$empdepart= DB::table('departements')
                    ->get();*/
        if ($locale == 'fr') {
            $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart');
        } elseif ($locale == 'ar') {
            $nom_d = Departement::where('id_depart', $dep_id)->value('Nom_depart_ar');
        }

        /* $nom_d = DB::table('departements')
                    ->where('id_depart', $dep_id)
                    ->value('Nom_depart');*/

        //le nbr total des employe pour chaque depart
        $totalEmpDep = $empdep->count();
        // dd($totalEmpDep);

                      // Définir le nombre d'éléments par page
        $perPage = 2; // Par exemple, 2 éléments par page
        $page    = 1; // Page actuelle
        if (request()->get('page') != null) {
            $page = request()->get('page');
        }
        $offset = ($page - 1) * $perPage;

        // Extraire les éléments pour la page actuelle
        $items = $empdep->slice($offset, $perPage)->values();
        //dd($items);

        // Créer le paginator
        $paginator = new LengthAwarePaginator(
            $items,           // Items de la page actuelle
            $empdep->count(), // Nombre total d'éléments
            $perPage,         // Nombre d'éléments par page
            $page,            // Page actuelle
            [
                'path'  => request()->url(),   // URL actuel
                'query' => request()->query(), // Paramètres de la requête
            ]
        );
        /************************encadrement_maitris_executif*************** */
/***********************************************Employe $fonction superieur***********************************************/
/********************************************************************************************************************************* */
        $fs = Employe::join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
        ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        //->where('occupes.type_CTR', '=', 'Fonctinnaire')
        ->whereNotNull('occupes.id_fonction')
        ->whereNull('occupes.id_postsup')
        ->whereNotIn('employes.id_nin', [1254953, 254896989]) // Ajouté pour cohérence avec les requêtes précédentes, si non nécessaire, retirez-le
        ->where('sous_departements.id_depart', '=', $dep_id)
        ->whereRaw('occupes.date_recrutement = (
            SELECT MAX(o2.date_recrutement)
            FROM occupes o2
            WHERE o2.id_nin = employes.id_nin
        )')
        ->whereRaw('travails.date_installation = (
            SELECT MAX(t2.date_installation)
            FROM travails t2
            WHERE t2.id_nin = employes.id_nin
        )')
            ->count();
        //dd( $dep_id,$fs);
/***********************************************Employe $post superieur***********************************************/
/********************************************************************************************************************************* */
        $ps = Employe::join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
        ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        //->where('occupes.type_CTR', '=', 'Fonctinnaire')
        ->whereNull('occupes.id_fonction')
        ->whereNotNull('occupes.id_postsup')
        ->whereNotIn('employes.id_nin', [1254953, 254896989]) // Ajouté pour cohérence avec les requêtes précédentes, si non nécessaire, retirez-le
        ->where('sous_departements.id_depart', '=', $dep_id)
        ->whereRaw('occupes.date_recrutement = (
            SELECT MAX(o2.date_recrutement)
            FROM occupes o2
            WHERE o2.id_nin = employes.id_nin
        )')
        ->whereRaw('travails.date_installation = (
            SELECT MAX(t2.date_installation)
            FROM travails t2
            WHERE t2.id_nin = employes.id_nin
        )')
            ->count();
        //dd( $ps, $dep_id);
/***********************************************Employe $contrat actuel (CDI)***********************************************/
/********************************************************************************************************************************* */
        $ca = Employe::join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
        ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        ->where('occupes.type_CTR', '=', 'CDI')
        ->whereNull('occupes.id_fonction')
        ->whereNull('occupes.id_postsup')
        ->whereNotIn('employes.id_nin', [1254953, 254896989]) // Ajouté pour cohérence avec les requêtes précédentes, si non nécessaire, retirez-le
        ->where('sous_departements.id_depart', '=', $dep_id)
        ->whereRaw('occupes.date_recrutement = (
            SELECT MAX(o2.date_recrutement)
            FROM occupes o2
            WHERE o2.id_nin = employes.id_nin
        )')
        ->whereRaw('travails.date_installation = (
            SELECT MAX(t2.date_installation)
            FROM travails t2
            WHERE t2.id_nin = employes.id_nin
        )')
            ->count();
       // dd( $ca);

/***********************************************Employe $corps commun (fonctionnaire)***********************************************/
/********************************************************************************************************************************* */
        $cc = Employe::join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
        ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
        ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
        ->where('occupes.type_CTR', '=', 'Fonctinnaire')
        ->whereNull('occupes.id_fonction')
        ->whereNull('occupes.id_postsup')
        ->whereNotIn('employes.id_nin', [1254953, 254896989]) // Ajouté pour cohérence avec les requêtes précédentes, si non nécessaire, retirez-le
        ->where('sous_departements.id_depart', '=', $dep_id)
        ->whereRaw('occupes.date_recrutement = (
            SELECT MAX(o2.date_recrutement)
            FROM occupes o2
            WHERE o2.id_nin = employes.id_nin
        )')
        ->whereRaw('travails.date_installation = (
            SELECT MAX(t2.date_installation)
            FROM travails t2
            WHERE t2.id_nin = employes.id_nin
        )')
            ->count();
        //dd( $cc);
        return view('department.dashboard_depart', compact('paginator', 'empdep', 'empdepart', 'totalEmpDep', 'nom_d', 'dep_id', 'champs', 'direction', 'fs', 'ps', 'ca', 'cc'));
    }

    public function AddDepart($dep_id)
    {
        $empdep = DB::table('employes')
            ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->join('contients', 'posts.id_post', '=', 'contients.id_post')
            ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')

            ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
            ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
            ->where('departements.id_depart', $dep_id)

            ->get();

        $empdepart = Departement::get();
        $nom_d     = Departement::where('id_depart', $dep_id)->value('Nom_depart');

        $gi           = $empdep->count();
        $departements = Departement::get();

        return view('department.add_depart', compact('empdep', 'empdepart', 'nom_d', 'departements'));

        /*$empdep=Employe::with([
        'occupeIdNin.post.contient.sous_departement.departement',
        'occupeIdP.post.contient.sous_departement.departement',
        'travailByNin.sous_departement.departement',
        'travailByP.sous_departement.departement'
    ])->whereHas('travailByNin.sous_departement.departement', function ($query) use ($dep_id) {
        $query->where('id_depart', $dep_id);

    })->get();*/
//dd($empdep);

/*$empdepart= DB::table('departements')
->get();*/

        /* $nom_d = DB::table('departements')
        ->where('id_depart', $dep_id)
        ->value('Nom_depart');*/

//le nbr total des employe pour chaque depart

    }

    public function store_sous(Request $request)
    {

    }

    // Check if the department name already exists
    public function checkName(Request $request)
    {
        $exists = Departement::where('Nom_depart', $request->nom)
            ->orWhere('Nom_depart_ar', $request->nom)
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        // Vérifie si le département existe déjà
        $existingDepart = Departement::where('Nom_depart', $request->get('Nom_depart'))->first();

        if ($existingDepart) {
            // Rediriger avec un message d’erreur
            //dd('Ce département existe déjà.');
            return redirect()->back()->withInput()->with('error', 'Ce département existe déjà.');
        }

        // Création du département
        $departement = Departement::create([
            'Nom_depart'           => $request->get('Nom_depart'),
            'Descriptif_depart'    => $request->get('Descriptif_depart'),
            'Nom_depart_ar'        => $request->get('Nom_depart_ar'),
            'Descriptif_depart_ar' => $request->get('Descriptif_depart_ar'),
        ]);

        // Création du sous-département lié
        DB::table('sous_departements')->insert([
            'id_depart'                 => $departement->id_depart,
            'Nom_sous_depart'           => $request->get('Nom_sous_depart'),
            'Descriptif_sous_depart'    => $request->get('Descriptif_sous_depart'),
            'Nom_sous_depart_ar'        => $request->get('Nom_sous_depart_ar'),
            'Descriptif_sous_depart_ar' => $request->get('Descriptif_sous_depart_ar'),
        ]);

        // Chargement des données
        $departements = Departement::get();
        $empdepart    = Departement::with('Sous_departement')->get();

        return view('department.liste', compact('departements', 'empdepart'))
            ->with('success', 'Direction créée avec succès.');

        /*([

        ]);-*/
        //  $sdb->save();
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

  ode'=>200
        ]);*/

    }
    public function editer($nom)
    {
        $departement = Departement::where('id_depart', $nom)->firstOrFail();
        $empdepart   = Departement::get();
        // dd( $departement);
        return view('department.editer', compact('departement', 'empdepart'));

    }

    public function update(Request $request, $id)
    {

        $departement = Departement::where('id_depart', $id)->update(['Nom_depart' => $request->input('Nom_depart'), 'Descriptif_depart'       => $request->input('Descriptif_depart'),
            'Nom_depart_ar'                                                           => $request->input('Nom_depart_ar'), 'Descriptif_depart_ar' => $request->input('Descriptif_depart_ar')]);

        return redirect('/liste');

    }

    public function get_emp_dep($id)
    {
        $employes = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
        ])->whereNotIn('employes.id_nin', [1254953, 254896989])
            ->get();
        //dd( $empdep);
        //filter fct de laravel
        $empdep = $employes->filter(function ($employe) use ($id) {
            $post            = $employe->occupeIdNin->last()->post ?? null;
            $travail         = $employe->travailByNin->last();
            $sousDepartement = $travail->sous_departement ?? null;
            $departement     = $sousDepartement->departement ?? null;

            // Vérifiez si le département de l'employé correspond à l'ID du département
            return $departement && $departement->id_depart == $id;
        });

        return response()->json(
            [
                'nbr'     => $empdep->count(),
                'success' => 200,
            ]
        );
    }

    public function delete($id_depart)
    {

        $departement = new Departement();
        $departement->where('id_depart', '=', $id_depart)->delete();

        return redirect()->back()->with('success_message', 'Direction Supprimé');

    }

    public function get_sdic($id_depart)
    {
        $sous_dep = Sous_departement::where('id_depart', $id_depart)->get();
        if ($sous_dep) {
            return response()->json(['success' => 'exist', 'status' => 200, 'data' => $sous_dep]);
        } else {
            return response()->json(['success' => 'empty', 'status' => 302]);
        }
    }
    public function liste_contient(Request $request, $ss_dep)
    {
        $empdepart = Departement::with('sous_departement')->get();
        $direction = $request->input('direction', 'asc');

        $nom_d = Sous_departement::where('Nom_sous_depart')->value('Nom_sous_depart');
                                                           /////
        $champs    = $request->input('champs', 'Nom_emp'); // Champ de tri par défaut
        $direction = $request->input('direction', 'asc');  // Direction de tri par défaut

        $employes = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
        ])->whereNotIn('employes.id_nin', [1254953, 254896989])

            ->get();
        //dd( $empdep);
        //filter fct de laravel
        $empdep = $employes->filter(function ($employe) {
            $post = $employe->occupeIdNin->last()->post ?? null;

            $sousDepartement = $travail->sous_departement ?? null;
            $departement     = $sousDepartement->departement ?? null;

            // Vérifiez si le département de l'employé correspond à l'ID du département
            return $departement && $departement->id_depart;
        });

        //optional pour si ya null il envoi pas erreur il envoi null
        //SORT_REGULAR veut dire que les éléments doivent être triés en utilisant la comparaison des valeurs telles qu'elles sont, sans conversion spéciale.

        if ($champs === 'Nom_post') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional($emp->occupeIdNin->last())->post->Nom_post;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'Nom_depart') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional(optional($emp->travailByNin->last())->sous_departement->departement)->Nom_depart;
            }, SORT_REGULAR, $direction === 'desc');

        } elseif ($champs === 'Nom_sous_depart') {
            $empdep = $empdep->sortBy(function ($emp) {
                return optional($emp->travailByNin->last())->sous_departement->Nom_sous_depart;
            }, SORT_REGULAR, $direction === 'desc');

        } else {
            $empdep = $empdep->sortBy($champs, SORT_REGULAR, $direction === 'desc');
        }

        $empdep = $empdep->values();
        $locale = app()->getLocale();
        //dd($empdep);
        $empdepart = Departement::get();

        /*$empdepart= DB::table('departements')
                    ->get();*/
        if ($locale == 'fr') {
            $nom_d = Sous_departement::where('Nom_sous_depart', $ss_dep)->value('Nom_sous_depart');
        } elseif ($locale == 'ar') {
            $nom_d = Sous_departement::where('Nom_sous_depart', $ss_dep)->value('Nom_sous_depart_ar');
        }

        //le nbr total des employe pour chaque depart
        $totalEmpDep = $empdep->count();
        // dd($totalEmpDep);

                      // Définir le nombre d'éléments par page
        $perPage = 5; // Par exemple, 2 éléments par page
        $page    = 1; // Page actuelle
        if (request()->get('page') != null) {
            $page = request()->get('page');
        }
        $offset = ($page - 1) * $perPage;

        // Extraire les éléments pour la page actuelle
        $items = $empdep->slice($offset, $perPage)->values();
        //dd($items);

        // Créer le paginator
        $paginator = new LengthAwarePaginator(
            $items,           // Items de la page actuelle
            $empdep->count(), // Nombre total d'éléments
            $perPage,         // Nombre d'éléments par page
            $page,            // Page actuelle
            [
                'path'  => request()->url(),   // URL actuel
                'query' => request()->query(), // Paramètres de la requête
            ]
        );
        /************************encadrement_maitris_executif*************** */
        $encadrement = Employe::
            join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->where('posts.Grade_post', '>', 11)
            ->whereNotIn('employes.id_nin', [1254953, 254896989])
            ->whereRaw('occupes.date_recrutement = (
                    SELECT MAX(o2.date_recrutement)
                    FROM occupes o2
                    WHERE o2.id_nin = employes.id_nin
                )')->count();
        // dd( $encadrement);

        $maitrise = DB::table('employes')
            ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->whereBetween('posts.Grade_post', [7, 11])
            ->whereNotIn('employes.id_nin', [1254953, 254896989])
            ->whereRaw('occupes.date_recrutement = (
                   SELECT MAX(o2.date_recrutement)
                   FROM occupes o2
                   WHERE o2.id_nin = employes.id_nin
               )')->count();
        //dd( $maitrise);

        $executif = DB::table('employes')
            ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->where('posts.Grade_post', '<', 7)
            ->whereNotIn('employes.id_nin', [1254953, 254896989])
            ->whereRaw('occupes.date_recrutement = (
                   SELECT MAX(o2.date_recrutement)
                   FROM occupes o2
                   WHERE o2.id_nin = employes.id_nin
               )')->count();
        // dd( $executif);

        return view('department.listcontient', compact('paginator', 'empdep', 'empdepart', 'totalEmpDep', 'nom_d', 'champs', 'direction', 'encadrement', 'maitrise', 'executif'));
    }
// Méthode pour afficher le formulaire d'ajout d'une sous-direction
    public function createSubDepart()
    {
        $departments = Departement::all();
        $empdepart   = Departement::all();
        return view('sub_departments.create', compact('departments', 'empdepart'));
    }
    /* public function dashboard_sous()
    {
        $alldepart=Departement::get();

        return view('department.add_sous_depart',compact('alldepart'));
    }*/
    public function indexSubDepart()
    {
        $subDepartments = Sous_departement::with('departement')->get();
        $empdepart      = Departement::all();
        return view('sub_departments.index', compact('subDepartments', 'empdepart'));
    }

    public function storeSubDepart(Request $request)
    {
        $request->validate([
            'id_depart'                 => 'required|exists:departements,id_depart',
            'Nom_sous_depart'           => 'required|string|max:255',
            'Descriptif_sous_depart'    => 'nullable|string',
            'Nom_sous_depart_ar'        => 'required|string|max:255',
            'Descriptif_sous_depart_ar' => 'nullable|string',
        ]);

        $subDepartment                            = new Sous_departement();
        $subDepartment->id_depart                 = $request->id_depart;
        $subDepartment->Nom_sous_depart           = $request->Nom_sous_depart;
        $subDepartment->Descriptif_sous_depart    = $request->Descriptif_sous_depart;
        $subDepartment->Nom_sous_depart_ar        = $request->Nom_sous_depart_ar;
        $subDepartment->Descriptif_sous_depart_ar = $request->Descriptif_sous_depart_ar;
        $subDepartment->save();

        //$subDepartment->load('departments');

        return redirect()->route('app_liste_sub_dir')
            ->with('success', 'Sous-direction ajoutée avec succès.')
            ->with('subDepartment', $subDepartment);
    }
    public function edit($id)
    {
        $subDepartment = Sous_departement::with('departement')->findOrFail($id);
        $departments   = Departement::all();
        $empdepart     = Departement::all();                                                       // Ajoute $empdepart
        return view('sub_departments.edit', compact('subDepartment', 'departments', 'empdepart')); // Ajoute empdepart dans compact
    }

    public function updatesub(Request $request, $id)
    {
        $subDepartment = Sous_departement::findOrFail($id);

        $request->validate([
            'id_depart'                 => 'required|exists:departements,id_depart',
            'Nom_sous_depart'           => 'required|string|max:255',
            'Descriptif_sous_depart'    => 'nullable|string',
            'Nom_sous_depart_ar'        => 'required|string|max:255',
            'Descriptif_sous_depart_ar' => 'nullable|string',
        ]);

        $subDepartment->update([
            'id_depart'                 => $request->id_depart,
            'Nom_sous_depart'           => $request->Nom_sous_depart,
            'Descriptif_sous_depart'    => $request->Descriptif_sous_depart,
            'Nom_sous_depart_ar'        => $request->Nom_sous_depart_ar,
            'Descriptif_sous_depart_ar' => $request->Descriptif_sous_depart_ar,
        ]);

        $subDepartment->load('departement');

        return redirect()->route('app_liste_sub_dir')
            ->with('success', 'Sous-direction mise à jour avec succès.');
    }

    public function destroySubDepart($id)
    {
        $subDepartment = Sous_departement::findOrFail($id);
        $subDepartment->delete();
        return redirect()->route('app_liste_sub_dir')
            ->with('success', 'Sous-direction supprimée avec succès.');
    }

    public function dashboardSubDepart($id)
    {
        $subDepartment = Sous_departement::with('department')->findOrFail($id);
        $empdepart     = Departement::all();
        return view('sub_departments.dashboard', compact('subDepartment', 'empdepart'));
    }

}
