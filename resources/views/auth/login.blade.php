    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content=" {{csrf_token()}}">
        <title>{{ __('lang.login') }}</title>
        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
            @guest
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            {{-- barre de navigation--}}

            @endguest
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"> 
    </script>

    <style>

        body {
            font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                background: linear-gradient(to left, #f5f5f5, #000080);
                background-size: cover; /* Assure que l'image de fond couvre l'intégralité de l'écran */
                background-repeat: no-repeat;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                /*overflow: scroll;*/
            }


            .full-page {
        display: flex;
        justify-content: center;
        align-items:  flex-start;
        width: 100%;
        height: 100vh; 
        overflow: auto; 
        padding: 50px 0; 
    }
    .scroll-container {
        width: 100%;
        max-width: 600px;
        padding: 50px;
    }
    .login-card {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border: 2px solid #000080;
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
            
            }

            .logo {
                margin-bottom: 1rem;
            
            }

            .logo img {
                width: 150px;
                height: 150px;
            }

            h1, h2 {
            
                color: #333;
                text-align: center;
            }

            h1 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            h2 {
                font-size: 1.25rem;
                margin-bottom: 1.5rem;
            }

            .form-group {
                margin-bottom: 1rem;
                text-align: left;
                width: 100%;
            }
    .form-check{
        margin-top:5px;
    }
            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: #555;
            }

            .form-control {
                padding: 0.75rem;
                border: 1px solid #ccc;
                border-radius: 4px;
                background: #f9f9f9;
                font-size: 1rem;
                width: 100%;
                box-sizing: border-box;
            
            }

            .form-control:focus {
                border-color: #000080;
                outline: none;
            }

            .alert {
                margin-bottom: 1rem;
                color: #ff0000;
                text-align: center;
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
                background: #000060;
            }

            .text-end {
                text-align: right;
                margin-top: 5px;
            }

            .language-switcher {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 0.875rem;
            }

            .language-switcher a {
                color: #007bff;
                text-decoration: none;
                margin: 0 5px;
            }

            .language-switcher a:hover {
                text-decoration: underline;
            }

        
    </style>
    </head>
    <body>
        <div class="language-switcher">
            <a href="{{ url('lang/fr') }}">Français</a> |
            <a href="{{ url('lang/ar') }}">العربية</a>
        </div>

    <div class="full-page">
        <div class="scroll-container">
            <div class="login-card">
                <div class="logo text-center mb-4">
                    <img src="{{ asset('assets/navbar/images/logo.png') }}" alt="Logo">
                </div>
                <h1 class="text-center text-muted mb-3">{{ __('lang.bienvenue') }}</h1>
                <h2 class="text-center text-muted mb-3">{{ __('lang.login') }}</h2>
                <form method="POST" action="{{ route('login_post') }}" class="form-group">
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
    </body>
    <script>
        var lng='{{app()->getLocale()}}'
        console.log('loging '+lng)
        lang_alert = {
        userNotFound: "{{ __('lang.Lemotutilisateurnestpastrouvé') }}",
        errorOccurred: "{{ __('lang.Uneerreurestproduitelorsdelavérificationdunomutilisateur') }}",
        enterUsername: "{{ __('lang.Veuillezntrerunnomutilisateuravandedemandeuneréinitialisationdumotdepasse') }}",
    };
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
                            alert(lang_alert.userNotFound);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert(lang_alert.errorOccurred);
                    });
            } else {
                alert(lang_alert.enterUsername);
            }
        });

    });
    </script>
    </html>
