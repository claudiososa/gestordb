$(document).ready(function() {

  //$('#teachers').on('click', '.profesor', function(){
//boton elmininar Hora  (X)


  $('#dias').on('click','.dia', function(){
    //id guardar el cursoFacilitadoresId para buscar en tabla cursoFacilitadores
    let id = $(this).attr('id').substr(6)


    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxDeleteHour.php',
      type: 'POST',
      dataType: 'json',
      data: {id: id}
    })
    .done(function(lista) {
    //  for (let item of lista) {
      //  $('#horaCourseName').append(`<option value="${item.cursoId}">${item.curso} ${item.division} ${item.turno}</option>`)
    //  }
      $(`#hora${id}`).remove()
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  })

  $('.agregarHora').click(function(){
    let inputDia = $(this).parent().attr('id').substr(10);
    console.log(inputDia)




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
        <h4 class="modal-title" id="myModalLabel"><img width="25" height="25" src="img/iconos/nuevaHora.png"> Nueva Hora Catedra</h4>
      </div>
      <div class="modal-body" id="modal-body">

      <form class="" action="" method="post">

        <div class="form-group">
          <label  for="horaDia">Dia</label>
          <input type="text" class="form-control" id="horaDia" name="horaDia" value="${inputDia}" readonly="">
        </div>

        <div class="form-group">
          <label  for="horaCourseName">Curso</label>
          <select class="form-control" name="horaCourseName" id="horaCourseName">
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
                  $('#horaCourseName').append(`<option value="${item.cursoId}">${item.curso} ${item.division} ${item.turno}</option>`)
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
                  $('#horaTeacherName').append(`<option value="${item.personaId}">${item.apellido},${item.nombre}</option>`)
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

        <div class="form-group">
        <label  for="horaInicio">Hora Inicio</label>
          <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
            <input type="text" id="horaInicio" class="form-control" value="8:00">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
          </div>
      </div>
      <div class="form-group">
        <label  for="horaFinal">Hora Final</label>
        <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
        <input type="text" id="horaFinal" class="form-control" value="10:00">
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
          </span>
        </div>
      </div>
       <button type="button" id="saveHour" class="btn btn-warning" name="button" >Guardar Hora</button>
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
      $('#saveHour').click(function(){
        let horaCourseName = $("#horaCourseName option:selected").val()
        let horaTeacherName = $("#horaTeacherName option:selected").val()
        let asignatura = $("#asignatura option:selected").val()
        let dia = $("#horaDia").val()
        let horaInicio = $("#horaInicio").val()
        let horaFinal = $("#horaFinal").val()

        console.log('presionaste boton guardar Hora  / saveHour')
        $.ajax({
          url: 'includes/mod_cen/clases/ajax/ajaxSaveHour.php',
          type: 'POST',
          dataType: 'json',
          data: {horaCourseName: horaCourseName,
                 horaTeacherName:horaTeacherName,
                 asignatura:asignatura,
                 referenteId:referenteId,
                 dia:dia,horaInicio:horaInicio,
                 horaFinal:horaFinal,
                 escuelaId:escuelaId,
                 referenteId:referenteId}
        })
        .done(function(lista) {

          //$('#LUNES').hide(500)

          for (let item of lista) {
              let dia = item.dia
            }
          //$(`#${dia}`).empty()
          for (let item of lista) {
            //$(`#${dia}`).append(``)
            $(`#${dia}`).append(`<tr id="hora${item.id}"><td>${item.dia}</td><td>${item.horaInicio}</td><td>${item.horaFinal}</td><td>${item.asignatura}</td>
              <td>${item.curso}</td><td>${item.turno}</td><td>${item.profesor}</td>
              <td><a href='#'><img class='dia' id='horaId${item.id}' src='img/iconos/delete.jpg' alt='borrar item'></a></td></tr>`)
            //$(`#${dia}`).append('')
            //console.log(item.dia)
            //$('#horaTeacherName').append(`<option value="${item.personaId}">${item.nombre}</option>`)
          }

          $(`#${dia}`).show(500)
          console.log("successdddddddddddddddd");
          $("#myModal").modal("hide");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
      });

    $('#myModal').on('hidden.bs.modal', function (e) {

      $("#myModal").remove()
      $(".agregarHora").removeAttr('disabled')
    })

    $('#myModal').on('show.bs.modal', function (e) {
      $('.clockpicker').clockpicker()
      $("#btnHoraCatedra").remove()

    })

  })

});
