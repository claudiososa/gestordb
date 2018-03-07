$(document).ready(function () {
    var user = /^[0-9]+$/;
    $("#btnvalidar").click(function (){
        $(".error").remove();
       if( $("#formulario-login").val() == "" || !user.test($("#formulario-login").val()) ){
            $("#alerta").focus().after("<span class='error'>Ingrese su usuario (solo números,máximo 8)</span>");
            return false;
        }
    });

    $("#formulario-login").keyup(function(){
        if( $(this).val() != "" && user.test($(this).val())){
            $(".error").fadeOut();
            return false;
        }
    });
});
