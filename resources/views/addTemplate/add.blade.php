
@php
$id=0;
@endphp
@extends('base')

@section('title', 'Formulaire')

@section('content')
@php
    $uid=auth()->id();
@endphp
<body>

<div class="" id="prog-add">
  <div class="stepper-item completed">
    <div class="step-counter">1</div>
    <div class="step-name">{{ __('lang.persondata') }}</div>
  </div>
  <div class="stepper-item active">
    <div class="step-counter">2</div>
    <div class="step-name">{{ __('lang.educatdata') }}</div>
  </div>
  <div class="stepper-item active">
    <div class="step-counter">3</div>
    <div class="step-name">{{ __('lang.admindata') }}</div>
  </div>
  <div class="stepper-item">
    <div class="step-counter">4</div>
    <div class="step-name">{{ __('lang.generat') }} </div>
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
        <form class="form-fa " action="/Employe/add" method="POST">
            @csrf
        <div class="col-md-18">
            <div class="p-5 py-15">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">{{__('lang.prof_set')}}</h4>
                </div>
                <div class="row mt-2 just">
                <div class="col-md-12">
                        <label class="labels">{{__('lang.NIN')}}</label>
                        <input type="text" class="form-control" placeholder="NIN" value="" id="ID_NIN">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">{{__('lang.NSS')}}</label>
                        <input type="text" class="form-control" placeholder="NSS" value="" id="ID_SS">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Nom</label>
                        <input type="text" class="form-control" placeholder="Nom" value="" id="Nom_P">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Prenom</label>
                        <input type="text" class="form-control" value="" placeholder="Prenom" id="Prenom_O">
                    </div>
                </div>
                <div class="row mt-2 just">
                    <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">الإسم</label>
                        <input type="text" class="form-control" placeholder="الإسم" value="" id="Nom_PAR" style="direction: rtl;">
                    </div>
                    <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">اللقب</label>
                        <input type="text" class="form-control" value="" placeholder=" ...اللقب" id="Prenom_AR" style="direction: rtl;">
                    </div>
                </div>
                <div class="row mt-3 just">
                    <div class="col-md-12">

                        <label class="labels">{{__('lang.num_tel')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('lang.slct_num_tel')}}" value="" id="PHONE_NB">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Address</label>
                        <input type="text" class="form-control" placeholder="enter address line 1" value="" id="Address">
                    </div>
                    <div class="col-md-12" style="direction: rtl;">
                        <label class="labels">العنوان</label>
                        <input type="text" class="form-control" placeholder="شارع ..." value="" id="AddressAR" style="direction: rtl;">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">date Naissance</label>
                        <input type="date" class="form-control" value="" id="Date_Nais_P">
                    </div>
                    <div class="row mt-3 just">
                    <div class="col-md-6">
                        <label class="labels">Lieu</label>
                        <input type="text" class="form-control" placeholder="Wilaya" value="" id="Lieu_N">
                    </div>
                    <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">مكان الإزدياد</label>
                        <input type="text" class="form-control" value="" placeholder="ولاية ..." id="Lieu_AR" style="direction: rtl;">
                    </div>
                </div>
                    <div class="col-md-12">
                        <label class="labels">{{__('lang.mail')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('lang.slct_mail')}}" value="" id="EMAIL">
                    </div>
                </div>
                <div class="row mt-3 just">
                    <div class="col-md-6">
                    <label class="labels">{{ __('lang.sx') }} </label>
                       <select name="sexe" id="Sexe"class="form-select form-select-lm mb-3" aria-label="Default select example">
                            <option value=""></option>
                            <option value="{{ __('lang.sx_ma') }}">{{ __('lang.sx_ma') }}</option>
                            <option value="{{ __('lang.sx_fm') }}">{{ __('lang.sx_fm') }}</option>
                        </select>
                    </div>
                    <hr>
                    <span>{{ __('lang.stitua_fam') }}</span>
                    <hr>
                    <div class="row mt-3 just">
                     <div class="col-md-6">
                        <label class="labels">Prenom du Pere</label>
                        <input type="text" class="form-control" placeholder="Prenom" value="" id="Prenom_Per">
                     </div>
                     <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">إسم الأب</label>
                        <input type="text" class="form-control" value="" placeholder="إسم" id="Prenom_PerAR" style="direction: rtl;">
                     </div>
                     </div>
                    <div class="row mt-3 just">
                     <div class="col-md-6">
                        <label class="labels">Nom du Mere </label>
                        <input type="text" class="form-control" placeholder="Nom" value="" id="Nom_mere">
                     </div>
                      <div class="col-md-6">
                        <label class="labels">Prenom du Mere </label>
                        <input type="text" class="form-control" placeholder="Prenom" value="" id="Prenom_mere">
                      </div>
                     </div>
                     <div class="row mt-3 just">
                     <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">لقب الأم</label>
                        <input type="text" class="form-control" placeholder="Prenom" value="" id="Nom_mereAR">
                     </div>
                     <div class="col-md-6" style="direction: rtl;">
                        <label class="labels">إسم الأم</label>
                        <input type="text" class="form-control" value="" placeholder="إسم" id="Prenom_mereAR" style="direction: rtl;">
                     </div>
                     </div>
                     <div class="col-md-6">
                        <label class="labels">{{__('lang.famill')}} </label>
                      <select select name="situat" id="situat"class="form-select form-select-lm mb-3" aria-label="Default select example">
                        <option value="">{{__('lang.slct_famill')}}</option>
                        <option value="cel">{{__('lang.cel')}}</option>
                        <option value="marie">{{__('lang.marie')}}</option>
                        <option value="Divor">{{__('lang.divor')}}</option>
                        <option value="veuve">{{__('lang.veu')}}</option>
                     </select>
                     </div>
                     <div class="col-md-2">
                        <label class="labels">{{__('lang.children')}}</label>
                        <select select name="nbrenfant" id="nbrenfant"class="form-select form-select-lm mb-3" aria-label="Default select example">
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="addf">    
                      </div>
                <div class="mt-5 text-end">
                    <button class="btn btn-primary profile-button" type="submit" id="btn-sv">{{ __('lang.next') }}</button>
                </div>
            </div>
        </div>
        </form>
        <div class="file-holder">
                    <div class="file-select-holder">
                      {{-- <label for="file">Choose file:</label> --}}
                      <input type="file" name="file" id="file"> </br>
                      <div class="">
                      <button class="button-33" type="button" id="upload-button" onclick="uploadFile()">{{ __('lang.upload') }}</button>
                      </div>
                    </div>
                          <div>
                              <div class="file-upload">
                                  <div class="file-prog">
                                      <div class="file-name" id='file1'>
                                          <p> Fichier </p>
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


   @endsection
<script>
        var dir="Personnel";
        var uid='{{$uid}}'
        var id;
      document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('nbrenfant');
            const maxNumber = 10; // Change this to the desired maximum number

            for (let i = 0; i <= maxNumber; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                dropdown.appendChild(option);
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('situat');
            const inputContainer = document.getElementById('addf');

            dropdown.addEventListener('change', () => {
                // Clear previous input if any
                inputContainer.innerHTML = '';

                if (dropdown.value === 'marie') {
                    const input = document.createElement('input');
                    const label = document.createElement('label');
                    label.classList='labels'
                    label.textContent ="Prenom du Mari"
                    input.type = 'text';
                    input.placeholder = 'Prenom Du marie';
                    input.classList='form-control'
                    input.name = 'marie';
                    inputContainer.appendChild(label);
                    inputContainer.appendChild(input);
                }
                // Add other conditions for different options if needed
            });
        });
</script>