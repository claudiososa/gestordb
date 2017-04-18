

$(document).ready(function() {
var cuil =  /^[0-9]+$/;

$("#boton1").click(function (){

        $("#error").remove();

        if( $("#cuil").val() == "" ||  !cuil.test($("#cuil").val()) ){

          $("#cuil").focus().after("<span class='error'>Campo obligatorio.Ingrese su cuil sin guiones ni puntos</span>");
                    return false;
        }else {
            $(".error").fadeOut();
        }
        
            });

          $("#cuil").keyup(function(){
              if( $(this).val() != "" && (cuil.test($(this).val() ))){
                  $(".error").fadeOut();
                  return true;

              }

      });
});
