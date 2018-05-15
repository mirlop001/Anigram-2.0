'use strict';

(function() {
    $(document).ready(function() {
        $('#email-registro').on('change', function(){
            var parametros = {
                "UserMail" : $('#email-registro').val(),
                "comprobacion": 'registro'
            };
            $.ajax({
                data:  parametros,
                url:   '../../App/controllers/compruebaExisteMail.php',
                type:  'post',
                success:  function (response) {
                    console.log(response);
                    if(response){
                        $('#email-registro').removeClass("invalidInput");
                        $('.usuarioExiste').hide();
                        $('div#boton_enviar #submit').show()
                    }else {
                        $('#email-registro').addClass("invalidInput");
                        $('.usuarioExiste').show();
                        $('div#boton_enviar #submit').hide();
                    }
                },
                error: function(err){
                    console.log(response);
                }
            });
        });

        $('#form-login').on('submit', function(e){
            e.preventDefault();
            
            if($('#email-login').val() != ""){
                var parametros = {
                    "UserMail" : $('#email-login').val(),
                    "Password" : $('#Clave-login').val(),
                    "comprobacion": 'login'
                };
                $.ajax({
                    data:  parametros,
                    url:   '../../App/controllers/login_controller.php',
                    type:  'post',
                    success:  function (response) {
                        console.log(response);
                        if(response){
                            $('#email-login').removeClass("invalidInput");
                            $('#Clave-login').removeClass("invalidInput");
                            $('.usuarioNoExiste').hide();
                            window.location.href = '../views/home.php';
                        }else {
                            $('#email-login').addClass("invalidInput");
                            $('#Clave-login').addClass("invalidInput");
                            $('.usuarioNoExiste').show();
                        }
                    },
                    error: function(err){
                        console.log(response);
                    }
                });
            }
        });

        $('#clave1').on('change', function(){
            var pass1 = $('#clave1').val();
            var pass2 = $('#clave2').val();
            var regexClave = /^(?=\w*[a-zA-Z])(?=\w*[0-9])\S{3,}$/g;
            var error = false;
            
            if(pass2 != "" && pass1 != pass2){
                $('#clave1').addClass("invalidInput");
                $('#clave2').addClass("invalidInput");
                $('.error-form.clavesNoCoinciden').show();
                error = true;

            }else if(!regexClave.test(pass1)){
                $('#clave1').addClass("invalidInput");
                $('.error-form.tipoClave1').show();
                error = true;
            }else{
                $('.error-form.clavesNoCoinciden').hide();
                $('.error-form.tipoClave1').hide();
                $('#clave1').removeClass("invalidInput");
                $('#clave2').removeClass("invalidInput");
            }

           
            if(error) $('div#boton_enviar #submit').hide();
            else $('div#boton_enviar #submit').show();
            
        });

        $('#clave2').on('change', function(){
            var regexClave = /^(?=\w*[a-zA-Z])(?=\w*[0-9])\S{3,}$/g;
            var pass1 = $('#clave1').val();
            var pass2 = $('#clave2').val();
            var error = false;
            
            if(pass1 != pass2){
                $('#clave1').addClass("invalidInput");
                $('#clave2').addClass("invalidInput");
                $('.error-form.clavesNoCoinciden').show();
                error = true;
            }else{
                $('#clave1').removeClass("invalidInput");
                $('#clave2').removeClass("invalidInput");
                $('.error-form.clavesNoCoinciden').hide();
            }

            if(error) $('div#boton_enviar #submit').hide();
            else $('div#boton_enviar #submit').show();
        });

        $('.form-woof').on('submit', function(e){
            e.preventDefault();
            var puntos = $(e.target).find("input[type=submit]:focus")[0].value;
            var media = $(e.target).find(".mediaID")[0].value;
            var datos = $(this).serialize()+'&Puntos='+puntos;
            $.ajax({
                url : '../../App/controllers/gestionaWoof.php',
                type: "POST",
                data: datos,
                success: function (data) {
                    console.log(data);

                    (function(p){
                        for(var i = 1; i <= p; i++){
                            $('.btn-woof.'+i+'.'+media).css('background-image', 'url(../../public/img/woofed-icon.png)');
                        }
                        for(var i = +p+1; i <= 5; i++){
                            $('.btn-woof.'+i+'.'+media).css('background-image', 'url(../../public/img/woof-icon.png)');                            
                        }
                    })(puntos);
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });

       
    });
})();


function getError(mensaje, clase){
   return "<label class='error-form "+clase+"'>"+mensaje+"</label>";
}

