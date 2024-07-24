<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fichies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                        <ul class="list-group list-group-flush" id="file-holder">
                            @foreach($filesArray as $file)
                                <li class="list-group-item">
                                        <a href="{{url('/live/read/'.$empdoss.'/'.$subDir.'-'.$file.'/')}}" target="_blank" id="{{$file}}">{{ $file }}</a>
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
 $(document).ready(function() {
            // Select all ul elements
            $('#file-holder').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){

                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
        });
</script>
</html>