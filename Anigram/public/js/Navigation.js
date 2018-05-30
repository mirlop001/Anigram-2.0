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
    $("#div-Mascota .required").prop('required', false);
    $("#div-Comercio .required").prop('required', false);
    $("#div-" + elem + ".required").prop('required', true);
}
function selectTabAmigos(elem) {
    console.log(elem);
    $(".menu-tabs").removeClass("active");
    $("#" + elem).addClass("active");

    $(".tab-content1").removeClass("active");
    $("#div-" + elem).addClass("active");
   $("#Aceptados").val ((elem == 'Aceptados') ? 1 : 2);

    cambiaRequeridosAmigos(elem);
}
function cambiaRequeridosAmigos(elem) {
    $("#div-Aceptados input").prop('required', false);
    $("#div-Peticiones input").prop('required', false);
    $("#div-" + elem + " input").prop('required', true);
}