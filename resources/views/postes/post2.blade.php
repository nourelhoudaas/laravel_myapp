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

                <th>{{__('lang.Post')}}</th>
                <th>{{__('lang.filier_dipl')}}</th>
                <th>{{__('lang.grade')}}</th>
                <th>{{__('lang.Post_ar')}}</th>
                <th>{{__('lang.filier_dipl')}}</th>
                
                <th>{{__('lang.edit')}}</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($post as $poste)
                <tr>
                    <td>{{ $poste->Nom_post }}</td>
                     <td>{{$poste->Nom_filiere}}</td>
                    <td>{{ $poste->Grade_post }}</td>
                    <td>{{ $poste->Nom_post_ar }}</td>
                    <td>{{$poste->Nom_filiere_ar}}</td>
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


        <!-- *************************ADD POST **********************-->
         
@extends('base')

@section('title', 'ajout_Poste')




        <h1 class="app-page-title">Ajout d un Poste</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <h3 class="section-title">{{__('lang.ajot_pos')}} 
                <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                    <circle cx="8" cy="4.5" r="1"/>
                    </svg></span></h3>

                <div class="section-intro"> </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card shadow-lg p-3 mb-5 bg-body-tertiary rounded"  >
                    <div class= "section-title"><h4> {{__('lang.nvl_post')}} </h4></div>

                    <div class="app-card-body" >

                            <form action="{{ route('app_store_poste') }}" method="POST">
                            @csrf

                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.Post')}}</label>
                                <input type="text" class="form-control" id="Nom_post" placeholder="Nom de la Direction" name="Nom_post" required>

                            </div>
                            <div class="text-bg-light p-3">
                                <label for="setting-input-2" class="fw-bold">{{__('lang.grade')}}</label>
                                <input type="text" class="form-control" id="Grade_post" placeholder="Discription de la direction" name="Grade_post" required>
                            </div>
                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.Post_ar')}}</label>
                                <input type="text" class="form-control" id="Nom_post_ar" placeholder="Nom de la Direction en Arabe" name="Nom_post_ar" required>

                            </div>


                             <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.sec_')}} </label>
                                <input type="text" class="form-control" id="Nom_secteur" placeholder="Nom de la Direction" name="Nom_secteur" required>

                            </div>

                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.sec_ar')}}</label>
                                <input type="text" class="form-control" id="Nom_secteur_ar" placeholder="Nom de la Direction en Arabe" name="Nom_secteur_ar" required>

                            </div>


                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.filier')}} </label>
                                <input type="text" class="form-control" id="Nom_filiere" placeholder="Nom de la Direction" name="Nom_filiere" required>

                            </div>

                            <div class= "text-bg-light p-3">
                                <label for="setting-input-1" class="fw-bold">{{__('lang.filier_ar')}}</label>
                                <input type="text" class="form-control" id="Nom_filiere_ar" placeholder="Nom de la Direction en Arabe" name="Nom_filiere_ar" required>

                            </div>
                        
                            <button type="submit" class="btn btn-primary">{{__('lang.btn.enregistrer')}}</button>
                        </form>
                    </div><!--//app-card-body-->

                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <!--Laraval JAVASCRIPT VALIDATION-->


<!-- ****************************************************** -->
