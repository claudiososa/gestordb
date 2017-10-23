$(document).ready(function() {
  $('#dias').on('click','.dia', function(){
    //id guardar el cursoFacilitadoresId para buscar en tabla cursoFacilitadores
    let id = $(this).attr('id').substr(6)
    //alert(id)
    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxDeleteHour.php',
      type: 'POST',
      dataType: 'json',
      data: {id: id}
    })
    .done(function(lista) {
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
$("#modal-body").append(`
    </select>
  </div>
  <div class="form-group">
    <label  for="horaTeacherName">Profesor/a</label>
    <select class="form-control" name="horaTeacherName" id="horaTeacherName">
        <option value="0">Seleccione</option>`)
        $.ajax({
          url: 'includes/mod_cen/clases/Profesores.php',
          type: 'POST',
          dataType: 'json',
          data: {buscarProfesores: escuelaId}
        })
        .done(function(lista) {
          for (let item of lista) {
            $('#horaTeacherName').append(`<option value="${item.profesorId}">${item.apellido},${item.nombre}</option>`)
          }
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
  $("#modal-body").append(`
    </select>
    </div>
  <div class="form-group">
    <label  for="asignatura">Asignatura</label>
    <select class="form-control" name="asignatura" id="asignatura">
        <option value="0">Seleccione</option>`)
        let materias ='materias'
        $.ajax({
          url: 'includes/mod_cen/clases/Profesores.php',
          type: 'POST',
          dataType: 'json',
          data: {materias: materias}
        })
        .done(function(lista) {
          for (let item of lista) {
            $('#asignatura').append(`<option value="${item.asignaturaId}">${item.nombre}</option>`)
          }
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

        $("#modal-body").append(`
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

    </div>
  </div>
</div>`)
$($(this).parent()).append(`
<button id="btnHoraSandwich" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2">
Hora Sandwich
</button>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Hora Sandwich</h4>
      </div>
      <div class="modal-body">
      <form class="" action="" method="post">
<div class="form-group">
<label  for="horaDia">Dia</label>
<input type="text" class="form-control" id="horaDiaS" name="horaDiaS" value="${inputDia}" readonly="">
</div>

<div class="form-group">
<label  for="horaInicio">Hora Inicio</label>
<div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
  <input type="text" id="horaInicio2" class="form-control" value="8:00">
  <span class="input-group-addon">
      <span class="glyphicon glyphicon-time"></span>
  </span>
</div>
</div>
<div class="form-group">
<label  for="horaFinal">Hora Final</label>
<div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
<input type="text" id="horaFinal2" class="form-control" value="10:00">
<span class="input-group-addon">
  <span class="glyphicon glyphicon-time"></span>
</span>
</div>
</div>
<button type="button" id="saveHourSandwich" class="btn btn-warning" name="button" >Guardar Hora</button>
</form>
      </div>
    </div>
  </div>
</div>`)
      $('#saveHour').click(function(){
          let horaInicio3 = $("#horaInicio").val()
          let horaFinal3 = $("#horaFinal").val()
          let horInicio = horaInicio3.substr(0,horaInicio3.indexOf(':'))
          let minInicio = horaInicio3.substr(horaInicio3.indexOf(':')+1)
          let horFinal = horaFinal3.substr(0,horaFinal3.indexOf(':'))
          let minFinal = horaFinal3.substr(horaFinal3.indexOf(':')+1)

          var year = '2013';
          var month = '04';
          var day = '18';

          var entrada = new Date(year,month,day,horInicio,minInicio)
          var salida = new Date(year,month,day,horFinal,minFinal)
          console.log(entrada.getTime());
          console.log(salida.getTime());


        //reserv.getTime() - reserv2.getTime()

        let horaCourseName = $("#horaCourseName option:selected").val()
        let horaTeacherName = $("#horaTeacherName option:selected").val()
        let asignatura = $("#asignatura option:selected").val()


        if (horaCourseName =='0' || horaTeacherName =='0' || asignatura =='0' ) {
          alert('Falta seleccionar opcion para guardar este Horario')
        }else if(entrada.getTime() > salida.getTime()){
            alert('Error: la hora de inicio es mayor a la hora de salida')
        }else{
          $("#myModal").modal("hide");

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
              <td>${item.curso}</td><td>${item.turno}</td><td>${item.cantidad}</td><td>${item.profesor}</td>
              <td><a href='#'><img class='dia' id='horaId${item.id}' src='img/iconos/delete.jpg' alt='borrar item'></a></td></tr>`)
            //$(`#${dia}`).append('')
            //console.log(item.dia)
            //$('#horaTeacherName').append(`<option value="${item.personaId}">${item.nombre}</option>`)
          }

          $(`#${dia}`).show(500)
          console.log("successdddddddddddddddd");

        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

        }
      });

      $('#saveHourSandwich').click(function(){

        let horaSandiwch = 'si'
        let horaCourseName = '1'
        let horaTeacherName = '1'
        let asignatura = '1'
        let dia = $("#horaDiaS").val()
        let horaInicio = $("#horaInicio2").val()
        let horaFinal = $("#horaFinal2").val()


        let horInicio = horaInicio.substr(0,horaInicio.indexOf(':'))
        let minInicio = horaInicio.substr(horaInicio.indexOf(':')+1)
        let horFinal = horaFinal.substr(0,horaFinal.indexOf(':'))
        let minFinal = horaFinal.substr(horaFinal.indexOf(':')+1)

        var year = '2013';
        var month = '04';
        var day = '18';

        var entrada = new Date(year,month,day,horInicio,minInicio)
        var salida = new Date(year,month,day,horFinal,minFinal)
        console.log(entrada.getTime());
        console.log(salida.getTime());

        if (entrada.getTime() > salida.getTime()) {
            alert('Error: la hora de inicio es mayor a la hora de salida')
        }else{
            $("#myModal2").modal("hide");



        console.log('presionaste boton guardar Hora  / saveHour')
        $.ajax({
          url: 'includes/mod_cen/clases/ajax/ajaxSaveHour.php',
          type: 'POST',
          dataType: 'json',
          data: {
                 horaSandiwch: horaSandiwch,
                 horaCourseName: horaCourseName,
                 horaTeacherName:horaTeacherName,
                 asignatura:asignatura,
                 referenteId:referenteId,
                 dia:dia,horaInicio:horaInicio,
                 horaFinal:horaFinal,
                 escuelaId:escuelaId,
                 referenteId:referenteId}
        })
        .done(function(lista) {



          for (let item of lista) {
              let dia = item.dia
            }
          //$(`#${dia}`).empty()
          for (let item of lista) {
            //$(`#${dia}`).append(``)
            console.log('id creado')
            //console.log(item.id)
            if (item.id=='1') {//dibuja hora Sandwich
              $(`#${dia}`).append(`<tr class="alert alert-success" id="hora${item.idHora}"><td>${item.dia}</td><td>${item.horaInicio}</td><td>${item.horaFinal}</td><td colspan='5'>Hora Sandwich</td>
                <td><a href='#'><img class='dia' id='horaId${item.idHora}' src='img/iconos/delete.jpg' alt='borrar item'></a></td></tr>`)
            }else{
              $(`#${dia}`).append(`<tr id="hora${item.id}"><td>${item.dia}</td><td>${item.horaInicio}</td><td>${item.horaFinal}</td><td>${item.asignatura}</td>
                <td>${item.curso}</td><td>${item.turno}</td><td>${item.cantidad}</td><td>${item.profesor}</td>
                <td><a href='#'><img class='dia' id='horaId${item.id}' src='img/iconos/delete.jpg' alt='borrar item'></a></td></tr>`)
            }

          }

          $(`#${dia}`).show(500)
          //console.log("successdddddddddddddddd");

        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

          }
      });

    $('#myModal').on('hidden.bs.modal', function (e) {
      $("#myModal").remove()
      $("#myModal2").remove()
      $("#btnHoraCatedra").remove();
      $("#btnHoraSandwich").remove();
      $(".agregarHora").removeAttr('disabled')
    })
    $('#myModal2').on('hidden.bs.modal', function (e) {
      $("#myModal2").remove()
      $("#myModal").remove()
      $("#btnHoraCatedra").remove();
      $("#btnHoraSandwich").remove();
      $(".agregarHora").removeAttr('disabled')
    })

    $('#myModal').on('show.bs.modal', function (e) {
      $('.clockpicker').clockpicker()
      $("#btnHoraCatedra").remove()
      $("#btnHoraSandwich").remove()
      })

    $('#myModal2').on('show.bs.modal', function (e) {
      $('.clockpicker').clockpicker()
      $("#btnHoraCatedra").remove()
      $("#btnHoraSandwich").remove()
      console.log('inicia ventana modal 2')
    })


  })

});
