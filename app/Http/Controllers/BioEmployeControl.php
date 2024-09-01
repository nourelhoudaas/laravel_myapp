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
            'Prenom_OAR'=> 'string',
            'Nom_PAR'=> 'string' ,
            'Email' => 'string',
            'phone_pn' => 'integer',
            'dateN' => 'date',
            'adr' => 'string',
            'adrAR' => 'string',
            'email_pro'=>'string'
        ]);
       // dd($request);
        $updated = DB::table('employes')
                    ->where('id_nin', $id)
                    ->update([
                        'Nom_emp'=>$request->input('Nom_P'),
                        'Prenom_emp' => $request->input('Prenom_O'),
                        'Nom_ar_emp'=>$request->input('Nom_PAR'),
                        'Prenom_ar_emp' => $request->input('Prenom_OAR'),
                        'Date_nais'=>$request->input('dateN'),
                        'adress' => $request->input('adr'),
                        'adress_ar' => $request->input('adrAR'),
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

}
