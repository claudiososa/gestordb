$(document).ready(function() {
  var alfanum = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ0-9_\s]+$/;

$("#btn-ndoc").click(function(event) {
  $("#error").remove();
  /* Act on the event */
  if ($("#tituloDoc").val() =="" || !alfanum.test($("#tituloDoc").val())) {
    $("#tituloDoc").focus().after("<span class='error'>Ingrese titulo. Solo letras y/o números</span>");
    return false;

  }else if ($("#descripcion").val() =="" || !alfanum.test($("#descripcion").val())) {
    $("#descripcion").focus().after("<span class='error'>Ingrese una descripcion del documento.Solo letras y/o números</span>");
    return false;

  }

  else if(($('#tipo option:selected').val()==='0')){
    $("#tipo").focus().after("<span class='error'>Seleccione una categoria</span>");
    return false;

  } else if(( $("#input-img").val() === "")){
    $("#input2").focus().after("<span class='error'>Seleccione archivo</span>");
    return false;
       // file selected
   }if($('input[name="tipo[]"]').is(':checked')){

            return true;
        }
        else{
          $("#permisodoc").after("<span class='error'>Seleccione al menos una opción</span>");
            return false;
        }

});

          $("#tituloDoc").keyup(function(event){
              if( $(this).val() != "" && (alfanum.test($(this).val() ))){
                  $(".error").fadeOut();
                  return true;

              }

           });
          $("#descripcion").keyup(function(event){
            if ($(this).val() != "" && (alfanum.test($(this).val()))) {
              $(".error").fadeOut();
              return true;

            }
          })
          $("#tipo").click(function(){
            if ($(this).val() != '0' && ($(this).val())) {
              $(".error").fadeOut();
              return false;
              //checkbox
            }
          })
          $("#input-img").click(function(){
            if ($(this).val() != "" && ($(this).val())) {
              $(".error").fadeOut();
              return false;
              //checkbox
            }
          })
/*
          $("#permisodoc").click(function(){
            if ($(this).val() != "" && ($(this).val())) {
              $(".error").fadeOut();
              return false;
              //checkbox
            }
          })*/
});
