@extends('base')

@section('title', 'Employees')

@section('content')
@php
    $uid=auth()->id();
    @endphp
    <body>
    <div id="loadingSpinner" class="spinner-overlay">
        <div class="spinner"></div>
    </div>
        <div class="container2">
            <!-- start section aside -->
            @include('./navbar.sidebar')
            <!-- end section aside -->

            <!-- main section start -->
            <main>
                <div class="title"><h1>{{ __('lang.ctrl_abs') }}</h1></div>
                <div class="recent_order">
                <div class="date" id="ddate">
                    <input type="date" id="abs_date">
                </div>
                <div class="space"></div>
                <select type="text" class="form-select" value="" id="Dep">
                        <option value="">{{ __('lang.slct_dept') }}</option>
                        @foreach($empdepart as $empdeparts)
                        <option value='{{$empdeparts->id_depart}}'>
                            @if(app()->getLocale() == 'ar')
                            {{$empdeparts->Nom_depart_ar}}
                            @else
                            {{$empdeparts->Nom_depart}}
                            @endif
                        </option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="recent_order">


                    <table id="AbsTable" class="styled-table">

                        <thead>

                            <tr>
                                <th>{{ __('lang.name') }} </th>
                                <th>{{ __('lang.surname') }} </th>
                                <th> {{ __('lang.post') }}</th>
                                <th>{{ __('lang.sous_dept') }} </th>
                                <th>{{ __('lang.dept') }}</th>
                                <th>{{ __('lang.stuation') }}</th>
                                <th>{{ __('lang.stuation') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div>
                    <h3 id='emp-info'></h3>
                </div>

                <div class="recent_order" id="secondDiv" style="display: none; margin_bottom=10px">
                    <table  class="styled-table" id="AbsempTable" >
                        <thead></thead>
                        <tbody></tbody>
                    </table>

                </div>
                <div id="mySidenav" class="">
                    <div>
    <a href="javascript:void(0)" class="closebtn" id="close"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
    <a href="javascript:void(0)" class="cancelbtn" id="cancel">&times;</a>
                    </div>
    <div class="container mt-4">
        <form>
        @csrf
        <div class="info-handler">
            <label>{{ __('lang.period') }} :</label>
           </br>
            <div class="info-info">
                <div class="form-check info-wid">
                   <input class="form-check-input" type="radio" name="MheureRadio" id="Mheure" value="1">
                   <label class="form-check-label" for="exampleRadios1">
                    {{ __('lang.matin') }}
                   </label>
                </div>

                <div class="form-check info-wid">
                    <input class="form-check-input" type="radio" name="SheureRadio" id="Sheure" value="2">
                    <label class="form-check-label" for="exampleRadios2">
                    {{ __('lang.soire') }}
                    </label>
                </div>
            </div>
        </div>
<hr>
        <div class="info-handler">
          <label>{{ __('lang.motif') }} :</label>
      </br>
          <div class="info-info">
            <div class="form-check info-wid">
                <input class="form-check-input" type="radio" name="StatusRadio" id="StatusJ" value="F1">
                <label class="form-check-label" for="exampleRadios1">
                {{ __('lang.justifie') }}
                </label>
            </div>
            <div class="form-check info-wid">
                <input class="form-check-input" type="radio" name="StatusRadio" id="StatusNoJ" value="F2">
                <label class="form-check-label" for="exampleRadios2">
                {{ __('lang.nojust') }}
                </label>
            </div>
            </div>
<hr>
        <div class="info-handler">
          <label>{{ __('lang.motif') }} :</label>
      </br>
          <div class="info-info" id="checkboxContainer">
        </div>
        <hr>
            <div class="form-group">
            <label for="file" class='file-get-handle' id="file-custm">{{__("lang.Choisirunfichier")}}</label>
            <input type="file" name="file" id="file">
            <div class="">

            <label id='file-nm'>{{__('lang.filnull')}}</lable>
            </div>
            </div>
        </form>
    </div>
</div>
            </main>

        </div>
        <script>
             var uid='{{$uid}}'
            var id
            var dir='Maladie'
            var dateabs='{{__("lang.date_abs")}}'
            var filestatus="{{ session('success') }}"
        </script>
    </body>
    <script>
        var flang='{{__("lang.filnull")}}'
 $('#file').on('change',function(){
    var label = $('#file-custm');
    var fileName = this.files && this.files.length > 0 ? this.files[0].name : flang;
    label.textContent = fileName;
      console.log('file handler'+fileName)
      $('#file-nm').text(''+fileName)})
    </script>
@endsection
