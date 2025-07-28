
$('#register-user').click(function(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var id_nin = $('#id_nin').val();
    var id_p = $('#id_p').val();
    var username = $('#username').val();
    //var email = $('#email').val();
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

            /*if(email != "" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                $('#error-register-email').text("");*/

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

                            if (id_nin !="" &&  /^[0-9]+$/.test(id_nin)) {
                                $('#id_nin').removeClass('is-invalid');
                                $('#id_nin').addClass('is-valid');
                                $('#error-register-id_nin').text("");

                                if (id_p !="" &&  /^[0-9]+$/.test(id_p)) {
                                    $('#id_p').removeClass('is-invalid');
                                    $('#id_p').addClass('is-valid');
                                    $('#error-register-id_p').text("");

                            //var data_response= existEmail(email);
                            var data_response4= existIDP(id_p);
                            console.log("data_response4= $data_response4") ;
                            var data_response3= existIDNIN(id_nin);
                            var data_response2= existUsername(username);

                            (/*data_response!= "exist" &&*/ data_response2!= "exist"  && data_response3!= "exist"  && data_response4!= "exist")?  $('#form-register').submit()
                           : ( /*$('#email').addClass('is-invalid'),
                                $('#email').removeClass('is-valid'),
                                $('#error-register-email').text("email is already used!"),*/

                                $('#username').addClass('is-invalid'),
                                $('#username').removeClass('is-valid'),
                                $('#error-register-username').text("Username is already used! "),

                                $('#id_nin').addClass('is-invalid'),
                                $('#id_nin').removeClass('is-valid'),
                                $('#error-register-id_nin').text("id_nin is already used! "),

                                $('#id_p').addClass('is-invalid'),
                                $('#id_p').removeClass('is-valid'),
                                $('#error-register-id_p').text("id_p is already used! "));

                            }else{
                                $('#id_p').addClass('is-invalid');
                                $('#id_p').removeClass('is-valid');
                                $('#error-register-id_p').text("id_p is invalid! ");

                            }
                        }else{
                            $('#id_nin').addClass('is-invalid');
                                $('#id_nin').removeClass('is-valid');
                                $('#error-register-id_nin').text("id_nin is invalid! ");
                        }
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
           /* }else{
                $('#email').addClass('is-invalid');
                $('#email').removeClass('is-valid');
                $('#error-register-email').text("Your email address is not valid!");
            }*/
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


/*function existEmail(email) {
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
}*/

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

function existIDNIN(id_nin) {
    var url = $('#id_nin').attr('url-IDNINExist');
    var response = "";

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id_nin : id_nin
        },

        success: function (resut) {
            response = resut.data_response3;
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

function existIDP(id_p) {
    var url = $('#id_p').attr('url-IDPExist');
    var response = "";

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id_p : id_p
        },

        success: function (resut) {
            response = resut.data_response4;
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
