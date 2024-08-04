@extends('base')

@section('title', 'Login')

@section('content')
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: linear-gradient(to left, #f5f5f5, #000080); /* Dégradé beige clair à bleu clair */
    background-size: cover; /* Assure que l'image de fond couvre l'intégralité de l'écran */
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.full-page {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh; /* Assure que le conteneur prend toute la hauteur de la vue */
    overflow: hidden; /* Évite les débordements */
}

.login-card {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 600px;
    min-height: 400px; /* Modifiez cette valeur pour ajuster la hauteur minimale */
    display: flex;
    flex-direction: column;
    align-items: center; /* Centre horizontalement tous les enfants */
    position: relative;
    border: 2px solid #000080; /* Ajoute une bordure bleue foncée de 2px */
}

.logo {
    margin-bottom: 1rem;
}

.logo img {
    width: 150px;
    height: 150px;
}

h1, h2 {
    margin-bottom: 1.5rem;
    color: #333;
    text-align: center;
}

h1 {
    font-size: 1.5rem; 
}

h2 {
    font-size: 1.25rem; 
}

.form-group {
    width: 100%;
}

.form-label {
    display: block;
    margin-bottom: 1.25rem;
}

.form-control {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: #f9f9f9;
    width: 100%;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #000080; 
    outline: none;
}

.alert {
    margin-bottom: 1rem;
}

.btn-primary {
    background: #000080; 
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 1rem;
    padding: 0.75rem;
    cursor: pointer;
    transition: background 0.3s;
    width: 100%; 
    margin-top: 20px;
}

.btn-primary:hover {
    background: #000080; 
}

.text-muted {
    color: #666;
    display: block;
    margin-top: 1rem;
}

.text-end {
    text-align: right;
    margin-bottom: 1rem;
    margin-top: 20px;
}

/* Styles spécifiques aux alignements */
.form-group {
    text-align: left;
    /* Aligne les champs de saisie et les autres éléments à gauche */
}

.form-group .form-check {
    text-align: left; 
    margin-top: 20px; /* Assure que "Souviens-toi de moi" est aligné à gauche */
}

.form-group .form-check input {
    margin-top: 0.25rem;
}

.form-group .form-check label {
    margin-left: 0.5rem;
}

/* Styles pour les petits écrans */
@media (max-width: 600px) {
    .logo img {
        width: 100px;
        height: 100px;
    }
    .login-card {
        padding: 1rem;
    }
    h1 {
        font-size: 1.25rem;
    }
    h2 {
        font-size: 1rem;
    }
    .form-control {
        padding: 0.5rem;
    }
    .btn-primary {
        font-size: 0.875rem;
        padding: 0.5rem;
    }
}
</style>
<div class="full-page">
    <div class="left-half">
        <div class="login-card">
            <div class="logo text-center mb-4">
                <img src="{{ asset('assets/navbar/images/logo.png') }}" alt="Logo">
            </div>
            <h1 class="text-center text-muted mb-3">{{ __('lang.bienvenue') }}</h1>
            <h2 class="text-center text-muted mb-3">{{ __('lang.login') }}</h2>
            <form method="POST" action="{{ route('login') }}" class="form-group">
                @csrf

                @error('username')
                    <div class="alert alert-danger text-center" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                @error('password')
                    <div class="alert alert-danger text-center" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="username" class="form-label">{{ __('lang.username') }}</label>
                    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('lang.motdepass') }}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('lang.rememberme') }}</label>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="#" id="forgotPasswordLink">{{ __('lang.forgotpass') }}</a>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">{{ __('lang.login') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('forgotPasswordLink').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien

        var username = document.getElementById('username').value; // récupère la val du champ username
            //si usrname existe
        if (username) {
            
            fetch("{{ route('checkUsername') }}?username=" + encodeURIComponent(username))
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Redirige vers forgotpass
                        window.location.href = "{{ route('app_forgotPassword') }}?username=" + encodeURIComponent(username);
                    } else {
                        alert('Le nom d\'utilisateur n\'existe pas.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur s\'est produite lors de la vérification du nom d\'utilisateur.');
                });
        } else {
            alert('Veuillez entrer un nom d\'utilisateur avant de demander une réinitialisation du mot de passe.');
        }
    });

});
</script>
@endsection
