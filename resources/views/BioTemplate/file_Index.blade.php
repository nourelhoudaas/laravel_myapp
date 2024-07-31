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
    $emp_name;
    $emp_sur;
    if(app()->getLocale() == 'ar')
    {
        $emp_name=$employe->Nom_ar_emp;
        $emp_sur=$employe->Prenom_ar_emp;
    }
    else
    {
        $emp_name=$employe->Nom_emp;
        $emp_sur=$employe->Prenom_emp;
    }
    @endphp
@extends('base')
<body>

@include('./navbar.sidebar')
 <h6>{{__('lang.DosierD')}} : {{$emp_name}} {{$emp_sur}}</h6>
    <div class="container mt-5">
        <div class="row">
            @foreach($files as $subDir => $filesArray)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                         <div class="card-headf"> 
                            @php
                             $name= $subDir ?: 'Root Directory';
                             $lang='lang.'.$name;
                            @endphp     
                            <strong>{{ __($lang.'') }}</strong>
                            <p class="thbtn" id="{{ $subDir ?: 'Root Directory' }}">...</p>
                        </div>    
                        </div>
                        <ul class="list-group list-group-flush" id="file-holder-{{$subDir}}">
                            @foreach($filesArray as $file)
                                <li class="list-group-item" id='file-holder'>
                                        <a href="{{url('/live/read/'.$empdoss.'/'.$subDir.'-'.$file.'/')}}" target="_blank" id="{{$file}}">{{ $file }}</a>
                                    </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="overlay" id="overlay"></div>

<div class="bottom-popup" id="bottomPopup">
    <div class="popup-content">
        <form>
            @csrf
        <input type="file" id="file">
        <button class="button-33" onclick='uploadFile()'>{{__('lang.upload')}}</button>
        </form>
    </div>
</div>
</body>

<script>
    var dir;
    var id='{{$employe->id_nin}}'
    var uid='{{$uid}}'
 $(document).ready(function() {
            // Select all ul elements
            $('#file-holder-Admin').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Congé').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Contonsion').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Maladie').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Niveaux').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Personnel').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Promotion').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
            $('#file-holder-Social').each(function() {
                // For each ul, find all li elements
                $(this).find('li a').each(function() {
                    // Get the id attribute of each li element
                    var liId = $(this).attr('id');
                    $.ajax({
                        url:'/realwhoiam/'+liId,
                        type:'GET',
                        success:function(response)
                        {
                            console.log('-->id :'+response.name)
                            $('#'+liId).text(response.name)
                            $('#'+liId).click(function(){
                               
                            })
                        }
                    })
                    console.log('-->id :'+liId); // Outputs the id of each li element
                });
            });
        });
        $(document).ready(function(){
        

        // Hide the popup when clicking outside of it
        $("#overlay").click(function(){
            $("#bottomPopup").removeClass("show-popup");
            $("#overlay").removeClass("show-overlay");
        });

        $("p").click(function(){
            var clickedId = $(this).attr('id');
            dir=clickedId;
            $("#bottomPopup").addClass("show-popup");
            $("#overlay").addClass("show-overlay");
            //alert("You clicked on: " + clickedId);
        });
    });
</script>
</html>