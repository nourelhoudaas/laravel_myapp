@extends('base')

@section('title', 'Change your email address')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
         
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h2 class="text-center text-muted mb-3 mt-5">Change your email address</h2>

                <form action="{{ route('app_activation_account_change_email',['token' => $token])}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="new-email" class="form-label">New Email address</label>
                        <input
                            type="email" class="form-control @if(Session::has('danger')) is-invalid @endif" name="new_email" id="new_email"
                            value="@if(Session::has('new_email')){{ Session::get('new_email') }}@endif"
                            placeholder="Enter the new email address" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Change</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
