@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>
    <main>
            <div class="recent_order2">
                <div class="title">
                    <h1> {{ __('lang.modif_grade') }}</h1>
                </div>

                    <form action="{{ route('update.poste',$post->id_post)}}" method="Post">

                        {{ csrf_field() }}



                    <div class= " p-3">
                        <label for="setting-input-1" class="fw-bold">Nom du poste</label>
                        <input type="text" class="form-control" id="Nom_post" placeholder="Nom du poste" name="Nom_post" value="{{$post->Nom_post}}" required >

                    </div>
                    <div class=" p-3">
                        <label for="setting-input-2" class="fw-bold">Grade de poste</label>
                        <input type="text" class="form-control" id="Grade_post" placeholder="Grade de poste" name="Grade_post" value="{{$post->Grade_post}}" required>
                    </div>
                    <div class= " p-3">
                        <label for="setting-input-1" class="fw-bold">Nom du poste en arabe</label>
                        <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" value="{{$post->Nom_post_ar}}" required>
                    </div>

    




                            <button type="submit" class="btn btn-primary btn-group22">{{ __('lang.btn.enregistrer') }}</button>
                        </form>
       
        </div><!--//row-->
</body>
