

function uploadFile() {
  var formData = new FormData();
  var file = document.getElementById('file').files[0];
  formData.append('file', file);
  formData.append('_token', document.querySelector('input[name="_token"]').value);
   var id=$('#NIN').val();
   formData.append('num', id);
   console.log(' --- '+id);
   if(typeof id === 'undefined')
    {
      console.log(' -- '+id);
     var id='{{ $employe->ID_NIN }}';
      console.log(' - '+id);
    }
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
/** function pour calcler les Jour */
function calculateDayscng(startDate,datechange) {
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
///------------------ this function for Nav left side -----------------------------
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    var radios = document.querySelectorAll('input[name="MheureRadio"]');
    radios.forEach(function(radio) {
        radio.checked = false;
    });
    var radios = document.querySelectorAll('input[name="SheureRadio"]');
    radios.forEach(function(radio) {
        radio.checked = false;
    });
    var radios = document.querySelectorAll('input[name="StatusRadio"]');
    radios.forEach(function(radio) {
        radio.checked = false;
    });
}

function closeNav(absensform,id_nin,absens) {
    document.getElementById("mySidenav").style.width = "0";
    var matin,soire,jour;
    var justfi;
    $(document).ready(function(){
        var selectedB = $('input[name="MheureRadio"]:checked');
        if (selectedB.length > 0) {
            var selectedValues = [];
            selectedB.each(function() {
                selectedValues.push({
                    id: $(this).attr('id'),
                    value: $(this).val()
                });
            });
            console.log('the data select are '+JSON.stringify(selectedValues))
            matin=selectedValues[0].value;
    }
    else
    {
        selectedB='';
        matin='';
    }
    var selectedB = $('input[name="SheureRadio"]:checked');
        if (selectedB.length > 0) {
            var selectedValues = [];
            selectedB.each(function() {
                selectedValues.push({
                    id: $(this).attr('id'),
                    value: $(this).val()
                });
            });
            console.log('the data select are '+JSON.stringify(selectedValues))
            soire=selectedValues[0].value;
    }
    else
    {
        selectedB='';
        soire='';
    }
    var selectedB = $('input[name="StatusRadio"]:checked');
        if (selectedB.length > 0) {
            var selectedValues = [];
            selectedB.each(function() {
                selectedValues.push({
                    id: $(this).attr('id'),
                    value: $(this).val()
                });
            });
            console.log('the data select are '+JSON.stringify(selectedValues[0].value))
            justfi=selectedValues[0].value;
    }
    else
    {
        selectedB='';
        justfi=''
    }
   
    
    jour=soire+matin;
    absensform.jour=jour
    absensform.justifie=justfi;
    console.log('version final is :: -->'+JSON.stringify(absensform));
    $('#mySidenav').removeClass('toRight')
    if( soire !=='' || matin !=='')
        {
            var i = 0;
            if(i<1){
    $.ajax({
        url: '/add_absence/',
        data:absensform,
        type:'POST',
        success:function(response)
        {
           
            var j=1;
            alert('Absens');
            $("#"+id_nin+" i").remove();
            $('#'+id_nin).removeClass('pre');
            $('#'+id_nin).append(absens);
            $('#'+id_nin).addClass('abs');
            matin=''
            soire=''
            justfi=''
            jour='';
            i++;
            j++;
            console.log('i '+i+' j'+ j)
        }
      })    
    }
    else
    {
        alert('close it with '+i);
    }  
    }
    else
    {
        alert('chose time');
    }
})
}
//------------------------------------------------------------------------------------
//add profile

     $(document).ready(function(){

    $('#ID_NIN').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Nom_P').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Prenom_O').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Nom_PAR').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Prenom_AR').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#PHONE_NB').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#username').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Address').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#AddressAR').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Date_Nais_P').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Lieu_N').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Lieu_AR').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#EMAIL').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#Sexe').focus(function()
    {
        $(this).removeClass('error-handle')
    });
    $('#btn-sv').click(function(e){
        e.preventDefault();
                selectElement =document.querySelector('#Sexe');
            output = selectElement.value;
            selectSituat =document.querySelector('#situat');
            outputS = selectSituat.value;
            selectenf =document.querySelector('#nbrenfant');
            outputF = selectenf.value;
                // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN:parseInt($('#ID_NIN').val()),
                    ID_SS:parseInt($('#ID_SS').val()),
                    Nom_P:$('#Nom_P').val(),
                    Prenom_O:$('#Prenom_O').val(),
                    Nom_PAR:$('#Nom_PAR').val(),
                    Prenom_AR:$('#Prenom_AR').val(),
                    PHONE_NB : parseInt($('#PHONE_NB').val()),
                    Address :$('#Address').val(),
                    AddressAR :$('#AddressAR').val(),
                    Date_Nais_P: $('#Date_Nais_P').val(),
                    Lieu_N:$('#Lieu_N').val(),
                    Lieu_AR:$('#Lieu_AR').val(),
                    Prenom_Per:$('Prenom_Per').val(),
                    Prenom_PerAR:$('Prenom_PerAR').val(),
                    Prenom_PerAR:$('Nom_mere').val(),
                    Prenom_PerAR:$('Prenom_mere').val(),
                    Prenom_PerAR:$('Nom_mereAR').val(),
                    Prenom_PerAR:$('Prenom_mereAR').val(),
                    Situat:outputS,
                    nbrenfant:outputF,
                    Sexe:output,
                    EMAIL:$('#EMAIL').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'POST'
                };

                $.ajax({
                    url: '/Employe/add/',
                    type: 'POST',
                    data: formData,
                    success: function (response) {

                        var id=$('#ID_NIN').val();
                        alert('donnee personnel a ajouter')
                      window.location.href="/Employe/IsTravaill/"+id;
                    },
                    error: function (xhr) {

                        console.log(xhr.responseJSON);
                        var error=xhr.responseJSON;
                        $.each(error.errors,function(key,val)
                    {
                        console.log('key'+key);
                        $('#'+key+'').addClass('error-handle')
                    })
                    }
                });
    });

