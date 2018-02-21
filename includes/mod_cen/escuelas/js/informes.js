

  function formPersona(informeActual)
  {
    let escuelaId =  $('#escuelaId').val()

      console.log("script cargado");



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
                    <div id="divContenido" class="col-md-12">
                      <textarea  rows='20' name="contenido" id="contenido" class="form-control" >${informeActual.contenido}
                      </textarea>
                    </div>
                    <div id="divRespuesta" class="col-md-12">
                      <textarea  rows='20' name="respuesta" id="respuesta" class="form-control" >
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
        $('#divRespuesta').hide()

        CKEDITOR.replace( 'contenido', {
        toolbar: [

        ]
      });

      CKEDITOR.replace( 'respuesta', {
      toolbar: [
          { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
          { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', 'Subscript', 'Superscript', '-' ] },
          { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
          { name: 'links', items: [ 'Link', 'Unlink' ] },
          '/',
          { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
          { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
          { name: 'others', items: [ '-' ] }
      ]
    });
        //CKEDITOR.replace('contenido');

        $.fn.modal.Constructor.prototype.enforceFocus = function () {
            modal_this = this
            $(document).on('focusin.modal', function (e) {
                if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
                // add whatever conditions you need here:
                &&
                !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                    modal_this.$element.focus()
                }
            })
          };
      })

      $('#btnSave').click(function(){
        let valorBoton = $(this).text()
        let informeId = informeActual.informeId
        console.log("Valor de Informe Id" +informeId)
        if (valorBoton=="Responder") {
          console.log('boton responder')
          $('#divContenido').hide()
          $('#btnSave').html('Enviar')
          $('#divRespuesta').show()
        }else{
          $.ajax({
            url: 'includes/mod_cen/clases/ajax/ajaxRespuesta.php',
            type: 'POST',
            dataType: 'json',
            data: {informeId:informeId,referenteId:referenteId2}
          })
          .done(function() {

            console.log("Se guardo con exito... success");
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });

          console.log('guardando respuesta...')
        }

      })




  }
