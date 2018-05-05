'use strict';

function selectTab(elem) {
    console.log(elem);
    $(".menu-tabs").removeClass("active");
    $("#" + elem).addClass("active");

    $(".tab-content").removeClass("active");
    $("#div-" + elem).addClass("active");
    $("#rol").val((elem == 'Mascota') ? 1 : 2);

    cambiaRequeridos(elem);
}

function cambiaRequeridos(elem) {
    $("#div-Mascota.required").prop('required', false);
    $("#div-Comercio.required").prop('required', false);
    $("#div-" + elem + ".required").prop('required', true);
}