
@extends('base')

@section('title', 'Formulaire Administration')

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
<div id="loadingSpinner" class="spinner-overlay">
        <div class="spinner"></div>
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
        <div id='remq'>
            <p class=''></p>
        </div>
        <div class="form-holder">
        <form class="form-fa" action="/Employe/add" method="POST">
            @csrf
        <div class="col-md-10 just">
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
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">{{__('lang.post')}}</label>
                        <select type="text" class="form-select" placeholder="Diplome" value="" id="post">
                        <option value="">{{__('lang.slct_post')}}</option>
                        @foreach($dbpost as $post)
                        @if (app()->getLocale() == 'ar')
                        
                            <option value='{{$post->id_post}}'>{{$post->Nom_post_ar}}</option>
                        @else
                        
                            <option value='{{$post->id_post}}'>{{$post->Nom_post}}</option>

                        @endif
                        @endforeach
                        </select>
                        <div >
                            <label class='labels'>{{__('lang.PV_inst')}}</label>
                            <p id='pv_inst'></p>
                        </div>
                    </div >
                    <div  style="
    width: 50%;
    display: flex;
    flex-direction: column;
">
                    <div>  
                   <div>
                    <label class="labels" for="sel_posup">{{__('lang.post_sup_check')}}</label>
                    <input type="checkbox" id="sel_posup" class="col-md-2">
                    </div>
                    <div id="postsup-opt"  class="col-md-11" style="display: flex; align-items: center;">

                    </div>
                    <hr>
                    </div>
                    <div>
                       <label class="labels" for="sel_fonc">{{__('lang.fonc_check')}}</label>
                       <input type="checkbox" id="sel_fonc" class="col-md-2">
                    </div>
                    <div id="fonc-opt"  class="col-md-11" style="display: flex; align-items: center;">

                    </div>
                    <hr>
                    </div>
                    
                </div>
                <div class="row mt-2">
                <div class="col-md-6">
                        <label class="labels">{{__('lang.date_inst')}}</label>
                        <input type="date" class="form-control" id="PVDate">
                    </div>
                <div class="col-md-6">
                        <label class="labels">{{__('lang.date_rec')}}</label>
                        <input type="date" class="form-control" id="RecDate">
                    </div>
                    </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="submit" id="aft">{{ __('lang.submit') }}</button>
                </div>
            </div>
        </div>
        </form>
        <div class="file-holder">
          <div class="file-select-holder">
            <label for="file" class="file-get-handle" id="file-custm">{{__("lang.Choisirunfichier")}}</label>
            <input type="file" name="file" id="file"> </br>
            <div class="">
            <button class="button-33" type="button" id="upload-button" onclick="uploadFile()">{{ __('lang.upload') }}</button>
            </div>
            <label id='file-nm'>{{__('lang.filnull')}}</lable>
          </div>
                <div>
                    <div class="file-upload">
                    </div>
                </div>
        </div>
</div>
<dialog id="myDialog" class="myDial">
        <label>Confirm Action</label>
        <br>
        <input type="text" placeholder="{{__('lang.discis')}}" id='pv_num'></input>
        <hr>
        <div class="dialog-buttons">
            <button onclick="confirmAction()">{{__('lang.btn.enregistrer')}}</button>
            <button onclick="cancelDialog()">{{__('lang.cancel')}}</button>
        </div>
    </dialog>
