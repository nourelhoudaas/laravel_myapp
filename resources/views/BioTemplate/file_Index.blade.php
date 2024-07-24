<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fichies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
@php
    $uid=auth()->id();
    @endphp
@extends('base')
<body>

@include('./navbar.sidebar')
 <h6>Dossier D' Employe : {{$employe->Nom_emp}} {{$employe->Prenom_emp}}</h6>
    <div class="container mt-5">
        <div class="row">
            @foreach($files as $subDir => $filesArray)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>{{ $subDir ?: 'Root Directory' }}</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($filesArray as $file)
                                <li class="list-group-item">
                                        <a href="{{ url('storage/' .$empdoss.'/'. $subDir . '/' . $file) }}" target="_blank" id='{{$file}}'>{{ $file }}</a>
                                    </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
<script>
    
  /*  filess.foreach((index,hash)=>{
    hash.foreach((file)=>
    {
        $.ajax({
            url:'upload/realwhoam/'+file,
            type:'GET',
            success:function(response)
            {
                $('#'+file).text(response.name)
            }
        })

    })
})*/
</script>
</html>