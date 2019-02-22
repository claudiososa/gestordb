function informeNuevo(escuela)
{

  let escuelaId = escuela.escuelaId
  console.log('mi escuela:'+escuelaId)
    $(`
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
          <!--**** Inicio de Header **** -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

              <h5 class="modal-title" id="myModalLabel"><b>${escuela.nombre}</b>
              <br>
              </h5>

              <div class="row">
                <div class="col-md-6">
              Numero: ${escuela.numero}</div>
                <div class="col-md-6">Cue: ${escuela.cue}</div>
              </div>

            </div><!--./modal-header-->


            <!-- ***** MODAL BODY ****-->

            <div class="modal-body" id="modal-body" >
              <form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
              <div class="form-group  cprioridad">
                 <div class="col-md-12">
                   <label class="control-label cvalidacion">Prioridad</label>
                 </div>
                   <div class="col-md-12">
                     <select  class="form-control" id="prioridad" name="prioridad">
                          <option value='normal'>Normal</option>
                          <option value='media'>Media</option>
                          <option value='alta'>Alta</option>
                     </select>
                     <span class=" hide errorp">Seleccione prioridad</span>
                  </div>

               </div>

               <div class="form-group ccategoria">
                  <div class="col-md-12">
                    <label class="control-label ctvalidacion">Categoría</label>
                  </div>
                  <div class="col-md-12">
                  <select  class="form-control" id="tipo" name="nuevotipo">
                        <option value='0'>Seleccione</option>
                </select>
                <span class=" hide errorc">Seleccione una categoria</span>
                  </div>
              </div>

              <div class="form-group csubcategoria">
                 <div class="col-md-12">
                   <label class="control-label svalidacion">Sub Categoría</label>
                 </div>

                 <div class="col-md-12" id="divsubtipo">
                 <select  class="form-control" id="subTipo" name="subTipo">
                    <option value='0'>Seleccione</option>
                 </select>
                 <span class=" hide errors">Seleccione una subcategoria</span>
                 </div>
             </div>
             <div class="form-group cfecha">
                <div class="col-md-12">
                  <label class="control-label fvalidacion">Fecha</label>
                </div>
                <div class="col-md-12">
                    <input
                        id="input_01"
                        class="datepicker"
                        name="date"
                        type="text"
                        autofocuss
                        value=""
                        data-valuee="">
                 </div>
                 <span class=" hide errorf">Seleccione una fecha</span>
               </div>
             <div class="form-group ctxttitulo">
                <div class="col-md-12">
                  <label class="control-label validacion">Título</label>
                </div>
                <div class="col-md-12">
                   <input required type='text' id='titulo' name="titulo" class="form-control" placeholder="Titulo corto para tu informe" value="">
                   <span class="hide error">Titulo obligatorio </span>
                 </div>
               </div>
               <div class="form-group">
                    <div id="divContenido" class="col-md-12">
                      <textarea  rows='20' name="contenido" id="contenido" class="form-control" >
                      </textarea>
                    </div>
                    <div id="divRespuesta" class="col-md-12">
                      <div class="col-md-12">
                        <label class="control-label">Adjuntar archivos (máximo 5 archivos, peso máximo por archivo 1024 kb)</label>
                      </div>
                      <div class="col-md-12">
                        <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
                      </div>
                    </div>
                  </div>
              </form>
            </div>
            <div id="cargando">

            <img class="img img-responsive cargando" style="display:none;margin:auto;" src="img/iconos/informes/ajax-loader.gif"><br>
            <b><p class="cargando"align="center"style="display:none;color:#068587;">GUARDANDO INFORME, POR FAVOR ESPERE...</p></b>
            </div>
            <!-- **** FIN MODAL BODY ****-->
            <!-- **** INICIO MODAL FOOTER ****-->

            <div class="modal-footer" id="modal-footer">

              <div id="divButton">
                <button type="button" class="btn btn-default footerButton" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary footerButton" id="btnSave">Guardar</button>
              </div>
              <div id="respuestasContenido"></div>
            </div>
            <!-- **** FIN MODAL FOOTER ****-->

            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="container"></div>
            `).appendTo('#padreIr')

            traerCategorias(tipoR)

            $('#tipo').change(function(event) {
              /* Act on the event */
              $('#subTipo').find('option').remove().end().append('<option value="0">Selecione...</option>').val('0');

              //console.log($(this).val())
              traerSubcategorias($(this).val())
            });

            //$(`<option>Conectar</option>`).appendTo('#tipo')
    $('#myModal').modal('show')

    $('#myModal').on('hide.bs.modal', function(){
      $('#myModal').remove()
    })

    $('#myModal').on('shown.bs.modal', function(){
      $("#input-img").fileinput({
          browseClass: "btn btn-success btn-block",
          allowedFileExtensions: ["jpg", "pdf","xlsx","xls"],
          maxFileCount: 5,
          showCaption: true,
          initialCaption: "Seleccione archivos para informe",
          showRemove: false,
          maxFileSize: 1024,
          maxFilePreviewSize: 1024,
          showUpload: false
      });



        var $input = $( '.datepicker' ).pickadate({
            formatSubmit: 'yyyy/mm/dd',
            // min: [2015, 7, 14],
            container: '#container',
            // editable: true,
            closeOnSelect: false,
            closeOnClear: false,
        });

        var picker = $input.pickadate('picker');
        // picker.set('select', '14 October, 2014')
        // picker.open()

        // $('button').on('click', function() {
        //     picker.set('disable', true);
        // });



      $("#input-24").fileinput({


              initialPreview: [
                  'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
                  'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg'
              ],
              initialPreviewAsData: true,
              initialPreviewConfig: [
                  {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
                  {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
              ],
              showCaption: false,
            showRemove: false,
            showDelete: false,

            showUpload: false

          });
      //$('#divRespuesta').hide()
      $('[id ^=rp]').hide()
    //  $('[class ^=img]').hide()

      // $('[id ^=titulo]').click(function(){
      //   let resp = $(this).attr('id')
      //   let numeroResp = resp.substr(6)
      //   $("#rp"+numeroResp).toggle()
      //   $(".img"+numeroResp).toggle()
      //   console.log('respuestas ...'+numeroResp)
      // });


      CKEDITOR.replace( 'contenido', {
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

 if (validarInforme()) {
      let valorBoton = $(this).text()
      let informeId = escuela.informeId
     $(this).attr('disabled',true);
     $('#formInforme').hide()
     $('.cargando').css('display','block')
     $('#divButton').hide()

      if (valorBoton=="Responder") {
        $('#divContenido'+informeId).hide()
        $('#verInforme'+informeId).show()
        $('#btnSave').html('Enviar')

        $('#divRespuesta').show()
      }else{

        let contenido = new String(CKEDITOR.instances['contenido'].getData());
        let prioridad = new String($('#prioridad').val())
        let titulo = new String($('#titulo').val())
        let tipo = new String($('#tipo').val())
        let subTipo = new String($('#subTipo').val())
        let fecha = new String($('input[name=date_submit]').val())
        //console.log(fecha)



        $('#formInforme').on('submit',(function(e) {
            let paqueteData = new FormData()
            let ins = document.getElementById('input-img').files.length;
                  for (var x = 0; x < ins; x++) {
                      paqueteData.append("input-img[]", document.getElementById('input-img').files[x]);
                  }
            paqueteData.append('informeId', informeId);
            paqueteData.append('escuelaId', escuelaId);
            paqueteData.append('prioridad', prioridad);
            paqueteData.append('titulo', titulo);
            paqueteData.append('tipo', tipo);
            paqueteData.append('subTipo', subTipo);
            paqueteData.append('fecha', fecha);
            paqueteData.append('referenteId', referenteId2);
            paqueteData.append('contenido', contenido);

            $.ajax({
                url: 'includes/mod_cen/clases/ajax/ajaxInformeNuevo.php',
                type: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                //dataType: 'json',
                data: paqueteData
              })
              .done(function() {
                //alert("Guardado correctamente")
                console.log("Se guardo con exito... success Ahora");
                $("#myModal").modal("hide");


              })
              .fail(function(dato) {
                 //   alert('dato');
                 console.log("error al volver de guardar");
               })
              // .fail( function( jqXHR, textStatus, errorThrown ) {
              //   if (jqXHR.status === 0) {
              //
              //      alert('Not connect: Verify Network.');
              //
              //    } else if (jqXHR.status == 404) {
              //
              //      alert('Requested page not found [404]');
              //
              //    } else if (jqXHR.status == 500) {
              //
              //      alert('Internal Server Error [500].');
              //
              //    } else if (textStatus === 'parsererror') {
              //
              //      alert('Requested JSON parse failed.');
              //
              //    } else if (textStatus === 'timeout') {
              //
              //      alert('Time out error.');
              //
              //    } else if (textStatus === 'abort') {
              //
              //      alert('Ajax request aborted.');
              //
              //    } else {
              //
              //      alert('Uncaught Error: ' + jqXHR.responseText);
              //
              //    }
              //
              //   console.log("al volver de ajax de guardar informe ");
              // })
              .always(function() {
                console.log("complete");
              });

          })
        );

        $( "#formInforme" ).submit();

      }
}
    })



////////js boton ver mas datos de informe
  let informeId = escuela.informeId
//alert (informeId)
//  $("#infoOculta"+informeId).hide()

  $('#verMas'+informeId).click(function(event) {
    /* Act on the event */
    $('#infoOculta' + informeId).toggle();
evt.preventDefault();
  })
//////boton ver /ocultar informe

$('#verInforme'+informeId).click(function(event) {
//alert ('informe');
$('#divContenido'+informeId).toggle()
});

}