</body>
<script>
     var id = '{{ $employe->id_nin }}';
     console.log('my id::'+id);
     var idp = '{{ $employe->id_p }}';
     var dir = 'Admin';
     var uid='{{$uid}}'
     var lang='{{app()->getLocale()}}'

     $(document).ready(function() {
            $('#Dic').on('change', function() {
                var directionId = $(this).val();
                if(directionId) {
                    $.ajax({
                        url: '/direction/'+directionId,
                        type: "GET",
                        dataType: "json",
                        success:function(response) {
                            $('#SDic').empty();
                            $('#SDic').append('<option value="">{{__("lang.slct_sous_dept")}}</option>');
                            $.each(response.data, function(key, value) {
                                console.log(' value'+JSON.stringify(value))
                                if(lang == 'ar')
                                {
                                $('#SDic').append('<option value="'+ value.id_sous_depart +'">'+ value.Nom_sous_depart_ar +'</option>');
                                }
                                else
                                {
                                $('#SDic').append('<option value="'+ value.id_sous_depart +'">'+ value.Nom_sous_depart +'</option>');
                                }
                            });
                        }
                    });
                } else {
                    $('#SDic').empty();
                    $('#SDic').append('<option value="">{{__("lang.slct_sous_dept")}}</option>');
                }
            });
        });
        $('#file').on('change',function(){
    var label = $('#file-custm');
    var fileName = this.files && this.files.length > 0 ? this.files[0].name : flang;
    label.textContent = fileName;
      console.log('file handler'+fileName)
      $('#file-nm').text(''+fileName)
   
    })
    document.getElementById('sel_posup').addEventListener('change', function() {
    const inputContainer = document.getElementById('postsup-opt');
    
    if (this.checked) {
        showPV_postsup()
        // Create a new select element
        const newSelect = document.createElement('select');
        newSelect.id = 'postsup'; // Optional, for easier manipulation later
        newSelect.classList='form-select'
        // Create options for the select element
        const option1 = document.createElement('option');
        option1.value = 'Chef_bur_res';
      
        const option2 = document.createElement('option');
        option2.value = 'Chef_bur_SI';
       
        const option3 = document.createElement('option');
        option3.value = 'respons_secI';
        
        if( lng =='ar')
        {
        option1.text = 'مكلف بالشبكات';
        option3.text = 'مكلف بانظمة المعلوماتية';
        option2.text = 'مكلف بالانظمة الحماية';
        }
        else
        {
        option1.text = 'Chargé Reseaux';
        option3.text = 'Chargé Systeme information';
        option2.text = 'Chargé Securité du System';
        }
        // Add options to the select element
        newSelect.appendChild(option1);
        newSelect.appendChild(option2);
        newSelect.appendChild(option3);

        // Add the select element to the container
        inputContainer.appendChild(newSelect);
        var divfunctpv=document.createElement('div')
        divfunctpv.id='pv-handl'
        var labal=document.createElement('label')
        labal.classList.add='labels'
        labal.textContent ='{{__("lang.PV_ref")}}'
        labal.style.fontSize = "16px";
        labal.style.fontWeight = "bold";  // Set font size // Set background color
        var textp=document.createElement('p')
        textp.id='pv_postsup'
        textp.text='test'
        textp.classList.add='labels'
        divfunctpv.appendChild(labal)
        divfunctpv.appendChild(textp)
        inputContainer.appendChild(divfunctpv)
        $('#pv_num').addClass('pv_postup')
    } else {
        // Remove the select element if it exists
        const dynamicSelect = document.getElementById('postsup');
        const dynamicpost = document.getElementById('pv-handl');
        if (dynamicSelect) {
            inputContainer.removeChild(dynamicSelect);
            inputContainer.removeChild(dynamicpost);
            $('#pv_num').removeClass('pv_postup')
        }
    }
});
document.getElementById('sel_fonc').addEventListener('change', function() {
    const inputContainer = document.getElementById('fonc-opt');
    
    if (this.checked) {
        // Create a new select element
        showPV_function()
        const newSelect = document.createElement('select');
        newSelect.id = 'fonc'; // Optional, for easier manipulation later
        newSelect.classList='form-select'
        $('#pv_num').addClass('pv_funct')
        // Create options for the select element
        const option1 = document.createElement('option');
        option1.value = 'sous_dic';
       

        const option2 = document.createElement('option');
        option2.value = 'Dir';
       

        const option3 = document.createElement('option');
        option3.value = 'SG';
       
        if( lng =='ar')
        {
        option1.text = 'مدير فرعي';
        option3.text = 'مدير';
        option2.text = 'أمين عام';
        }
        else
        {
        option1.text = 'Sous-Directeur';
        option3.text = 'Directeur';
        option2.text = 'Secrétiare General';
        }
        // Add options to the select element
        newSelect.appendChild(option1);
        newSelect.appendChild(option2);
        newSelect.appendChild(option3);

        // Add the select element to the container
        inputContainer.appendChild(newSelect);
        var divfunctpv=document.createElement('div')
        divfunctpv.id='func-handl'
        var labal=document.createElement('label')
        labal.classList.add='labels'
        labal.textContent ='{{__("lang.PV_ref")}}'
        labal.style.fontSize = "16px";
        labal.style.fontWeight = "bold";
        var textp=document.createElement('p')
        textp.id='pv_func'
        textp.text='test'
        textp.classList.add='labels'
        divfunctpv.appendChild(labal)
        divfunctpv.appendChild(textp)
        inputContainer.appendChild(divfunctpv)
    } else {
        // Remove the select element if it exists
        const dynamicSelect = document.getElementById('fonc');
        const dynamicfunct = document.getElementById('func-handl');
        if (dynamicSelect) {
            inputContainer.removeChild(dynamicSelect);
            inputContainer.removeChild(dynamicfunct);
            $('#pv_num').removeClass('pv_funct')

        }
    }
});
</script>
@endsection


