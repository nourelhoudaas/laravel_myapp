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
  <div class="stepper-item completed">
    <div class="step-counter">2</div>
    <div class="step-name">{{ __('lang.educatdata') }}</div>
  </div>
  <div class="stepper-item completed">
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
                <img class="rounded-circle mt-5" width="150px"src="{{ asset('assets/main/img/profile.jpg')}}">
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

                    <h4 class="text-right">{{__('lang.prof_set')}}</h4>
                </div>
                <div class="row mt-2">
                <div class="col-md-12">
                        <label class="labels">{{__('lang.ID_p')}}</label>
                        <input type="text" class="form-control" placeholder="" value="{{$employe->id_emp}}" id="IDP" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.dept')}}</label>
                        <select type="text" class="form-select" placeholder="Specialitie" value="" id="Dic">
                            <option>{{__('lang.slct_dept')}}</option>
                              @foreach($dbdirection as $dbd)
                              @if(app()->getLocale() == 'ar')
                              
                              <option value='{{$dbd->id_depart}}'>{{$dbd->Nom_depart_ar}}</option>
                              
                              @else
                              
                              <option value='{{$dbd->id_depart}}'>{{$dbd->Nom_depart}}</option>
                              
                              @endif
                              @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.sous_dept')}}</label>
                        <select type="text" class="form-select" value="" placeholder="Filiere" id="SDic">
                        <option>{{__('lang.slct_sous_dept')}}</option>
                        @foreach($dbsdirection as $dic)
                              @if (app()->getLocale() == 'ar')
                              
                                <option value="{{$dic->id_sous_depart}}">{{$dic->Nom_sous_depart_ar}}</option>
                              @else
                              
                                <option value="{{$dic->id_sous_depart}}">{{$dic->Nom_sous_depart}}</option>
                              
                              @endif
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.post')}}</label>
                        <select type="text" class="form-select" placeholder="Diplome" value="" id="post">
                        <option>{{__('lang.slct_post')}}</option>
                        @foreach($dbpost as $post)
                        @if (app()->getLocale() == 'ar')
                        
                            <option value='{{$post->id_post}}'>{{$post->Nom_post_ar}}</option>
                        @else
                        
                            <option value='{{$post->id_post}}'>{{$post->Nom_post}}</option>
                        
                        @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.date_inst')}}</label>
                        <input type="date" class="form-control" id="PVDate">
                    </div>
                </div>
                <div class="col-md-6">
                        <label class="labels">{{__('lang.date_rec')}}</label>
                        <input type="date" class="form-control" id="RecDate">
                    </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" id="aft">{{ __('lang.submit') }}</button>
                </div>
            </div>
        </div>
        </form>
        <div class="file-holder">
          <div class="file-select-holder">
            <label for="file">Choose file:</label>
            <input type="file" name="file" id="file"> </br>
            <div class="">
            <button class="button-33" type="button" id="upload-button" onclick="uploadFile()">{{ __('lang.upload') }}</button>
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
     console.log('my id::'+id);
     var idp = '{{ $employe->id_p }}';
     var dir = 'Admin';
     var uid='{{$uid}}'
</script>
@endsection


