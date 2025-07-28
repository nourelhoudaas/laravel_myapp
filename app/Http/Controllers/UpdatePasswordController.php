<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class UpdatePasswordController extends Controller
{
    //
    public function update(Request $request)
    {
        App::setLocale(Session::get('locale', config('app.locale')));
        // Valider les données de la requête
        $request->validate([
           
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8',
           
        ]);
        //dd($request);
        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, Auth::user()->password)) {
           
            return back()->withErrors(['current_password' => __('lang.Le_mot_de_passe_actuel_est_incorrect')]);
        }

        // Mettre à jour le mot de passe
        $user = Auth::user();
        if ($user->nbr_login == 1) {
            return back()->withErrors(['error' => __('lang.Lemotdeassenepeutêtremisàjourquuneseulfois')]);
        } else {
            $user->nv_password = Hash::make($request->new_password);
            $user->password_changed_at = now();
            $user->nbr_login += 1;
            $user->save();
    
            // Déconnecter l'utilisateur
            Auth::logout();
    
            // Rediriger avec un message de succès
            return redirect()->route('login')->with(['status'=>__('lang.Mot_de_passe_modifié_avec_succès')]);
        }
}

}