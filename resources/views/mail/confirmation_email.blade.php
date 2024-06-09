<h1> Hi {{ $name}} Please confirm your email!</h1>

<p>
    Please activate your account with the activation code sended to your address email
    <br> Activation code: {{$activation_code}}.
    <br> Or click to the following link: <br>
    <a href="{{ route('app_activation_account_link',['token' => $activation_token]) }}" target="_blank">Confirm your accout</a>
</p>

<p>
    M_Com team.
</p>


