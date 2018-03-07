
$(document).ready(function (e) {

    var tel = /^[0-9]+$/;
		//var sitioweb = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var sitioweb = /^(ht|f)tps?:\/\/\w+([\.\-\w]+)?\.([a-z]{2,6})?([\.\-\w\/_]+)$/i;
    $("#botonF_escuela").click(function (){
        $("#error").remove();
        //if( $("#nombref_escuela").val() == "" ){
          //  $("#nombref_escuela").focus().after("<span class='error'>Ingrese su nombre</span>");
            //return false;
        //}
        //else
         if( $("#tel_escuela").val() != "" &&  !tel.test($("#tel_escuela").val()) ){
            $("#tel_escuela").focus().after("<span class='error'>Ingrese solo números</span>");
            return false;
          }else {
            $(".error").fadeOut();
          }
				 if( $("#sitio_escuela").val() != "" && !sitioweb.test($("#sitio_escuela").val())){
							$("#sitio_escuela").focus().after("<span class='error'>Ingrese formato de dirección web correcto( ejemplo: www.mipagina.com )</span>");
							return false;
        }else {
          $(".error").fadeOut();
        }
    });
    //$("#nombref_escuela").keydown(function(){
      //  if( $(this).val() != "" ){
        //    $(".error").fadeOut();
          //  return false;
        //}
  //  });
  $("#tel_escuela").keyup(function(){
      if( $(this).val() != "" && (tel.test($(this).val() ))){

          $(".error").fadeOut();
          return true;

      }

  });
    $("#sitio_escuela").keyup(function(){
        if( $(this).val() != "" && (sitioweb.test($(this).val() ))){

            $(".error").fadeOut();
            return true;
        }
    });

});
