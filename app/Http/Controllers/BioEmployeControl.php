<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Employe;
use \App\Models\Compt;
use \App\Models\Niveau;
use \App\Models\Post;
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
            'Prenom_O' => 'required|string',
            'Nom_P' => 'required|string',
            'Prenom_OAR'=> 'required|string',
            'Nom_PAR'=> 'required|string' ,
            'Email' => 'required|string',
            'phone_pn' => 'required|integer',
            'dateN' => 'required|date',
            'adr' => 'required|string',
            'adrAR' => 'required|string',
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
                            ]);

        if ($updated) {
            
             //ajouter l'action dans table log
          $log= $this->logService->logAction(
            Auth::user()->id,
            $id,
            'Update Employé',
            $this->logService->getMacAddress()
        );
            return response()->json(['success' => 'Employee Prenom updated successfully']);
        } else {
            return response()->json(['error' => 'Employee not found or update failed'], 404);
        }
    }
        
}
