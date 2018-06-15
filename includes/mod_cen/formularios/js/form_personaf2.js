$(document).ready(function() {

//alert('no');


 var persona = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]+$/;
// Crear nueva variable o combinar poar numero telefonico y validar con formtqatos para codigo y para numero
     // cuil - dni - tel casa - tel cel - cp
     var num =  /^[0-9]+$/;

     // correos:

     var correo = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}|[.][a-zA-Z]{2,4}$/;



$("#boton1").click(function(event){

      
        $("#error").remove();

         if ( $("#apellido").val() =="" || !persona.test($("#apellido").val())) {
           $("#apellido").focus().after("<span class='error'>Campo obligatorio.(Solo letras)</span");

            return false;
         }else {
           $(".error").fadeOut();
         }
          if ( $("#nombre").val() =="" || !persona.test($("#nombre").val())) {
           $("#nombre").focus().after("<span class='error'>Campo obligatorio.(Solo letras)</span");

            return false;
         }else {
           $(".error").fadeOut();
         }

// campo cuil obligatorio

        if( $("#cuil").val() == "" ||  !num.test($("#cuil").val()) ){

          $("#cuil").focus().after("<span class='error'>Campo obligatorio.Ingrese su cuil sin guiones ni puntos</span>");
                    return false;
        }else {
            $(".error").fadeOut();
        }

// campo dni obligatorio

        if ($("#dni").val() == "" || !num.test($("#dni").val())) {
          $("#dni").focus().after("<span class='error'>Campo obligatorio.Ingrese DNI sin puntos</span>");
                return false;
        }else {
            $(".error").fadeOut();
        }

  // telefonos: casa y celular

        if ($("#telefonoC").val() != "" && !num.test($("#telefonoC").val())) {
            $("#telefonoC").focus().after("<span class='error'>Ingrese sólo números</span>");
                    return false;
        }else {
            $(".error").fadeOut();
        }

        if ($("#telefonoM").val() != "" && !num.test($("#telefonoM").val())) {
            $("#telefonoM").focus().after("<span class='error'>Ingrese sólo números</span>");
                    return false;
        }else {
            $(".error").fadeOut();
        }



 // campos de correos electronicos

 // correo1 obligatorio

        if ($("#email").val() == "" || !correo.test($("#email").val())) {
           $("#email").focus().after("<span class='error'>Campo obligatorio.Ingrese formato valido ej:nombre@gmail.com</span>");
                return false;
        }else {
            $(".error").fadeOut();
        }

 // correo2

       


  // cp obligatorio

        if ($("#cpostal").val() == "" || !num.test($("#cpostal").val())) {
           $("#cpostal").focus().after("<span class='error'>Campo obligatorio.Ingrese solo números</span>");
                return false;
        }else {
            $(".error").fadeOut();
        }
              
return true;
});


 $("#apellido").keyup(function(event){
              if( $(this).val() != "" && (persona.test($(this).val() ))){
                  $(".error").fadeOut();
                  return true;

              }

           });


           $("#nombre").keyup(function(){
               if( $(this).val() != "" && (persona.test($(this).val() ))){
                   $(".error").fadeOut();
                   return true;

               }

            });


            $("#cuil").keyup(function(){
                if( $(this).val() != "" && (num.test($(this).val() ))){
                    $(".error").fadeOut();
                    return true;

                }

            });

            $("#dni").keyup(function(){
                if( $(this).val() != "" && (num.test($(this).val() ))){
                    $(".error").fadeOut();
                    return true;

                }

            });


            $("#telefonoC").keyup(function(){
                if( $(this).val() != "" && (num.test($(this).val() ))){
                    $(".error").fadeOut();
                    return true;

                }

            });

            $("#telefonoM").keyup(function(){
                if( $(this).val() != "" && (num.test($(this).val() ))){
                    $(".error").fadeOut();
                    return true;

                }

            });


            $("#email").keyup(function(){
                if( $(this).val() != "" && (correo.test($(this).val() ))){
                    $(".error").fadeOut();
                    return true;

                }

            });


            $("#cpostal").keyup(function(){
                if( $(this).val() != "" && (num.test($(this).val() ))){
                    $(".error").fadeOut();
                    return true;

                }

            });


	 
         
        


});   