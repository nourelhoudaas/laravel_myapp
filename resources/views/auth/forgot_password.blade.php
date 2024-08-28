<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content=" {{csrf_token()}}">

    <title>{{ __('lang.forgotpass') }}</title>
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
    padding: 15px 0; 
}
.scroll-container {
    width: 100%;
    max-width: 600px;
    padding: 15px;
}
    


.login-card {
  
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 2px solid #000080;
    display: flex;
    flex-direction: column;
}

.login-card .logo {
    text-align: center;
    margin-bottom: 1rem;
   
}

.login-card .logo img {
    width: 250px;
    height: 250px;
}


.login-card h1 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
    text-align: center;
}

.login-card p {
    font-size: 1rem;
    margin-bottom: 2rem;
}


.login-card .textarea {
    resize: vertical;
    min-height: 200px;
    overflow:scroll;
    
    
}

.login-card .btn-primary {
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

.login-card .btn-primary:hover {
    background: #000060;
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

<body>
    <div class="language-switcher">
     <a href="{{ url('lang/fr') }}">Français</a> |
    <a href="{{ url('lang/ar') }}">العربية</a>
    </div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         
         <div class="full-page">
            <div class="scroll-container">
        <div class="login-card">
            <div class="logo">
            <img src="{{ asset('assets/navbar/images/logo.png') }}" alt="Logo">
            </div>
            <h1 class="text-center text-muted mb-3 mt-5">{{ __('lang.forgotpass') }}</h1>
            <p class="text-center text-muted mb-5">{{ __('lang.reason') }}</p>
            
            <form method="POST" action="{{ route('app_forgotPassword') }}" class="form-group">
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
