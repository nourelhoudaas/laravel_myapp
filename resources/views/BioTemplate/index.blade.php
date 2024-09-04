@php
    $uid=auth()->id();
    @endphp
@extends('base')
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/main.css')}}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personnel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">


<body>


    <!-- Page Wrapper -->
    <div id="wrapper" style="margin-top: 35px;">

        <!-- Sidebar -->
        <?php // require '../fragmentation/side.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php // require '../fragmentation/header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container">
        <div class="main-body">

              <!-- /Breadcrumb -->
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center"> 
                        <div class='gen-file-handle'> 
                          <p class='gen-list-handl'>...</p>
                          <div class="dropdown-opt">
                            <button id='gen_ats'>{{__('lang.ats')}}</button>
                        </div>
                        </div>
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                          </br>
                          <div class="mod-but" id="mod-but">
                             <i class="fa fa-times" aria-hidden="true" id="btn-icon">...</i>
                          </div>
                        <div class="mt-3">
                          <h4>{{__('lang.NIN')}} :<p id="ID_NIN">{{$last->id_nin}}</p></h4>
                          <h4>{{$last->Nom_emp}} {{$last->Prenom_emp}}</h4>
                          <h4>{{$last->Nom_ar_emp}} {{$last->Prenom_ar_emp}}</h4>
                        
                          <h6>
                         @if(app()->getLocale() == 'ar')
                            @if($last->sexe == 'femelle')
                            {{ __('lang.sx_fm') }}  
                            @else
                                {{ __('lang.sx_ma') }}  
                            @endif
                        @else
                            @if($last->sexe  == 'femelle')
                                {{ __('lang.sx_fm') }} 
                            @else
                                {{ __('lang.sx_ma') }}  
                            @endif
                        @endif
                       
                        </h6>
                          <div class="row">
                          @if(app()->getLocale() == 'ar') 
                            <p class="text-secondary mb-1">{{$last->Nom_post_ar}}</p><p class="text-secondary mb-1">{{__('lang.post_grad')}} : {{$last->Grade_post}}</p></div>
                            <p class="text-muted font-size-sm">{{$last->Nom_sous_depart_ar}},{{$last->Nom_depart_ar}}, {{__('lang.mnc')}}</p>
                            @else 
                            <p class="text-secondary mb-1">{{$last->Nom_post}}</p><p class="text-secondary mb-1">{{__('lang.post_grad')}} : {{$last->Grade_post}}</p></div>
                            <p class="text-muted font-size-sm">{{$last->Nom_sous_depart}},{{$last->Nom_depart}}, {{__('lang.mnc')}}</p>
                          @endif

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                    @if(isset($last->email_pro) && $last->email_pro != null)
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap" id="mail_pro">
                        <h6 class="mb-0">
                        
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                          {{__('lang.pro_mail')}}
                        </h6>
                        <span class="text-secondary">{{$last->email_pro}}</span>
                      </li>
                      @else
                      <div id="pro-add">
                    
                      </div>
                      @endif
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <div >
                          <span class="text-secondary" style="border-bottom: 1px solid darkgrey;"> {{__('lang.stitua_fam')}}</span>
                          <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap info-bord">
                            <h6 class="mb-0"><i class="fa fa-users" aria-hidden="true"></i> {{__('lang.famill')}}:
                            @if(app()->getLocale() == 'ar')
                            {{$last->situation_familliale_ar}}
                            @else
                            {{$last->situation_familliale}}
                            @endif
                          </h6>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap info-bord">
                            <h6 class="mb-0"><i class="fa fa-child" aria-hidden="true" ></i> {{__('lang.children')}} : {{$last->nbr_enfants}}</h6>
                        </div>
                        <div >
                          <span class="text-secondary" style="border-bottom: 1px solid darkgrey;"> {{__('lang.niv_edu')}} </span>
                          <div  class="list-group-item d-flex justify-content-between align-items-center flex-wrap info-bord">
                            <h6 class="mb-0"><i class="fa fa-university" aria-hidden="true" ></i> {{__('lang.nom_dipl')}} : 
                            @if( app()->getLocale() == 'ar')
                           {{$last->Nom_niv_ar}}
                           @else
                           {{$last->Nom_niv}}
                           @endif
                          </h6>
                          </div>
                          <div  class="list-group-item d-flex justify-content-between align-items-center flex-wrap info-bord">
                           <h6 class="mb-0"><i class="fa fa-graduation-cap" aria-hidden="true" ></i> {{__('lang.spec_dipl')}} : 
                           @if( app()->getLocale() == 'ar')
                           {{$last->Specialité_ar}}
                           @else
                           {{$last->Specialité}}
                           @endif
                          </h6>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="field">
                        <div class="field-holder">
                        <div class="col-sm-3">
                          <h6 class="mb-0 ">Nom</h6>
                        </div>
                        <input class="col-sm-9 text-secondary" id='Nom_P' value='{{$last->Nom_emp}}' style="border: hidden;background-color: transparent;" disabled>
                      </div>
                      <div class="field-holderAR">
                        <div class="col-sm-3">
                          <h6 class="mb-0 staticent">اللقب</h6>
                        </div>
                        <input class="col-sm-9 text-secondary" id='Nom_PAR' value='{{$last->Nom_ar_emp}}' style="border: hidden;background-color: transparent;" disabled>
                      </div>
                    </div>
                      <hr>
                      <div class="field">
                        <div class="field-holder">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Prénom</h6>
                        </div>
                        <input class="col-sm-9 text-secondary" id='Prenom_O' value=' {{$last->Prenom_emp}}' style="border: hidden;background-color: transparent;" disabled>
                        </div>
                        <div class="field-holderAR">
                        <div class="col-sm-3">
                          <h6 class="mb-0 staticent">الإسم</h6>
                        </div>
                        <input class="col-sm-9 text-secondary" id='Prenom_OAR' value=' {{$last->Prenom_ar_emp}}' style="border: hidden;background-color: transparent;" disabled>
                      </div>
                      </div>
                      <hr>
                      <div class="row field">
                        <div class="col-sm-3">
                          <h6 class="mb-0" >{{__('lang.mail')}}</h6>
                        </div>
                        <input class="col-sm-9 text-secondary"
                        id='Email'
                        value='{{$last->email}}'
                        style="border: hidden;background-color: transparent;" disabled>
                      </div>
                      <hr>
                      <div class="row field">
                        <div class="col-sm-3">
                          <h6 class="mb-0">{{__('lang.num_tel')}}</h6>
                        </div>
                        <input class="col-sm-9 text-secondary" type="number"
                        id='phone_pn'
                        value='0{{$last->Phone_num}}'
                        style="border: hidden;background-color: transparent;" disabled>
                      </div>
                      <hr>
                      <div class="field">
                        <div class="col-sm-3">
                          <h6 class="mb-0">{{__('lang.birtday')}}</h6>
                        </div>
                        <input class="col-sm-3 text-secondary" type='date'
                          id='dateN'
                          value='{{$last->Date_nais}}'
                          style="border: hidden;background-color: transparent; text-align: center;" disabled>
                          <div class="col-sm-6">
                      <div class="field-holder">
                          <h6 class="mb-0">{{ __('lang.Lieunaiss') }}</h6>
                          <input class="text-secondary"
                                type="text"
                                id="lieuN"
                                value="@if(app()->getLocale() == 'ar') {{ $last->Lieu_nais_ar }} @else {{ $last->Lieu_nais }} @endif"
                                style="border: hidden; background-color: transparent; text-align: center;"   disabled>
                              
                      </div>
                      </div>

                      </div>
                                      

                 

                  <hr>
                      
                      <div class="field">
                        <div  class="field-holder">
                        <div class="col-sm-3">
                          <h6 class="mb-0">{{__('lang.adresse')}}</h6>
                        </div>
                        <input class="col-sm-9 text-secondary"
                        id='adr'
                        value="@if(app()->getLocale() == 'ar') {{ $last->adress_ar }} @else {{ $last->adress }} @endif"
                        style="border: hidden;background-color: transparent;" disabled>
                      </div>
                      <div class="field-holder" id='adr-toadd'>
                      </div>
                      </div>

                      <hr>
                      <div class="row ">
                        <div class="col-sm-12" style="display: flex;flex-direction: row;justify-content: space-between;">
                          <button class="btn btn-info i" id="btn-ch">{{ __('lang.edit') }}</a>
                          <button class="btn btn-info i" id="btn-tr">{{ __('lang.tran') }}</a>
                          <button class="btn btn-info i" id="btn-dir">{{ __('lang.files') }}</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="wrapper">

                    <i id="left" class="fa-solid  fas fa-angle-left"></i>

                  <div class="row gutters-sm carousel">
                    <!--div class="col-sm-12 mb-3">
                      <div class="card h-100">
                        <div class="card-body">
                          <small>Web Design</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>Website Markup</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>One Page</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>Mobile Template</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small>Backend API</small>
                          <div class="progress mb-3" style="height: 5px">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div-->
                    @php
                    $count=1;
                    @endphp
                    @for($i=0;$i<count($detailemp);$i++)

                    <div class="col-sm-12 mb-3">
                        <div class="card h-100">
                          <div class="card-body">

                            <p>{{__('lang.dept')}} :
                            @if(app()->getLocale() == 'ar')
                              {{$postarr[$i]->Nom_sous_depart_ar}}
                            @else
                             {{$postarr[$i]->Nom_sous_depart}}
                            @endif
                            </p>
                           <div class="card-info">
                              <p>
                              {{__('lang.post')}} :
                              @if(app()->getLocale() == 'ar')
                              {{$postarr[$i]->Nom_post_ar}}
                              @else
                              {{$postarr[$i]->Nom_post}}
                              @endif
                              </p>
                              <p>
                              {{__('lang.post')}} : {{$postarr[$i]->Grade_post}}
                              </p>
                              <p>
                              {{__('lang.note')}} : {{$detailemp[$i]->notation}}
                              </p>
                              <p>
                              {{__('lang.post_echl')}}  : {{$postarr[$i]->echellant}}
                              </p>
                           </div>
                           <p>{{__('lang.obs')}}</p>
                            <div >
                              <p>{{__('lang.obs_dic')}}</p>
                            </div>
                            <p id="{{$detailemp[$i]->id_nin}}{{$count}}"></p>
                            <div class="card-info">
                              <p>{{__('lang.start')}} : {{$detailemp[$i]->date_installation}}</p>
                            </div>
                            </div>
                          </div>
                      </div>
                      @php
                        $count++;
                      @endphp
                      @endfor

                  </div>
                  <i id="right" class="fas fa-angle-right"></i>
                  </div>
                </div>
                </div>
              </div>

            </div>
        </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php // require ('../fragmentation/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{ asset('assets/carousel.js')}}"></script>
    <script src="{{ asset('assets/app.js')}}"></script>
    <!--script src="../js/printPD.js"></script>
    <script src="../js/sb-abd.js"></script-->

    <script >
       var id = '{{ $last->id_nin }}';
       var uid='{{$uid}}'
      var md=false;
      var chek='{{!isset($last->email_pro)}}'
