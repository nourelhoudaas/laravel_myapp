@extends('base')


@section('title', 'liste Postes')

@section('content')


<body>
    <main>
        <div class="recent_order">
            <div class="title">
                <h1>{{__('lang.list_pts')}}</h1>
            </div>
            <table id='postTable' class="styled-table">
            <thead>

            <tr>

                <th>{{__('lang.Post')}}</th>
                <th>{{__('lang.filier_dipl')}}</th>
                <th>{{__('lang.grade')}}</th>
                <th>{{__('lang.Post_ar')}}</th>
                <th>{{__('lang.filier_dipl')}}</th>
                
                <th>{{__('lang.edit')}}</th>
                
            </tr>
        </thead>
        <tbody>
            @php
        $locale = app()->getLocale();
        @endphp
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
        </table>
    </div>


</body>







        @endsection
