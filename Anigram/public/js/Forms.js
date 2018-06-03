'use strict';

(function() {
    var form = document.getElementById("form-login");

    $(document).ready(function() {
        $("#fotoPerfilUsuario").on("change", function(event) {
            muestraImagenUsuario(event);

        });

        $("#fotoPerfilMascota").on("change", function(event) {
            muestraImagenMascota(event);

        });
        $("#fotoPerfilMascotaNuevo").on("change", function(event) {
            muestraImagenMascotaNuevo(event);
        });

        $("#fotoPerfilComercio").on("change", function(event) {
            muestraImagenComercio(event);

        });

        $(".tipo-mascota-drp").on("click", function(event) {
            $("#dropdownTipo").html($(this).html());
            $("#input-tipo-mascota").val($(this).val());
        });

        $(".tipo-mascota-drp").on("click", function(event) {
            $("#dropdownTipoNuevo").html($(this).html());
            $("#input-tipo-mascota-nuevo").val($(this).val());
        });

        $('#email-registro').on('change', function() {
            var parametros = {
                "UserMail": $('#email-registro').val(),
                "comprobacion": 'registro'
            };
            $.ajax({
                data: parametros,
                url: '../../App/controllers/gestionaUsuario.php',
                type: 'post',
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $('#email-registro').removeClass("invalidInput");
                        $('.usuarioExiste').hide();
                        $('div#boton_enviar #submit').show()
                    } else {
                        $('#email-registro').addClass("invalidInput");
                        $('.usuarioExiste').show();
                        $('div#boton_enviar #submit').hide();
                    }
                },
                error: function(err) {
                    console.log(response);
                }
            });
        });

        $('#form-login').on('submit', function(e) {
            e.preventDefault();

            if ($('#email-login').val() != "") {
                var parametros = {
                    "UserMail": $('#email-login').val(),
                    "Password": $('#Clave-login').val(),
                    "comprobacion": 'login'
                };
                $.ajax({
                    data: parametros,
                    url: '../../App/controllers/gestionaUsuario.php',
                    type: 'post',
                    success: function(response) {
                        console.log(response);
                        if (response.match(/\w+/g)) {
                            $('#email-login').removeClass("invalidInput");
                            $('#Clave-login').removeClass("invalidInput");
                            $('.usuarioNoExiste').hide();
                            window.location.href = '../views/home.php';
                        } else {
                            $('#email-login').addClass("invalidInput");
                            $('#Clave-login').addClass("invalidInput");
                            $('.usuarioNoExiste').show();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });

        $('#clave1').on('change', function() {
            var pass1 = $('#clave1').val();
            var pass2 = $('#clave2').val();
            var regexClave = /^(?=\w*[a-zA-Z])(?=\w*[0-9])\S{3,}$/g;
            var error = false;

            if (pass2 != "" && pass1 != pass2) {
                $('#clave1').addClass("invalidInput");
                $('#clave2').addClass("invalidInput");
                $('.error-form.clavesNoCoinciden').show();
                error = true;

            } else if (!regexClave.test(pass1)) {
                $('#clave1').addClass("invalidInput");
                $('.error-form.tipoClave1').show();
                error = true;
            } else {
                $('.error-form.clavesNoCoinciden').hide();
                $('.error-form.tipoClave1').hide();
                $('#clave1').removeClass("invalidInput");
                $('#clave2').removeClass("invalidInput");
            }


            if (error) $('div#boton_enviar #submit').hide();
            else $('div#boton_enviar #submit').show();

        });

        $('#clave2').on('change', function() {
            var regexClave = /^(?=\w*[a-zA-Z])(?=\w*[0-9])\S{3,}$/g;
            var pass1 = $('#clave1').val();
            var pass2 = $('#clave2').val();
            var error = false;

            if (pass1 != pass2) {
                $('#clave1').addClass("invalidInput");
                $('#clave2').addClass("invalidInput");
                $('.error-form.clavesNoCoinciden').show();
                error = true;
            } else {
                $('#clave1').removeClass("invalidInput");
                $('#clave2').removeClass("invalidInput");
                $('.error-form.clavesNoCoinciden').hide();
            }

            if (error) $('div#boton_enviar #submit').hide();
            else $('div#boton_enviar #submit').show();
        });

        

        $('#form-registro').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '../../App/controllers/gestionaRegistroUsuario.php',
                type: "POST", 
                data:   new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    if(data)
                        window.location.href = '../views/home.php';
                },
                error: function(jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });

        $('#form-update').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '../../App/controllers/gestionaUpdateUsuario.php',
                type: "POST",
                data:   new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                        $('svg.svg-inline--fa.fa-spinner.fa-w-16.fa-spin ').show();
                        $('#submit').hide();

                        // window.location.href = '../views/home.php';
                    setTimeout(function(){ 
                        $('svg.svg-inline--fa.fa-spinner.fa-w-16.fa-spin ').hide();
                        $('#submit').show();
                        $('#modificacion-correcta').show(); 
                    }, 1000);
                   
                },
                error: function(jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });

       

        $(".form-comentario ").on("keypress", function() {
            $(this).find('.btn-guardarComentario').css("width", "90px");
            $(this).find('.btn-guardarComentario').css("color", "#cc9795");
        }).on('focusout', function() {
            $(this).find('.btn-guardarComentario').css("width", "0px");
            $(this).find('.btn-guardarComentario').css("color", "transparent");
        });

        $(".btn-guardarComentario").on('click', function() {
            $(this).find('.btn-guardarComentario').css("width", "0px");
            $(this).find('.btn-guardarComentario').css("color", "transparent");
        });

    });
})();



function getError(mensaje, clase) {
    return "<label class='error-form " + clase + "'>" + mensaje + "</label>";
}

function muestraNuevoComentario(data) {
    var imagen = "";
    if (data.ImagenMascota != "") {
        imagen = '../../public/img/saved/' + data.ImagenMascota;
    } else {
        imagen = '../../public/img/Espectro.png';
    }
    return '<div class="comentario row"> <div class="col-2"><img src="' + imagen + '" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación"></div>' +
        '<div class="col-10">' +
        '<div class="row"><label>' + data.NombreMascota + '</label></div>' +
        '<div class="row"><p>' + data.Comentario + '</p></div>' +
        '</div>' +
        '</div>';
}

$(document).on('submit','.form-woof', function(e) {
    e.preventDefault();
    var puntos = $(e.target).find("button[type=submit]:focus")[0].value;
    var media = $(e.target).find(".mediaID")[0].value;
    var datos = $(this).serialize() + '&Puntos=' + puntos;
    $.ajax({
        url: '../../App/controllers/gestionaWoof.php',
        type: "POST",
        data: datos,
        success: function(data) {

            (function(p) {
                $('.btn-woof.media-' + media + ' .fa-paw').removeClass('woofed');
                for (var i = 1; i <= p; i++) {
                    $('.btn-woof.puntos-' + i + '.media-' + media + ' .fa-paw').addClass('woofed');
                }


            })(puntos);
        },
        error: function(jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});

$(document).on('submit', '.form-comentario',function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../App/controllers/gestionaNuevoComentario.php',
        type: "POST",
        data: $(this).serialize(),
        success: function(data) {
            if (data) {
                data = JSON.parse(data);
                var htmlNuevoComentario = muestraNuevoComentario(data);
                $("#nuevos-comentarios-post" + data.IDMedia).prepend(htmlNuevoComentario);
                $("textarea.nuevoComentario").val("");
            }
        },
        error: function(jXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
});