document.getElementById('mod-but').addEventListener('click',function(){
var icon= document.getElementById('btn-icon');
if(md == false){
  if(chek == '1')
 {
 document.getElementById('pro-add').innerHTML='<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap" id="mail_pro">'
                        +'<h6 class="mb-0">'
                        +'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>'
                        +'</h6>'
                        +'<div id="inp-pro"></div>'
                        +'<span class="text-secondary" id="pro-mail-add"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>'
                        +'</li>'
 }
$('#pro-mail-add').on('click',function(){
$("#inp-pro").html('<input class="col-sm-9 text-secondary" id="email_pro" style="height: 35px;width: 100%;border-style: ridge;background-color: transparent;"></input>')
})
if( lng == 'ar')
{
  $("#adr").attr('id','adrAR')
  $('#adr-toadd').html('<div class="col-sm-3">'
                        +'<h6 class="mb-0">Address </h6>'
                        +'</div>'
                        +'<input class="col-sm-9 text-secondary"'
                        +"id='adr'"
                        +'value="{{ $last->adress }}"'
                        +' style="border: hidden;background-color: transparent;" disabled>'
                        +'</div>')
}
else
{
  $('#adr-toadd').html('<div class="col-sm-3">'
                        +'<h6 class="mb-0">العنوان</h6>'
                        +'</div>'
                        +'<input class="col-sm-9 text-secondary"'
                        +"id='adrAR'"
                        +'value="{{ $last->adress_ar }}"'
                        +' style="border: hidden;background-color: transparent;" disabled>'
                        +'</div>')
}
icon.classList.remove('fa-times')
icon.classList.add('fa-pencil');
document.getElementById('Nom_P').disabled=false;
document.getElementById('Nom_PAR').disabled=false;
document.getElementById('Prenom_O').disabled=false;
document.getElementById('Prenom_OAR').disabled=false;
document.getElementById('Email').disabled=false;
document.getElementById('phone_pn').disabled=false;
document.getElementById('dateN').disabled=false;
if( lng == 'ar')
{
  $('#adrAR').prop('disabled', false);
}else
{
  $('#adr').prop('disabled', false);
}

md=true;
}
else
{
$('#pro-add').empty()
$('#adr-toadd').empty()
if( lng == 'ar')
{
  $('#adrAR').prop('disabled', true);
}else
{
  $('#adr').prop('disabled', true);
}

icon.classList.remove('fa-pencil')
icon.classList.add('fa-times');
document.getElementById('Nom_P').disabled=true;
document.getElementById('Nom_PAR').disabled=true;
document.getElementById('Prenom_O').disabled=true;
document.getElementById('Prenom_OAR').disabled=true;
document.getElementById('Email').disabled=true;
document.getElementById('phone_pn').disabled=true;
document.getElementById('dateN').disabled=true;
//document.getElementById('adr').disabled=true;
//document.getElementById('adrAR').disabled=true;
md=false;
}
})
document.addEventListener("DOMContentLoaded", function() {
    const carousel = document.querySelector(".carousel");
    const arrowBtns = document.querySelectorAll(".wrapper i");
    const wrapper = document.querySelector(".wrapper");

    const firstCard = carousel.querySelector(".card");
    const firstCardWidth = firstCard.offsetWidth;

    let isDragging = false,
        startX,
        startScrollLeft,
        timeoutId;

    const dragStart = (e) => {
        isDragging = true;
        carousel.classList.add("dragging");
        startX = e.pageX;
        startScrollLeft = carousel.scrollLeft;
    };

    const dragging = (e) => {
        if (!isDragging) return;

        // Calculate the new scroll position
        const newScrollLeft = startScrollLeft - (e.pageX - startX);

        // Check if the new scroll position exceeds
        // the carousel boundaries
        if (newScrollLeft <= 0 || newScrollLeft >=
            carousel.scrollWidth - carousel.offsetWidth) {

            // If so, prevent further dragging
            isDragging = false;
            return;
        }

        // Otherwise, update the scroll position of the carousel
        carousel.scrollLeft = newScrollLeft;
    };

    const dragStop = () => {
        isDragging = false;
        carousel.classList.remove("dragging");
    };

    const autoPlay = () => {

        // Return if window is smaller than 800
        if (window.innerWidth < 800) return;

        // Calculate the total width of all cards
        const totalCardWidth = carousel.scrollWidth;

        // Calculate the maximum scroll position
        const maxScrollLeft = totalCardWidth - carousel.offsetWidth;

        // If the carousel is at the end, stop autoplay
        if (carousel.scrollLeft >= maxScrollLeft) return;

        // Autoplay the carousel after every 2500ms
        timeoutId = setTimeout(() =>
            carousel.scrollLeft += firstCardWidth, 2500);
    };

    carousel.addEventListener("mousedown", dragStart);
    carousel.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);
    wrapper.addEventListener("mouseenter", () =>
        clearTimeout(timeoutId));
    wrapper.addEventListener("mouseleave", autoPlay);

    // Add event listeners for the arrow buttons to
    // scroll the carousel left and right
    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            carousel.scrollLeft += btn.id === "left" ?
                -firstCardWidth : firstCardWidth;
        });
    });
});
    </script>

   </body>
   <script>
      function calculateDaysFromStart(startDate,datechange) {
    // Parse the start date
    const start = new Date(startDate);

    // Get the current date
    const current = new Date(datechange);

    // Calculate the difference in time
    const differenceInTime = current - start;

    // Convert the time difference from milliseconds to days
    const differenceInDays = Math.floor(differenceInTime / (1000 * 60 * 60 * 24));

    return differenceInDays;
}

