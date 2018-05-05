'use strict';

function muestraImagenUsuario(evt) {
    var imagen = evt.target.files[0];


    var fr = new FileReader();
    fr.readAsDataURL(imagen);

    fr.onload = function(img) {
        var image = new Image();
        image.src = img.target.result;
        $("#foto-usuario").css("background-image", "url(" + image.src + ")");

        var height = $("#foto-usuario").height() * 1000;

        image.onload = function() {
            console.log(this.height);

            $("#foto-usuario").css("background-size", (height / this.height) + 100 + "%");
        }
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

        image.onload = function() {
            console.log(this.height);

            $("#perfil-mascota").css("background-size", (height / this.height) * 1000 + 100 + "%");
        }
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

        var height = $("#perfil-Comercio").height();

        image.onload = function() {
            console.log(this.height);

            $("#perfil-Comercio").css("background-size", (height / this.height) * 1000 + 100 + "%");
        }
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