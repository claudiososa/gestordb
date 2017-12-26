$(document).ready(function() {


  $('#btn_ir').click(function(){

    let escuelaId = $('#escuelaId option:selected').val()
    let modulo = $('#modulo option:selected').val()

    switch (modulo) {
      case 'director':
        alert('director')
        break;
      default:
      let url = 'index.php?mod=slat&men='+modulo+'&escuelaId='+escuelaId
      $(location).attr('href',url);
    }

  });

  $('#escuelaId').change(function() {
    let escuelaId = $('#escuelaId option:selected').val()
    if (escuelaId != '0')
    {
      $.ajax({
        url: 'includes/mod_cen/clases/escuela.php',
        type: 'POST',
        dataType: 'html',
        data: {escuelaId: escuelaId}
      })
      .done(function(data) {
        console.log("success");
        console.log(data);
        $("#modulo option[value='referentes&id=11']").remove();
        $("#modulo option[value='referentes&id=8']").remove();
        $('#modulo').append(data)

        //$('#addFacil').remove('id')

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }
    //alert('hola mundo')
  });


/*  $('#saveTeacher').click(function (){

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
        let cantidad = 0
        alert('Dato Guardado Teacher')
        $('#teachers').empty()
        clearPersonaAndDni()
        for (let item of persona) {
          cantidad++
          $('#teachers').prepend('<p>'+item.nombre+' '+item.apellido+'</b><img class="profesor" id="profesor'+item.profesorId+'" src="img/iconos/delete.png" alt="borrar"></p>')
          console.log(item.nombre)
        }
        $('#teachers').prepend(`Total de Profesores: ${cantidad}`)
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });


  })


*/
});