//---------------------calculate -------------------------

function calculateDateDifference(totalDays) {
  const daysInYear = 365;
    const daysInMonth = 30; // Simplified approximation, can be adjusted
    console.log('--> '+totalDays)
    // Calculate the number of years
    const years = Math.floor(totalDays / daysInYear);
    // Calculate the remaining days after accounting for the years
    let remainingDays = totalDays % daysInYear;

    // Calculate the number of months
    const months = Math.floor(remainingDays / daysInMonth);
    // Calculate the remaining days after accounting for the months
    remainingDays = remainingDays % daysInMonth;

    return {
        years: years,
        months: months,
        days: remainingDays
    };
}
// Example usage
 // YYYY-MM-DD format
const count =@json($nbr);
const data =@json($detailemp);
var i=1;
/*data.forEach(function(emp){
  console.log(''+emp.date_recrutement)
const startDate = emp.date_recrutement;
const datechange=emp.date_chang;
document.getElementById(emp.id_nin+''+i).innerText=" La Duree : "+calculateDaysFromStart(startDate,datechange)+" Jours";
const daysElapsed = calculateDaysFromStart(startDate,datechange);
console.log(`Number of days from ${startDate} to today: ${daysElapsed}`);
i++;

})*/
for (let index = 0; index < data.length; index++) {
  {
    if(i > data.length-1)
    {
      console.log('no more to fetch');
    }
    else
    {
      const startDate = data[index].date_installation;
      const datechange=data[i].date_installation ;
      const daysElapsed = calculateDaysFromStart(startDate,datechange);
      var all=calculateDateDifference(daysElapsed)

       var jour='';
          var mois='';
          switch (true) {
            case all.days == 2:
              jour='يومان'
              break;
            case all.days >= 2:
              jour='أيام'
              break;
            case all.days >= 10:
              jour='يوم'
              break;
            default:
              jour='يوم'
              break;
          }
          switch (true) {
            case all.months == 1:
              mois='شهر'
              break;
            case all.months == 2:
              mois='شهران'
              break;
              case all.months <= 10:
              mois='أشهر'
              break;
              case all.months > 10:
              mois='شهرا'
              break;
            default:
              mois='شهرا'
              break;
          }
          switch (true) {
            case all.years== 1:
              anne='سنة'
              break;
            case all.years == 2:
              anne='سنتان'
              break;
            default:
            anne='سنوات'
              break;
          }


          var lang='{{app()->getLocale()}}'
      if(all.years != 0)
      {
        if(lang == 'ar')
        {
          document.getElementById(data[i].id_nin+''+i).innerText=" لمدة : "+all.days+''+jour+' و '+all.months+''+mois+''+all.years+' '+anne ;
        }
        else
        {document.getElementById(data[i].id_nin+''+i).innerText=" La Duree : "+all.days+'Jour(s) et '+all.months+' Moi(s) '+all.years+' Anneé(s)' ;}

      }
      else
      if(all.months != 0 )
      {
        if(lang =='ar'){
        document.getElementById(data[i].id_nin+''+i).innerText=" لمدة : "+all.days+''+jour+' و ' +all.months+''+mois;}
        else
        {
          document.getElementById(data[i].id_nin+''+i).innerText=" La Duree : "+all.days+'Jour(s) et '+all.months+' Moi(s)';
        }
      }
      else
      {
        if(lang =='ar')
        {
        document.getElementById(data[i].id_nin+''+i).innerText=" La Duree : "+all.days+'Jour(s) '
        }
        else
        {
           document.getElementById(data[i].id_nin+''+i).innerText=" لمدة: "+all.days+''+jour
        }
      }
      console.log(`Number of days from ${startDate} to today: ${daysElapsed}`)

    }
    i++;
  }

}
</script>
</html>
