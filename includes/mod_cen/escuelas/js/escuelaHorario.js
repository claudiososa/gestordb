$(document).ready(function() {
  $('#formNewCourse').hide()
  $('#newCourse').click(function (){
    $('#formNewCourse').toggle()
  })



  $('#saveCourse').click(function (){
      let guardado = 'no'
    //alert('guardando curse')
      //tipoReferente almacena la opcion seleccionada (value) Por ejemplo
      //ETT, ETJ, et
      /*
      courseName
      divisionName
      turn
      quantityStudents
      */
      let courseName = $("#courseName option:selected").val()
      let divisionName = $("#divisionName option:selected ").val()
      let turn = $("#turn option:selected").val()
      let quantityStudents = $("#quantityStudents").val()
      let escuelaId = $("#escuelaId").val()

      //alert(courseName+courseName.length+" "+divisionName+divisionName.length+" "+turn+turn.length+" "+quantityStudents+quantityStudents.length+" "+escuelaId+escuelaId.length)

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

            console.log(item.guardado)
              //let escuelaId = $("#escuelaId").val()
            $.ajax({
              url: 'includes/mod_cen/clases/Cursos.php',
              type: 'POST',
              dataType: 'json',
              data: {escuelaIdAjaxId:escuelaId}
            })
          .done(function(data) {
              console.log(data)
              //for (let item of data) {
                //console.log(item.curso)
              //}
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
