$(document).ready(function() {

//$('#teachers').on('click', '.profesor', function(){

/*$('input.timepicker').timepicker({
  timeFormat: 'h:mm p',
  interval: 10,
  minTime: '7',
  maxTime: '11:50pm',
  defaultTime: '8',
  startTime: '08:00',
  dynamic: false,
  dropdown: true,
  scrollbar: true
})
*/

  $('.agregarHora').click(function(){
    //$($(this).parent().siblings('form')).append('aaaa')
    $('.agregarHora').attr('disabled',true)
    $($(this).parent()).append(`
      <button id="btnHoraCatedra" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
      Hora Catedra
      </button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nueva Hora Catedra</h4>
      </div>
      <div class="modal-body" id="modal-body">

      <form class="" action="" method="post">

        <div class="form-group">
          <label  for="horaDia">Dia</label>
          <input type="text" name="horaDia" value="" readonly="">
        </div>

        <div class="form-group">
          <label  for="HoracourseName">Curso</label>
          <select class="form-control" name="HoracourseName" id="HoracourseName">
            <option value="0">Seleccione</option>
              `)
              let escuelaId = $("#escuelaId").val()
              $.ajax({
                url: 'includes/mod_cen/clases/Cursos.php',
                type: 'POST',
                dataType: 'json',
                data: {buscarCursos: escuelaId}
              })
              .done(function(lista) {
                for (let item of lista) {
                  $('#HoracourseName').append(`<option value="${item.cursoId}">${item.curso} ${item.division} ${item.turno}</option>`)
                }
                console.log("success");
              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });


    //$($(this).parent()).append(`
    $("#modal-body").append(`
          </select>
        </div>

        <div class="form-group">
          <label  for="horaTeacherName">Profesor/a</label>
          <select class="form-control" name="horaTeacherName" id="horaTeacherName">
              <option value="0">Seleccione</option>`)


              //let escuelaId = $("#escuelaId").val()
              $.ajax({
                url: 'includes/mod_cen/clases/Profesores.php',
                type: 'POST',
                dataType: 'json',
                data: {buscarProfesores: escuelaId}
              })
              .done(function(lista) {
                for (let item of lista) {
                  $('#horaTeacherName').append(`<option value="${item.personaId}">${item.nombre}</option>`)
                }
                console.log("success");
              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });


        //$($(this).parent()).append(`
        $("#modal-body").append(`
          </select>
          </div>
        <div class="form-group">
          <label  for="asignatura">Asignatura</label>
          <select class="form-control" name="asignatura" id="asignatura">
              <option value="0">Seleccione</option>
              <option value="1">Matematica</option>
              <option value="2">Lengua</option>

          </select>
        </div>

        <div class="input-group clockpicker">
          <input type="text" class="form-control" value="09:30">
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>

        <div class="form-group">
          <label  for="horaFinal">Hora Final</label><br>
          <input type="text" name="" id="horaFinal" class="timepicker" value="">
        </div>

       <button type="button" id="saveHour" class="btn btn-warning" name="button">Guardar Hora</button>
      </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
      `)


      $('.clockpicker').clockpicker()
      	.find('input').change(function(){
      		console.log(this.value);
      	});
      var input = $('#single-input').clockpicker({
      	placement: 'bottom',
      	align: 'left',
      	autoclose: true,
      	'default': 'now'
      });

      $('.clockpicker-with-callbacks').clockpicker({
      		donetext: 'Done',
      		init: function() {
      			console.log("colorpicker initiated");
      		},
      		beforeShow: function() {
      			console.log("before show");
      		},
      		afterShow: function() {
      			console.log("after show");
      		},
      		beforeHide: function() {
      			console.log("before hide");
      		},
      		afterHide: function() {
      			console.log("after hide");
      		},
      		beforeHourSelect: function() {
      			console.log("before hour selected");
      		},
      		afterHourSelect: function() {
      			console.log("after hour selected");
      		},
      		beforeDone: function() {
      			console.log("before done");
      		},
      		afterDone: function() {
      			console.log("after done");
      		}
      	})
      	.find('input').change(function(){
      		console.log(this.value);
      	});

      // Manually toggle to the minutes view
      $('#check-minutes').click(function(e){
      	// Have to stop propagation here
      	e.stopPropagation();
      	input.clockpicker('show')
      			.clockpicker('toggleView', 'minutes');
      });
      if (/mobile/i.test(navigator.userAgent)) {
      	$('input').prop('readOnly', true);
      }
      
    //$($(this).parent().('form')).html('<input type="text" name="" value="holaa">')
//    $('.timepicker').timepicker()
    //$('#horaFinal').timepicker()
    //$($(this).parent().siblings('form')).append('aaa')
    $('#myModal').on('hidden.bs.modal', function (e) {
      $("#btnHoraCatedra").remove()
      $("#myModal").remove()
      $(".agregarHora").removeAttr('disabled')
    })

    $('#horaInicio').timepicker({
      timeFormat: 'h:mm p',
      interval: 10,
      minTime: '7',
      maxTime: '11:50pm',
      defaultTime: '7',
      startTime: '07:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
    });
/*
    $('#horaFinal').timepicker({
    timeFormat: 'h:mm p',
    interval: 10,
    minTime: '7',
    maxTime: '11:50pm',
    defaultTime: '8',
    startTime: '08:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
    });
*/
  })



});
