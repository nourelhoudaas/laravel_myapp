<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Direction;
use App\Models\Travaill;
use App\Models\Post;
use App\Models\Appartient;
use App\Models\Niveau;
class EmployeControl extends Controller
{
    public function ListeEmply()
    {
        return view('employees.liste');
    }

    public function AddEmply()
    {
        return view('employees.add');
    }

    //liste de tous les employes
    public function listEmployes()
    {
        $employe = DB::table('employe')
            ->join('post','employe.ID_NIN','=','post.ID_NIN')
            //->select('ID_NIN','ID_P','NOM_P','PRENOM_O','DATE_NAIS_P','LIEU_N','ADDRESS','EMAIL','PHONE_PN')
            ->select('employe.ID_NIN','employe.ID_P','employe.NOM_P','employe.PRENOM_O','post.NOM_POST')
            ->get();

    //le nbr total des employés
            $totalEmployes = $employe->count();
          echo "le nombre total des employés est : ", $totalEmployes ,"\n";

              return view('listemploye', compact('employe'));
       // return $employe; // Return the LIST of employees

    }



   //liste de tous les employes "fiche technique"
      public function fichetech()
      {
        $fich=DB::table('employe')
            ->join('appartient','employe.ID_NIN','=','appartient.ID_NIN')
            ->join('niveau','appartient.ID_N','=','niveau.ID_N')
            ->join('post','employe.ID_NIN','=','post.ID_NIN')
            ->join('travaill','employe.ID_NIN','=','travaill.ID_NIN')
            ->join('departement','travaill.ID_D','=','departement.ID_D')
            ->select('employe.ID_NIN','employe.ID_P','employe.NOM_P',
            'employe.PRENOM_O','employe.DATE_NAIS_P','employe.LIEU_N',
            'employe.ADDRESS','employe.EMAIL','employe.PHONE_PN',
            'niveau.NOM_N','niveau.SPECIAL_N','niveau.FILIERE_N',
            'post.NOM_POST','post.GRADE_POST','post.ECHELLAN','post.DATE_RECT','departement.Nom_D')
            ->get();
            return $fich;
        }

        //liste fiche technique de chaque employé
        public function fichetechemp($id)
        {
            $fichemp = DB::table('employe')
                ->join('appartient', 'employe.ID_NIN', '=', 'appartient.ID_NIN')
                ->join('niveau', 'appartient.ID_N', '=', 'niveau.ID_N')
                ->join('post', 'employe.ID_NIN', '=', 'post.ID_NIN')
                ->join('travaill', 'employe.ID_NIN', '=', 'travaill.ID_NIN')
                ->join('departement', 'travaill.ID_D', '=', 'departement.ID_D')
                ->select('employe.ID_NIN', 'employe.ID_P', 'employe.NOM_P',
                    'employe.PRENOM_O', 'employe.DATE_NAIS_P', 'employe.LIEU_N',
                    'employe.ADDRESS', 'employe.EMAIL', 'employe.PHONE_PN',
                    'niveau.NOM_N', 'niveau.SPECIAL_N', 'niveau.FILIERE_N',
                    'post.NOM_POST', 'post.GRADE_POST', 'post.ECHELLAN', 'post.DATE_RECT', 'departement.Nom_D')
                ->where('employe.ID_NIN', $id)
                ->first(); // Récupérer uniquement le premier enregistrement

            return view('fichtech', compact('fichemp'));
        }


        //chercher employe UTILISER request here pour dire que fnct expects user input for searching
        public function searchemp(Request $request)
        {
          $req=DB::table('employe')
              ->join('appartient','employe.ID_NIN','=','appartient.ID_NIN')
              ->join('niveau','appartient.ID_N','=','niveau.ID_N')
              ->join('post','employe.ID_NIN','=','post.ID_NIN')
              ->join('travaill','employe.ID_NIN','=','travaill.ID_NIN')
              ->join('departement','travaill.ID_D','=','departement.ID_D')
              ->select('employe.ID_NIN','employe.ID_P','employe.NOM_P',
              'employe.PRENOM_O','employe.DATE_NAIS_P','employe.LIEU_N',
              'employe.ADDRESS','employe.EMAIL','employe.PHONE_PN',
              'niveau.NOM_N','niveau.SPECIAL_N','niveau.FILIERE_N',
              'post.NOM_POST','post.GRADE_POST','post.ECHELLAN','post.DATE_RECT','departement.Nom_D');


              //chercher by id_nin
            if($request->ID_NIN)
            {
              $req ->where('employe.ID_NIN','LIKE','%'.$request -> ID_NIN.'%');
              }

             //chercher by id_p

             elseif($request->ID_P)
             {
               $req ->where('employe.ID_P','LIKE','%'.$request -> ID_P.'%');

               }

               //chercher by nom
               elseif($request->NOM_P)
               {
                $req->where('employe.NOM_P','LIKE','%'.$request ->NOM_P.'%');
               }

               //chercher by phone number
               elseif($request->PHONE_PN)
               {
                $req->where('employe.PHONE_PN','LIKE','%'.$request->PHONE_PN.'%');
               }

               //chercher by post
               elseif($request->NOM_POST)
               {
                $req->where('post.NOM_POST','LIKE','%'.$request->NOM_POST.'%');
               }
             $result= $req->get();
             return $result;

            }
            public function showSearchResults(Request $request)
            {
                // Appel de la fonction searchemp pour récupérer les résultats de la recherche
                $searchResults = $this->searchemp($request);

                // Passer les résultats à une vue pour l'affichage
                return view('search', ['employe' => $searchResults]);
            }



    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all employees from the database
        $people = Employe::all();

        // Return the list as a JSON response
        return response()->json($people);
    }


    public function getByBirthday(Request $request)
    {
        // Validate the request data
        $request->validate([
            'birthday' => 'required|date',
        ]);

        // Retrieve employees with the same birthday
        $birthday = $request->input('birthday');
        $employees = Employe::where('birthday', $birthday)->get();

        // Return the list as a JSON response
        return response()->json($employees);
    }
    public function getByBirthdayGET($birthday)
    {
        // Validate the birthday format (optional but recommended)
        $validatedDate = \Illuminate\Support\Facades\Validator::make(
            ['birthday' => $birthday],
            ['birthday' => 'required|date']
        );

        if ($validatedDate->fails()) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        // Retrieve employees with the same birthday
        $employees = Employe::where('DATE_NAIS_P', $birthday)->get();

        // Return the list as a JSON response
        return response()->json($employees);
    }
    public function create()
    {
        return view('addTemplate.create');
    }
    public function createF()
    {
        return view('addTemplate.add');
    }
    public function getall($id)
    {
       // dd($id);
        $detailemp=DB::table('employes')->join('travails','travails.id_nin','=','employes.id_nin')
                                        ->join('occupes','employes.id_nin',"=",'occupes.id_nin')
                                       ->join('sous_departements','travails.id_sous_depart',"=","sous_departements.id_sous_depart")
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
        return view('BioTemplate.index',compact('detailemp','nbr'));}
        else
        {
            return view('404');
        }
    }
}
