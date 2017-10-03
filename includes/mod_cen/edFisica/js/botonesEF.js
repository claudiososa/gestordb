
$(document).ready(function() {

  $(".bodyprof").hide()
  $(".ocultartr").hide()
  //ocultar datos Institucion
  $(".datosInst").hide()
    //nuevo curso

  $('#formNewCourseProf').hide()

///////// boton ver profesores ed. fisica
 $(".botondesplegable").click(function(event) {
   //alert($(this).attr("id"))

   $("#panel" + $(this).attr('id')).toggle()

	});

 /////// datos institucion:
 $(".btnDatosInst").click(function(event) {
  // alert($(this).attr("id"))
    $(".datosInst#datosInst" + $(this).attr('id')).toggle()
	});


//nuevo curso


$('#newCourseProf').click(function (){
  $('#formNewCourseProf').toggle()
})


  $(document).on('click', ".panelprof", function(){
    var $this = $(this);
    if(!$this.hasClass('.panel-collapsed')) {
      	$this.closest('.panel').find('.panel-body').slideDown();
        $this.addClass('.panel-collapsed');
    		$this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
    	} else {
    		$this.closest('.panel').find('.panel-body').slideUp();

        $this.removeClass('.panel-collapsed');
    		$this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');
    	}
  })



});
