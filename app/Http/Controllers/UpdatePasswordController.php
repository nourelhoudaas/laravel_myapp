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
            Log::error('Mot de passe actuel incorrect');
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mettre à jour le mot de passe
        $user = Auth::user();
      //  $user->password = Hash::make($request->new_password);
        $user->nv_password = Hash::make($request->new_password);
        $user->password_changed_at = now();
        $user->save();
       // Log::info('Mot de passe mis à jour pour l\'utilisateur', ['user_id' => $user->id]);
        // Déconnecter l'utilisateur
        Auth::logout();

        // Rediriger avec un message de succès
        return redirect()->route('login')->with('status', 'Mot de passe modifié avec succès !');
    }
}

