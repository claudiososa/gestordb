

  function formPersona(informeActual)
  {
    let escuelaId =  $('#escuelaId').val()

      console.log("script cargado");
      bkLib.onDomLoaded(function() {
              new nicEditor({iconsPath : 'js/nicEditorIcons.gif'}).panelInstance('contenido');

      });
      

      //bkLib.onDomLoaded(function() {
//        new nicEditor({iconsPath : 'js/nicEditorIcons.gif'}).panelInstance('contenido');
  //      });
      $('#padreIr').append(`
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">${informeActual.escuelaNombre}<br>
                Numero: ${informeActual.escuelaNumero} Cue: ${informeActual.escuelaCue} <br>Departamento: Oran
                <br>Fecha: ${informeActual.fecha}<br>Prioridad: ${informeActual.prioridad}
                <br>Categoria: ${informeActual.categoria}<br>Subcategoria:${informeActual.subcategoria}
                <br>
                <br>Titulo: ${informeActual.titulo}
                </h4>

              </div>
              <div class="modal-body" id="modal-body" >
              <form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
                  <div class="form-group">
                    <div class="col-md-12">
                      <label class="control-label">Contenido</label>
                    </div>
                    <div class="col-md-12">
                      <textarea  readonly  rows='20' name="contenido" id="contenido" class="form-control" >${informeActual.contenido}
                      </textarea>
                    </div>
                  </div>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSave">Responder</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        `)
      $('#myModal').modal('show')
      //$("#operar").attr("disabled",false);
      $('#myModal').on('hide.bs.modal', function(){
        $('#myModal').remove()
      })

      $('#myModal').on('shown.bs.modal', function(){
        $('#txtdni').focus()
      })

      $('#btnSave').click(function(){
        console.log('boton guardar')
      })




  }
