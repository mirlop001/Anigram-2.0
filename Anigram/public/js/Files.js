'use strict';

function muestraImagenUsuario(evt) {
    var imagen = evt.target.files[0];


    var fr = new FileReader();
    fr.readAsDataURL(imagen);

    fr.onload = function(img) {
        var image = new Image();
        image.src = img.target.result;
        $("#foto-usuario").css("background-image", "url(" + image.src + ")");

    };

}

function muestraImagenMascota(evt) {
    var imagen = evt.target.files[0];


    var fr = new FileReader();
    fr.readAsDataURL(imagen);

    fr.onload = function(img) {
        var image = new Image();
        image.src = img.target.result;
        $("#perfil-mascota").css("background-image", "url(" + image.src + ")");

        var height = $("#perfil-mascota").height();

    };
}

function muestraImagenComercio(evt) {
    var imagen = evt.target.files[0];


    var fr = new FileReader();
    fr.readAsDataURL(imagen);

    fr.onload = function(img) {
        var image = new Image();
        image.src = img.target.result;
        $("#perfil-Comercio").css("background-image", "url(" + image.src + ")");

    };
}


$(document).ready(function() {
    $("#perfil-usuario").on("change", function(event) {
        muestraImagen(event);
    });

    $("#perfil-mascota").on("change", function(event) {
        muestraImagenMascota(event);
    });
});