<?php

namespace App\Actions\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LoginViewResponse as LoginViewResponseContract;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LoginUser
{
    public function authenticateUser(Request $request)
    {
        App::setLocale(Session::get('locale', config('app.locale')));
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user=User::where('username',$request->username)->first();
       //dd($user);
       if($user!= NULL){
       if($user->nbr_login == 0 )
       {
        $pass=$user->password;
       }
       else
       {
        $pass=$user->nv_password;
       }
    }
        if($user && Hash::check($request->password, $pass))
        {

            //recuperation des données de l'usr
            $iduser = $user->id;
            $id_nin=$user->id_nin;
            $id_p=$user->id_p;

                    //authntifier l'usr
                 Auth::login($user);

            //stocker les infos dans table logins
            Login::create([
                'id'=>$iduser,
                'id_nin'=>$id_nin,
                'id_p'=>$id_p,
                'date_login'=>new \DateTimeImmutable,
                'date_logout'=>null,
            ]);
           // $c=auth()->id();
          //  dd($c);
          //  View::share('uid',$iduser);

          // Vérifier la valeur de nbr_login
        if ($user->nbr_login == 0) {
            // Mettre à jour nbr_login

            $user->save();
            $user->nbr_login = 1;

            // Rediriger vers la page de mise à jour du mot de passe
            return redirect()->route('password_update'); // Assure-toi que cette route existe
        }

            return redirect()->route('app_dashboard');
        }


    else{
        return back()->withErrors([
            'username' => __('lang.Invalidusernameorpassword'),
        ]);
    }
}


}



