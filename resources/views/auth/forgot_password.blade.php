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




.login-card {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 600px;
    height: 850px;

    display: flex;
    flex-direction: column;
    align-items: center; /* Centre horizontalement tous les enfants */
    position: relative;
    
   
}

.logo {
    margin-bottom: 1rem;
}

.logo img {
    width: 250px;
    height: 250px;
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



.btn-primary:hover {
    background: #000080; 
}

.text-muted {
    color: #666;
    display: block;
    margin-top: 1rem;
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
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control" required></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
        </div>
    </form>
</div>

@endsection