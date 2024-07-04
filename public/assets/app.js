/*import './bootstrap';

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});*/

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

