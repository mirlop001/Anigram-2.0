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

        $("#fotoPerfilComercio").on("change", function(event) {
            muestraImagenComercio(event);

        });

        $(".tipo-mascota-drp").on("click", function(event) {
            $("#dropdownTipoMascota").html($(this).html());
            $("#input-tipo-mascota").val($(this).val());
        });

        $(".btn-nuevoComentario").on("click", function(event) {
            $(".nuevoComentario").show();
            $(".btn-guardarComentario").show();
            $(".btn-nuevoComentario").hide();
            
        });

        

    });

})();