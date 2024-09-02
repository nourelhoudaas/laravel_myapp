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
$(document).ready(function(){
    $('#btn-ch').click(function(e){
        e.preventDefault();
 // Assuming you are searching by ID_NIN
                var formData = {
                    ID_NIN: id,
                    Nom_P: $('#Nom_P').val(),
                    Prenom_O: $('#Prenom_O').val(),
                    Nom_P_ar:$('#Nom_PAR').val(),
                    Prenom_O_ar: $('#Prenom_OAR').val(),
                    Date_Nais_P: $('#dateN').val(),
                    Lieu_N: $('#Lieu_N').val(),
                    Address: $('#adr').val(),
                    AddressAR: $('#adrAR').val(),
                    phone_pn:parseInt($('#phone_pn').val()),
                    email_pro:$('#email_pro').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    _method: 'PUT'
                };

                $.ajax({
                    url: '/BioTemplate/edit/' + id,
                    type: 'POST',
                    data: formData,
                    success: function (response) {

                        alert(response.success);
                        window.location.href = "/BioTemplate/search/"+id;
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        if( lng == 'ar')
                        {
                            alert('خطأ في عملية التحديث')
                        }
                        else
                        {
                            alert('Opération échouée')
                        }
                    }
                });
    });
});