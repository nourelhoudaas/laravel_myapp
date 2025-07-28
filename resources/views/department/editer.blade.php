
@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>


            <div class="container2">
        <!-- start section aside -->
        @include('./navbar.sidebar')
        <!-- end section aside -->
        <main>
            <div class="recent_order">
        <h1 class="app-page-title">Direction et Sous Direction</h1>

       
            <div class="col-12 col-md-8">
                <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded"  >
                    <div class= "section-title"><h4> Modifier une Direction </h4></div>

                    <div class="app-card-body" >

                            <form action="{{ route('departement.update',$departement->id_depart)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom de la Direction</label>
                                <input type="text" class="form-control" id="Nom_depart" placeholder="Nom de la Direction" name="Nom_depart" value="{{$departement->Nom_depart}}" required >

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">Description de la Direction</label>
                                <input type="text" class="form-control" id="Descriptif_depart" placeholder="Discription de la direction" name="Descriptif_depart" value="{{$departement->Descriptif_depart}}" required>
                            </div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom de la Direction en arabe</label>
                                <input type="text" class="form-control" id="Nom_depart_ar" placeholder="Nom de la Direction en Arabe" name="Nom_depart_ar" value="{{$departement->Nom_depart_ar}}" required>
                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">Description de la Direction en arabe</label>
                                <input type="text" class="form-control" id="Descriptif_depart_ar" placeholder="Discription de la direction" name="Descriptif_depart_ar" value="{{$departement->Descriptif_depart_ar}}" required>
                            </div>



                            <div class="container">
                                <div class="wrap">
                                    <h4 class= >Modifier une sous direction</h4>
                                    <a href="#" class="add">&plus;</a>
                                </div>
                                <div class="inp-group"></div>


                            </div>


                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <!--Laraval JAVASCRIPT VALIDATION-->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!!JsValidator::formRequest('App\Http\Requests\saveDepartementRequest')!!}
@endsection
