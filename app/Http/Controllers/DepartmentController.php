<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use DB;
    use App\Models\Employe;
    use App\Models\Departement;
    use Illuminate\Support\Facades\Log;


    class DepartmentController extends Controller
    {
        public function ListeDepart()
        {
            return view('department.list_depart');
        }


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

    return view('department.dashboard_depart', compact('empdep','empdepart','totalEmpDep','nom_d','dep_id','champs','direction'));
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
            $totalEmpDep = $empdep->count();


            return view('department.add_depart', compact('empdep','totalEmpDep','empdepart','nom_d'));
        }

        
    }
