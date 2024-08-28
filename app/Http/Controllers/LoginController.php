<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use DateTimeImmutable;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{



//---------------------------------------------------------------------LOGOUT---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function logout()
    {
         // Récupérer l'usr connecté
    $user = Auth::user();

    if ($user) {
        // si usr est authntifié
        $login = Login::where('id', $user->id)
                            ->whereNull('date_logout')
                            ->first();

        if ($login) {
            // Mettre à jour la date de logout
            $login->update(['date_logout' => new \DateTimeImmutable]);
        }

        // Déconnecter l'utilisateur and redirect to login
        Auth::logout();

        return redirect()->route('login');
        
    }

    // Si l'utilisateur n'est pas connecté, rediriger vers la page de login
    return redirect('/login')->withErrors(['message' => 'Aucun utilisateur connecté.']);
}
       
    


//---------------------------------------------------------------------CONSTRUCTEURS---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
protected $request;
    protected $request2;
    function __construct(Request $request, Request $request2)
    {
        $this->request= $request;
        $this->request2= $request2;
    }


//---------------------------------------------------------------------EXIST EMAIL---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
   /* public function existEmail()
    {
        //recuperation de l email inserer a partir de input
        $email = $this->request->input('email');

        // verifier si email est deja utilisé
        $user= User::where('email', $email)
                            ->first();
        $response="";
        ($user) ? $response="exist" : $response="not_exist";

        return response()->json([
            'code'=> 200,
            'data_response'=>$response,
        ]);
    }
*/

//---------------------------------------------------------------------EXIST USERNAME---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function existUsername()
    {
        //recuperation de l email inserer a partir de input
        $username = $this->request->input('username');

        // verifier si email est deja utilisé
        $user= User::where('username', $username)
                            ->first(); // La méthode first() renvoie le premier utilisateur trouvé ou null s'il n'y en a pas.

        $response="";
        ($user) ? $response="exist" : $response="not_exist";

        return response()->json([
            'code'=> 200,
            'data_response2'=>$response,
        ]);
    }



//---------------------------------------------------------------------EXIST IDP---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
public function existIDP()
{
    //recuperation de l email inserer a partir de input
    $id_p = $this->request->input('id_p');

    // verifier si email est deja utilisé
    $user= User::where('id_p', $id_p)
                        ->first(); // La méthode first() renvoie le premier utilisateur trouvé ou null s'il n'y en a pas.

    $response="";
    ($user) ? $response="exist" : $response="not_exist";

    return response()->json([
        'code'=> 200,
        'data_response4'=>$response,
    ]);
}



//---------------------------------------------------------------------EXIST ID NIN---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
public function existIDNIN()
{
    //recuperation de l email inserer a partir de input
    $id_nin = $this->request->input('id_nin');

    // verifier si email est deja utilisé
    $user= User::where('id_nin', $id_nin)
                        ->first(); // La méthode first() renvoie le premier utilisateur trouvé ou null s'il n'y en a pas.

                        // verifier si email est deja utilisé
     $user= User::where('id_nin', $id_nin)
     ->first(); // La méthode first() renvoie le premier utilisateur trouvé ou null s'il n'y en a pas.

    $response="";
    ($user) ? $response="exist" : $response="not_exist";

    return response()->json([
        'code'=> 200,
        'data_response3'=>$response,
    ]);
}

//---------------------------------------------------------------------PASSWORD FORGOTEN---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function forgotPassword(Request $request)
    {
        return view('auth.forgot_password');

    }

    public function checkUsername(Request $request)
        {
            $username = $request->query('username');
            // dd($username);
            if (User::where('username', $username)->exists()) {
                return response()->json(['exists' => true]);
            } else {
                return response()->json(['exists' => false]);
            }
        }

        public function sendResetLinkEmail(Request $request)
            {   
                $request->validate([
                'username' => 'required|string',
                'reason' => 'required|string',
            ]);

            $user = User::where('username', $request->username)->first();

            if (!$user) {
                return redirect()->route('login')->with('erreur', 'Le mot d'/'utilisateur n'/'est pas trouvé ');
            }

            $emailData = [
                'username' => $request->username,
                'reason' => $request->reason,
            ];

            Mail::raw("Username: {$emailData['username']}\nReason: {$emailData['reason']}", function($message) {
                $message->to('test@example.com') 
                        ->subject('Mot de passe oublié - Raison fournie')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return back()->with('status', 'Votre réponse a été envoyé avec success ');
        }
            



//---------------------------------------------------------------------VERIFICATION DE L'AUTHENTIFICATION DU USER---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
/*public function userChecker()
{
    // Récupère à partir de la base de donnée le jeton d'activation et le statut de vérification de l'utilisateur connecté
    $activation_token = Auth::user()->activation_token;
    $is_verified = Auth::user()->is_verified;

    // Vérifie si l'utilisateur n'est pas vérifié
    if($is_verified != 1)
    {
        // Déconnecte l'utilisateur
        Auth::logout();

        // Redirige l'utilisateur vers la page d'activation avec un message d'avertissement
        return redirect()->route('app_activation_code', ['token' => $activation_token])
                        ->with('warning', 'Your account is not activate yet, please check your mail-box
                                and activate your account or resend the confirmation message.');
    }
    else
    {
        // Redirige l'utilisateur vérifié vers le tableau de bord
        return redirect()->route('app_dashboard');
    }
}
*/
//---------------------------------------------------------------------ACTIVATION CODE---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
   /* public function activationCode($token)
    {
    // Recherche de l'utilisateur correspondant au token d'activation
        $user = User::where('activation_token', $token)->first();

    // Vérifie si aucun utilisateur correspondant n'est trouvé
        if(!$user)
        {
        // Redirige vers la page de connexion avec un message d'erreur
            return redirect()->route('login')->with('danger', 'This token doesn\'t match any user.');
        }

 //le code à l'intérieur de cette condition sera exécuté uniquement lorsque le formulaire est soumis, car le formulaire utilise la méthode POST pour envoyer les données.
//le code à l'intérieur de cette condition sera exécuté uniquement lorsque le formulaire est soumis, car le formulaire utilise la méthode POST pour envoyer les données.
        if($this->request->isMethod('post'))
        {
         // Récupère de la bd le code d'activation de l'utilisateur
            $code = $user->activation_code;
         // Récupère le code d'activation saisi par l'utilisateur
            $activation_code = $this->request->input('activation-code');
         // Vérifie si le code d'activation saisi correspond au code d'activation de l'utilisateur
            if($activation_code != $code)
            {
              // Redirige vers la page précédente avec un message d'erreur
                return back()->with([
                    'danger' => 'This activation code is invalid!',
                    'activation_code' => $activation_code
                ]);
            }
            else
            {
              // Met à jour les données de l'utilisateur dans la base de données pour marquer son adresse e-mail comme vérifiée
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'is_verified' => 1,
                        'activation_code' => '',
                        'activation_token' => '',
                        'email_verified_at' => new \DateTimeImmutable,// est utilisé pour gérer les dates et heures de manière immuable(non modifiable)
                        'updated_at' => new \DateTimeImmutable
                    ]);

                return redirect()->route('login')->with('success', 'Your e-mail address has been verified!');
            }
        }
     // Charge la vue pour entrer le code d'activation
        return view('auth.activation_code', [
            'token' => $token
        ]);
    }

*/
//---------------------------------------------------------------------RENVOYER LE CODE D'AUTHENTIFICATION---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
   /* public function resendActivateCode($token)
{
    // Recherche l'utilisateur par son jeton d'activation
        $user = User::where('activation_token', $token)->first();
        $email=$user->email;
        $name=$user->name;
        $activation_token=$user->activation_token;
        $activation_code=$user->activation_code;

    // Envoie du mail
        $emailSend= new EmailService;
        $subject="activate your account";
        $emailSend->sendEmail($subject, $email, $name,true, $activation_code,$activation_token);

        return back()->with('success', 'We have just resent the new activation code');
}



    public function activationAccountLink($token)
{
    // Recherche l'utilisateur par son jeton d'activation
    $user = User::where('activation_token', $token)->first();


   // Si aucun utilisateur n'est trouvé avec ce jeton, redirige vers la page de connexion avec un message d'erreur
   // D'une autre maniere on fait cette condition pour eviter tout changement manuelle dans l'URL.

    if(!$user)
    {
        return redirect()->route('login')->with('danger', 'This token doesn\'t match any user.');
    }

    // Si un utilisateur est trouvé, met à jour les informations de l'utilisateur pour le marquer comme vérifié
    DB::table('users')
        ->where('id', $user->id)
        ->update([
            'is_verified' => 1, // Marque l'utilisateur comme vérifié
            'activation_code' => '', // Efface le code d'activation
            'activation_token' => '', // Efface le jeton d'activation
            'email_verified_at' => new \DateTimeImmutable, // Met à jour la date de vérification de l'email
            'updated_at' => new \DateTimeImmutable // Met à jour la date de modification
        ]);

    // Redirige vers la page de connexion avec un message de succès
    return redirect()->route('login')->with('success', 'Your e-mail address has been verified!');
}
*/
//---------------------------------------------------------------------CHANGE EMAIL ACCOUNT---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------
/*
    public function activateAccountChangeEmail($token)
{
    $user=User::where('activation_token', $token)->first();

    if($this->request->isMethod('post'))
    {
        $new_email= $this->request->input('new_email');
        $user_exist=User::where('email', $new_email)->first();;


           // Cette ligne affiche le contenu de $user_existe de manière lisible pour le développeur et arrête l'exécution du script.
           // Cela signifie que toute ligne de code après dd($user_existe); ne sera pas exécutée.
                        //dd($user_existe);


        if($user_exist)
        {
            // Redirige vers la page précédente avec un message d'erreur
            return back()->with([
                'danger' => ' This adress email is already used!, please enter another email adress',
                'new_email' => $new_email,
            ]);
        }
        else
        {
            DB::table('users')
                ->where('id',$user->id)
                ->update([
                    'email'=>$new_email,
                    'updated_at' => new DateTimeImmutable,
                ]);
            $activation_code=$user->activation_code;
            $activation_token=$user->activation_token;
            $name= $user->name;

        // Envoie du mail
            $emailSend= new EmailService;
            $subject="activate your account";
            $emailSend->sendEmail($subject, $new_email, $name,true, $activation_code,$activation_token);

            return redirect()->route('app_activation_code', ['token'=>$token])
                             ->with('success', 'Your e-mail address has been changed!');
        }
    }
    return view('auth.activation_account_change_email', [
        'token' => $token
    ]);
}*/

//---------------------------------------------------------------------FORGOT PASSWORD---------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------------------------------------------------


}

