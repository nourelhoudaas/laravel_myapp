/**
 * script pour la verification de l'enregistrement des users
 */
/*
$('#register-user').click(function(){
    var firstname=$('#firstname').val();
    var lastname=$('#lastname').val();
    var email=$('#email').val();
    var password=$('#password').val();
    var username=$('#username').val();
    var password_confirm=$('#password-confirm').val();
    var passwordLength=password.length;
    var agreeTerms=$('#agreeTerms');

    if (firstname !=""  && /^[a-zA-Z]+$/.test(firstname)) {
        $('#firstname').removeClass('is-invalid');
        $('#firstname').addClass('is-valid');
        $('#error-register-firstname').text("");

    }else{
        $('#firstname').addClass('is-invalid');
        $('#firstname').removeClass('is-valid');
        $('#error-register-firstname').text("First Name is invalid! ");
    }

    if (lastname !="" && /^[a-zA-Z]+$/.test(lastname)) {
        $('#lastname').removeClass('is-invalid');
        $('#lastname').addClass('is-valid');
        $('#error-register-lastname').text("");

    }else{
        $('#lastname').addClass('is-invalid');
        $('#lastname').removeClass('is-valid');
        $('#error-register-lastname').text("Last Name is invalid! ");
    }

    if (email !="" &&  /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)) {
        $('#email').removeClass('is-invalid');
        $('#email').addClass('is-valid');
        $('#error-register-email').text("");




    }else{
        $('#email').addClass('is-invalid');
        $('#email').removeClass('is-valid');
        $('#error-register-email').text("Email is invalid! ");
    }

    if (username !="" &&  /^[a-zA-Z0-9._-]+$/.test(username)) {
        $('#username').removeClass('is-invalid');
        $('#username').addClass('is-valid');
        $('#error-register-username').text("");

    }else{
        $('#username').addClass('is-invalid');
        $('#username').removeClass('is-valid');
        $('#error-register-username').text("Username is invalid! ");
    }

    if (passwordLength >=8 ) {
        $('#password').removeClass('is-invalid');
        $('#password').addClass('is-valid');
        $('#error-register-password').text("");

        if (password == password_confirm ) {
            $('#password-confirm').removeClass('is-invalid');
            $('#password-confirm').addClass('is-valid');
            $('#error-register-password-confirm').text("");

            var res =existEmailjs(email);


            (res != "exist") ? $('#form-register').submit()
                :   ($('#email').addClass('is-invalid'),
                    $('#email').removeClass('is-valid'),
                    $('#error-register-email').text("Email already exist! "));

            //$('#form-register').submit();

        }else{
            $('#password-confirm').addClass('is-invalid');
            $('#password-confirm').removeClass('is-valid');
            $('#error-register-password-confirm').text("Password must be the same! ");
        }

    }else{
        $('#password').addClass('is-invalid');
        $('#password').removeClass('is-valid');
        $('#error-register-password').text("Password must be at least 8 characters! ");
    }
});
/*
//pour les termes et conditions
    if (agreeTerms.is(':checked')) {
        $('#agreeTerms').removeClass('is-invalid');
        $('#error-register-agreeTerms').text("");
        //Envoie du formulaire
    }else{
        $('#agreeTerms').addClass('is-invalid');
        $('#error-register-agreeTerms').text("You should agree our terms" );
    }


});

//evenement pour les termes et conditions
$('#agreeTerms').change(function(){
    var agreeTerms=$('#agreeTerms');

    if (agreeTerms.is(':checked')) {
        $('#agreeTerms').removeClass('is-invalid');
        $('#error-register-agreeTerms').text("");
    }else{
        $('#agreeTerms').addClass('is-invalid');
        $('#error-register-agreeTerms').text("You should agree our terms" );
    }

})
*/
/*
// ici j envoie l email pour verifier si il existe deja ou pas cad envoiyer une requette et attendre une reponse du serveur
function existEmailjs(email)
{
    var url=$('#email'). attr('url-emailExist');
    var token=$('#email'). attr('email_token');
    var res="";


    $.ajax({
        type: 'POST',
        url: url, // le premier url c le nom de l attribut et le deuxieme url c l url de js qui est en haut
        data:{
            '_token': token,
            email: email
        },
        // si tt est correcte alors cette fonction  renvoie le resultat qui vas etre dans la variable result
        success:function(result){
            // mettre le resultat dans res
            res= result.response;
        },
        //pour pouvoir recuperer le resultat en dehors de la fonction ajax
        async: false
    });

    return res;
}

*/

