'use strict';

(function() {
    var form = document.getElementById("form-login");
   
    $(document).ready(function(){
        $("#fotoPerfilUsuario").on("change",function(event){
            muestraImagen(event);
        });
    });
    
 })();