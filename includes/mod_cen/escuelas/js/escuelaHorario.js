$(document).ready(function() {
  let escuelaIdBorrar = $("#escuelaId").val()


  $('#formNewCourse').hide()
  $('#formNewTeacher').hide()

  $('#newCourse').click(function (){
    $('#formNewCourse').toggle()
  })

  $('#newTeacher').click(function (){
    $('#formNewTeacher').toggle()
  })

  $('#searchTeacher').click(function (){
    let dni = $('#teacherDni').val()
    //alert($('#teacherDni').val())
    $.ajax({
      url: 'includes/mod_cen/clases/Profesores.php',
      type: 'POST',
      dataType: 'json',
      data: {dni: dni}
    })
    .done(function(lista) {
      console.log("success");
      //$('#courses').empty()

      for (let item of lista) {

        if (item.dni=='error') {
          alert('NO EXISTE')
          $("#statusTeacher").val('create');
          
        }else{
          $("#statusTeacher").val('update');
          //alert(item.personaId+item.dni+item.nombre+item.apellido)
          $('#personaId').val(item.personaId)
          $('#nameTeacher').val(item.nombre)
          $('#surnameTeacher').val(item.apellido)
          $('#phoneTeacher').val(item.telefono)
          $('#emailTeacher').val(item.email)
          $('#cuilTeacher').val(item.cuil)

        }
          //$('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img class="curso" id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
      }

        //alert('Borrado correctamente')
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  })

  $('#courses').on('click', '.curso', function(){

    let cursoId =$(this).attr("id").substring(5)
    $.ajax({
      url: 'includes/mod_cen/clases/Cursos.php',
      type: 'POST',
      dataType: 'json',
      data: {cursoId: cursoId,escuelaIdBorrar:escuelaIdBorrar}
    })
    .done(function(lista) {
      console.log("success");
      $('#courses').empty()
      for (let item of lista) {
          console.log(item.cursoId)
          $('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img class="curso" id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
      }
        alert('Borrado correctamente')
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  })

  $('#saveTeacher').click(function (){
      alert('hola saveTeacher')
      let boton = $("#saveTeacher").attr("id")

      let action = $("#statusTeacher").val()
      //alert(action)
      let personaId= $("#personaId").val()
      let cuilTeacher= $("#cuilTeacher").val()
      let dniTeacher = $("#teacherDni").val()
      let nameTeacher = $("#nameTeacher").val()
      let surnameTeacher = $("#surnameTeacher").val()
      let phoneTeacher = $("#phoneTeacher").val()
      let emailTeacher = $("#emailTeacher").val()
      let escuelaId = $("#escuelaId").val()
      //alert(dni+nameTeacher+surnameTeacher+phoneTeacher+emailTeacher)
      $.ajax({
        url: 'includes/mod_cen/clases/Profesores.php',
        type: 'POST',
        dataType: 'json',
        data: { dniTeacher: dniTeacher,
                nameTeacher: nameTeacher,
                surnameTeacher:surnameTeacher,
                phoneTeacher:phoneTeacher,
                emailTeacher:emailTeacher,
                escuelaId:escuelaId,
                botonSaveTeacher:boton,
                statusTeacher:action,
                personaId:personaId,
                cuilTeacher:cuilTeacher
                }
      })
    .done(function(persona) {
      //console.log("okok")
        for (let item of persona) {
          console.log(item.estado)
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


  })


  $('#saveCourse').click(function (){
      let guardado = 'no'
      let courseName = $("#courseName option:selected").val()
      let divisionName = $("#divisionName option:selected ").val()
      let turn = $("#turn option:selected").val()
      let quantityStudents = $("#quantityStudents").val()
      let escuelaId = $("#escuelaId").val()
      $.ajax({
        url: 'includes/mod_cen/clases/Cursos.php',
        type: 'POST',
        dataType: 'json',
        data: {courseName: courseName,divisionName: divisionName, turn:turn, quantityStudents:quantityStudents,escuelaId:escuelaId}

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
              url: 'includes/mod_cen/clases/Cursos.php',
              type: 'POST',
              dataType: 'json',
              data: {escuelaIdAjaxId:escuelaId}
            })
          .done(function(lista) {
              $('#courses').empty()
              for (let item of lista) {
                if (id==item.cursoId) {
                      console.log(item.cursoId)
                  $('#courses').prepend('<p class="alert alert-success">'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img class="curso" id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
                }else{
                  $('#courses').prepend('<p>'+item.curso+' '+item.division+' Turno <b>'+item.turno+'</b><img class="curso" id="curso'+item.cursoId+'" src="img/iconos/delete.png" alt="borrar"></p>')
                }
              }
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
            $('#quantityStudents').val('1')
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

});
