
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
                // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN:parseInt($('#ID_NIN').val()),
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
                        alert('donnee personnel a ajouter')
                        var id=$('#NIN').val();
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
});


//ADMIN
$(document).ready(function(){
    $('#aft').click(function(e){
        e.preventDefault();

                var id = '{{ $employe->id_nin }}';
                var idp = '{{ $employe->id_p }}'; // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN:id,
                    ID_P : idp,
                    Dic: $('#Dic').val(),
                    SDic: parseInt($('#SDic').val()),
                    post:$('#post').val(),
                    PVDate:$('#PVDate').val(),
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
                    }
                });
    });
});

//TRAVILL
$(document).ready(function(){
    $('#aft2').click(function(e){
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

var md=false;
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
md=true;}
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

