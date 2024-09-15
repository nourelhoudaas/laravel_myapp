<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Conge;
use Illuminate\Http\Request;
use \App\Models\Employe;
use \App\Models\Compt;
use \App\Models\Niveau;
use \App\Models\Post;
use \App\Models\Fichier;
use \App\Models\Absence;
use \App\Models\Occupe;
use Illuminate\Support\Facades\DB;
use App\Services\logService;
use Illuminate\Support\Facades\Auth;

class BioEmployeControl extends Controller
{
    //
    protected $logService;

    public function __construct(logService $logService)
    {
        $this->logService = $logService;
    }

    public function create($id)
    {
        $employe=Employe::where('ID_NIN', $id)->firstOrFail();
        return view('BioTemplate.index',compact('employe'));
    }


    public function update(Request $request,$id)
    {

        $request->validate([
            'Prenom_O' => 'string',
            'Nom_P' => 'string',
            'Prenom_O_ar'=> 'string',
            'Nom_P_ar'=> 'string' ,
            'Email' => 'string',
            'phone_pn' => 'integer',
            'Date_Nais_P' => 'date',
            'Address' => 'string',
            'AddressAR' => 'string',
            'email_pro'=>'string'
        ]);
      //      dd($request);
        $updated = DB::table('employes')
                    ->where('id_nin', $id)
                    ->update([
                        'Nom_emp'=>$request->input('Nom_P'),
                        'Prenom_emp' => $request->input('Prenom_O'),
                        'Nom_ar_emp'=>$request->input('Nom_P_ar'),
                        'Prenom_ar_emp' => $request->input('Prenom_O_ar'),
                        'Date_nais'=>$request->input('Date_Nais_P'),
                        'adress' => $request->input('Address'),
                        'adress_ar' => $request->input('AddressAR'),
                        'email' => $request->input('Email'),
                        'Phone_num' => $request->input('phone_pn'),
                        'email_pro'=>$request->input('email_pro')
                            ]);
                            $ups='mise à jour';
                            $upsnot='n`est pas mise à jour';
                            if(app()->getLocale() == 'ar')
                            {
                                $ups=' تم التحديث ';
                                $upsnot='خطا في التحديث';
                            }

        if ($updated) {

             //ajouter l'action dans table log
          $log= $this->logService->logAction(
            Auth::user()->id,
            $id,
            'Update Employé',
            $this->logService->getMacAddress()
        );

            return response()->json([
                'success' =>  $ups,
                'status'=>200
            ]);
        } else {
            return response()->json(['error' => $upsnot,], 404);
        }
    }
    public function update_just(Request $request)
    {
        App::setLocale(Session::get('locale', config('app.locale')));
        $request->validate([
            'id_nin'=>'required|integer',
            'just'=>'required|string',
            'date_abs'=>'required|date',
            'sous_d'=>'required|string'
        ]);

        $id_file=Fichier::select('id_fichier')
                         ->where('nom_fichier',$request->get('just'))
                         ->orderBy('date_cree_fichier','desc')
                        ->first();

        $update=Absence::where('id_nin',$request->get('id_nin'))
                        ->where('date_abs',$request->get('date_abs'))->first();

        $update=Absence::find($update->id_abs);
        dd($update);
        $update->update(['id_fichier'=>$id_file->id_fichier]);
        $ups='mise à jour';
        $upsnot='n`est pas mise à jour';
        if(app()->getLocale() == 'ar')
        {
            $ups=' تم التحديث ';
            $upsnot='خطا في التحديث';
        }

            if($update)
            {
                return response()->json([
                    'success'=>$ups,
                    'code'=>200,
                ]);
            }
            else
            {
                return response()->json([
                    'success'=>$upsnot,
                    'code'=>404,
                ]);
            }
    }
    public function update_cng(Request $request)
    {
        App::setLocale(Session::get('locale', config('app.locale')));
        $request->validate([
            'id_nin'=>'required|integer',
            'titre'=>'required|string',
            'date_debut_cong'=>'required|date',
            'sous_d'=>'required|string'
        ]);

        $id_file=Fichier::select('id_fichier')
                         ->where('nom_fichier',$request->get('titre'))
                         ->orderBy('date_cree_fichier','desc')
                         ->orderBy('id_fichier','desc')
                        ->first();

        $update=Conge::where('id_nin',$request->get('id_nin'))
                        ->where('date_debut_cong',$request->get('date_debut_cong'))->first();
        $update=Conge::find($update->id_cong);
        $update->update(['id_fichier'=>$id_file->id_fichier]);
        $ups='mise à jour';
        $upsnot='n`est pas mise à jour';
        if(app()->getLocale() == 'ar')
        {
            $ups=' تم التحديث ';
            $upsnot='خطا في التحديث';
        }
            if($update)
            {
                return response()->json([
                    'success'=>$ups,
                    'code'=>200,
                ]);
            }
            else
            {
                return response()->json([
                    'success'=> $upsnot,
                    'code'=>404,
                ]);
            }
    }
    public function getcarrier(Request $request)
    {

      //  dd($request);
        $idar=explode(' ',$request->get('idocp'));
      //  dd($idar);
        $idtr=intval($idar[0]);
        $idocp=intval($idar[1]);
      /*  $req='SELECT * FROM `occupes` JOIN posts on posts.id_post = occupes.id_post
						JOIN secteurs on secteurs.id_secteur=posts.id_secteur
                        JOIN filieres on filieres.id_filiere = secteurs.id_filiere
						JOIN contients on contients.id_post = posts.id_post
                        JOIN sous_departements on sous_departements.id_sous_depart = contients.id_sous_depart
                        JOIN travails on travails.id_sous_depart = sous_departements.id_sous_depart
                        WHERE travails.id_travail=21 and occupes.id_occup=12';*/
        $carrier=Occupe::join('posts','posts.id_post','=','occupes.id_post')
                        ->join('secteurs','secteurs.id_secteur','=','posts.id_secteur')
                        ->join('filieres','filieres.id_filiere','=','secteurs.id_filiere')
                        ->join('contients','contients.id_post','=','posts.id_post')
                        ->join('sous_departements','sous_departements.id_sous_depart','=','contients.id_sous_depart')
                        ->join('travails','travails.id_sous_depart','=','sous_departements.id_sous_depart')
                        ->where('travails.id_travail',$idtr)
                        ->where('occupes.id_occup',$idocp)
                        ->first();
                        dd($carrier);
                        if($carrier)
                        {
                            return response()->json([
                                'message'=>__('lang.next'),
                                'emp'=>$carrier,
                                'status'=>200,
                            ]);
                        }
                        else
                        {
                            return response()->json([
                                'message'=>'Pas de recorde',
                                'status'=>302,
                            ]);
                        }
    }

}
