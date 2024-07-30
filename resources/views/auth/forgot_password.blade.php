@extends('base')

@section('title', 'Forgot Password')

@section('content')
<style>
    
body {
    font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background: linear-gradient(to left, #f5f5f5, #000080); /* Dégradé beige clair à bleu clair */
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
}



/* Style pour la carte de connexion */
.login-card {
    width: 600px;
    height: 850px;

    margin: 0 auto;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;

 
   
}

/* Style pour le logo */
.login-card .logo {
    text-align: center;
    margin-bottom: 1rem;
   
}

.login-card .logo img {
    width: 250px;
    height: 250px;
}

/* Style pour les titres */
.login-card h1 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.login-card p {
    font-size: 1rem;
    margin-bottom: 2rem;
}

/* Style pour le textarea */
.login-card .textarea {
    resize: vertical;
    min-height: 200px;
    overflow:scroll;/* Ajoute une barre de défilement verticale si nécessaire */
    
}

/* Style pour le bouton de soumission */
.login-card .btn-primary {
    background-color: #000080; ;
    border-color: #007bff;
    padding: 0.75rem 1.25rem;
    font-size: 1rem;
    border-radius: 4px;
    transition: background-color 0.3s, border-color 0.3s;
    margin-top:40px;
    width:100%;
}

.login-card .btn-primary:hover {
    background: #000080; 
}



</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<div class="login-card">
    <div class="logo">
    <img src="{{ asset('assets/navbar/images/logo.png') }}" alt="Logo">
    </div>
    <h1 class="text-center text-muted mb-3 mt-5">{{ __('lang.forgotpass') }}</h1>
    <p class="text-center text-muted mb-5">{{ __('lang.reason') }}</p>
    <form action="{{route('app_forgotPassword')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">{{ __('lang.username') }}</label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', request()->query('username')) }}" readonly>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
           
            <textarea name="reason" id="reason" class="form-control textarea" required></textarea>

        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{ __('lang.envoiforgotpass') }}</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @if ($errors->any())
        alert('Veuillez corriger les erreurs dans le formulaire.');
    @endif

    @if (session('status'))
        alert('{{ session('status') }}');
    @endif
});
</script>
@endsection