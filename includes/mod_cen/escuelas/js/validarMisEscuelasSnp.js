$(document).ready(function() {
//  let update = '0' //determina si se desea guardar nuevo registro o actualizar (valor 0 corresponde a nuevo)
  $('#btn_ir').click(function(){
    $("#myModal").remove()
    let escuelaId = $('#escuelaId option:selected').val()
    let modulo = $('#modulo option:selected').val()

    switch (modulo) {
      case 'director':
        $('#tipoId').val('3')
        formPersona()
        break;
      case 'snp':
          $('#tipoId').val('4')
          formPersona()
          break;
      case 'srp':
          $('#tipoId').val('12')
              formPersona()
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




function formPersona()
{
  let escuelaId =  $('#escuelaId').val()
  console.log(escuelaId)
  $('#padreIr').append(`
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Datos de Director</h4>
          </div>
          <div class="modal-body" id="modal-body" >
          <form action="" method="post" id="form1">
            <div class="form-group">
              <div class="col-md-12">
                <div class="col-md-6"><label for="" class="control-label">Nro. de Documento</label>
                <input  class="form-control" name="txtdni" type="text" id="txtdni" autofocus="autofocus" />
                </div>
                <div class="col-md-6">
                  <p class="btn btn-danger" id="btnBuscarDni"> Buscar</p>
                </div>

              </div>
              <div class="col-md-12">
                  <input name="txtidpersona" type="hidden" id="statusDni" value="0" />
                  <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                  <input name="txtidesacuela" type="hidden" id="txtescuelaid" value="${escuelaId}"/>
                  <input type="hidden" name="iddirector" id="iddirector" value="" />

              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">Apellido</label>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="txtapellido" id="txtapellido" class="hades" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">Nombre</label>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="txtnombre" id="txtnombre" class="hades" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">CUIL</label>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="txtcuil" id="txtcuil" class="hades" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">Localidad</label>
              </div>
              <div class="col-md-12">
                <select class="form-control" name="localidad" id="localidad">
                <option value="0">Seleccione...</option>

                `)
                $.ajax({
                  url: 'includes/mod_cen/clases/ajax/ajaxLocalidad.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {local: 'local'}
                })
                .done(function(lista) {
                  for (let item of lista) {
                    $('#localidad').append(`<option value="${item.id}">${item.nombre}</option>`)
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
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">Teléfono </label>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="txttelefonoM" id="txttelefonoM" class="hades" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">Email </label>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="txtemail" id="txtemail" class="hades" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label"></label>
              </div>

            </div>




          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    `)
  $('#myModal').modal('show')

  $('#myModal').on('hide.bs.modal', function(){
    $('#myModal').remove()
  })

  $('#myModal').on('shown.bs.modal', function(){
    $('#txtdni').focus()


    let escuelaId = $('#txtescuelaid').val()
    let tipoId = $('#tipoId').val()
    let search ='search'
    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
      type: 'POST',
      dataType: 'json',
      data: {search:search,escuelaId: escuelaId,tipoId:tipoId}
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
  })

  $('#btnSave').click(function(){
    console.log('boton guardar')

    let id = $('#txtidpersona').val()
    let nombre = $('#txtnombre').val()
    let apellido = $('#txtapellido').val()
    let cuil = $('#txtcuil').val()
    let telefonoM = $('#txttelefonoM').val()
    let email = $('#txtemail').val()
    let localidad = $('#localidad').val()
    let txtdni = $('#txtdni').val()
    let escuelaId = $('#txtescuelaid').val()
    let tipoId = $('#tipoId').val()
    //let tipoId = $('#modulo').val()
    console.log('txtdni' + txtdni)
    let update = $('#statusDni').val()

    console.log('Estado de update '+update)


    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
      type: 'POST',
      dataType: 'json',
      data: {
            btnSave:'btnSave',
            escuelaId:escuelaId,
            tipoId:tipoId,
            update: update,
            personaId:id,
            nombre:nombre,
            apellido:apellido,
            txtdni:txtdni,
            cuil:cuil,
            telefonoM:telefonoM,
            email:email,
            localidad:localidad}
    })
    .done(function(lista) {

      for (let item of lista) {
        if (item.status=='new') {
          console.log('se creo con exito')
        }else{
          console.log('se actualizo con exito')
        }
          //$('#myModal').remove()
          $('#myModal').modal('hide')

      }
      console.log("success");
    })
    .fail(function() {
      console.log("error Guardar");
    })
    .always(function() {
      console.log("complete");
    });


    //$('#myModal').remove()
    //$('#myModal').hide()

  })





  $('#btnBuscarDni').click(function() {
    let dni = $('#txtdni').val()

    //$('#localidad option:selected').remove();

    //$json = json_encode($arrayPrincipal);
    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
      type: 'POST',
      dataType: 'json',
      data: {dni: dni}
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

    console.log('hola dni')
  });
}
});
