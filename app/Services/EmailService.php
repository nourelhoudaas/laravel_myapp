<?php

namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
class EmailService
{
    protected $app_name;
    protected $host;
    protected $port;
    protected $user_name;
    protected $password;



    function __construct()
    {
        //recuperer (APP_NAME) qui se trouve dans [env]( variable d environement) a partir du dossier [config] dedans le fichier [app] dedans [name] d'où (app.name)
        $this->app_name=config('app.name');
        $this->host=config('app.mail_host');
        $this->port=config('app.mail_port');
        $this->username=config('app.mail_username');
        $this->password=config('app.mail_password');
    }

//-----------------------------------------------------CREATION ET ENVOIE DU MAIL DE VERIFICATION------------------------------------------------
//-----------------------------------------------------------------------------------------------------
    public function sendEmail($subject, $emailUser, $nameUser, $isHtml, $activation_code,$activation_token)
    {
        //configuration de l envoie du mail de verification
        $mail= new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug=0;
        $mail->Host=$this->host;
        $mail->Port=$this->port;
        $mail->Username=$this->username;
        $mail->Password=$this->password;
        $mail->SMTPAuth=true;
        $mail->Subject=$subject;
        $mail->setFrom($this->app_name, $this->app_name);
        $mail->addReplyTo($this->app_name, $this->app_name);
        $mail->addAddress($emailUser, $nameUser);
        $mail->isHTML($isHtml);
        $mail->Body=$this->viewSendEmail($nameUser, $activation_code,$activation_token);
        $mail->send();
    }

//-------------------------------------------------------------LA VUE DU MAIL DE VERIFICATION ENVOYER----------------------------------------
//-----------------------------------------------------------------------------------------------------

    public function viewSendEmail($name, $activation_code, $activation_token)
{
    /* si on veut envoyer l email en type simple sans html

        $message="Hi ".$name." We have received your request for a one-time code to use with your M_Com account. Your one-time use code is: ".$activation_code.
                 ". \br Or click on the link below to activate it: \br".$activation_token;

        $emailSend->sendEmail($subject, $email, $name,false, $message);
*/

//si on veut envoyer l email en type HTML ce qui veut dire envoyer une npage et donc une vue [view]
        return view('mail.confirmation_email')
                ->with([
                            'name'=>$name,
                            'activation_code'=>$activation_code,
                            'activation_token'=>$activation_token
                        ]);
}
}
