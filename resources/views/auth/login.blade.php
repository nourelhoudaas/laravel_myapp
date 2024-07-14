@extends('base')

@section('title', 'Login')

@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">Sign in</h1>
            <p class="text-center text-muted mb-5"> Gestion des décisions</p>
            <form  method="POST" action="{{ route('login')}}" class="row g-3" >
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

                <label for="username" >Username</label>
                <input type="text" name="username" id="username" class="form-control mb-3 @error ('username') is-invalid @enderror" value="{{ old('username')}}" required autocomplete="username" autofocus>

                <label for="password" > Password</label>
                <input type="password" name="password" id="password" class="form-control mb-3 @error('password') is-invalid @enderror" required autocomplete="current-password " autofocus>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="remember" name="remember" {{ old('remember') ? 'checked' : ''}}>
                            <label class="form-check-label" for="remember">Remember me</label>
                          </div>

                    </div>

                    <div class="col-md-6 text-end">
                        <a href="{{route('app_forgotPassword')}}">Forgot your password?</a>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit" > Sign in</button>

                </div>

                <p class="text-center text-muted mt-5">Not registered yet ? <a href="{{ route('register')}}">Create an account</a></p>
            </form>
        </div>
    </div>

</div>

@endsection