/**
 * script pour la vérification de l'enregistrement des utilisateurs
 */

$('#register-user').click(function(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var username = $('#username').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var password_confirm = $('#password-confirm').val();
    var passwordLength = password.length;
    //var agreeTerms = $('#agreeTerms');


    if(firstname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(firstname)){
        $('#firstname').removeClass('is-invalid');
        $('#firstname').addClass('is-valid');
        $('#error-register-firstname').text("");

        if(lastname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(lastname)){
            $('#lastname').removeClass('is-invalid');
            $('#lastname').addClass('is-valid');
            $('#error-register-lastname').text("");

            if(email != "" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                $('#error-register-email').text("");

                if(passwordLength >= 8){
                    $('#password').removeClass('is-invalid');
                    $('#password').addClass('is-valid');
                    $('#error-register-password').text("");

                    if(password == password_confirm){
                        $('#password-confirm').removeClass('is-invalid');
                        $('#password-confirm').addClass('is-valid');
                        $('#error-register-password-confirm').text("");

                        if (username !="" &&  /^[a-zA-Z0-9._-]+$/.test(username)) {
                            $('#username').removeClass('is-invalid');
                            $('#username').addClass('is-valid');
                            $('#error-register-username').text("");

                            var data_response= existEmail(email);
                            var data_response2= existUsername(username);

                            (data_response!= "exist" && data_response2!= "exist")?  $('#form-register').submit()
                           : ( $('#email').addClass('is-invalid'),
                                $('#email').removeClass('is-valid'),
                                $('#error-register-email').text("email is already used!"),
                                $('#username').addClass('is-invalid'),
                                $('#username').removeClass('is-valid'),
                                $('#error-register-username').text("Username is already used! "));

                        }else{
                            $('#username').addClass('is-invalid');
                            $('#username').removeClass('is-valid');
                            $('#error-register-username').text("Username is invalid! ");
                        }

                    }else{
                        $('#password-confirm').addClass('is-invalid');
                        $('#password-confirm').removeClass('is-valid');
                        $('#error-register-password-confirm').text("Your passwords must be identical!");
                    }
                }else{
                    $('#password').addClass('is-invalid');
                    $('#password').removeClass('is-valid');
                    $('#error-register-password').text("Your password must be at last 8 characteres!");
                }
            }else{
                $('#email').addClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#error-register-email').text("Your email address is not valid!");
            }
        }else{
            $('#lastname').addClass('is-invalid');
            $('#lastname').removeClass('is-valid');
            $('#error-register-lastname').text("Last Name is not valid!");
        }
    }else{
        $('#firstname').addClass('is-invalid');
        $('#firstname').removeClass('is-valid');
        $('#error-register-firstname').text("First Name is not valid!");
    }
});


function existEmail(email) {
    var url = $('#email').attr('url-emailExist');
    var token = $('#email').attr('token');
    var response = "";

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token,
            email: email
        },

        success: function (resut) {
            response = resut.data_response;
        },

        error: function (xhr, status, error) {
            console.error("Erreur lors de la requête AJAX :", error);
            // Afficher un message d'erreur à l'utilisateur ou prendre d'autres mesures appropriées
          //  alert("Une erreur s'est produite lors de la requête AJAX. Veuillez réessayer plus tard.");
        },
        async: false,

    });

    return response;
}

function existUsername(username) {
    var url = $('#username').attr('url-usernameExist');
    var response = "";

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            username: username
        },

        success: function (resut) {
            response = resut.data_response2;
        },

        error: function (xhr, status, error) {
            console.error("Erreur lors de la requête AJAX :", error);
            // Afficher un message d'erreur à l'utilisateur ou prendre d'autres mesures appropriées
          //  alert("Une erreur s'est produite lors de la requête AJAX. Veuillez réessayer plus tard.");
        },
        async: false,

    });

    return response;
}

