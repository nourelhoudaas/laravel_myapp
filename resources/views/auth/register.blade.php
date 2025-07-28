@extends('base')

@section('title', 'Register')


{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
<div class="container">
    <div class="row">
        <div class="col-md-5  mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">Register</h1>
            <p class="text-center text-muted mb-5"> Create an account</p>

            <form action="{{ route('register')}}" method="POST" class="row g-3" id="form-register" >
                {{-- c'est un token pour la secuirité--}}
                @csrf

                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}" required autocomplete="firstname" autofocus>
                    <small class="text-danger fw-bold" id="error-register-firstname"></small>
                </div>

                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}" required autocomplete="lastname" autofocus>
                    <small class="text-danger fw-bold" id="error-register-lastname"></small>
                </div>

                {{--<div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" url-emailExist="{{ route('app_exist_email') }}" token="{{ csrf_token() }}"autofocus>
                    <small class="text-danger fw-bold" id="error-register-email"></small>
                </div>
--}}
                <div class="col-md-12">
                    <label for="id_p" class="form-label">ID NIN</label>
                    <input type="text" class="form-control" id="id_nin" name="id_nin" value="{{old('id_nin')}}" required autocomplete="id_nin"  url-IDNINExist="{{ route('app_exist_id_nin') }}" autofocus>
                    <small class="text-danger fw-bold" id="error-register-id_nin"></small>
                </div>

                <div class="col-md-12">
                    <label for="id_p" class="form-label">ID P</label>
                    <input type="text" class="form-control" id="id_p" name="id_p" value="{{old('id_p')}}" required autocomplete="id_p" url-IDPExist="{{ route('app_exist_id_p') }}" autofocus>
                    <small class="text-danger fw-bold" id="error-register-id_p"></small>
                </div>

                <div class="col-md-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" required autocomplete="username"  url-usernameExist="{{ route('app_exist_username') }}" autofocus>
                    <small class="text-danger fw-bold" id="error-register-username"></small>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" required autocomplete="password" autofocus>
                    <small class="text-danger fw-bold" id="error-register-password"></small>
                </div>

                <div class="col-md-6">
                    <label for="password-confirm" class="form-label">Password confirmation</label>
                    <input type="password" class="form-control" id="password-confirm" name="password-confirm" value="{{old('password-confirm')}}" required autocomplete="password-confirm" autofocus>
                    <small class="text-danger fw-bold" id="error-register-password-confirm"></small>
                </div>

{{--    Agree terms
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="agreeTerms">
                        <label class="form-check-label" for="agreeTerms">
                            Agree terms
                        </label><br>
                        <small class="text-danger fw-bold" id="error-register-agreeTerms"></small>
                    </div>
                </div>
--}}
                <div class="d-grid gap-2">
                   <button class="btn btn-primary" type="button" id="register-user">Register</button>
                </div>

                <p class="text-center text-muted mt-5">Already have an account? <a href="{{ route('login')}}">Login</a></p>

            </form>
        </div>
    </div>

</div>

