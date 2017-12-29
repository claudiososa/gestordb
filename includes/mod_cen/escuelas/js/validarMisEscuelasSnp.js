$(document).ready(function() {

  $('#btn_ir').click(function(){
    $("#myModal").remove()
    let escuelaId = $('#escuelaId option:selected').val()
    let modulo = $('#modulo option:selected').val()

    switch (modulo) {
      case 'director':
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

                  <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                  <input name="txtidesacuela" type="hidden" id="txtidesacuela" value=""/>
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
                <input class="form-control" type="text" name="txtcuit" id="txtcuit" class="hades" />
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
                <input class="form-control" type="text" name="txttelefono1" id="txttelefono1" class="hades" />
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <label for="" class="control-label">Email </label>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="txtemail1" id="txtemail1" class="hades" />
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    `)
  $('#myModal').modal('show')
  $('#btnBuscarDni').click(function() {
    let dni = $('#inputDni').val()
    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
      type: 'POST',
      dataType: 'json',
      data: {dni: dni}
    })
    .done(function() {
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
