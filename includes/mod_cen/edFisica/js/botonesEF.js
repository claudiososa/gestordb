
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

/////////// guardar curso /////////////

$(".saveCourse").click(function(event){
   let numeroGuardarIdCurso= $(this).attr("id").substr(10)
        $("#saveCourse" + numeroGuardarIdCurso).click(function (){
        let guardado = 'no'
        let courseName = $("#courseName option:selected").val()
        let divisionName = $("#divisionName option:selected ").val()
        let turn = $("#turn option:selected").val()
        let cantidadHoras = $("#cantidadHoras").val()
        let escuelaId = $("#escuelaId").val()
        let nivel = $("#nivel option:selected").val()
        let tipoCargo = $("tipoCargo option:selected").val()
        $.ajax({
          url: 'includes/mod_cen/clases/ajax/profeEdFisica.php',
          type: 'POST',
          dataType: 'json',
          data: {courseName: courseName,divisionName: divisionName, turn:turn, cantidadHoras:cantidadHoras,escuelaId:escuelaId,nivel:nivel,tipoCargo:tipoCargo}

        })
      .done(function(data) {
          //console.log(data)
          for (let item of data) {

            if (item.guardado="ok") {
              let guardado = 'si'
              let id = item.id
              //console.log(item.guardado)
              //console.log(item.id)
                //let escuelaId = $("#escuelaId").val()
              $.ajax({
                url: 'includes/mod_cen/clases/ajax/profeEdFisica.php',
                type: 'POST',
                dataType: 'json',
                data: {escuelaIdAjaxId:escuelaId}
              })
            .done(function(lista) {
                let cantidad = 0
                $('#courses').empty()

                for (let item of lista) {
                  cantidad++
                  if (id==item.cursoId) {

                        console.log(item.cursoId)
                        $('#courses').prepend('<p class="alert alert-success">'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img class="curso" id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
                  }else{
                    $('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img class="curso" id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
                  }
                }
                $('#courses').prepend(`Total de Cursos: ${cantidad}`)
              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });

              $('#formNewCourse').toggle()
              $('#courseName > option[value="0"]').prop('selected','true')
              $('#divisionName > option[value="0"]').prop('selected','true')
              $('#turn > option[value="0"]').prop('selected','true')
              $('#cantidadHoras').val('1')
              alert('Se creo correctamente')
            }else{
              alert('algo no esta bien')
            }
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });


    }) 
})

//// aqui ///


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
