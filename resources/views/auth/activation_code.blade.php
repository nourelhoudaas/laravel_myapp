@extends('base')

@section('title', 'Account activation')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h1 class="text-center text-muted mb-3 mt-5">Account activation</h1>



                <form method="POST" action="{{ route('app_activation_code',['token' => $token]) }}">
                    @csrf

                    <div class="mb-3">
                        <label for="activation-code" class="form-label">Activation Code</label>
{{--
    required: Cela signifie que l'utilisateur doit remplir ce champ avant de pouvoir soumettre le formulaire.
    class: Si la session contient une clé nommée 'danger', alors la classe 'is-invalid' sera ajoutée au champ. Cela permet de marquer le champ en tant qu'erreur si une erreur est détectée dans la session.
    value: définir une valeur par défaut pour le champ. Elle vérifie si la session contient une clé nommée 'activation_code' et, si c'est le cas, elle utilise cette valeur comme valeur par défaut du champ.
    Cela peut être utile pour pré-remplir le champ avec une valeur précédemment soumise si l'utilisateur revient à cette page.
--}}
                        <input type="text" class="form-control @if(Session::has('danger')) is-invalid @endif" name="activation-code" id="activation-code"
                            value="@if(Session::has('activation_code')){{ Session::get('activation_code') }}@endif" required>
                    </div>


                   <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="{{ route('app_activation_account_change_email', ['token' => $token]) }}">Change your email address</a>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('app_resend_activation_code', ['token' => $token]) }}">Resend the activation code</a>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Activate</button>
                    </div>

                </form>
            </div>

        </div>



    </div>

@endsection
