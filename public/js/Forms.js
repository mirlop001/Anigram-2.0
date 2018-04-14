'use strict';

(function() {
    var form = document.getElementById("form-login");
    $("#boton_enviar").click(function(){
        alert("hey!");
    });
    $("#boton_enviar").on("click",function(event){
        alert("hey");
    });
    // document.getElementById("boton_enviar").addEventListener("click", function () {
    //   form.submit();
    // });
    $(document).ready(function(){
        $("#fotoPerfilUsuario").on("change",function(event){
            muestraImagen(event);
        });
    });
    
 })();