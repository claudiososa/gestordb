
$(document).ready(function() {

  $(".bodyprof").hide()
  $(".ocultartr").hide()
  $(".datosInst").hide()
  $('.formNewCourse').hide()

///////// boton ver profesores ed. fisica/////
 $(".botondesplegable").click(function(event) {
  //let numero=$(this).attr("id").substr(16)

    $("#panel" + $(this).attr('id')).toggle()

	});

 /////// panel datos institucion:////

  $(".btnDatosInst").click(function(event) {
       let numIdDatosInst=$(this).attr("id").substr(12)
       $("#datosInst" + numIdDatosInst).toggle()
  });

/////formulario Nuevo curso: Seleccionado por id= personaId////

  $(".btnNuevoCurso").click(function(event) {
        let numeroIdCurso= $(this).attr("id").substr(13)
        $("#formNewCourse" + numeroIdCurso).toggle()
  });



//////////panel general/////

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
