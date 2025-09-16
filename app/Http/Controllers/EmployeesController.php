<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Absence;
//use App\Models\Log;
use App\Models\appartient;
use App\Models\Bureau;
use App\Models\Conge;
use App\Models\Departement;
use App\Models\Dossier;
use App\Models\Employe;
use App\Models\Fonction;
use App\Models\Niveau;
use App\Models\Occupe;
use App\Models\Post;
use App\Models\PostSup;
use App\Models\Sous_departement;
use App\Models\Stocke;
use App\Models\Travail;
use App\Models\type_cong;
use App\Models\User;
use App\Services\logService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Add this line if logService exists in App\Services

class EmployeesController extends Controller
{
 protected $logService;

    // Injecter logService via le constructeur si nécessaire
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    //! IMPRESSION LISTE GLOBALE
public function exportPdf()
    {
        $employe = Employe::with([
            'occupeIdNin.post',
            'occupeIdNin.fonction',
            'occupeIdNin.postsup',
            'travailByNin.sous_departement.departement',
        ])->get();
        log::info($employe);
        Log::info('Liste globale des employés pour impression PDF');

        $empdepart = Departement::get();

        $pdf = PDF::loadView('impression.liste_globale', compact('employe', 'empdepart'))
        ->setPaper('a4', 'landscape')
            ->setOptions([
               'encoding' => 'UTF-8',
            'defaultFont' => 'DejaVuSans', // Définit DejaVuSans comme police par défaut
            'isFontSubsettingEnabled' => true,
            'isRemoteEnabled' => true, // Nécessaire si le fichier est dans public/
            ]);
            return $pdf->stream('liste_globale.pdf'); // Nom du fichier PDF
            //return view('impression.liste_globale', compact('employe', 'empdepart'));
    }
    //! IMPRESSION CATEGORIE
public function exportPdfCatg()
    {
        // Récupérer les employés avec les données associées, filtrés par grade 6-16
        $employe = Employe::with([
            'occupeIdNin.post' => function ($query) {
                $query->whereBetween('Grade_post', [6, 16]);
            },
            'travailByNin.sous_departement.departement'
        ])
        ->whereHas('occupeIdNin.post', function ($query) {
            $query->whereBetween('Grade_post', [6, 16])
                  ->whereDoesntHave('fonctions')
                  ->whereDoesntHave('postSups');
        })
        ->get();

        // Récupérer tous les départements
        $empdepart = Departement::all();

        // Générer le PDF
        $pdf = Pdf::loadView('impression.liste_par_catg', compact('employe', 'empdepart'))
            ->setPaper('a4', 'landscape') // Changé en landscape pour correspondre à la vue
            ->setOptions([
                'encoding' => 'UTF-8',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        return $pdf->stream('Liste_employes_par_categorie.pdf');
    }

    //! IMPRESSION FONCTION
    public function exportPdfFnc()
    {
       $employe = Employe::join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->where('occupes.type_CTR', '=', 'Fonctinnaire')
            ->where(function ($query) {
                $query->whereNotNull('occupes.id_postsup')
                      ->whereNull('occupes.id_fonction')
                      ->orWhere(function ($subQuery) {
                          $subQuery->whereNotNull('occupes.id_fonction')
                                   ->whereNull('occupes.id_postsup');
                      });
            })
            ->whereNotIn('employes.id_nin', [1254953, 254896989])
            ->whereRaw('occupes.date_recrutement = (
                SELECT MAX(o2.date_recrutement)
                FROM occupes o2
                WHERE o2.id_nin = employes.id_nin
            )')
            ->with([
                'occupeIdNin.post',
                'occupeIdNin.fonction',
                'occupeIdNin.postsup',
                'travailByNin.sous_departement.departement',
            ])
            ->select('employes.*')
            ->get();


        $empdepart = Departement::get();

        $pdf = PDF::loadView('impression/liste_par_fnc', compact('employe', 'empdepart'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'encoding' => 'UTF-8',

            ]);
        return $pdf->stream('Liste des employés.pdf');
    }

    //! IMPRESSION CONTRAT ACTUEL
    public function exportPdfCat()
    {
        $employe = Employe::with([
            'occupeIdNin.post',
            'occupeIdNin.fonction',
            'occupeIdNin.postsup',
            'travailByNin.sous_departement.departement',
        ])->get();

        $empdepart = Departement::get();

        $pdf = PDF::loadView('impression/liste_catg', compact('employe', 'empdepart'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'encoding' => 'UTF-8',

            ]);
        return $pdf->stream('Liste des employés.pdf');
    }

    //! IMPRESSION HORS CATEGORIE [0,5]
     public function exportPdfHorsGrade()
    {
        $employe = Employe::join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->whereBetween('posts.Grade_post', [0, 5])
            ->whereRaw('occupes.date_recrutement = (
                SELECT MAX(o2.date_recrutement)
                FROM occupes o2
                WHERE o2.id_nin = employes.id_nin
            )')
            ->with([
                'occupeIdNin.post',
                'occupeIdNin.fonction',
                'occupeIdNin.postsup',
                'travailByNin.sous_departement.departement',
            ])
            ->select('employes.*')
            ->get();

        $empdepart = Departement::get();

        $pdf = PDF::loadView('impression/liste_par_hors_grade', compact('employe', 'empdepart'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'encoding' => 'UTF-8',
            ]);

        return $pdf->stream('Liste des employés par grade 0-5.pdf');
    }

    public function ListeEmply(Request $request)
    {

        $champs    = $request->input('champs', 'Nom_emp'); // Champ par défaut pour le tri
        $direction = $request->input('direction', 'asc');  // Ordre par défaut ascendant
        /* $fct = Fonction::select('id_fonction', 'Nom_fonction')
         ->with(['occupeIdNin:id_occup,id_fonction,date_recrutement']) // Sélectionner les colonnes de la relation
         ->get();
        dd($fct);
  */
        $employe = Employe::with([
            'occupeIdNin.post',
            'occupeIdNin.fonction',
            'occupeIdNin.postsup',
            'travailByNin.sous_departement.departement',

        ])->whereNotIn('id_nin', [1254953, 254896989])
            ->get();
        // dd( $employe);

        //optional pour si ya null il envoi pas erreur il envoi null
        //SORT_REGULAR veut dire que les éléments doivent être triés en utilisant la comparaison des valeurs telles qu'elles sont, sans conversion spéciale.

        if ($champs === 'age') {
            $employe = $employe->sortBy(function ($emp) {
                return Carbon::parse($emp->Date_nais)->age;
            }, SORT_REGULAR, $direction === 'desc');
        } elseif ($champs === 'Nom_post') {
            $employe = $employe->sortBy(function ($emp) {
                return optional($emp->occupeIdNin->last())->post->Nom_post;
            }, SORT_REGULAR, $direction === 'desc');
        } elseif ($champs === 'id_p') {
            $employe = $employe->sortBy(function ($emp) {
                return optional($emp->id_p);
            }, SORT_REGULAR, $direction === 'desc');
        } elseif ($champs === 'Nom_depart') {
            $employe = $employe->sortBy(function ($emp) {
                return optional(optional($emp->travailByNin->last())->sous_departement->departement)->Nom_depart;
            }, SORT_REGULAR, $direction === 'desc');
        } elseif ($champs === 'Nom_sous_depart') {
            $employe = $employe->sortBy(function ($emp) {
                return optional($emp->travailByNin->last())->sous_departement->Nom_sous_depart;
            }, SORT_REGULAR, $direction === 'desc');
        } elseif ($champs === 'date_recrutement') {
            $employe = $employe->sortBy(function ($emp) {
                return optional($emp->occupeIdNin->last())->date_recrutement;
            }, SORT_REGULAR, $direction === 'desc');
        } elseif ($champs === 'date_installation') {
            $employe = $employe->sortBy(function ($emp) {
                return optional($emp->travailByNin->last())->date_installation;
            }, SORT_REGULAR, $direction === 'desc');
        } else {
            $employe = $employe->sortBy($champs, SORT_REGULAR, $direction === 'desc');
        }
        $employe = $employe->values(); // la collection résultante a des clés numériques consécutives.

        $empdepart = Departement::get();

        /*$empdepart= DB::table('departements')
        ->get();*/

        //le nbr total des employe pour chaque depart
        $totalEmployes = $employe->count();
        /*
        // Définir le nombre d'éléments par page
        $perPage = 5; // Par exemple, 2 éléments par page
        $page = 1; // Page actuelle
        if (request()->get('page') != null) {
            $page = request()->get('page');
        }
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
                'path' => request()->url(), // URL actuel
                'query' => request()->query() // Paramètres de la requête
            ]
        );*/
        //dd($locale);
        return view('employees.liste', compact('employe', 'totalEmployes', 'empdepart', 'champs', 'direction'));
    }



public function delete(Request $request, $id_nin)
    {
        // Loguer l'entrée dans la méthode
        Log::info('Appel de la méthode delete avec id_nin : ' . $id_nin);

        // Valider que id_nin est un nombre décimal de 18 chiffres
        if (!preg_match('/^\d{18}$/', $id_nin)) {
            Log::error('Identifiant employé invalide : ' . $id_nin);
            return redirect()->back()->with('error', 'Identifiant employé invalide.');
        }

        // Rechercher l'employé par id_nin
        try {
            $employe = Employe::where('id_nin', $id_nin)->first();

            // Vérifier si l'employé est trouvé
            if (!$employe) {
                Log::error('Employé non trouvé pour id_nin : ' . $id_nin);
                return redirect()->back()->with('error', 'Employé non trouvé.');
            }

            // Loguer l'employé trouvé
            Log::info('Employé trouvé : ' . json_encode($employe->toArray()));

            // Commencer une transaction
            DB::beginTransaction();

            try {
                // Supprimer les enregistrements liés
                Log::info('Suppression des absences pour id_nin : ' . $employe->id_nin);
                Absence::where('id_nin', $employe->id_nin)->delete();
                Absence::where('id_p', $employe->id_p)->delete();

                Log::info('Suppression des appartenances pour id_nin : ' . $employe->id_nin);
                Appartient::where('id_nin', $employe->id_nin)->delete();
                Appartient::where('id_p', $employe->id_p)->delete();

                Log::info('Suppression des congés pour id_nin : ' . $employe->id_nin);
                Conge::where('id_nin', $employe->id_nin)->delete();
                Conge::where('id_p', $employe->id_p)->delete();

                Log::info('Suppression des occupations pour id_nin : ' . $employe->id_nin);
                Occupe::where('id_nin', $employe->id_nin)->delete();
                Occupe::where('id_p', $employe->id_p)->delete();

                Log::info('Suppression des travails pour id_nin : ' . $employe->id_nin);
                Travail::where('id_nin', $employe->id_nin)->delete();
                Travail::where('id_p', $employe->id_p)->delete();

                Log::info('Suppression des utilisateurs pour id_nin : ' . $employe->id_nin);
                User::where('id_nin', $employe->id_nin)->delete();
                User::where('id_p', $employe->id_p)->delete();

                Log::info('Suppression des enregistrements stocke pour id_nin : ' . $employe->id_nin);
                Stocke::where('ref_Dossier', 'Em_' . $employe->id_nin)->delete();

                Log::info('Suppression des dossiers pour id_nin : ' . $employe->id_nin);
                Dossier::where('ref_Dossier', 'Em_' . $employe->id_nin)->delete();

                // Supprimer l'employé
                Log::info('Suppression de l\'employé avec id_nin : ' . $employe->id_nin);
                $employe->delete();

                // Enregistrer l'action dans la table log APRÈS la suppression
                $this->logService->logAction(
                    Auth::user()->id,
                    $id_nin, // Utiliser $id_nin directement
                    'supprimer un employé',
                    $this->logService->getMacAddress()
                );

                // Valider la transaction
                DB::commit();
                Log::info('Suppression réussie pour l\'employé avec id_nin : ' . $id_nin);

                return redirect()->route('app_liste_emply')->with('success', 'Employé et ses enregistrements associés supprimés avec succès.');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Erreur lors de la suppression des enregistrements liés pour id_nin : ' . $id_nin . ' - Message : ' . $e->getMessage());
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression de l\'employé : ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la recherche de l\'employé avec id_nin : ' . $id_nin . ' - Message : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la recherche de l\'employé : ' . $e->getMessage());
        }
    }




    public function AddEmply()
    {
        return view('employees.add');
    }

    public function AbsenceEmply()
    {

        $employe = Employe::with([
            'occupeIdNin.post.contient.sous_departement.departement',
            'occupeIdP.post.contient.sous_departement.departement',
        ])->get();

        $empdepart = DB::table('departements')
            ->get();

        //le nbr total des employés
        $totalEmployes = $employe->count();
        return view('employees.liste_abs', compact('employe', 'totalEmployes', 'empdepart'));
    }

    public function createF()
    {
        $dbempdepart = new Departement();
        $empdepart   = $dbempdepart->get();
        return view('addTemplate.add', compact('empdepart'));
    }

    public function getall($id)
    {
        // dd($id);
        $dbempdepart = new Departement();
        $empdepart   = $dbempdepart->get();
        //dd($id);
        $last = Occupe::join('employes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
            ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
            ->join('travails', 'travails.id_nin', '=', 'employes.id_nin')
            ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
            ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
            ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
           // ->join('post_sups', 'occupes.id_postsup', 'post_sups.id_postsup')
            ->join('fonctions', 'occupes.id_fonction', '=', 'fonctions.id_fonction')
            ->orderBy('travails.date_chang', 'desc')
            ->where('employes.id_nin', $id)
            ->first();
        //  dd($last);
        if (!isset($last)) {
            $last = Occupe::join('employes', 'employes.id_nin', '=', 'occupes.id_nin')
                ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
                ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
                ->join('travails', 'travails.id_nin', '=', 'employes.id_nin')
                ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('post_sups','occupes.id_postsup','post_sups.id_postsup')
                //->join('fonctions','occupes.id_fonction','=','fonctions.id_fonction')
                ->where('employes.id_nin', $id)
                ->orderBy('travails.date_chang', 'desc')
                ->first();
            if (!isset($last)) {

                     $last = Occupe::join('employes', 'employes.id_nin', '=', 'occupes.id_nin')
                ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
                ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
                ->join('travails', 'travails.id_nin', '=', 'employes.id_nin')
                ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                //->join('post_sups','occupes.id_postsup','post_sups.id_postsup')
                //->join('fonctions','occupes.id_fonction','=','fonctions.id_fonction')
                ->where('employes.id_nin', $id)
                ->orderBy('travails.date_chang', 'desc')
                ->first();
                if(!isset($last))
                {
                   // dd($last);
                    return redirect('/Employe/IsTravaill/' . $id);
                }
            }
        }
        $result = DB::table('employes')->distinct()
            ->join('travails', 'travails.id_nin', '=', 'employes.id_nin')
            ->join('occupes', 'employes.id_nin', "=", 'occupes.id_nin')
            ->join('sous_departements', 'travails.id_sous_depart', "=", "sous_departements.id_sous_depart")
            ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
            ->join('posts', 'posts.id_post', '=', 'occupes.id_post')

            ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
            ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
            ->where('employes.id_nin', $id)
            ->select('id_travail')
            ->groupBy('id_travail')
            ->get();
        //  return response()->json($detailemp);
        //   print_r(compact('detailemp'));
        // dd($result);
        $postwork = Occupe::where('occupes.id_nin', $id)->distinct()
            ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
            ->join('contients', 'contients.id_post', '=', 'posts.id_post')

            ->select('id_occup', 'date_recrutement')->orderBy('date_recrutement')
            ->get();
        //dd($postwork);
        if (count($postwork) == 0 && count($result)) {
            return redirect('/Employe/IsEducat/' . $id);
        }
        $nbr    = $result->count();
        $allemp = [];
        foreach ($result as $res) {
            $val   = $res->id_travail;
            $inter = DB::table('employes')->distinct()
                ->join('travails', 'travails.id_nin', '=', 'employes.id_nin')
                ->join('occupes', 'employes.id_nin', "=", 'occupes.id_nin')
                ->join('sous_departements', 'travails.id_sous_depart', "=", "sous_departements.id_sous_depart")
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->join('contients', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')

                ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
                ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
                ->where('id_travail', $val)
                ->select(
                    'employes.Nom_emp',
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
                    'travails.id_travail',
                    'travails.date_chang',
                    'travails.date_installation',
                    'travails.notation'
                )
                ->orderBy('travails.date_installation', 'desc')
                //->orderBy('occupes.date_recrutement','desc')
                ->first();
            array_push($allemp, $inter);
        }
        //dd($allemp);
        $postarr = [];
        $i       = 0;
        foreach ($postwork as $single) {

            $inter = DB::table('contients')->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('travails', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('posts', 'posts.id_post', '=', 'contients.id_post')
                ->join('occupes', 'occupes.id_post', '=', 'posts.id_post')
                // ->join('post_sups','occupes.id_postsup','post_sups.id_postsup')
                 ->join('fonctions','occupes.id_fonction','=','fonctions.id_fonction')
                ->join('employes', 'employes.id_nin', '=', 'occupes.id_nin')
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
                ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
                ->where('id_occup', $single->id_occup)
                ->where('id_travail', $allemp[$i]->id_travail)
                ->select(
                    'travails.id_travail',
                    'niveaux.Nom_niv',
                    'niveaux.Nom_niv_ar',
                    'niveaux.Specialite',
                    'niveaux.Specialite_ar',
                    'posts.Grade_post',
                    'posts.Nom_post',
                    'posts.Nom_post_ar',
                    'occupes.date_recrutement',
                    'occupes.echellant',
                    'occupes.id_occup',
                    'occupes.id_postsup',
                    'occupes.id_fonction',
                    'fonctions.Nom_fonction',
                    'fonctions.Nom_fonction_ar',
                   /*  'post_sups.Nom_postsup',
                    'post_sups.Nom_postsup_ar',*/
                    'departements.Nom_depart',
                    'departements.Nom_depart_ar',
                    'sous_departements.Nom_sous_depart',
                    'sous_departements.Nom_sous_depart_ar',
                )
                ->orderBy('occupes.date_recrutement', 'desc')
                ->first();
                if(!isset($inter))
                {
                    $inter = DB::table('contients')->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                    ->join('travails', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                    ->join('posts', 'posts.id_post', '=', 'contients.id_post')
                    ->join('occupes', 'occupes.id_post', '=', 'posts.id_post')
                     ->join('post_sups','occupes.id_postsup','post_sups.id_postsup')
                    // ->join('fonctions','occupes.id_fonction','=','fonctions.id_fonction')
                    ->join('employes', 'employes.id_nin', '=', 'occupes.id_nin')
                    ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                    ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
                    ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
                    ->where('id_occup', $single->id_occup)
                    ->where('id_travail', $allemp[$i]->id_travail)
                    ->select(
                        'travails.id_travail',
                        'niveaux.Nom_niv',
                        'niveaux.Nom_niv_ar',
                        'niveaux.Specialite',
                        'niveaux.Specialite_ar',
                        'posts.Grade_post',
                        'posts.Nom_post',
                        'posts.Nom_post_ar',
                        'occupes.date_recrutement',
                        'occupes.echellant',
                        'occupes.id_occup',
                        'occupes.id_postsup',
                        'occupes.id_fonction',
                        /* 'fonctions.Nom_fonction',
                        'fonctions.Nom_fonction',*/
                        'post_sups.Nom_postsup',
                        'post_sups.Nom_postsup_ar',
                        'departements.Nom_depart',
                        'departements.Nom_depart_ar',
                        'sous_departements.Nom_sous_depart',
                        'sous_departements.Nom_sous_depart_ar',
                    )
                    ->orderBy('occupes.date_recrutement', 'desc')
                    ->first();
                 if(!isset($inter))
                 {
                                            $inter = DB::table('contients')->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                    ->join('travails', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                    ->join('posts', 'posts.id_post', '=', 'contients.id_post')
                    ->join('occupes', 'occupes.id_post', '=', 'posts.id_post')
                    // ->join('post_sups','occupes.id_postsup','post_sups.id_postsup')
                    // ->join('fonctions','occupes.id_fonction','=','fonctions.id_fonction')
                    ->join('employes', 'employes.id_nin', '=', 'occupes.id_nin')
                    ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                    ->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
                    ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
                    ->where('id_occup', $single->id_occup)
                    ->where('id_travail', $allemp[$i]->id_travail)
                    ->select(
                        'travails.id_travail',
                        'niveaux.Nom_niv',
                        'niveaux.Nom_niv_ar',
                        'niveaux.Specialite',
                        'niveaux.Specialite_ar',
                        'posts.Grade_post',
                        'posts.Nom_post',
                        'posts.Nom_post_ar',
                        'occupes.date_recrutement',
                        'occupes.echellant',
                        'occupes.id_occup',
                        'occupes.id_postsup',
                        'occupes.id_fonction',
                        /* 'fonctions.Nom_fonction',
                        'fonctions.Nom_fonction',
                        'post_sups.Nom_postsup',
                        'post_sups.Nom_postsup_ar',*/
                        'departements.Nom_depart',
                        'departements.Nom_depart_ar',
                        'sous_departements.Nom_sous_depart',
                        'sous_departements.Nom_sous_depart_ar',
                    )
                    ->orderBy('occupes.date_recrutement', 'desc')
                    ->first();
                 }
                }
            //dd($inter);
            array_push($postarr, $inter);
            $i++;
        }
        $carier = Employe::where('employes.id_nin', $id)->join('appartients', 'appartients.id_nin', '=', 'employes.id_nin')
            ->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')
            ->orderBy('niveaux.id_niv', 'desc')
            ->first();
        $detailemp = [];
        for ($i = 0; $i < count($postarr); $i++) {
            # code...
            // array_push($detailemp,$postarr[$i],$allemp[$i]);
            //dd($detailemp[$i]);
        }

         // dd($postarr);
        $detailemp = $allemp;
         // dd($postarr);
        $sdir=Sous_departement::all();
        $dir=Departement::all();
       $post         = Post::join('secteurs', 'secteurs.id_secteur', '=', 'posts.id_secteur')
            ->join('filieres', 'filieres.id_filiere', '=', 'secteurs.id_filiere')->get();
        $postsup=PostSup::all();
        $fonction=Fonction::all();
        if ($nbr > 0) {
            $nbr = $nbr - 1;
            return view('BioTemplate.index', compact('detailemp', 'nbr', 'empdepart', 'last', 'postarr', 'carier','dir','sdir','post','postsup','fonction'));
        } else {
            return view('404');
        }
    }

    //chercher un  employe
    public function searchemp(Request $request)
    {
        $employe = Employe::with([
            'occupeIdNin.post.contient.sous_departement.departement',
            'occupeIdP.post.contient.sous_departement.departement',
            'travailByNin.sous_departement.departement',
            'travailByP.sous_departement.departement',
        ]);

        //chercher by id_nin
        if ($request->id_nin) {
            $employe->where('id_nin', 'LIKE', '%' . $request->id_nin . '%');
        }
        $employes = $employe->get();
    }

    //list Employe par departement

    public function listabs_depart($id_dep)
    {
        $result  = [];
        $post    = [];
        $id_sous = Sous_departement::where('id_depart', $id_dep)->get();

        foreach ($id_sous as $sous_dep) {
            //print_r('sous_id '.$sous_dep);
            $id_post = Post::where('sous_departements.id_sous_depart', $sous_dep->id_sous_depart)->select('contients.id_contient')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->get();
            foreach ($id_post as $sas) {
                array_push($post, $sas->id_contient);
            }
        }
        //--------------------------------------------------------------------------- success ---/////
        $allwor = [];
        $emps   = Employe::join('travails', 'travails.id_nin', '=', 'employes.id_nin')
            ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
            ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
            ->where('departements.id_depart', $id_dep)
            ->orderBy('travails.date_installation', 'desc')
            ->get();

        foreach ($emps as $empl) {
            array_push($allwor, $empl);
        }
        // dd($allwor);

        $empdpart = [];
        $fis      = [];
        foreach ($allwor as $workig) {
            $travs = Travail::where('travails.id_nin', $workig->id_nin)
                ->join('employes', 'employes.id_nin', '=', 'travails.id_nin')
                ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
                ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
                // ->where('departements.id_depart',$id_dep)
                ->orderBy('date_installation', 'desc')
                ->first();
            /* foreach($travs as $bind)
              {   */
            if ($workig->date_installation <= $travs->date_installation && $travs->id_depart == $id_dep) {
                array_push($fis, $travs);
            }
            // }
        }
        //------------------------------------------------------------------until here -----------------------*/
        foreach ($fis as $emp) {
            $idcnt = Occupe::where('id_nin', $emp->id_nin)->where('contients.id_sous_depart', $emp->id_sous_depart)->select('id_contient')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->orderBy('date_recrutement', 'desc')
                ->first();

            $emps = Employe::join('occupes', 'occupes.id_nin', '=', 'employes.id_nin')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->where('contients.id_contient', $idcnt->id_contient)
                ->where('employes.id_nin', $emp->id_nin)
                ->orderBy('date_recrutement', 'desc')
                ->first();
            $find = false;
            if (count($empdpart) > 0) {
                $i = 0;

                while ($i < count($empdpart) && $find == false) {
                    # code...
                    if ($empdpart[$i]->id_nin == $emps->id_nin) {

                        $find = true;
                        // print_r('------- insrt:::'.$emps->id_nin.'find');
                    }

                    $i++;
                }
                if ($find != true) {
                    //print_r('------- insrt:::'.$emps->id_nin.' ----- comparing to ::::');
                    $i = 0;
                    array_push($empdpart, $emps);
                }
            } else {
                // print_r('insrt null'.$emps->id_nin);
                array_push($empdpart, $emps);
            }
        }

        /*------------------ pagination----------------------------------------**/

        // Définir le nombre d'éléments par page
        $perPage = 4; // Par exemple, 2 éléments par page
        $total   = count($empdpart);
        $page    = 1; // Page actuelle
        if (request()->get('page') != null) {
            $page = request()->get('page');
        }
        $offset = ($page - 1) * $perPage;

        // Extraire les éléments pour la page actuelle
        $items = array_slice($empdpart, $offset, $perPage);
        // dd($items);

        // Créer le paginator
        $paginator = new LengthAwarePaginator(
            $items,   // Items de la page actuelle
            $total,   // Nombre total d'éléments
            $perPage, // Nombre d'éléments par page
            $page,    // Page actuelle
            [
                'path'  => request()->url(),   // URL actuel
                'query' => request()->query(), // Paramètres de la requête
            ]
        );
        $empdepart = Departement::get();
        $nom_d     = Departement::where('id_depart', $id_dep)->value('Nom_depart');

        return response()->json(['paginator' => $paginator, 'employe' => $empdpart]);
        // return response()->json($empdpart);

    }

    public function absens_date($date)
    {
        // dd($date);
        $abs = Absence::select('id_p', 'id_nin')
            ->where('date_abs', $date)
            ->distinct()
            ->get();
        //dd($abs);
        return response()->json($abs);
    }
    public function add_absence(Request $request)
    {
        $request->validate([
            'Date_ABS' => 'required|date',
            'jour'     => 'required|string',
        ]);
        $soud_dic = Sous_departement::where('id_depart', $request->get('Dic'))->value('id_sous_depart');
        $id_nin   = explode('n', $request->get('ID_NIN'));
        // dd(intval($id_nin[1]));
        //  $id_p=explode('n',$request->get('ID_P'));
        $id_p   = intval($request->get('ID_P'));
        $id_nin = intval($id_nin[1]);
        //   dd(intval($request->get('ID_P')));
        // dd($request);
        $heur    = '13:00:00';
        $justf   = "justifier";
        $justfar = "مبرر";

        if ($request->get('jour') == '21') {
            $heur = '08:30:00';
        }
        if ($request->get('jour') == '2') {
            $heur = '16:30:00';
        }
        if ($request->get('justifier') == 'F2') {
            $justf   = "Non justier";
            $justfar = "غير مبرر";
        }
        if ($request->get('justifier') == 'F1') {
            $justf   = "justifier";
            $justfar = "مبرر";
        }
        $abs = new Absence([
            'id_nin'         => $id_nin,
            'id_p'           => $id_p,
            'id_sous_depart' => $soud_dic,
            'statut'         => $justf,
            'statut_ar'      => $justfar,
            'heure_abs'      => $heur,
            'id_fichier'     => 1,
            'date_abs'       => $request->get('Date_ABS'),
        ]);
        // dd($abs);
        if ($abs->save()) {
            return response()->json([
                'message' => 'success',
                'status'  => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'unsuccess',
                'status'  => 404,
            ]);
        }
    }
    public function list_cong()
    {

        $empdepart = DB::table('departements')
            ->get();

        $typecon = type_cong::select('titre_cong', 'ref_cong', 'titre_cong_ar')->get();

        // dd($typeconge);
        $today = Carbon::now();

        $emptypeconge = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
            'congeIdNin.type_conge',
        ])->whereHas('congeIdNin', function ($query) use ($today) {
            $query->where('date_fin_cong', '>=', $today)
                ->orderBy('date_fin_cong', 'desc');
        })->get();
        //dd($emptypeconge);
        // Définir le nombre d'éléments par page
        $perPage = 5; // Par exemple, 2 éléments par page
        $page    = 1; // Page actuelle
        if (request()->get('page') != null) {
            $page = request()->get('page');
        }
        $offset = ($page - 1) * $perPage;

        // Extraire les éléments pour la page actuelle
        $items = $emptypeconge->slice($offset, $perPage)->values();
        //dd($items);

        // Créer le paginator
        $paginator = new LengthAwarePaginator(
            $items,                 // Items de la page actuelle
            $emptypeconge->count(), // Nombre total d'éléments
            $perPage,               // Nombre d'éléments par page
            $page,                  // Page actuelle
            [
                'path'  => request()->url(),   // URL actuel
                'query' => request()->query(), // Paramètres de la requête
            ]
        );

        // dd($emptypeconge );

        $count = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
            'congeIdNin.type_conge',
        ])->whereHas('congeIdNin.type_conge', function ($query) use ($today) {
            $query->where('date_fin_cong', '>=', $today)
                ->whereIn('titre_cong', ['annuel']);
        })->count();
        $countExceptionnel = Employe::with([
            'occupeIdNin.post',
            'travailByNin.sous_departement.departement',
            'congeIdNin.type_conge',
        ])->whereHas('congeIdNin.type_conge', function ($query) use ($today) {
            $query->where('date_fin_cong', '>=', $today)
                ->whereNotIn('titre_cong', ['annuel']);
        })->count();
        // dd($typecon);

        //array_push($empcng,$emptypeconge);

        return view('employees.list_cong', compact('paginator', 'emptypeconge', 'empdepart', 'typecon', 'today', 'count', 'countExceptionnel'));
    }

    public function filterByType($typeconge)
    {
        //dd($typeconge);
        $empcng    = [];
        $today     = Carbon::now()->format('Y-m-d');
        $conge_nin = Conge::distinct()->select('id_nin', 'date_fin_cong', 'id_cong')->orderBy('date_fin_cong', 'desc')->get();
        //dd($conge_nin);
        foreach ($conge_nin as $cong_emp) {
            $query = Employe::query()
                ->join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                ->join('travails', 'employes.id_nin', '=', 'travails.id_nin')
                ->join('sous_departements', 'travails.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
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
                ->orderBy('date_recrutement', 'desc')
                ->where('conges.id_nin', $cong_emp->id_nin);

            if ($typeconge) {
                $query->where('type_congs.ref_cong', $typeconge)
                    ->where('date_fin_cong', '>=', $today)
                    ->where('id_cong', $cong_emp->id_cong);
            }
            $emptypeconge = $query->first();
            if ($emptypeconge) {
                $empcng[] = $emptypeconge;
            }
            // Convert array to collection for pagination
            $empcng = collect($empcng);
            //dd($empcngCollection);
            // Définir le nombre d'éléments par page
            $perPage = 1;                         // Par exemple, 4 éléments par page
            $page    = request()->get('page', 1); // Page actuelle, par défaut 1
            $offset  = ($page - 1) * $perPage;

            // Extraire les éléments pour la page actuelle
            $items = $empcng->slice($offset, $perPage)->values();
            //  dd($items);
            // Créer le paginator
            $paginator = new LengthAwarePaginator(
                $items,           // Items de la page actuelle
                $empcng->count(), // Nombre total d'éléments
                $perPage,         // Nombre d'éléments par page
                $page,            // Page actuelle
                [
                    'path'  => request()->url(),   // URL actuel
                    'query' => request()->query(), // Paramètres de la requête
                ]
            );

            /* // Ajoutez ces lignes pour obtenir les informations de pagination
             $currentPage = $paginator->currentPage(); // Page actuelle
             $totalPages = $paginator->lastPage(); // Nombre total de pages
             $totalConges = $paginator ->total(); // Total des employés en congé*/

            //array_push($empcng,$emptypeconge);
        }
        // dd($empcng);

        /*    return view('employees.list_cong', [
             'response' => [
                 'paginator' => $paginator,
                 'empcng' => $empcng,
                 'currentPage' => $currentPage,
                 'totalPages' => $totalPages,
                 'totalConges' => $totalConges],
         ]);*/
        return response()->json($empcng);
        /*   return response()->json([

             'empcng' => $empcng ,'paginator' => $paginator
         ]);*/
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
        $today   = Carbon::now()->format('Y-m-d');
        $result  = [];
        $post    = [];
        $id_sous = Sous_departement::where('id_depart', $department)->get();

        foreach ($id_sous as $sous_dep) {
            //print_r('sous_id '.$sous_dep);
            $id_post = Post::where('sous_departements.id_sous_depart', $sous_dep->id_sous_depart)->select('contients.id_contient')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->get();
            foreach ($id_post as $sas) {
                array_push($post, $sas->id_contient);
            }
        }
        //--------------------------------------------------------------------------- success ---/////
        $allwor = [];
        $emps   = Employe::join('travails', 'travails.id_nin', '=', 'employes.id_nin')
            ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
            ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
            ->where('departements.id_depart', $department)
            ->orderBy('travails.date_installation', 'desc')
            ->get();
        foreach ($emps as $empl) {
            array_push($allwor, $empl);
        }
        // dd($allwor);

        $empdpartcng = [];
        $fis         = [];
        foreach ($allwor as $workig) {
            $travs = Travail::where('travails.id_nin', $workig->id_nin)
                ->join('employes', 'employes.id_nin', '=', 'travails.id_nin')
                ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
                ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
                // ->where('departements.id_depart',$id_dep)
                ->orderBy('date_installation', 'desc')
                ->first();
            /* foreach($travs as $bind)
              {   */
            if ($workig->date_installation <= $travs->date_installation && $travs->id_depart == $department) {
                array_push($fis, $travs);
            }
            // }
        }
        //------------------------------------------------------------------until here -----------------------*/
        foreach ($fis as $emp) {
            $idcnt = Occupe::where('id_nin', $emp->id_nin)->where('contients.id_sous_depart', $emp->id_sous_depart)->select('id_contient')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->orderBy('date_recrutement', 'desc')
                ->first();
            $emps = Employe::join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                ->join('occupes', 'occupes.id_nin', '=', 'employes.id_nin')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->where('contients.id_contient', $idcnt->id_contient)
                ->where('employes.id_nin', $emp->id_nin)
                ->where('conges.date_fin_cong', '>=', $today)
                ->orderBy('date_recrutement', 'desc')
                ->select(
                    'employes.*',
                    'conges.*',
                    'type_congs.*',
                    'sous_departements.*',
                    'posts.*',
                    DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE())+1  AS joursRestants')
                )
                ->first();
            $find = false;
            // dd($emps);
            if (isset($emps)) {
                if (count($empdpartcng) > 0) {
                    $i = 0;

                    while ($i < count($empdpartcng) && $find == false) {
                        # code...

                        if ($empdpartcng[$i]->id_nin == $emps->id_nin) {

                            $find = true;
                            // print_r('------- insrt:::'.$emps->id_nin.'find');
                        }

                        $i++;
                    }
                    if ($find != true) {
                        //print_r('------- insrt:::'.$emps->id_nin.' ----- comparing to ::::');
                        $i = 0;
                        array_push($empdpartcng, $emps);
                    }
                } else {
                    // print_r('insrt null'.$emps->id_nin);
                    array_push($empdpartcng, $emps);
                }
            }
        }
        $empdepart = Departement::get();
        //   dd($empdpartcng);
        return response()->json($empdpartcng);
        /** ------------------------- Modification  Terminer--------------------------------- */
    }

    public function filtercongdep($typeconge, $department)
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

        $today   = Carbon::now()->format('Y-m-d');
        $result  = [];
        $post    = [];
        $id_sous = Sous_departement::where('id_depart', $department)->get();

        foreach ($id_sous as $sous_dep) {
            //print_r('sous_id '.$sous_dep);
            $id_post = Post::where('sous_departements.id_sous_depart', $sous_dep->id_sous_depart)->select('contients.id_contient')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->get();
            foreach ($id_post as $sas) {
                array_push($post, $sas->id_contient);
            }
        }
        //--------------------------------------------------------------------------- success ---/////
        $allwor = [];
        $emps   = Employe::join('travails', 'travails.id_nin', '=', 'employes.id_nin')
            ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
            ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
            ->where('departements.id_depart', $department)
            ->orderBy('travails.date_installation', 'desc')
            ->get();
        foreach ($emps as $empl) {
            array_push($allwor, $empl);
        }
        // dd($allwor);

        $empdpartcng = [];
        $fis         = [];
        foreach ($allwor as $workig) {
            $travs = Travail::where('travails.id_nin', $workig->id_nin)
                ->join('employes', 'employes.id_nin', '=', 'travails.id_nin')
                ->join('sous_departements', 'sous_departements.id_sous_depart', '=', 'travails.id_sous_depart')
                ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
                // ->where('departements.id_depart',$id_dep)
                ->orderBy('date_installation', 'desc')
                ->first();
            /* foreach($travs as $bind)
              {   */
            if ($workig->date_installation <= $travs->date_installation && $travs->id_depart == $department) {
                array_push($fis, $travs);
            }
            // }
        }
        //------------------------------------------------------------------until here -----------------------*/
        foreach ($fis as $emp) {
            $idcnt = Occupe::where('id_nin', $emp->id_nin)->where('contients.id_sous_depart', $emp->id_sous_depart)->select('id_contient')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->orderBy('date_recrutement', 'desc')
                ->first();
            $emps = Employe::join('conges', 'employes.id_nin', '=', 'conges.id_nin')
                ->join('type_congs', 'conges.ref_cong', '=', 'type_congs.ref_cong')
                ->join('occupes', 'occupes.id_nin', '=', 'employes.id_nin')
                ->join('posts', 'posts.id_post', '=', 'occupes.id_post')
                ->join('contients', 'contients.id_post', '=', 'posts.id_post')
                ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
                ->join('departements', 'departements.id_depart', '=', 'sous_departements.id_depart')
                ->where('contients.id_contient', $idcnt->id_contient)
                ->where('employes.id_nin', $emp->id_nin)
                ->where('conges.date_fin_cong', '>=', $today)
                ->where('type_congs.ref_cong', $typeconge)
                ->orderBy('date_recrutement', 'desc')
                ->select(
                    'employes.*',
                    'conges.*',
                    'type_congs.*',
                    'sous_departements.*',
                    'posts.*',
                    DB::raw('DATEDIFF(conges.date_fin_cong, CURDATE())+1  AS joursRestants')
                )
                ->first();
            $find = false;
            // dd($emps);
            if (isset($emps)) {
                if (count($empdpartcng) > 0) {
                    $i = 0;

                    while ($i < count($empdpartcng) && $find == false) {
                        # code...

                        if ($empdpartcng[$i]->id_nin == $emps->id_nin) {

                            $find = true;
                            // print_r('------- insrt:::'.$emps->id_nin.'find');
                        }

                        $i++;
                    }
                    if ($find != true) {
                        //print_r('------- insrt:::'.$emps->id_nin.' ----- comparing to ::::');
                        $i = 0;
                        array_push($empdpartcng, $emps);
                    }
                } else {
                    // print_r('insrt null'.$emps->id_nin);
                    array_push($empdpartcng, $emps);
                }
            }
        }
        $empdepart = Departement::get();
        //   dd($empdpartcng);
        return response()->json($empdpartcng);
    }

    public function check_cg($id_p)
    {
        $totaljour = 0;
        $emp       = Employe::where('employes.id_emp', '=', $id_p)
            ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
            ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
            ->join('contients', 'posts.id_post', '=', 'contients.id_post')
            ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
            ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
            ->orderBy('occupes.date_recrutement', 'asc')
            ->first();
        //dd($emp);
        $empstat = 'Exist pas';
        if (app()->getLocale() == 'ar') {
            $empstat = 'لا يوجد';
        }
        if (isset($emp)) {
            $cng = Conge::where('id_nin', $emp->id_nin)->orderBy('date_fin_cong', 'desc')->get();
        } else {
            return response()->json([
                'message' => $empstat,
                'status'  => 302,
            ]);
        }
        if ($cng->count() > 0 && $cng[0]->ref_cong == 'RF001') {

            //   dd($cng[0]->nbr_jours);
            foreach ($cng as $cg) {
                $totaljour += $cg->nbr_jours;
            }
            $nbrMal = 0;
            $nbrsn  = 0;
            $cngMal = Conge::select('nbr_jours')
                ->where('ref_cong', 'RF002')
                ->where('id_nin', $emp->id_nin)
                ->orderBy('date_fin_cong')
                ->first();
            if (isset($cngMal)) {
                $nbrMal = $cngMal->nbr_jours;
            }

            $cngSan = Conge::select('nbr_jours')
                ->where('ref_cong', 'RF003')
                ->orderBy('date_fin_cong')
                ->first();
            if (isset($cngSan)) {
                $nbrsn = $cngSan->nbr_jours;
            }
            return response()->json(
                [
                    'employe'        => $emp,
                    'Jour_congé_an'  => $cng[0]->nbr_jours,
                    'Jour_congé_mal' => $nbrMal,
                    'Jour_congé_sn'  => $nbrsn,
                    'date_congé'     => $cng[0]->date_fin_cong,
                ]
            );
        } else {
            if (isset($cng[0]) && $cng[0]->ref_cong == 'RF002') {
                //dd($cng);
                $nbrAnu = 0;
                $nbrsn  = 0;
                $cngAn  = Conge::select('nbr_jours')
                    ->where('ref_cong', 'RF001')
                    ->orderBy('date_fin_cong')
                    ->first();
                if (isset($cngAn)) {
                    $nbrAnu = $cngAn->nbr_jours;
                }

                $cngSan = Conge::select('nbr_jours')
                    ->where('ref_cong', 'RF003')
                    ->orderBy('date_fin_cong')
                    ->first();
                if (isset($cngSan)) {
                    $nbrsn = $cngAn->nbr_jours;
                }
                $current  = Carbon::parse($cng[0]->date_debut_cong);
                $mald_deb = Carbon::parse($cng[0]->date_fin_cong);
                $diff     = $current->diffInDays($mald_deb);
                return response()->json(
                    [
                        'employe'        => $emp,
                        'Jour_congé_mal' => $diff,
                        'date_congé'     => $cng[0]->date_fin_cong,
                        'Jour_congé_an'  => $nbrAnu,
                        'Jour_congé_sn'  => $nbrsn,
                        'type'           => 'Maladie',
                    ]
                );
            }
            //dd($emp);

            $startDate = Carbon::parse($emp->date_recrutement);

            $endDate = Carbon::parse('01-06-' . Carbon::now()->year);

            // Calculate the number of months between the two dates
            $monthsDifference = $startDate->diffInMonths($endDate);
            if ($monthsDifference > 0) {
                $totaljour = $monthsDifference * 2.5;
            }
            return response()->json(
                [
                    'employe'       => $emp,
                    'Jour_congé_an' => round($totaljour),
                ]
            );
        }
    }
    public function add_cng(Request $request)
    {

        $request->validate(
            [
                'ID_NIN'    => 'required|integer',
                'ID_P'      => 'required|integer',
                'Dic'       => 'required|integer',
                'date_dcg'  => 'required|date',
                'date_fcg'  => 'required|date',
                'type_cg'   => 'required|string',
                'situation' => 'required|string',
                'ref_cng'   => 'required||string',
            ]
        );

        if ($request->get('situation') == 'algerie') {
            $situation_ar = 'الجزائر';
        } else {
            $situation_ar = 'خارج التراب';
        }
        $msgmald    = 'Vérifier la date de congé maladie';
        $msgdatein  = 'Vérifier la date de congé';
        $msgdateout = 'Vérifier le delai de congé';
        $msgdateins = 'Opération échouée d`insertion';
        $msgsuc     = 'Opération réussie';
        $msgunsc    = 'opération échoué';
        $ups        = 'mise à jour';
        $upsnot     = 'n`est pas mise à jour';
        if (app()->getLocale() == 'ar') {
            $msgmald    = 'التحقق من تاريخ الإجازة المرضية';
            $msgdatein  = 'التحقق من تاريخ الإجازة';
            $msgdateout = 'التحقق من مدة الإجازة';
            $msgsuc     = 'تم العملية';
            $msgunsc    = 'فشلت العملية';
            $msgdateins = ' فشلت عملية الإضافة';
            $ups        = ' تم التحديث ';
            $upsnot     = 'خطا في التحديث';
        }
        $cng = Conge::where('id_nin', $request->get('ID_NIN'))
            ->select('id_nin', 'ref_cong', 'nbr_jours', 'date_debut_cong', 'id_cong', 'date_fin_cong', DB::raw('YEAR(date_debut_cong) as annee'))
            ->orderBy('date_debut_cong', 'desc')
            ->get();
        $delai  = 0;
        $right  = false;
        $allday = '';
        if (gettype($request->get('total_cgj')) == 'string') {
            $allday = explode(',', $request->get('total_cgj'));
            //dd(intval($allday[0]));
        };
        //  dd($cng);
        if (count($cng) == 0) {

            if ($request->get('type_cg') == 'RF001' && intval($allday[0]) > 0) {
                $start          = Carbon::parse($request->get('date_dcg'));
                $end            = Carbon::parse($request->get('date_fcg'));
                $daysDifference = $start->diffInDays($end);
                $res            = $request->get('total_cgj') - $daysDifference;
                dd(intval($res));
                $cong = new Conge([
                    'id_nin'          => $request->get('ID_NIN'),
                    'id_p'            => $request->get('ID_P'),
                    'date_debut_cong' => $request->get('date_dcg'),
                    'date_fin_cong'   => $request->get('date_fcg'),
                    'nbr_jours'       => $res,
                    'ref_cong'        => $request->get('type_cg'),
                    'ref_cng'         => $request->get('ref_cng'),
                    'situation'       => $request->get('situation'),
                    'situation_AR'    => $situation_ar,
                    'id_sous_depart'  => $request->get('SDic'),
                ]);
                if ($cong->save()) {
                    return response()->json(['message' => $msgsuc, 'status' => 200]);
                } else {
                    return response()->json([
                        'message' => $msgdateins,
                        'status'  => 404,
                    ]);
                }
            }
        }
        if (isset($cng)) {
            //dd($cng);
            foreach ($cng as $cg) {

                if ($request->get('date_dcg') < $cg->date_fin_cong && $request->get('type_cg') == 'RF001') {

                    return response()->json([
                        'type'    => $cg->type_cg,
                        'message' => $msgdatein,
                        'status'  => 404,
                    ]);
                }
                if ($request->get('type_cg') == 'RF002') {
                    $current  = Carbon::now();
                    $mald_deb = Carbon::parse($request->get('date_dcg'));
                    $diff     = $current->diffInDays($mald_deb);
                    // dd($diff);
                    if (! $mald_deb->between($current->copy()->subDays(2), $current)) {
                        $startcng  = Carbon::parse($cg->date_debut_cng);
                        $endcng    = Carbon::parse($cg->date_fin_cong);
                        $cngall    = $startcng->diffInDays($endcng);
                        $end       = Carbon::parse($request->get('date_fcg'));
                        $consume   = $startcng->diffInDays($mald_deb);
                        $nbrcngbef = $cg->nbr_jours;
                        // dd($nbrcngbef);
                        $daysDifference = $mald_deb->diffInDays($end);
                        $difdays        = $mald_deb->diffInDays($endcng);
                        // dd($daysDifference);
                        $nbrcg = $nbrcngbef + $daysDifference;
                        //dd($nbrcg);
                        if ($endcng < $end) {
                            $dff   = $mald_deb->diffInDays($endcng);
                            $nbrcg = $nbrcngbef + $dff;
                        } else {
                            if ($endcng > $mald_deb) {
                                $dff = $mald_deb->diffInDays($end);
                                //  $diff=$startcng->diffInDays($mald_deb);
                                $rest  = $nbrcngbef + $dff;
                                $nbrcg = $rest;
                            }
                        }
                        if ($cg->date_fin_cong > $request->get('date_dcg')) {
                            // dd(intval($nbrcg));
                            $cg->update(['date_fin_cong' => $request->get('date_dcg'), 'nbr_jours' => $nbrcg]);
                        } else {
                            $cong = new Conge([
                                'id_nin'          => $request->get('ID_NIN'),
                                'id_p'            => $request->get('ID_P'),
                                'date_debut_cong' => $request->get('date_dcg'),
                                'date_fin_cong'   => $request->get('date_fcg'),
                                'nbr_jours'       => $daysDifference,
                                'ref_cong'        => $request->get('type_cg'),
                                'ref_cng'         => $request->get('ref_cng'),
                                'situation'       => $request->get('situation'),
                                'situation_AR'    => $situation_ar,
                                'id_sous_depart'  => $request->get('SDic'),
                            ]);
                            if ($cong->save()) {
                                return response()->json(['message' => $msgsuc, 'status' => 200]);
                            } else {
                                return response()->json([
                                    'message' => $msgdateins,
                                    'status'  => 404,
                                ]);
                            }
                        }
                        if ($cg) {
                            $cong = new Conge([
                                'id_nin'          => $request->get('ID_NIN'),
                                'id_p'            => $request->get('ID_P'),
                                'date_debut_cong' => $request->get('date_dcg'),
                                'date_fin_cong'   => $request->get('date_fcg'),
                                'nbr_jours'       => $daysDifference,
                                'ref_cong'        => $request->get('type_cg'),
                                'ref_cng'         => $request->get('ref_cng'),
                                'situation'       => $request->get('situation'),
                                'situation_AR'    => $situation_ar,
                                'id_sous_depart'  => $request->get('SDic'),
                            ]);
                            if ($cong->save()) {
                                return response()->json(['message' => $msgsuc, 'status' => 200]);
                            } else {
                                return response()->json([
                                    'message' => $msgdateins,
                                    'status'  => 404,
                                ]);
                            }
                        } else {
                            return response()->json([
                                'message' => $upsnot,
                                'status'  => 404,
                            ]);
                        }
                    } else {
                        return response()->json([
                            'message' => $msgmald,
                            'status'  => 404,
                        ]);
                    }
                }

                $startDate = Carbon::parse($request->get('date_dcg'));

                $endDate = Carbon::parse($request->get('date_fcg'));

                // Calculate the number of months between the two dates
                $monthsDifference = $startDate->diffInMonths($endDate);
                $len              = $cng->count() - 1;
                $all              = $request->get('total_cgj');
                $newcngs          = 0;
                $all              = intval($all);

                $date = intval($monthsDifference * 30);

                if ($all > $date) {
                    $nbrcng  = $all - $date;
                    $newcngs = $nbrcng;
                } else {
                    $nbrcng = -1;
                }
                //  dd($nbrcng);

                if ($nbrcng <= 0 && $request->get('type_cg') == 'RF001' && $cg->ref_cong != 'RF002') {
                    return response()->json([
                        'message' => $msgdateout . ' ' . $nbrcng,
                        'status'  => 404,
                    ]);
                } else {
                    $dat = Conge::select('nbr_jours')
                        ->where('ref_cong', 'RF001')
                        ->where('id_nin', $request->get('ID_NIN'))
                        ->orderBy('date_fin_cong', 'desc')
                        ->first();
                    //    dd($dat);
                    if ($dat == null) {
                        $newcngs = $date;
                    }

                    // dd($newcngs);
                    // dd(intval($newcngs));
                    $cong = new Conge([
                        'id_nin'          => $request->get('ID_NIN'),
                        'id_p'            => $request->get('ID_P'),
                        'date_debut_cong' => $request->get('date_dcg'),
                        'date_fin_cong'   => $request->get('date_fcg'),
                        'nbr_jours'       => intval($newcngs),
                        'ref_cng'         => $request->get('ref_cng'),
                        'ref_cong'        => $request->get('type_cg'),
                        'situation'       => $request->get('situation'),
                        'situation_AR'    => $situation_ar,

                        'id_sous_depart'  => $request->get('SDic'),
                    ]);
                    if ($cong->save()) {
                        return response()->json(['message' => $msgsuc, 'status' => 200]);
                    } else {
                        return response()->json([
                            'message' => $msgmald,
                            'status'  => 404,
                        ]);
                    }
                }
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
        if ($cng->count() > 0) {
            if (Carbon::now()->year >= $cng[0]->annee && $request->get('type_cg') == 'RF001') {
                $right = true;
                // dd($cg->annee);
            }
            if ($request->get('type_cg') == 'RF002') {
                $right = true;
            }
            $startDate = Carbon::parse($request->get('date_dcg'));

            $endDate = Carbon::parse($request->get('date_fcg'));

            // Calculate the number of months between the two dates
            $monthsDifference = $startDate->diffInMonths($endDate);
            $len              = $cng->count() - 1;
            $all              = $request->get('total_cgj');
            $all              = intval($all);
            $date             = intval($monthsDifference * 30);

            if ($all > $date) {
                $nbrcng = $all - $date;
            } else {
                $nbrcng = -1;
            }
            //  dd($nbrcng);
            if ($nbrcng <= 0 && $right == false) {
                return response()->json([
                    'message' => $msgdateout . '' . $nbrcng,
                    'status'  => 404,
                ]);
            } else {
                // dd(intval($nbrcng));
                $cong = new Conge([
                    'id_nin'          => $request->get('ID_NIN'),
                    'id_p'            => $request->get('ID_P'),
                    'date_debut_cong' => $request->get('date_dcg'),
                    'date_fin_cong'   => $request->get('date_fcg'),
                    'nbr_jours'       => intval($nbrcng),
                    'ref_cng'         => $request->get('ref_cng'),
                    'ref_cong'        => $request->get('type_cg'),
                    'situation'       => $request->get('situation'),
                    'situation_AR'    => $situation_ar,
                    'id_sous_depart'  => $request->get('SDic'),
                ]);
            }

            //  dd($cng[0]);
            if ($cng[0]->date_fin_cong < $request->get('date_dcg') && $request->get('type_cg') == 'RF001') {
                if ($cong->save()) {
                    return response()->json([
                        'message' => $msgsuc,
                        'status'  => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => $msgunsc,
                        'status'  => 404,
                    ]);
                }
            } else {
                if ($request->get('type_cg') != 'RF001' && $request->get('situation') == 'algerie') {
                    if ($cong->save()) {
                        return response()->json([
                            'message' => $msgsuc,
                            'status'  => 200,
                        ]);
                    } else {
                        return response()->json([
                            'message' => $msgunsc,
                            'status'  => 404,
                        ]);
                    }
                } else {
                    return response()->json([
                        'message' => $msgdateout,
                        'status'  => 404,
                        'type'    => 'Situation',
                    ]);
                }
            }
        } else {
            $startDate = Carbon::parse($request->get('date_dcg'));

            $endDate = Carbon::parse($request->get('date_fcg'));

            // Calculate the number of months between the two dates
            $monthsDifference = $startDate->diffInMonths($endDate);
            $cong             = new Conge([
                'id_nin'          => $request->get('ID_NIN'),
                'id_p'            => $request->get('ID_P'),
                'date_debut_cong' => $request->get('date_dcg'),
                'date_fin_cong'   => $request->get('date_fcg'),
                'nbr_jours'       => intval($monthsDifference * 30),
                'ref_cong'        => $request->get('type_cg'),
                'ref_cng'         => $request->get('ref_cng'),
                'situation'       => $request->get('situation'),
                'situation_AR'    => $situation_ar,
                'id_sous_depart'  => $request->get('SDic'),
            ]);
            if ($cong->save()) {
                return response()->json([
                    'message' => $msgsuc,
                    'status'  => 200,
                ]);
            } else {
                return response()->json([
                    'message' => $msgunsc,
                    'status'  => 404,
                ]);
            }
        }
    }

    public function existToAdd($id)
    {
        $employe     = Employe::where('id_nin', $id)->firstOrFail();
        $niv         = new Niveau();
        $dbniv       = $niv->SELECT('Nom_niv', 'Nom_niv_ar')->distinct()->get();
        $dbn         = $niv->SELECT('Specialite', 'Specialite_ar')->distinct()->get();
        $dbempdepart = new Departement();
        $empdepart   = $dbempdepart->get();
        if (app()->getLocale() == 'ar') {
            //   dd(app()->getLocale());
        }

        return view('addTemplate.travaill', compact('employe', 'dbniv', 'empdepart', 'dbn'));
    }
    public function existApp($id)
    {
        $employe      = Employe::where('id_nin', $id)->firstOrFail();
        $bureau       = new Bureau();
        $Direction    = new Departement();
        $SDirection   = new Sous_departement();
        $dbsdirection = $SDirection->get();
        $dbdirection  = $Direction->get();
        $dbbureau     = $bureau->get();
        $dbdirection  = $Direction->get();
        $Appartient   = appartient::where('id_nin', $id)->get();
        $post         = Post::join('secteurs', 'secteurs.id_secteur', '=', 'posts.id_secteur')
            ->join('filieres', 'filieres.id_filiere', '=', 'secteurs.id_filiere');
        $dbpost = $post->get();
        //dd($dbpost);
        $dbempdepart = new Departement();
        $empdepart   = $dbempdepart->get();

        $fonction = new Fonction();
        $fct      = $fonction->get();

        $postsup  = new PostSup();
        $postsupp = $postsup->get();
        //dd(app()->getLocale());
        //dd($postsupp);
        return view('addTemplate.admin', compact('employe', 'dbbureau', 'dbdirection', 'dbpost', 'dbsdirection', 'empdepart', 'postsupp', 'fct'));
    }
    public function getPostSups()
    {
        $postsup  = PostSup::all();
        $fonction = Fonction::all();
        //dd( $fonction);

        return response()->json([
            'post_sups' => $postsup,
            'fonction'  => $fonction,

        ]);
    }
    public function find_emp($id)
    {
        $find = Employe::where('id_nin', $id)->first();
        if ($find) {
            return response()->json(['success' => 'exist', 'status' => 200, 'data' => $find]);
        } else {
            return response()->json(['success' => 'not fund', 'status' => 302]);
        }
    }
    public function get_list_absemp($id)
    {
        $emp = Employe::where('id_nin', $id)->first();
        if (app()->getLocale() == 'ar') {
            $list_abs = Absence::where('id_nin', $id)->orderBy('date_abs', 'desc')
                ->select('date_abs', 'heure_abs', 'statut_ar', 'id_nin', 'id_p', 'id_sous_depart', 'id_fichier')
                ->orderBy('date_abs')
                ->distinct()
                ->get();
        } else {
            $list_abs = Absence::where('id_nin', $id)->orderBy('date_abs', 'desc')
                ->select('date_abs', 'heure_abs', 'statut', 'id_nin', 'id_p', 'id_sous_depart', 'id_fichier')
                ->orderBy('date_abs')
                ->distinct()
                ->get();
        }

        $perPage = 5; // Par exemple, 2 éléments par page
        $page    = 1; // Page actuelle
        if (request()->get('page') != null) {
            $page = request()->get('page');
        }
        $offset = ($page - 1) * $perPage;

        // Extraire les éléments pour la page actuelle
        $items = $list_abs->slice($offset, $perPage)->values();
        //dd($items);
        // Créer le paginator
        $paginator = new LengthAwarePaginator(
            $items,             // Items de la page actuelle
            $list_abs->count(), // Nombre total d'éléments
            $perPage,           // Nombre d'éléments par page
            $page,              // Page actuelle
            [
                'path'  => request()->url(),   // URL actuelle
                'query' => request()->query(), // Paramètres de la requête
            ]
        );
        return response()->json([
            'emp'      => $emp,
            'list_abs' => $list_abs,
        ]);
    }
    public function read_just($id)
    {
        if ($id != 0) {
            $file = Stocke::where('id_fichier', $id)->first();
            //    dd($file);
            $subdir  = $file->ref_Dossier;
            $fichier = $file->sous_d . '-' . $id;

            return redirect()->route('read_file_emp', ['dir' => 'employees', 'subdir' => $subdir, 'file' => $fichier]);
        } else {
            abort(404);
        }
    }

    /** =================================== this controller use for update New Id_nin of employers  ===================================  */
    public function modif_nin(Request $request, $id_nin)
    {
        $id_nin_local = 1254953;
        $related_list = [];
        // dd($id_nin);
        $related = Occupe::where('id_nin', $id_nin)->get();

        if (isset($related)) {
            foreach ($related as $key => $value) {
                # code...
                array_push($related_list, ["occupes" => $value->id_occup]);
                $value->id_nin = $id_nin_local;
                $value->save();
            }
        }
        /** ==========================================================*/
        $related = DB::table('logs')->where('id_nin', $id_nin)->delete();
        /* if(isset($related))
        {
            array_push($related_list,["logs"=>$related->id_log]);
            $related->id_nin=$id_nin_local;
             $related->save();
        }*/
        /** ===============================================================*/
        $related = Dossier::where('ref_Dossier', "Em_" . $id_nin)->first();
        if (isset($related)) {
            array_push($related_list, ["dossiers" => $related->ref_Dossier]);
        }

        /**=================================================================== */
        $related = appartient::where('id_nin', $id_nin)->get();
        if (isset($related)) {
            foreach ($related as $key => $value) {
                array_push($related_list, ["appartients" => $value->id_appar]);
                $value->id_nin = $id_nin_local;
                $value->save();
            }
        }
        /****************************************************************************** */
        /*         $ref='Em_'.$id_nin;
                    $ref_loco='Em_'.$id_nin_local;
                  $related=Stocke::where('ref_Dossier',$ref)->get();
                    if(isset($related))
                        {
                        foreach ($related as $key => $value) {
                        array_push($related_list,["stoke"=>$value->id_stocke]);
                        $value->ref_Dossier=$ref_loco;
                        $value->save();
                        }

                    }
                    else
                    {
                        Stocke::create([
                            'date_insertion'=>now(),
                            'ref_Dossier'=>$ref_loco='Em_'.$id_nin_local,
                            'sous_d'=>'Admin',
                            'id_fichier'=>1,
                            'id'=>1,
                            'mac'=>'notfound'
                        ]);
                    }*/
        /**===================================================================== */
        $related = Travail::where('id_nin', $id_nin)->get();
        if (isset($related)) {
            foreach ($related as $key => $value) {
                array_push($related_list, ["travails" => $value->id_travail]);
                $value->id_nin = $id_nin_local;
                $value->save();
            }
        }
        $related = Absence::where('id_nin', $id_nin)->get();
        if (isset($related)) {
            foreach ($related as $key => $value) {
                array_push($related_list, ["absences" => $value->id_abs]);
                $value->id_nin = $id_nin_local;
                $value->save();
            }
        }
        $related = Conge::where('id_nin', $id_nin)->get();
        if (isset($related)) {
            foreach ($related as $key => $value) {
                array_push($related_list, ["conges" => $value->id_cong]);
                $value->id_nin = $id_nin_local;
                $value->save();
            }
        }
        //  dd($related_list);
        if (count($related_list) > 0) {
            $related         = Employe::where('id_nin', $id_nin)->first();
            $related->id_nin = $request->input('id_nin_modif');
            $related->save();
            for ($i = 0; $i < count($related_list); $i++) {
                //dd($key,$value);
                foreach ($related_list[$i] as $key => $value) {
                    # code...
                    //
                    if ($key == 'conges') {
                        $related         = Conge::where('id_cong', $value)->first();
                        $related->id_nin = $request->input('id_nin_modif');
                        $related->save();
                    }
                    if ($key == 'absences') {
                        $related         = Absence::where('id_abs', $value)->first();
                        $related->id_nin = $request->input('id_nin_modif');
                        $related->save();
                    }
                    if ($key == 'travails') {

                        $related         = Travail::where('id_travail', $value)->first();
                        $related->id_nin = $request->input('id_nin_modif');
                        $related->save();
                    }
                    if ($key == 'occupes') {
                        $related         = Occupe::where('id_occup', $value)->first();
                        $related->id_nin = $request->input('id_nin_modif');
                        $related->save();
                    }
                    if ($key == 'appartients') {
                        $related         = appartient::where('id_appar', $value)->first();
                        $related->id_nin = $request->input('id_nin_modif');
                        $related->save();
                    }

                    /*     if( $key == 'stoke')
                {
                     $ref="Em_".$request->input('id_nin_modif');
                     $related=Stocke::where('id_stock',$value)->first();
                     $related->ref_Dossier=$ref;
                     $related->save();
                }*/

                    /*    if( $key == 'dossiers')
                {
                        $related=Dossier::where('ref_Dossier',$value)->first();
                        $old = $related->ref_Dossier;

                    $sourceDir = "employees/".$old;
                    $targetDir = "employees/Em_" . $request->input('id_modif');

                    $disk = Storage::disk('public');

                    if ($disk->exists($sourceDir)) {

                        // Step 1: Copy folder structure (directories)
                        $directories = $disk->allDirectories($sourceDir);
                        $disk->makeDirectory($targetDir);

                        foreach ($directories as $dir) {
                            $newDir = str_replace($sourceDir, $targetDir, $dir);
                            $disk->makeDirectory($newDir);
                        }

                        // Step 2: Copy files (only if not already exist)
                        $files = $disk->allFiles($sourceDir);
                        foreach ($files as $file) {
                            $newPath = str_replace($sourceDir, $targetDir, $file);

                            if (!$disk->exists($newPath)) {
                                $disk->put($newPath, $disk->get($file));
                            }
                            // else skip file
                        }
                        $related->ref_Dossier="Em_" . $request->input('id_modif');
                        $related->save();
                      }
                   }*/
                }
            }
        }
        $nin = $request->input('id_nin_modif');
        return response()->json(['success' => 'exist', 'status' => 200, 'data' => $nin]);
    }

    public function check_app(Request $request)
    {
        $value   = $request->input('id_apper');
        $related = appartient::where('id_appar', $value)->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')->first();
        if (isset($related)) {
            return response()->json(['success' => 'exist', 'status' => 200, 'data' => $related]);
        } else {
            return response()->json(['success' => 'exist pas', 'status' => 404, 'data' => []]);
        }
    }

    public function get_niv_nin($id_nin)
    {

        $related = appartient::where('id_nin', $id_nin)->join('niveaux', 'niveaux.id_niv', '=', 'appartients.id_niv')->first();
        if (isset($related)) {
            return response()->json(['success' => 'exist', 'status' => 200, 'data' => $related]);
        } else {
            return response()->json(['success' => 'exist pas', 'status' => 404, 'data' => []]);
        }
    }

    /*public function delete_by_nin(Request $request, $id_nin)
    {

        $related = Occupe::where('id_nin', $id_nin)->delete();
        $related = Log::where('id_nin', $id_nin)->delete();
        $related = Dossier::where('ref_Dossier', "Em_" . $id_nin)->first();
        if (isset($related)) {
            $related->type = 'OUT';
            $related->save();
        }

        //=================================================================== 
        $related = appartient::where('id_nin', $id_nin)->delete();

        //===================================================================== 
        $related = Travail::where('id_nin', $id_nin)->delete();
        $related = Absence::where('id_nin', $id_nin)->delete();

        $related = Conge::where('id_nin', $id_nin)->delete();
        //  dd($related_list);

        $related = Employe::where('id_nin', $id_nin)->delete();
        $nin     = $request->input('id_nin_modif');
        return response()->json(['success' => 'exist', 'status' => 200, 'data' => $nin]);
    }*/


    function delete_carier($id_travail, $id_occup)
    {
        $delet_tra = Travail::where('id_travail', $id_travail)->delete();
        if ($delet_tra) {
            $delet_tra = Occupe::where('id_occup', $id_occup)->delete();
            if ($delet_tra) {
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    function update_mail()
    {
                // Load JSON
        $jsonPath = storage_path('app/public/mails_local/mails.json');
        if (!file_exists($jsonPath)) {
            $this->error("JSON file not found!");
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);

        if (!$data) {
            $this->error("Invalid JSON format.");
            return;
        }

        foreach ($data as $mails) {
            # code...

              $name = strtolower($mails['name']);
               $name = str_replace(' ', '', $name);    
                $emp=Employe::all();
                foreach($emp as $e)
                {
                    $ename=$e->Nom_emp.$e->Prenom_emp;
                    $ename=  strtolower($ename);
                    $ename = str_replace(' ', '', $ename);
                    if($name == $ename)
                    {
                        print('1 - names are :'.$name.' emp : '.$ename.' his mail'.$mails['mail']);
                        $e->email=$mails['mail'];
                        $e->save();
                    }
                    else
                    {
                    $ename=$e->Prenom_emp.$e->Nom_emp;
                    $ename=  strtolower($ename);
                    $ename = str_replace(' ', '', $ename);
                        if($name == $ename)
                        {
                            print('2 - names are :'.$name.' emp : '.$ename.' his mail'.$mails['mail']);
                            $e->email=$mails['mail'];
                            $e->save();
                        }
                    }
                  
                }
// Remove all spaces
           
             
            
        } 
    }
}
