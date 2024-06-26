@extends('base')

@section('title', 'Forgot Password')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         
<div>
    <div class="row">
        <div class="col-md-4 mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">Forgot password</h1>
            <p class="text-center text-muted mb-5">Please enter your email address, we'll send you a link to rset your password</p>
            <form action="{{route('app_forgotPassword')}}" method="post">
                @csrf
                <label for="email-send" class="form-label">Email</label>
                <input type="email" name="email-send" id="email-send" class="form-control">
            </form>

        </div>
    </div>
</div>

@endsection
