@extends('base')

@section('title', 'Formulaire Educative')

@section('content')
@php
    $uid=auth()->id();
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body>

<div class="" id="prog-add">
  <div class="stepper-item completed">
    <div class="step-counter">1</div>
    <div class="step-name">{{ __('lang.persondata') }}</div>
  </div>
  <div class="stepper-item completed">
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
<div id="loadingSpinner" class="spinner-overlay">
        <div class="spinner"></div>
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
        <div class="col-md-10 just">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3 title">

                    <h4 >{{__('lang.educatdata')}}</h4>
                </div>
                <div class="row mt-2">
                <div class="col-md-12">
                        <label class="labels">{{__('lang.ref_dipl')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('lang.slct_ref_dipl')}}" value="" id="DipRef">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.spec_dipl')}}</label>
                        <select type="text" class="form-select" placeholder="Specialité" value="" id="Spec">
                        <option value="">{{__('lang.slct_spec_dipl')}}</option>
                            @foreach($dbn as $niv)
                            @if (app()->getLocale() == 'ar')

                                <option value="{{$niv->Specialité}}">{{$niv->Specialité_ar}}</option>

                            @else

                                <option value="{{$niv->Specialité}}">{{$niv->Specialité}}</option>

                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.filier_dipl')}}</label>
                        <input type="text" class="form-control" value="" placeholder="Filiere" id="Filr">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.nom_dipl')}}</label>
                        <select type="text" class="form-select" placeholder="Diplome" value="" id="Dip">
                            <option value="">{{__('lang.slct_nom_dipl')}}</option>
                            @foreach($dbniv as $niv)
                            @if (app()->getLocale() == 'ar')

                                <option value="{{$niv->Nom_niv}}">{{$niv->Nom_niv_ar}}</option>

                            @else

                                <option value="{{$niv->Nom_niv}}">{{$niv->Nom_niv}}</option>

                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.dat_optn_dipl')}}</label>
                        <input type="date" class="form-control" id="DipDate">
                    </div>
                </div>
                <div class="mt-5 text-center ">
                    <button class="btn btn-primary  btn-group2" type="submit" id="aft2">{{ __('lang.next') }}</button>
                </div>
            </div>
        </div>
        </form>

        <div class="file-holder">
          <div class="file-select-holder">
            <label for="file" class="file-get-handle" id="file-custm">{{__("lang.Choisirunfichier")}}</label>
            <input type="file" name="file" id="file">
        </br>

            <div class="">
            <button class="button-33" type="button" id="upload-button" onclick="uploadFile()">{{ __('lang.upload') }}</button>
                        </div>
                        <label id='file-nm'>{{__('lang.filnull')}}</lable>
          </div>
                <div>
                    <div class="file-upload">
                        <div class="file-prog">
                            <div class="file-name" id='file1'>

                            </div>
                            <div class="prog-holder">
                            <div id="progressWrapper" style="display: none;">
                               <div id="progressBar" style="width: 0%; height: 20px; background-color: #4caf50;"></div>
                            </div>
                            </div>
                            <div class="icon">

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
     var uid='{{$uid}}'
     var lang='{{app()->getLocale()}}'
       var flang='{{__("lang.filnull")}}'
       $('#file').on('change',function(){
    var label = $('#file-custm');
    var fileName = this.files && this.files.length > 0 ? this.files[0].name : flang;
    label.textContent = fileName;
      console.log('file handler'+fileName)
      $('#file-nm').text(''+fileName)
    })
</script>
@endsection
