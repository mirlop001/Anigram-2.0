'use strict';

(function() {
    var form = document.getElementById("form-login");

    $(document).ready(function() {
        $('#selector-mascota-icon').on('click', function() {
            if ($('#menu-secundario').hasClass("bounceIn")) {
                $('#menu-secundario').addClass("bounceOut");
                $('#menu-secundario').removeClass("bounceIn");
            } else {
                $('#menu-secundario').addClass("bounceIn");
                $('#menu-secundario').removeClass("bounceOut");

            }
        });

        $('#menu-secundario button').on('click', function(event) {
            var idMascota = event.currentTarget.value;

            $.ajax({
                url: '../../App/controllers/gestionaCambioMascota.php',
                type: "POST",
                data: { 'idMascota': idMascota },
                success: function(data) {
                    $('#selector-mascota-icon img').attr('src', data);
                    $('#menu-secundario').addClass("bounceOut");
                    $('#menu-secundario').removeClass("bounceIn");
                },
                error: function(jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });

        $('.div-seleccion-mascota').mouseenter(function(e) {
            var imagen = $(this).find('img')[0];
            var popover = $(this).find('.d-inline-block');

            popover[0].dataset.content = imagen.alt;
            popover.popover('show');
            console.log(popover);

        }).mouseleave(function(e) {
            $(this).find('.d-inline-block').popover('hide');
        });
    });
})();