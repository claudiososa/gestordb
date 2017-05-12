$(document).ready(function() {

  $("#botonF_escuela").click(function(event) {
    $(".error").remove();
if ($("#nombre").val() == "") {
  $("#nombre").focus().after("<span class='error'>Campo Obligatorio.</span>");
  return false;
}else if ($("#domicilio").val() == "") {
  $("#domicilio").focus().after("<span class='error'>Campo Obligatorio.</span>");
  return false;
}
  });

  $("#nombre").keyup(function(){
    if ($(this).val() != "" ||($(this).val())) {
      $(".error").fadeOut();
      return false;
    }
  })
  $("#domicilio").keyup(function(){
    if ($(this).val() != "" ||($(this).val())) {
      $(".error").fadeOut();
      return false;
    }
  })
});
