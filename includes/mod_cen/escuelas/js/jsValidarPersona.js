/////validacion formulario
function validarpersona(){
          let letras=  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]+$/;
          let num =  /^[0-9]+$/;
          let correo = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}|[.][a-zA-Z]{2,4}$/;
          $("#txtapellido").keyup(function(event){
            if( $('#txtapellido').val() != "" && (letras.test($('#txtapellido').val() ))){
                $(".error").removeClass('show').fadeOut();

                $('.ctxtapellido').removeClass('has-error').addClass('has-success')
                $('.validacion').attr('for','txtapellido')
                $('#txtapellido').attr('aria-describedby','helpBlock2')

              //  return true;

            }else{
              $('.ctxtapellido').addClass('has-error')
              $('.validacion').attr('for','txtapellido')
              $('#txtapellido').attr('aria-describedby','helpBlock2')
              $('.error').addClass('show').addClass('help-block').attr('id','help-block2')
            //  return true;
            }


          })



          $("#txtnombre").keyup(function(event){
              if( $(this).val() != "" && (letras.test($(this).val() ))){
                  $(".errorn").removeClass('show').fadeOut();

                  $('.ctxtnombre').removeClass('has-error').addClass('has-success')
                  $('.validacionn').attr('for','txtnombre')
                  $('#txtnombre').attr('aria-describedby','helpBlock3')

                  return true;

              }else{
                $('.ctxtnombre').addClass('has-error')
                $('.validacionn').attr('for','txtnombre')
                $('#txtnombre').attr('aria-describedby','helpBlock3')
                $('.errorn').addClass('show').addClass('help-block').attr('id','help-block3')
                return true;
              }

           });

          $("#txtcuil").keyup(function(event){
             if( $(this).val() != "" && (num.test($(this).val() ))){
                 $(".errorc").removeClass('show').fadeOut();

                 $('.ctxtcuil').removeClass('has-error').addClass('has-success')
                 $('.validacionc').attr('for','txtcuil')
                 $('#txtcuil').attr('aria-describedby','helpBlock4')

                 return true;

             }else{
               $('.ctxtcuil').addClass('has-error')
               $('.validacionc').attr('for','txtcuil')
               $('#txtcuil').attr('aria-describedby','helpBlock4')
               $('.errorc').addClass('show').addClass('help-block').attr('id','help-block4')
               return true;
             }

          });
          $("#txttelefonoM").keyup(function(event){
            if( $(this).val() != "" && (num.test($(this).val() ))){
                $(".errort").removeClass('show').fadeOut();

                $('.ctxttelefonoM').removeClass('has-error').addClass('has-success')
                $('.validaciont').attr('for','txttelefonoM')
                $('#txttelefonoM').attr('aria-describedby','helpBlock5')

                return true;

            }else{
              $('.ctxttelefonoM').addClass('has-error')
              $('.validaciont').attr('for','txttelefonoM')
              $('#txttelefonoM').attr('aria-describedby','helpBlock5')
              $('.errort').addClass('show').addClass('help-block').attr('id','help-block5')
              return true;
            }

          });


          $("#txtemail").keyup(function(event){
             if( $(this).val() != "" && (correo.test($(this).val() ))){
                 $(".errore").removeClass('show').fadeOut();

                 $('.ctxtemail').removeClass('has-error').addClass('has-success')
                 $('.validacione').attr('for','txtemail')
                 $('#txtemail').attr('aria-describedby','helpBlock6')

                 return true;

             }else{
               $('.ctxtemail').addClass('has-error')
               $('.validacione').attr('for','txtemail')
               $('#txtemail').attr('aria-describedby','helpBlock6')
               $('.errore').addClass('show').addClass('help-block').attr('id','help-block6')
               return true;
             }

          });


          if ($('#txtdni').val() == '' || !num.test($('#txtdni').val()) ) {
          //alert('Apellido: Ingrese solo letras')

            $('.ctxtdni').addClass('has-error')
            $('.validaciod').attr('for','txtdni')
            $('#txtdni').attr('aria-describedby','helpBlock9')
            $('.errord').removeClass('hide').addClass('help-block').attr('id','help-block9')
            return false
          }else{
            $('.ctxtdni').removeClass('has-error').addClass('has-success')
            $('.validaciond').attr('for','txtdni')
            $('#txtdni').attr('aria-describedby','helpBlock9')
            $('.errord').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block9')

          }

          if ($('#txtapellido').val() == '' || !letras.test($('#txtapellido').val()) ) {
        //alert('Apellido: Ingrese solo letras')

          $('.ctxtapellido').addClass('has-error')
          $('.validacion').attr('for','txtapellido')
          $('#txtapellido').attr('aria-describedby','helpBlock2')
          $('.error').removeClass('hide').addClass('help-block').attr('id','help-block2')
          return false
        }else{
          $('.ctxtapellido').removeClass('has-error').addClass('has-success')
          $('.validacion').attr('for','txtapellido')
          $('#txtapellido').attr('aria-describedby','helpBlock2')
          $('.error').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block2')

        }
      if( $('#txtnombre').val() == '' || !letras.test($('#txtnombre').val())){
              //  alert('Apellido: Ingrese solo letras')
          $('.ctxtnombre').addClass('has-error')
          $('.validacionn').attr('for','txtnombre')
          $('#txtnombre').attr('aria-describedby','helpBlock3')
          $('.errorn').removeClass('hide').addClass('help-block').attr('id','help-block3')

          return false
      }else{
          $('.ctxtnombre').removeClass('has-error').addClass('has-success')
          $('.validacionn').attr('for','txtnombre')
          $('#txtnombre').attr('aria-describedby','helpBlock3')
          $('.errorn').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block3')

        }
        if( $('#txtcuil').val() == '' || !num.test($('#txtcuil').val())){
                //  alert('Apellido: Ingrese solo letras')
            $('.ctxtcuil').addClass('has-error')
            $('.validacionc').attr('for','txtcuil')
            $('#txtcuil').attr('aria-describedby','helpBlock4')
            $('.errorc').removeClass('hide').addClass('help-block').attr('id','help-block4')

           return false
        }else{
            $('.ctxtcuil').removeClass('has-error').addClass('has-success')
            $('.validacionc').attr('for','txtcuil')
            $('#txtcuil').attr('aria-describedby','helpBlock4')
            $('.errorc').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block4')

          }

          if( $('#txttelefonoM').val() == '' || !num.test($('#txttelefonoM').val())){

                  //  alert('Apellido: Ingrese solo letras')
              $('.ctxttelefonoM').addClass('has-error')
              $('.validaciont').attr('for','txttelefonoM')
              $('#txttelefonoM').attr('aria-describedby','helpBlock5')
              $('.errort').removeClass('hide').addClass('help-block').attr('id','help-block5')

          return false
          }else{
              $('.ctxttelefonoM').removeClass('has-error').addClass('has-success')
              $('.validaciont').attr('for','txttelefonoM')
              $('#txttelefonoM').attr('aria-describedby','helpBlock5')
              $('.errort').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block5')

            }
            if ($('#localidad').val() == '0') {
              //alert('Seleccione Localidad')

              $('.clocalidad').addClass('has-error')
              $('.validacionl').attr('for','localidad')
              $('#localidad').attr('aria-describedby','helpBlock8')
              $('.errorl').removeClass('hide').addClass('help-block').attr('id','help-block8')

         return false
          }else{
              $('.clocalidad').removeClass('has-error').addClass('has-success')
              $('.validacionl').attr('for','localidad')
              $('#localidad').attr('aria-describedby','helpBlock8')
              $('.errorl').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block8')

            }

            if( $('#txtemail').val() == '' || !correo.test($('#txtemail').val())){
                    //  alert('Apellido: Ingrese solo letras')
                $('.ctxtemail').addClass('has-error')
                $('.validacione').attr('for','txtemail')
                $('#txtemail').attr('aria-describedby','helpBlock6')
                $('.errore').removeClass('hide').addClass('help-block').attr('id','help-block6')

      return false
            }else{
                $('.ctxtemail').removeClass('has-error').addClass('has-success')
                $('.validacione').attr('for','txtemail')
                $('#txtemail').attr('aria-describedby','helpBlock6')
                $('.errore').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block6')

              }


return true;

}
