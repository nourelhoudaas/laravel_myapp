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

class LoginUser  
{
    public function authenticateUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
       
        $user=User::where('username',$request->username)->first();
       
        if($user && Hash::check($request->password, $user->password))
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
            return redirect()->route('app_dashboard');
        }
        
    
    else{
        return back()->withErrors(['username' => 'Invalid username or password']);
    }
}
}

  

