'use strict';

(function() {
    var form = document.getElementById("form-login");
   
    $(document).ready(function(){
        $("#fotoPerfilUsuario").on("change",function(event){
            muestraImagenUsuario(event);
        });
    
        $("#fotoPerfilMascota").on("change",function(event){
            muestraImagenMascota(event);
        });

        $(".tipo-mascota-drp").on("click", function(event){
            $("#dropdownTipoMascota").html($(this).html());
        });        
    });

 })();