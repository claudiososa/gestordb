$(document).ready(function() {

  $("#proveedor").hide();
  $("#tipoInstalacion").hide();
  $("#Funcion").hide();

  $("#conectividad").change(function (ev){

    var opcion = $(this).val();
    if (opcion== 'Si') {
      $("#proveedor").show();
      $('.error').hide();

    }else if (opcion!= 'Si') {
      $("#proveedor").hide();
$("#claro , #arnet , #fibertel , #local , #satelital , #otro").prop("checked", false);
        $('.error').hide();
      }
  });

  $("#energia").change(function (ev){

    var opcion = $(this).val();
    if (opcion== 'Si') {
      $("#tipoInstalacion , #Funcion").show();
var select=$("select#tipoInstalacion");
select.val(value='Sin registrar').remove();
var select=$("select#Funcion");
select.val(value='Sin registrar').remove();
      $('.error').hide();

    }else if (opcion == 'No') {
      $("#tipoInstalacion").hide()
      var select = $("select#tipoinstalacion");
      select.append('<option value="Sin registrar" selected="selected">Sin registar</option>');
    select.val(value='Sin registrar').attr('selected','selected');

        $('.error').hide();
      }
  });
  $("#energia").change(function (ev){

    var opcion = $(this).val();
    if (opcion== 'Si') {
      $("#Funcion").show();
      $('.error').hide();

    }else if (opcion == 'No') {
      $("#Funcion").hide()
      var select = $("select#funcion");
      select.append('<option value="Sin registrar" selected="selected">Sin registar</option>');
    select.val(value='Sin registrar').attr('selected','selected');

        $('.error').hide();
      }
  });



/*
  if ($("#conectividad").val().trim() == '0') {
  $("#conectividad").focus().after("<span class='error'>Campo obligatorio.Seleccione una opción");
  return false;
}

*/
var cue= /^[0-9,]+$/;
var num= /^[0-9]+$/;

$("#botonF_escuela").click(function() {

  $(".error").remove();



  if ($("#cue").val() !="" && !cue.test($("#cue").val())) {
    $("#cue").focus().after("<span class='error'>Solo Números. Si es mas de un CUE ingresarlos separados por comas sin espacios.</span>");
    return false;


  }else if ($("#internado").val().trim() == '0') {
    $("#internado").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
    return false;

  }else if ($("#totalCargos").val() =="" || !num.test($("#totalCargos").val())) {
    $("#totalCargos").focus().after("<span class='error'>Campo obligatorio.Solo Números</span>");
    return false;

  }else if ($("#matricula").val() =="" || !num.test($("#matricula").val())) {
    $("#matricula").focus().after("<span class='error'>Campo obligatorio.Solo Números</span>");
    return false;
  }else if ($("#energia").val().trim() == '0') {
    $("#energia").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
    return false;

  }else if ($("#tipoinstalacion").val().trim() == '0') {
    $("#tipoinstalacion").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
    return false;

  }else if ($("#funcion").val().trim() == '0') {
    $("#funcion").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
    return false;

}else if ($("#cantidadAulas").val() =="" || !num.test($("#cantidadAulas").val())) {
  $("#cantidadAulas").focus().after("<span class='error'>Campo obligatorio.Solo Números</span>");
  return false;
}else if ($("#cantidadPcInstaladas").val() !="" && !num.test($("#cantidadPcInstaladas").val())) {
  $("#cantidadPcInstaladas").focus().after("<span class='error'>Campo obligatorio.Solo Números</span>");
  return false;
}else if ($("#heladera").val().trim() == '0') {
  $("#heladera").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
  return false;
//checkbox
}else if ($("#energiasuf").val().trim() == '0') {
$("#energiasuf").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
  return false;

}else if ($("#calefon").val().trim() == '0') {
  $("#calefon").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
  return false;

}else if ($("#calefonsolar").val().trim() == '0') {
  $("#calefonsolar").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
  return false;

}else if ($("#bombeo").val().trim() == '0') {
  $("#bombeo").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
  return false;

}else if ($("#conectividad").val().trim() == '0') {
  $("#conectividad").focus().after("<span class='error'>Campo obligatorio.Seleccione una opcion</span>");
  return false;

}

  });


$("#cue").keyup(function(){
  if ($(this).val() != "" && cue.test($(this).val())) {
    $(".error").fadeOut();
    return false;
  }
})

$("#internado , #energia , #tipoinstalacion , #funcion , #heladera , #energiasuf , #calefon , #calefonsolar , #bombeo , #conectividad").keyup(function(){
  if ($(this).val() != "0" &&($(this).val())) {
    $(".error").fadeOut();
    return false;
    //checkbox
  }
})
$("#totalCargos , #matricula , #cantidadAulas , #cantidadPcInstaladas").keyup(function(){
  if ($(this).val() != "" && num.test($(this).val())) {
    $(".error").fadeOut();
    return false;
  }
})

  });