//ADMIN
$(document).ready(function(){
$('#SDic').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#Dic').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#post').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#PVDate').focus(function()
{
    $(this).removeClass('error-handle')
});

    $('#aft').click(function(e){
        e.preventDefault();

        
                // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN:id,
                    ID_P : idp,
                    Dic: $('#Dic').val(),
                    SDic: parseInt($('#SDic').val()),
                    post:$('#post').val(),
                    PVDate:$('#PVDate').val(),
                    RecDate:$('#RecDate').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'POST'
                };

                $.ajax({
                    url: '/Employe/Generat',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert('Generate Success');
                        window.location.href="/BioTemplate/search/"+id;
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        var error=xhr.responseJSON;
                        $.each(error.errors,function(key,val)
                    {
                        console.log('key'+key);
                        $('#'+key+'').addClass('error-handle')
                    })
                    }
                });
    });
});
//TRAVAIL
$(document).ready(function(){
$('#DipRef').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#Spec').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#Filr').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#Dip').focus(function()
{
    $(this).removeClass('error-handle')
});
$('#DipDate').focus(function()
{
    $(this).removeClass('error-handle')
});
    $('#aft2').click(function(e){
        e.preventDefault();

                // Assuming you are searching by ID_NIN
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
                        var error=xhr.responseJSON;
                        $.each(error.errors,function(key,val)
                    {
                        console.log('key'+key);
                        $('#'+key+'').addClass('error-handle')
                    })
                    }
                });
    });
});
     });
