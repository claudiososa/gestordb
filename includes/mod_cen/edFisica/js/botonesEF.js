
$(document).ready(function() {

  $(".bodyprof").hide()
  $(".ocultartr").hide()
  $(".datosInst").hide()
  $('.formNewCourse').hide()

///////// boton ver profesores ed. fisica/////
 $(".botondesplegable").click(function(event) {
  //let numero=$(this).attr("id").substr(16)
    //let subPanel=$(this).find('.subpanelprofesores').attr("id").substr(12)
    //$("#panel" + $(this).attr('id')).find('#subpanelprofesores').hide()
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
        //$("#formNewCourse" + numeroIdCurso).toggle()
  });






//////////panel general/////

  $(document).on('click', ".panelprof", function(){
    $("#myModal2").remove()
    var $this = $(this);
    id_Ed_FisicaxEscuela = $(this).attr('id').substr(0,$(this).attr('id').indexOf('-'))
    escuelaId = $(this).attr('id').substr($(this).attr('id').indexOf('-')+1)

    //alert(escuelaId)

    $(this).parent().children('.bodyprof').children('.asignarCurso').empty()

   var numeroGuardarIdCurso= $(this).attr("id").substr(0,4)
   //alert (numeroGuardarIdCurso)
    $(this).parent().children('.bodyprof').children('.asignarCurso').append(`
      <button id="btnHoraSandwich" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2">
      Asignar Curso
      </button>
      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Curso</h4>
              <form class="" action="" method="post">
                <div class="col-md-6">
                <div class="form-group">
                  <br>
                  <label  for="courseName">Curso</label>
                  <select class="form-control" name="courseName" id="courseName">
                      <option value="0">Seleccione</option>
                      <option value="1°">1°</option>
                      <option value="2°">2°</option>
                      <option value="3°">3°</option>
                      <option value="4°">4°</option>
                      <option value="5°">5°</option>
                      <option value="6°">6°</option>
                      <option value="7°">7°</option>
                  </select>
                </div>

                <div class="form-group">
                  <label  for="divisionName">Division</label>
                  <select class="form-control" name="divisionName" id="divisionName">
                      <option value="0">Seleccione</option>

                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                      <option value="1ra">1ra</option>
                      <option value="2da">2da</option>
                      <option value="3ra">3ra</option>
                      <option value="4ta">4ta</option>
                      <option value="5ta">5ta</option>
                      <option value="6ta">6ta</option>
                      <option value="7ma">7ma</option>
                      <option value="8va">8va</option>
                      <option value="9na">9na</option>
                      <option value="10ma">10ma</option>
                      <option value="11va">11va</option>
                      <option value="Otro">Otro</option>
                  </select>
                </div>

                <div class="form-group">
                  <label  for="turn">Turno</label>
                  <select class="form-control" name="turn" id="turn">
                    <option value="0">Seleccione</option>
                    <option value="Mañana">Mañana</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Noche">Noche</option>
                    <option value="Alternancia">Alternacia </option>
                    <option value="Completo">Completo</option>
                  </select>
                </div>

                <div class="form-group">
                  <label  for="nivel">Nivel</label>
                  <select class="form-control" name="nivel" id="nivel">
                    <option value="0">Seleccione</option>
                    <option value="C. Basico">Ciclo Básico</option>
                    <option value="C. Basico Comun">Ciclo Básico Común</option>
                    <option value="C. Basico Tecnico">Ciclo Básico Técnico</option>
                    <option value="C. Orientado">Ciclo Orientado</option>
                    <option value="C. Superior">Ciclo Superior</option>
                    <option value="EGB">EGB</option>
                    <option value="Inicial">Inicial</option>
                    <option value="Polimodal">Polimodal</option>
                    <option value="Secundario">Secundario</option>
                    <option value="Superior">Superior</option>
                  </select>
                </div>

                <div class="form-group">
                  <label  for="cantidadHoras">Cantidad Horas Semanal</label>
                  <br>
                  <input type="number" name="cantidadHoras" min="1" max="20" value="1" id="cantidadHoras">
                </div>

<input type="hidden" id="prueba" name="prueba" value="25">
                  <div class="form-group">
                    <label  for="tipoCargo">Tipo de Cargo</label>
                    <select class="form-control" name="tipoCargo" id="tipoCargo">
                      <option value="0">Seleccione</option>
                      <option value="Titular">Titular</option>
                      <option value="Interino">Interino</option>
                      <option value="Suplente">Suplente</option>
                      <option value="Otro">Otro</option>
                    </select>
                  </div>

                <button type='button' class='btn btn-warning saveCourse' name='button' data-dismiss="modal">Guardar Curso</button>
                 </div>
              </form>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>
      `)

      $('#myModal2').on('hidden.bs.modal', function (e) {
        $("#myModal2").remove()
        //$("#btnHoraSandwich").remove();
      })
      /////////// guardar curso /////////////

      $(".saveCourse").click(function(event){


              //$("#saveCourse" + numeroGuardarIdCurso).click(function (){

              let guardado = 'no'
              let courseName = $("#courseName option:selected").val()
              let divisionName = $("#divisionName option:selected ").val()
              let turn = $("#turn option:selected").val()
              let cantidadHoras = $("#cantidadHoras").val()
              let prueba = $("#prueba").val()
              //let escuelaId = $("#escuelaId").val()
              //let id_Ed_FisicaxEscuela = $('#id_Ed_FisicaxEscuela').val()
              let nivel = $("#nivel option:selected").val()
              let tipoCargo = $("#tipoCargo option:selected").val()
              $.ajax({
                url: 'includes/mod_cen/clases/ajax/profeEdFisica.php',
                type: 'POST',
                dataType: 'json',
                data: {courseName:courseName, divisionName:divisionName,
                       turn:turn, cantidadHoras:cantidadHoras,
                       nivel:nivel, tipoCargo:tipoCargo, id_Ed_FisicaxEscuela:id_Ed_FisicaxEscuela, escuelaId:escuelaId
                      }
              })
            .done(function(data) {
                console.log('success')
                for (let item of data) {
         // console.log(item.profesorId)
          //cantidad++

               $('#tablaCursos'+numeroGuardarIdCurso).append('<tbody><tr class="alert alert-success"><td>'+item.curso+' '+item.seccion+'</td><td> '+item.turno+'</td><td>'+item.nivel+' </td><td>'+item.horas+'</td><td>'+item.tipoCargo+'</td></tr></tbody>')
                 }
                // alert(numeroGuardarIdCurso)
              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });


          //})
      })


      //// aqui ///



    //alert($(this).parent().attr('id'))
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
