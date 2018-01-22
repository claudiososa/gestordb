$(document).ready(function() {
  //evento clic para cualquier id que empiece con autoridad
  $('[id ^=autoridad]').click(function(){
    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
      type: 'POST',
      dataType: 'json',
      data: {all:all,escuelaId: escuelaId}
    })
    .done(function(lista) {
      for (let item of lista) {

        
        if (item.id=='0') {
          console.log('no encontrado')
          $('#statusDni').val('0')
          $('#txtidpersona').val('')
          $('#txtnombre').val('')
          $('#txtapellido').val('')
          $('#txtcuil').val('')
          $('#txttelefonoM').val('')
          $('#txtemail').val('')
          $('#localidad').val('0')
        }else{
          $('#statusDni').val('1')
          console.log('encontrado')
          $('#txtdni').val(item.dni)
          $('#txtidpersona').val(item.id)
          $('#txtnombre').val(item.nombre)
          $('#txtapellido').val(item.apellido)
          $('#txtcuil').val(item.cuil)
          $('#txttelefonoM').val(item.telefono)
          $('#txtemail').val(item.email)
          let selected = $('#localidad option:selected').val();
          $("#localidad option[value="+ selected +"]").attr("selected",false);
          console.log(selected)
          $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
          //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
        }
      }
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

    alert('fila')
  })
});
