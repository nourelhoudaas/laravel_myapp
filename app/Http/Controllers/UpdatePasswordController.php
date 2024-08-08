<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordController extends Controller
{
    //
    public function update(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
           
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8',
           
        ]);
        //dd($request);
        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, Auth::user()->password)) {
           
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mettre à jour le mot de passe
        $user = Auth::user();
        if ($user->nbr_login == 1) {
            return back()->withErrors(['error' => 'Le mot de passe ne peut être mis à jour qu\'une seule fois.']);
        } else {
            $user->nv_password = Hash::make($request->new_password);
            $user->password_changed_at = now();
            $user->nbr_login += 1;
            $user->save();
    
            // Déconnecter l'utilisateur
            Auth::logout();
    
            // Rediriger avec un message de succès
            return redirect()->route('login')->with('status', 'Mot de passe modifié avec succès !');
        }
}

}