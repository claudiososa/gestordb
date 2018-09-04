
function predioNuevo(escuela)
{
  let escuelaId = escuela.escuelaId
  console.log('mi escuela:'+escuelaId)
    $(`
      <div class="modal fade" id="modalBuscarEscuela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
          <!--**** Inicio de Header **** -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

              <h4 class="modal-title" id="myModalLabel"><b>Agregar escuela que comparte predio con: <br>${escuela.nombre}</b>
              <br>
              </h4>

              <div class="row">
                <div class="col-md-12">
                  Numero: ${escuela.numero}<br>
                  Cue: ${escuela.cue}
                </div>
              </div>

            </div><!--./modal-header-->


            <!-- ***** MODAL BODY ****-->

            <div class="modal-body" id="modal-body" >
              <form name="form" enctype="multipart/form-data" class="informef" id="formBuscarEscuela" action="" method="post">
              <div class="form-group  cbuscar">
                 <div class="col-md-12">
                   <label class="control-label cvalidacion">Buscar Escuela</label>
                 </div>
                 <div class="col-md-12">
                     <input type="text" id="inputBuscarEscuela" placeholder="Ingrese numero" />
                  </div>

               </div>
            <div id='resultado'></div>
            </div>

            <!-- **** FIN MODAL BODY ****-->
            <!-- **** INICIO MODAL FOOTER ****-->

            <div class="modal-footer" id="modal-footer">

              <div id="divButton">
                <button type="button" class="btn btn-primary" id="btnBuscarEscuela">Buscar</button>
                <button type="button" class="btn btn-default footerButton" data-dismiss="modal">Cerrar</button>

              </div>
            </div>
            <!-- **** FIN MODAL FOOTER ****-->

            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div id="container"></div>
            `).appendTo('#padreIr')

    // $('#modalBuscarEscuela').modal({
    //   backdrop:'static',
    //   keyboard: true,
    // });
    $('#modalBuscarEscuela').modal('show')

    $('#modalBuscarEscuela').on('hide.bs.modal', function(){
      $('#modalBuscarEscuela').remove()
    })

    $('#modalBuscarEscuela').on('shown.bs.modal', function(){
        $('[id ^=rp]').hide()
        $('#inputBuscarEscuela').focus();

    })



    $('#btnBuscarEscuela').click(function(){

      if ($(this).html()=='Buscar') {
        if (validarInforme()) {
            let valorBoton = $(this).text()
            let informeId = escuela.informeId
            $(this).attr('disabled',true);
            //$('#formInforme').hide()
            $('.cargando').css('display','block')
            //$('#divButton').hide()

            if (valorBoton=="Responder")
            {
               $('#divContenido'+informeId).hide()
               $('#verInforme'+informeId).show()
               $('#btnSave').html('Enviar')
               $('#divRespuesta').show()
             }else{
               let numeroEscuela = new String($('#inputBuscarEscuela').val())

               function buscarEscuela(){
                 $.ajax({
                     url: 'includes/mod_cen/clases/ajax/ajaxEscuela.php',
                     type: 'POST',
                     dataType: 'json',
                     data: {numeroEscuela:numeroEscuela,escuelaId:escuelaId}
                   })
                   .done(function(data) {
                     $('#resultado').empty();
                     for (let item of data) {
                       $(`<p><input type="button" id="button${item.escuelaId}" value="Agregar"> ->${item.numero}- ${item.cue} - ${item.nombre} </p>`).appendTo('#resultado')
                       console.log("Se guardo con exito... success Ahora");
                     }
                     $('#btnBuscarEscuela').attr('disabled',false);
                       $('[id ^=button]').click( function(){
                         alert($(this).attr('id').substr(6))
                       });
                   })
                   .fail(function(dato) {
                      console.log("error al volver de guardar");
                    })
                   .always(function() {
                     console.log("complete");
                   });
               }

             buscarEscuela();

             }
             //alert('llegue aqui')
           }
      } else if ($(this).html()=='Seleccionar') {
        alert($(this).html())
      }

})

}
