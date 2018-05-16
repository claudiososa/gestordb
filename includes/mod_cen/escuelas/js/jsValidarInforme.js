
    function validarInforme(){
    //       if ($('#titulo').val() != "") {
    //         //alert ('vacio')
    // $(this).focus()
    //       }
    //let letras=  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]+$/;
    //

    $('#tipo').keyup(function(event){
          if( $(this).val() != "0"){
            // alert('Obligatorio')
              $(".errorc").removeClass('show').fadeOut();
              $('.ccategoria').removeClass('has-error').addClass('has-success')
              $('.ctvalidacion').attr('for','nuevotipo')
              $('#tipo').attr('aria-describedby','helpBlock1')

             return true;

          }else{
            // alert ('paso')
            $('.ccategoria').addClass('has-error')
            $('.ctvalidacion').attr('for','nuevotipo')
            $('#tipo').attr('aria-describedby','helpBlock1')
            $('.errorc').addClass('show').addClass('help-block').attr('id','help-block1')
           return true;
          }


    })


        $('#subTipo').keyup(function(event){
              if( $(this).val() != "0"){
                // alert('Obligatorio')
                  $(".errorc").removeClass('show').fadeOut();
                  $('.csubcategoria').removeClass('has-error').addClass('has-success')
                  $('.svalidacion').attr('for','subTipo')
                  $('#subTipo').attr('aria-describedby','helpBlock3')

                 return true;

              }else{
                // alert ('paso')
                $('.csubcategoria').addClass('has-error')
                $('.svalidacion').attr('for','subTipo')
                $('#subTipo').attr('aria-describedby','helpBlock3')
                $('.errors').addClass('show').addClass('help-block').attr('id','help-block3')
               return true;
              }


        })
     $('#titulo').keyup(function(event){
      if( $(this).val() != ""){
        // alert('Obligatorio')
          $(".error").removeClass('show').fadeOut();
          $('.ctxttitulo').removeClass('has-error').addClass('has-success')
          $('.validacion').attr('for','titulo')
          $('#titulo').attr('aria-describedby','helpBlock2')

         return true;

      }else{
        // alert ('paso')
        $('.ctxttitulo').addClass('has-error')
        $('.validacion').attr('for','titulo')
        $('#titulo').attr('aria-describedby','helpBlock2')
        $('.error').addClass('show').addClass('help-block').attr('id','help-block2')
       return true;
      }

})




      if ($('#prioridad').val() == '0') {
        //alert('Seleccione Localidad')

        $('.cprioridad').addClass('has-error')
        $('.cvalidacion').attr('for','prioridad')
        $('#prioridad').attr('aria-describedby','helpBlock8')
        $('.errorp').removeClass('hide').addClass('help-block').attr('id','help-block8')

   return false
    }else{
        $('.cprioridad').removeClass('has-error').addClass('has-success')
        $('.cvalidacion').attr('for','prioridad')
        $('#prioridad').attr('aria-describedby','helpBlock8')
        $('.errorp').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block8')

      }



      if ($('#tipo').val() == '0') {
        //alert('Seleccione Localidad')

        $('.ccategoria').addClass('has-error')
        $('.ctvalidacion').attr('for','nuevotipo')
        $('#tipo').attr('aria-describedby','helpBlock1')
        $('.errorc').removeClass('hide').addClass('help-block').attr('id','help-block1')

   return false
    }else{
        $('.ccategoria').removeClass('has-error').addClass('has-success')
        $('.ctvalidacion').attr('for','nuevotipo')
        $('#tipo').attr('aria-describedby','helpBlock1')
        $('.errorc').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block1')

      }

              if ($('#subTipo').val() == '0') {
                //alert('Seleccione Localidad')

                $('.csubcategoria').addClass('has-error')
                $('.svalidacion').attr('for','subTipo')
                $('#subTipo').attr('aria-describedby','helpBlock3')
                $('.errors').removeClass('hide').addClass('help-block').attr('id','help-block3')

           return false
            }else{
                $('.csubcategoria').removeClass('has-error').addClass('has-success')
                $('.svalidacion').attr('for','subTipo')
                $('#subTipo').attr('aria-describedby','helpBlock3')
                $('.errors').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block3')

              }

      if( $('#titulo').val() == "" ){
              //  alert('Apellido: Ingrese solo letras')
          $('.ctxttitulo').addClass('has-error')
          $('.validacion').attr('for','titulo')
          $('#titulo').attr('aria-describedby','helpBlock2')
          $('.error').removeClass('hide').addClass('help-block').attr('id','help-block2')

          return false
      }else{
          $('.ctxttitulo').removeClass('has-error').addClass('has-success')
          $('.validacion').attr('for','titulo')
          $('#titulo').attr('aria-describedby','helpBlock2')
          $('.error').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block2')

        }

        if( $('#input_01').val() == "" ){
                //  alert('Apellido: Ingrese solo letras')
            $('.cfecha').addClass('has-error')
            $('.fvalidacion').attr('for','date')
            $('#input_01').attr('aria-describedby','helpBlock4')
            $('.errorf').removeClass('hide').addClass('help-block').attr('id','help-block4')

            return false
        }else{
            $('.cfecha').removeClass('has-error').addClass('has-success')
            $('.fvalidacion').attr('for','date')
            $('#input_01').attr('aria-describedby','helpBlock4')
            $('.errorf').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block4')

          }
return true
        }
