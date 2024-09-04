@extends('base')

@section('title', 'Dashboard Direction')

@section('content')

    <body>

        <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded"  >
            <div class= "section-title"><h4> Modifier une Direction </h4></div>

            <div class="app-card-body" >

                    <form action="{{ route('update.poste',$post->id_post)}}" method="Post">

                        {{ csrf_field() }}



                    <div class= "text-bg-light p-3">
                        <label for="setting-input-1" class="fw-bold">Nom du poste</label>
                        <input type="text" class="form-control" id="Nom_post" placeholder="Nom du poste" name="Nom_post" value="{{$post->Nom_post}}" required >

                    </div>
                    <div class="text-bg-light p-3">
                        <label for="setting-input-2" class="fw-bold">Grade de poste</label>
                        <input type="text" class="form-control" id="Grade_post" placeholder="Grade de poste" name="Grade_post" value="{{$post->Grade_post}}" required>
                    </div>
                    <div class= "text-bg-light p-3">
                        <label for="setting-input-1" class="fw-bold">Nom du poste en arabe</label>
                        <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" value="{{$post->Nom_post_ar}}" required>
                    </div>

    </div>
</body>



                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

