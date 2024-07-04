<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Education Information </title>
    <link href="{{ asset('assets/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="stepper-wrapper">
  <div class="stepper-item completed">
    <div class="step-counter">1</div>
    <div class="step-name">Donneé Personnel</div>
  </div>
  <div class="stepper-item completed">
    <div class="step-counter">2</div>
    <div class="step-name">Donneé Educative</div>
  </div>
  <div class="stepper-item active">
    <div class="step-counter">3</div>
    <div class="step-name">Donnée Administrative</div>
  </div>
  <div class="stepper-item">
    <div class="step-counter">4</div>
    <div class="step-name">Genere Dicision </div>
  </div>
</div>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">ADMIN</span>
                <span class="text-black-50">ADMIN@mail.com.my</span>
                <span> 

                </span>
            </div>
        </div>
        <div class="form-holder">
        <form class="form-fa" action="/Employe/add" method="POST">
            @csrf
        <div class="col-md-10">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
         
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                <div class="col-md-12">
                        <label class="labels">Ref_Diplome</label>
                        <input type="text" class="form-control" placeholder="Ref Diplome" value="" id="DipRef">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Specialitie</label>
                        <input type="text" class="form-control" placeholder="Specialitie" value="" id="Spec">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Filiere</label>
                        <input type="text" class="form-control" value="" placeholder="Filiere" id="Filr">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Diplome</label>
                        <input type="text" class="form-control" placeholder="Diplome" value="" id="Dip">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Date Obtenuation de Diplome</label>
                        <input type="date" class="form-control" id="DipDate">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" id="aft">Save Profile</button>
                </div>
            </div>
        </div>
        </form>
        <div class="file-holder">
          <div class="file-select-holder">
            <label for="file">Choose file:</label>
            <input type="file" name="file" id="file"> </br>
            <div class="">
            <button class="button-33" type="button" id="upload-button" onclick="uploadFile()">Upload</button>
            </div>
          </div>
                <div>
                    <div class="file-upload">
                        <div class="file-prog">
                            <div class="file-name" id='file1'>
                                <p> Fichier 1 </p>
                            </div>
                            <div class="prog-holder">
                            <div id="progressWrapper" style="display: none;">
                               <div id="progressBar" style="width: 0%; height: 20px; background-color: #4caf50;"></div>
                            </div>
                            </div>
                            <div class="icon">
                                x
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
        $(document).ready(function(){
    $('#aft').click(function(e){
        e.preventDefault();

                var id = '{{ $employe->id_nin }}';
                var idp = '{{ $employe->id_p }}'; // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN:id,
                    ID_P : idp,
                    DipRef :$('#DipRef').val(),
                    Spec: $('#Spec').val(),
                    filr: $('#Filr').val(),
                    Dip: $('#Dip').val(),
                    DipDate:$('#DipDate').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'POST'
                };

                $.ajax({
                    url: '/Employe/addApp',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        window.location.href="/Employe/IsEducat/"+id;
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
    });
});
    </script>
    <script>

$(document).ready(function () { 
    var currentGfgStep, nextGfgStep, previousGfgStep; 
    var opacity; 
    var current = 1; 
    var steps = $("fieldset").length; 
  
    setProgressBar(current); 
  
    $(".next-step").click(function () { 
  
        currentGfgStep = $(this).parent(); 
        nextGfgStep = $(this).parent().next(); 
  
        $("#progressbar li").eq($("fieldset") 
            .index(nextGfgStep)).addClass("active"); 
  
        nextGfgStep.show(); 
        currentGfgStep.animate({ opacity: 0 }, { 
            step: function (now) { 
                opacity = 1 - now; 
  
                currentGfgStep.css({ 
                    'display': 'none', 
                    'position': 'relative'
                }); 
                nextGfgStep.css({ 'opacity': opacity }); 
            }, 
            duration: 500 
        }); 
        setProgressBar(++current); 
    }); 
  
    $(".previous-step").click(function () { 
  
        currentGfgStep = $(this).parent(); 
        previousGfgStep = $(this).parent().prev(); 
  
        $("#progressbar li").eq($("fieldset") 
            .index(currentGfgStep)).removeClass("active"); 
  
        previousGfgStep.show(); 
  
        currentGfgStep.animate({ opacity: 0 }, { 
            step: function (now) { 
                opacity = 1 - now; 
  
                currentGfgStep.css({ 
                    'display': 'none', 
                    'position': 'relative'
                }); 
                previousGfgStep.css({ 'opacity': opacity }); 
            }, 
            duration: 500 
        }); 
        setProgressBar(--current); 
    }); 
  
    function setProgressBar(currentStep) { 
        var percent = parseFloat(100 / steps) * current; 
        percent = percent.toFixed(); 
        $(".progress-bar") 
            .css("width", percent + "%") 
    } 
  
    $(".submit").click(function () { 
        return false; 
    }) 
}); 

    </script>
    
    <script>

function uploadFile() {
            var formData = new FormData();
            var file = document.getElementById('file').files[0];
            formData.append('file', file);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
             
            var id='{{ $employe->id_nin }}';
            formData.append('num', id);
            $.ajax({
                url: '/upload/numdossiers',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(e) {
                        if (e.lengthComputable) {
                            var percentComplete = (e.loaded / e.total) * 100;
                            $('#progressWrapper').show();
                            $('#progressBar').width(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    $('#successMessage').show();
                    $('#progressWrapper').hide();
                    $('#progressBar').width('0%');
                },
                error: function() {
                    alert('Upload failed');
                }
            });
        }

    </script>
</html>
