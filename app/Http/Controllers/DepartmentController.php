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

    //la page dashboard_depart.blade.php
    public function dashboard_depart(Request $request,$dep_id)
    {
          
   // Récupérer les paramètres de tri depuis la requête
   $sort = $request->input('sort', 'Nom_emp'); // Champ de tri par défaut
   $direction = $request->input('direction', 'asc'); // Direction de tri par défaut

   $query = Employe::with([
       'occupeIdNin' => function ($query) {
           $query->orderBy('date_recrutement', 'desc')->take(1);
       },
       'occupeIdNin.post.contient.sous_departement.departement',
       'travailByNin' => function ($query) {
           $query->orderBy('date_installation', 'desc')->take(1);
       },
       'travailByNin.sous_departement.departement',
   ])
   ->join('occupes', 'employes.id_nin', '=', 'occupes.id_nin')
   ->join('posts', 'occupes.id_post', '=', 'posts.id_post')
   ->join('contients', 'posts.id_post', '=', 'contients.id_post')
   ->join('sous_departements', 'contients.id_sous_depart', '=', 'sous_departements.id_sous_depart')
   ->join('departements', 'sous_departements.id_depart', '=', 'departements.id_depart')
   ->join(DB::raw('(SELECT id_nin, MAX(date_installation) as max_date_installation 
   FROM travails GROUP BY id_nin) latest_travails'),
    function ($join) {
       $join->on('employes.id_nin', '=', 'latest_travails.id_nin');
   })
   ->join('travails', function ($join) {
       $join->on('employes.id_nin', '=', 'travails.id_nin')
            ->on('latest_travails.max_date_installation', '=', 'travails.date_installation');
   })
   ->where('departements.id_depart', $dep_id);
    // Appliquer le tri en fonction du champ et de la direction
    if ($sort == 'age') {
        $query->orderByRaw('TIMESTAMPDIFF(YEAR, Date_nais, CURDATE()) ' . $direction);
        dd($query);
    } elseif ($sort == 'Nom_post') {
        $query->orderBy('posts.Nom_post', $direction);
    } elseif ($sort == 'Nom_depart') {
        $query->orderBy('departements.Nom_depart', $direction);
    } elseif ($sort == 'Nom_sous_depart') {
        $query->orderBy('sous_departements.Nom_sous_depart', $direction);
    } elseif ($sort == 'date_recrutement') {
        $query->orderBy('occupes.date_recrutement', $direction);
    } elseif ($sort == 'date_installation') {
        $query->orderBy('travails.date_installation', $direction);
    } else {
        $query->orderBy($sort, $direction);
    }

    // Exécuter la requête et récupérer les résultats
    $empdep = $query->get();

 

  

    
    
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

return view('department.dashboard_depart', compact('empdep','empdepart','nom_d','dep_id','sort','direction'));
    }


    public function AddDepart()
    {
        return view('department.add_depart');
    }
}
