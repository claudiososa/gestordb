

  //$('#informeId7062').click(function(){
//    alert('hola')
//  });

  //$('[id ^=informeId]').on('click', function(){
//.    alert('hola')
  //  formPersona()
  //})
  //formPersona()

  function formPersona(escuelaNombre)
  {
    let escuelaId =  $('#escuelaId').val()
    console.log(escuelaId)
    $('#padreIr').append(`
      <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">${escuelaNombre}<br>
              Numero: ${escuelaNumero} Cue: 660034321 <br>Departamento: Oran
              <br>Fecha: 14-2-2018<br>Prioridad: Alta
              <br>Categoria: Cate<br>Subcategoria:subte
              <br>
              <br>Titulo: Mi titulo
              <br>Contenido</h4>

            </div>
            <div class="modal-body" id="modal-body" >
            <form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
             		<div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label"><br>Escuela</label>
                  </div>
                  <div class="col-md-12">
                       <input type='text' name="escuelaId"  class="form-control" value="" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label">Nombre de Escuela</label>
                  </div>
                  <div class="col-md-12">
                    <input type='text' name="nombre_escuela"  class="form-control" value="" disabled>
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
