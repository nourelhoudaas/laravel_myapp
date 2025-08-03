
@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>

        <main>
            <div class="recent_order2">
                <div class="title">
                    <h1> {{ __('lang.msg_modif_direc') }}</h1>
                </div>

                            <form action="{{ route('departement.update',$departement->id_depart)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">Nom de la Direction</label>
                                <input type="text" class="form-control" id="Nom_depart" placeholder="Nom de la Direction" name="Nom_depart" value="{{$departement->Nom_depart}}" required >

                            </div>
                            <div class=" p-3">
                                <label for="setting-input-2" class="fw-bold">Description de la Direction</label>
                                <input type="text" class="form-control" id="Descriptif_depart" placeholder="Discription de la direction" name="Descriptif_depart" value="{{$departement->Descriptif_depart}}" required>
                            </div>
                            <div class= " p-3">
                                <label for="setting-input-1" class="fw-bold">Nom de la Direction en arabe</label>
                                <input type="text" class="form-control" id="Nom_depart_ar" placeholder="Nom de la Direction en Arabe" name="Nom_depart_ar" value="{{$departement->Nom_depart_ar}}" required>
                            </div>
                            <div class=" p-3">
                                <label for="setting-input-2" class="fw-bold">Description de la Direction en arabe</label>
                                <input type="text" class="form-control" id="Descriptif_depart_ar" placeholder="Discription de la direction" name="Descriptif_depart_ar" value="{{$departement->Descriptif_depart_ar}}" required>
                            </div>


                            <button type="submit" class="btn btn-primary btn-group22">  {{ __('lang.btn.enregistrer') }}</button>
                        </form>
        </div><!--//row-->
<main>
        <!--Laraval JAVASCRIPT VALIDATION-->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!!JsValidator::formRequest('App\Http\Requests\saveDepartementRequest')!!}
@endsection
