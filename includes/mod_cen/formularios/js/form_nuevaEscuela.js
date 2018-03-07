$(document).ready(function() {
  var num= /^[0-9]+$/;


  $("#btn_nuevaEsc").click(function(event) {
    /* Act on the event */
    $(".error").remove();

    if ( $("#numEsc").val() =="" || !num.test($("#numEsc").val())) {
      $("#numEsc").focus().after("<span class='error'>Campo obligatorio.</span");

       return false;
    }else {
      $(".error").fadeOut();


    }if ( $("#cueEsc").val() =="" || !num.test($("#cueEsc").val())) {
      $("#cueEsc").focus().after("<span class='error'>Campo obligatorio.(Solo números)</span");

       return false;
    }else {
      $(".error").fadeOut();


    }if ( $("#nombreEsc").val() =="") {
      $("#nombreEsc").focus().after("<span class='error'>Campo obligatorio</span");

       return false;
    }else {
      $(".error").fadeOut();
    }



  });

  $("#numEsc , #cueEsc").keyup(function(){
    if ($(this).val() != "" && num.test($(this).val())) {
      $(".error").fadeOut();
      return false;
    }
  })

  $("#nombreEsc").keyup(function(){
    if ($(this).val() != "" ) {
      $(".error").fadeOut();
      return false;
    }
  })

});
