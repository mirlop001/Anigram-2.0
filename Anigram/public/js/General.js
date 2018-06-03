'use strict';
var page;
(function() {
    var form = document.getElementById("form-login");

    $(document).ready(function() {
        page = 1;
        $('#selector-mascota-icon').on('click', function() {
            if ($('#menu-secundario').hasClass("bounceIn")) {
                $('#menu-secundario').addClass("bounceOut");
                $('#menu-secundario').removeClass("bounceIn");
            } else {
                $('#menu-secundario').addClass("bounceIn");
                $('#menu-secundario').removeClass("bounceOut");

            }
        });

        // $('#menu-secundario button').on('click', function(event) {
        //     var idMascota = event.currentTarget.value;

        //     $.ajax({
        //         url: '../../App/controllers/gestionaCambioMascota.php',
        //         type: "POST",
        //         data: { 'idMascota': idMascota },
        //         success: function(data) {
        //             $('#selector-mascota-icon img').attr('src', data);
        //             $('#menu-secundario').addClass("bounceOut");
        //             $('#menu-secundario').removeClass("bounceIn");
        //         },
        //         error: function(jXHR, textStatus, errorThrown) {
        //             alert(errorThrown);
        //         }
        //     });
        // });

        $('.div-seleccion-mascota').mouseenter(function(e) {
            var imagen = $(this).find('img')[0];
            var popover = $(this).find('.d-inline-block');

            popover[0].dataset.content = imagen.alt;
            popover.popover('show');
            console.log(popover);

        }).mouseleave(function(e) {
            $(this).find('.d-inline-block').popover('hide');
        });
        

        $('#sonido-index-video').on('click', function() {
            $('#sonido-index-video svg').toggleClass('on');
            $('#sonido-index-video svg').toggleClass('off');
            $('#background-video').prop('muted', !$('#background-video').prop('muted'));
        });

        $('#ver-index-video').on('click', function() {
            if ($('#container-index').hasClass("desaparece")) {
                $('#container-index').addClass("aparece");
                $('#container-index-video::after').addClass("aparece");
                $('#container-index-video::after').removeClass("desaparece");
                $('#container-index').removeClass("desaparece");
                console.log($('#container-index-video::after'));
            } else {
                $('#container-index').addClass("desaparece");
                $('#container-index-video::after').addClass("desaparece");
                $('#container-index-video::after').removeClass("aparece");
                $('#container-index').removeClass("aparece");
            }
        });
        $("#input-busqueda input").on('keyup', function(event){
            var texto = event.currentTarget.value;
            console.log(texto);
            $.ajax({
                url: '../../App/controllers/gestionaBusqueda.php',
                type: "POST",
                data: { 'buscar': texto},
                success: function(data) {
                    if (data.match(/\w+/g)) {
                        $('#resultados').html(data);
                    } else{

                    }
                },
                error: function(jXHR, textStatus, errorThrown) {}
            });
        });
    });
})(page);

$(document).on('click','.btn-perfil', function(event){
    var idMascota = event.currentTarget.value;
    $.ajax({
        url: '../../App/controllers/gestionaVistaModal.php',
        type: "POST",
        data: { 'idMascota': idMascota, 'comando': 'verPerfil' },
        success: function(data) {
            if (data.match(/\w+/g)) {
                $('#perfil-mascota-content').html(data);
            } 
        },
        error: function(jXHR, textStatus, errorThrown) {}
    });
});

$(document).on('click','button#seguir-usuario', function(event){
    var idMascota = event.currentTarget.value;
    $.ajax({
        url: '../../App/controllers/gestionaVistaModal.php',
        type: "POST",
        data: { 'idMascota': idMascota, 'comando': 'seguirMascota' },
        success: function(data) {
            if (data) {
                $('button#seguir-usuario').html('<h5>Pendiente</h5>');
                $('button#seguir-usuario').prop('disabled', true);
            } 
        },
        error: function(jXHR, textStatus, errorThrown) {}
    });
});

$(document).on('click','.word-square', function(event){
    var idMedia = event.currentTarget.value;
    $.ajax({
        url: '../../App/controllers/gestionaVistaModal.php',
        type: "POST",
        data: { 'idMedia': idMedia , 'comando': 'verImagen'},
        success: function(data) {
            if (data.match(/\w+/g)) {
                $('#perfil-mascota-content').html(data);
            }
        },
        error: function(jXHR, textStatus, errorThrown) {}
    });
});

$(document).on('click', '#cargaMasContenido',function() {
    $.ajax({
        url: '../../App/controllers/gestionaVistaHome.php',
        type: "POST",
        data: { 'page': page },
        success: function(data) {
            if (data.match(/\w+/g)) {
                $('.container-anigram').append(data);
                page++;
            } else {
                $('#cargaMasContenido').hide();
            }
        },
        error: function(jXHR, textStatus, errorThrown) {}
    });
});