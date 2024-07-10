
@php
$id=0;
@endphp
@extends('base')

@section('title', 'Dashboard Direction')

@section('content')
<body>
   <!-- start section aside -->
   @include('./navbar.sidebar')
   <!-- end section aside -->

<div class="stepper-wrapper">
  <div class="stepper-item completed">
    <div class="step-counter">1</div>
    <div class="step-name">Données Personnel</div>
  </div>
  <div class="stepper-item active">
    <div class="step-counter">2</div>
    <div class="step-name">Données Educative</div>
  </div>
  <div class="stepper-item active">
    <div class="step-counter">3</div>
    <div class="step-name">Donneés Administrative</div>
  </div>
  <div class="stepper-item">
    <div class="step-counter">4</div>
    <div class="step-name">Généré une décision </div>
  </div>
</div>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{ asset('assets/main/img/profile.jpg')}}">
                {{-- <span class="font-weight-bold">ADMIN</span>
                <span class="text-black-50">ADMIN@mail.com.my</span> --}}

            </div>
        </div>
        <div class="form-holder">
        <form class="form-fa" action="/Employe/add" method="POST">
            @csrf
        <div class="col-md-10">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="text-right">Profile informations</h4>
                </div>
                <div class="row mt-2">
                <div class="col-md-12">
                        <label class="labels">NIN</label>
                        <input type="text" class="form-control" placeholder="enter NIN" value="" id="NIN">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Nom</label>
                        <input type="text" class="form-control" placeholder="Nom" value="" id="name">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Prenom</label>
                        <input type="text" class="form-control" value="" placeholder="Prenom" id="sname">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">الإسم</label>
                        <input type="text" class="form-control" placeholder="الإسم" value="" id="nameAR" style="direction: rtl;">
                    </div>
                    <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">اللقب</label>
                        <input type="text" class="form-control" value="" placeholder=" ...اللقب" id="prenomAR" style="direction: rtl;">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Numéro Telephone</label>
                        <input type="text" class="form-control" placeholder="enter Numero" value="" id="nbrphone">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Address Line 1</label>
                        <input type="text" class="form-control" placeholder="enter address line 1" value="" id="adr1">
                    </div>
                    <div class="col-md-12" style="direction: rtl;">
                        <label class="labels">العنوان</label>
                        <input type="text" class="form-control" placeholder="شارع ..." value="" id="adr1AR" style="direction: rtl;">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">date Naissance</label>
                        <input type="date" class="form-control" value="" id="brtday">
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="labels">Lieu</label>
                        <input type="text" class="form-control" placeholder="Wilaya" value="" id="plc">
                    </div>
                    <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">مكان الإزدياد</label>
                        <input type="text" class="form-control" value="" placeholder="ولاية ..." id="plcAR" style="direction: rtl;">
                    </div>
                </div>
                    <div class="col-md-12">
                        <label class="labels">Email ID</label>
                        <input type="text" class="form-control" placeholder="enter email" value="" id="mail">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                    <label class="labels">Sexe</label>
                       <select name="sexe" id="sexe"class="form-select form-select-lg mb-3" aria-label="Default select example">
                            <option value="">--Please choose an option--</option>
                            <option value="Femme">Femme</option>
                            <option value="Homme">Homme</option>
                        </select>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" id="btn-sv">Save Profile</button>
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
    $('#btn-sv').click(function(e){
        e.preventDefault();
                selectElement =document.querySelector('#sexe');
            output = selectElement.value;
                // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN:parseInt($('#NIN').val()),
                    Nom_P:$('#name').val(),
                    Prenom_O:$('#sname').val(),
                    Nom_PAR:$('#nameAR').val(),
                    Prenom_AR:$('#prenomAR').val(),
                    PHONE_NB : parseInt($('#nbrphone').val()),
                    Address :$('#adr1').val(),
                    AddressAR :$('#adr1AR').val(),
                    Date_Nais_P: $('#brtday').val(),
                    Lieu_N:$('#plc').val(),
                    Lieu_AR:$('#plcAR').val(),
                    Sexe:output,
                    EMAIL:$('#mail').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'POST'
                };

                $.ajax({
                    url: '/Employe/add/',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert('donnee personnel a ajouter')
                        var id=$('#NIN').val();
                      window.location.href="/Employe/IsTravaill/"+id;
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
    });
});
</script>

<script src="{{ asset('assets/app.js')}}"></script>
</html>
