@extends('base')

@section('title', 'Forgot Password')

@section('content')

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
