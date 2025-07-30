@extends('base')


@section('title', 'liste Postes')

@section('content')


<body>
 <div>


    <div class="container2">
        <div class="recent_order">
            <h1 class="app-page-title">{{__('lang.list_pts')}}</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
<div>

                <!--button class="btn btn-success newUser" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-plus-circle">Poste</i></button-->

            </div>
            <table id='myDataTable' class="table">
            <thead>

            <tr >

                <th>>{{__('lang.Post')}}</th>
                <th>{{__('lang.grade')}}</th>
                <th>{{__('lang.Post_ar')}}</th>
                <th>{{__('lang.Post_ar')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $poste)
                <tr>
                    <td>{{ $poste->Nom_post }} / {{$poste->Nom_filiere}}</td>
                    <td>{{ $poste->Grade_post }}</td>
                    <td>{{ $poste->Nom_post_ar }} / {{$poste->Nom_filiere_ar}}</td>
                    <td>

                     <!--  <a href="#"  data-bs-toggle="modal" data-bs-target="#readData"><i class="fa fa-edit"></i></a>-->
                     <!--  <a class="fa fa-edit" data-bs-toggle="modal" data-bs-target="readData"><i ></i></a>-->
                     <a href="editer/{{$poste->id_post}}"><i class="fa fa-edit"></i></a>

                     <form action="#" method="POST" style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?')"
                            href="/post/{{$poste->id_post}}"> <i
                                class="fa fa-trash" aria-hidden="true"></i></a>
                    </form>

                    </td>
                </tr>
            @endforeach
        </tbody>



<script type="text/javascript">
    function confirmation(ev){
        evpreventDefault();
        var urlToRedirect=ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
            title:"voulez-vous supprimé cette direction?",
            title:"etes vous sure ?",
            icon:"warning",
            buttons :true,
            dangerMode : true,
        })
        .then((willCancel)=>
    {
        if(willCancel)
    {
             window.location.href=urlToRedirect;
    }
    }
    )
    }
    </script>

        </table>
    </div>

</div>
<div class="modal fade" id="userForm">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <style>
                .modal-header{

    background: #0d6efd;
    color: #fff;

                       }
            </style>

            <div class="modal-header">
                <h4 class="modal-title">Ajouter un Nouveau Poste</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('app_store_poste') }}"  method="POST">


                        @csrf


                    <div class="inputField">
                        <div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom du Poste </label>
                                <input type="text" class="form-control" id="Nom_post" placeholder="Nom de la Direction" name="Nom_post" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">Grede Poste</label>
                                <input type="text" class="form-control" id="Grade_post" placeholder="Discription de la direction" name="Grade_post" required>
                            </div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom du Poste en Arabe</label>
                                <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" required>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i></button>
                    </div>

                </form>

            </div>


        </div>
    </div>
</div>

//** modifier
<div class="modal fade" id="readData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <style>
                .modal-header{

    background: #0d6efd;
    color: #fff;

                       }
            </style>

            <div class="modal-header">
                <h4 class="modal-title">Ajouter un Nouveau Poste</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('app_store_poste') }}"  method="POST">


                        @csrf


                    <div class="inputField">
                        <div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom du Poste </label>
                                <input type="text" class="form-control" id="Nom_post" placeholder="Nom de la Direction" name="Nom_post" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">Grede Poste</label>
                                <input type="text" class="form-control" id="Grade_post" placeholder="Discription de la direction" name="Grade_post" required>
                            </div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">Nom du Poste en Arabe</label>
                                <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" required>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i></button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i></button>
                    </div>

                </form>

            </div>


        </div>
    </div>
</div>


</body>







        @endsection