//TRAVAIL
function uploadFile2() {
    var formData = new FormData();
    var file = document.getElementById('file').files[0];
    formData.append('file', file);
    formData.append('_token', document.querySelector('input[name="_token"]').value);


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

// ------------- getting list empl with his dep ------------
$(document).ready(function() {
    var datch= $('#abs_date').val();
    var absens='<i id="stdout-ic" class="fa fa-user-times" aria-hidden="true"></i>';
    var present='<i id="stdin-ic" class="fa fa-check-circle" aria-hidden="true"></i>';
    var dateabs=new Object();
    var che=0;
   if(datch === '')
   {
    
    $('#ddate').addClass('error-handle');
   }
    $('#abs_date').change(function()
{
    var dates=$(this).val();
    if(dates)
    {
        $('#ddate').removeClass('error-handle');
        $('#Dep option:first').prop('selected', true);
        $('#AbsTable tbody').empty();
        $.ajax({
            url:'/abense_dates/'+dates,
            method :'GET',
            success:function(response)
            {
                dateabs=response;
                console.log('dattes'+JSON.stringify(dateabs))
            }
        })
    }
    else
    {
        $(this).addClass('error-hadle');
    }
});
   
       // alert('not empty')
     //   console.log('tes'+itemsdate.id_nin);
        $('#Dep').change(function() {
            let list_abs=new Object()
            var dep = $(this).val();
            var dates=$('#abs_date').val();
            console.log('date'+$.isEmptyObject(dateabs));
            if(!$.isEmptyObject(dateabs))
            {
            if (dep) {
                $.ajax({
                    url: '/liste_abs_deprt/' + dep,
                    method: 'GET',
                    success: function(response) {
                        $('#AbsTable tbody').empty();
                        list_abs=response
                        list_abs.absens=false;
                        list_abs.forEach(function(item) {
                           console.log('--'+JSON.stringify(dateabs));
                         //  if()
                     dateabs.forEach(function(itemsdate){
                            if(item.id_nin === itemsdate.id_nin)
                            {
                                item.absens=true;
                            }
                             })  
                });
                console.log('list'+JSON.stringify(list_abs))
                list_abs.forEach(function(item){
                    if(item.absens)
                    {
                        $('#AbsTable tbody').append('<tr id='+item.id_p+'><td><a href=/BioTemplate/search/' + item.id_nin+'>'+item.Nom_emp
                        + '</td><td>' + item.Prenom_emp 
                        + '</td><td>' + item.Nom_post 
                        + '</td><td>' + item.Nom_sous_depart 
                        + '</td><td>' + item.Nom_depart 
                        + '</td><td id="stdout'+item.id_nin+'" class="std-handle abs">'+absens+'</td></tr>');
                    }else
                    {

                        $('#AbsTable tbody').append('<tr id='+item.id_p+'><td><a href=/BioTemplate/search/' + item.id_nin+'>'+item.Nom_emp
                        + '</td><td>' + item.Prenom_emp 
                        + '</td><td>' + item.Nom_post 
                        + '</td><td>' + item.Nom_sous_depart 
                        + '</td><td>' + item.Nom_depart 
                        + '</td><td id="stdin'+item.id_nin+'" class="std-handle pre">'+present+'</td></tr>');

                    }
                })
               
              
                        $("#AbsTable tbody tr").each(function(){
                            var id_p=$(this).attr('id');   
                            var idme=$(this).find('td:nth-child(6)');
                            var id_nin=idme.attr('id')
                              $('#'+id_nin).click(function(){
                               
                               //   alert('present')
                               // console.log('id -> user  '+id_nin);
                                var check=$('#'+id_nin+' i').attr('id');
                           //     console.log('icons id'+check);
                                var checkv2 =  present.split('"');
                                console.log('gtting data'+checkv2[1]);
                              if(check === checkv2[1]){
                                openNav();
                                var absensform={
                                  ID_NIN:id_nin,
                                  ID_P:id_p,
                                  Dic:dep,
                                  heur:1,
                                  Date_ABS:dates,
                                  _token: $('meta[name="csrf-token"]').attr('content'),
                                  _method: 'POST'
                                }
                                $("#close").click(function()
                            {
                                if(che == 0){
                                closeNav(absensform,id_nin,absens)
                            che++;
                            }
                            else
                            {
                                che=0;
                            }
                            })
                            }
                                else
                                {
                                  alert('u don t have permission')
                                }
                              })
                        
                          }) 
                    },
                    error: function(response) {
                        console.log(JSON.stringify(response))
                    }
                });
            } else {
                $('#AbsTable tbody').empty();
            }
       
 
    }else
    {
       // alert('empty list');
            var dep = $(this).val();
          //  console.log('id'+dep);
            var datch=$('#abs_date').val();
           // console.log('-->'+datch)
            if (dep) {
                $.ajax({
                    url: '/liste_abs_deprt/' + dep,
                    method: 'GET',
                    success: function(response) {
                        $('#AbsTable tbody').empty();
                        response.forEach(function(item) {
                         //   console.log('--'+JSON.stringify(item));
                            $('#AbsTable tbody').append('<tr id='+item.id_p+'><td><a href=/BioTemplate/search/' + item.id_nin+'>'+item.Nom_emp
                                                      + '</td><td>' + item.Prenom_emp 
                                                      + '</td><td>' + item.Nom_post 
                                                      + '</td><td>' + item.Nom_sous_depart 
                                                      + '</td><td>' + item.Nom_depart 
                                                      + '</td><td id="stdin'+item.id_nin+'" class="std-handle pre">'+present+'</td></tr>');
                                                      
                          //  console.log('-->>'+$('#stdin').text())
                        });
                         $("#AbsTable tbody tr").each(function(){
                          var id_p=$(this).attr('id');   
                          var idme=$(this).find('td:nth-child(6)');
                          var id_nin=idme.attr('id')
                            $('#'+id_nin).click(function(){
                               // openNav();
                          
                              //$('#mySidenav').addClass('toRight');
                             //   alert('present')

                              console.log('id -> user  '+id_nin);
                              var check=$('#'+id_nin+' i').attr('id');
                         //     console.log('icons id'+check);
                              var checkv2 =  present.split('"');
                              console.log('gtting data'+checkv2[1]);
                            if(check === checkv2[1]){
                                openNav();
                              var absensform={
                                ID_NIN:id_nin,
                                ID_P:id_p,
                                Dic:dep,
                                heur:1,
                                Date_ABS:dates,
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                _method: 'POST'
                              }
                              $("#close").click(function()
                            {
                                if(che == 0){
                                    closeNav(absensform,id_nin,absens)
                                      che++;
                                }
                                else
                                {
                                    che=0;
                                }
                            })
                            }
                              else
                              {
                                alert('u don t have permission')
                              }
                            })
                      
                        }) 
                    },
                    error: function(response) {
                        console.log(JSON.stringify(response))
                    }
                });
            } else {
                $('#AbsTable tbody').empty();
                $('#ddate').addClass('error-handle');
            }
        
    }
});

});
/** -------------------------- Absence Partie ---------------------------- */



/** ---------------------------congé partie Demarer ------------------*/

$(document).ready(function(){
    var inpt=$('#id_emp')
    var droit='<i class="fa fa-check-square" aria-hidden="true"></i>'
    var pasrdoit='<i class="fa fa-ban" aria-hidden="true"></i>'
    var result=new Object()
      inpt.blur(function()
          {
                    $('#checkcg-box').empty()
                    $('.date-conge').removeClass('disp')
                    $('#checkcg-box').removeClass('abs');
                    $('#checkcg-box').removeClass('droit');
            var val=$(this).val();
            if(val){
            $.ajax({
                url:'/check_droitcg/'+val,
                method:'GET',
                success:function(response)
                {
                    result=response;
                    console.log('response'+JSON.stringify(response))
                    $('#Dic').val(response.employe.Nom_depart)
                    $('#SDic').val(response.employe.Nom_sous_depart)
                    $('#total_cgj').val(response.Jour_congé)
                    $('#typ_cg option:eq(1)').prop('selected', true)
                    if(response.Jour_congé == 0 )
                    {
                        var currentTime = new Date()
                       $('#checkcg-box').append(pasrdoit);
                       $('#checkcg-box').addClass('abs');  
                       $('.date-conge').addClass('disp') 
                       $('#date_rec').val(response.employe.date_recrutement)
                       $('#date_op').val('01-06-'+currentTime.getFullYear()) 
                    }
                    else
                    {
                       $('#checkcg-box').append(droit);
                       $('#checkcg-box').addClass('pre');
                    }
                    
                    alert('success')
                }
            })
}else
{
    $('#Dic').val('La Direction')
    $('#SDic').val('La Sous-Direction')
}
          })
          $('#Date_Dcg').focus(function(){
            $(this).removeClass('error-handle')
          })
          $('#Date_Fcg').focus(function(){
            $(this).removeClass('error-handle')
          })
          $('#conge_confirm').click(function()
                    {
                        var date_dcg=$('#Date_Dcg').val();
                        var date_fcg=$('#Date_Fcg').val();
                        var totaljour=calculateDayscng(date_dcg,date_fcg) 
                        if(totaljour >0 && totaljour <=30)
                            {
                        var congeform={
                            ID_NIN:parseInt(result.employe.id_nin),
                            ID_P:parseInt(result.employe.id_p),
                            Dic:parseInt(result.employe.id_depart),
                            date_dcg:$('#Date_Dcg').val(),
                            date_fcg:$('#Date_Fcg').val(),
                            totaljour:parseInt(totaljour),
                            type_cg:$('#typ_cg').find(":selected").val(),
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'POST'
                          }
                        $.ajax({
                            url:'/add_emp_holiday/',
                            data:congeform,
                            type:'POST',
                            success:function(response)
                            {
                                alert('add_to holiday')
                                if(response.status == 200)
                                    {
                                window.location.href='/conge';
                                    }
                                    else
                                    {
                                        alert(response.message);
                                        $('#Date_Dcg').addClass('error-handle')
                                        $('#Date_Fcg').addClass('error-handle') 
                                    }
                            }
                        })
                    }
                    else
                    {
                        $('#Date_Dcg').addClass('error-handle')
                        $('#Date_Fcg').addClass('error-handle')
                    }
                    })
})

/**------------------------------ tarmine congé ---------------------*/
 //------------------------
var md=true;
document.getElementById('mod-but').addEventListener('click',function(){
var icon= document.getElementById('btn-icon');
if(md == false){
icon.classList.remove('fa-times')
icon.classList.add('fa-pencil');
document.getElementById('Nom_P').disabled=false;
document.getElementById('Nom_PAR').disabled=false;
document.getElementById('Prenom_O').disabled=false;
document.getElementById('Prenom_OAR').disabled=false;
document.getElementById('Email').disabled=false;
document.getElementById('phone_pn').disabled=false;
document.getElementById('dateN').disabled=false;
document.getElementById('adr').disabled=false;
document.getElementById('adrAR').disabled=false;
md=true;
}
else
{
icon.classList.remove('fa-pencil')
icon.classList.add('fa-times');
document.getElementById('Nom_P').disabled=true;
document.getElementById('Nom_PAR').disabled=true;
document.getElementById('Prenom_O').disabled=true;
document.getElementById('Prenom_OAR').disabled=true;
document.getElementById('Email').disabled=true;
document.getElementById('phone_pn').disabled=true;
document.getElementById('dateN').disabled=true;
document.getElementById('adr').disabled=true;
document.getElementById('adrAR').disabled=true;
md=false;
}
})
