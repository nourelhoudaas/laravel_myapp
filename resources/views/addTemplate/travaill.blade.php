@extends('base')

@section('title', 'Formulaire')

@section('content')
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
                <img class="rounded-circle mt-5" width="150px" src="{{ asset('assets/main/img/profile.jpg')}}">
                {{-- <span class="font-weight-bold">ADMIN</span>
                <span class="text-black-50">ADMIN@mail.com.my</span> --}}
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
                        <select type="text" class="form-select" placeholder="Specialitie" value="" id="Spec">
                        <option value="">Selection La Specialité</option>
                            @foreach($dbniv as $niv)
                                <option value="{{$niv->Specialité}}">{{$niv->Specialité}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Filiere</label>
                        <input type="text" class="form-control" value="" placeholder="Filiere" id="Filr">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Diplome</label>
                        <select type="text" class="form-select" placeholder="Diplome" value="" id="Dip">
                            <option value="">Selection Le Diplome</option>
                            @foreach($dbniv as $niv)
                                <option value="{{$niv->Nom_niv}}">{{$niv->Nom_niv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Date Obtenuation de Diplome</label>
                        <input type="date" class="form-control" id="DipDate">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" id="aft2">Save Profile</button>
                </div>
            </div>
        </div>
        </form>

        <div class="file-holder">
          <div class="file-select-holder">
            <label for="file">Choose file:</label>
            <input type="file" name="file" id="file">
        </br>
        </br>
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
<script>
     var id = '{{ $employe->id_nin }}';
     var idp = '{{ $employe->id_p }}';
     var dir="Niveaux";
</script>
