<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Services\EmailService;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
    /*    Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();*/

       // $email=$input['email'];
        $id_nin=$input['id_nin'];
        $id_p=$input['id_p'];
        $name = $input['firstname']. ' '.$input['lastname'];

    // Generer un token d'activation
    // hasher en md5 un [id] qui  sera unique [uniqid()] et hasher en sha1 l [email] pour qu il soit un token tres unique
       // $activation_token= md5(uniqid()). $email.sha1($email);

    // Generer un token d'activation
        /*$activation_code="";
        $length_code=5;
        for ($i=0; $i <$length_code ; $i++)
        {
            $activation_code .=mt_rand(0,9);
        }*/

    // Envoie du mail
       /* $emailSend= new EmailService;
        $subject="activate your account";
        $emailSend->sendEmail($subject, $email, $name,true, $activation_code,$activation_token);
*/

    // insertion les infos du nouveau user dans la table users
        return User::create([
            'name' => $name,
            'id_nin' => $id_nin,
            'id_p' => $id_p,
            'username' => $input['username'],
            //'email' => $email,
            'password' => Hash::make($input['password']),
           // 'activation_code' =>$activation_code,
            //'activation_token'=>$activation_token
            'password_created_at' => now(),
            'password_changed_at' => null, // Pas encore changé
        ]);
    }
}
