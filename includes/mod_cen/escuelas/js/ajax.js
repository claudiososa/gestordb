function traerSubcategorias(idCategoria){
  $.ajax({
    url: 'includes/mod_cen/clases/ajax/ajaxCategoriaInforme.php',
    type: 'POST',
    dataType: 'json',
    data: {idCategoria:idCategoria}
  })
  .done(function(data) {
    for (let item of data) {
      $(`<option value="${item.subTipoId}">${item.nombre}</option>`).appendTo('#subTipo')
    }
    //console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });

}

function traerCategorias(tipoReferente){
  console.log('llego a traerCategorias')
  $.ajax({
    url: 'includes/mod_cen/clases/ajax/ajaxCategoriaInforme.php',
    type: 'POST',
    dataType: 'json',
    data: {tipoReferente:tipoReferente}
  })
  .done(function(data) {
    for (let item of data) {
      $(`<option value="${item.tipoInformeId}">${item.nombre}</option>`).appendTo('#tipo')
    }

  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });

}
function buscarDatosEscuela(escuela){
  //let escuela ={}
    return promise = new Promise(function(resolve,reject){
      let estado="0"
      let id = escuela.escuelaId
      console.log('id es dentro de buscarDatosEscuela'+id)
      $.ajax({
        url: 'includes/mod_cen/clases/ajax/ajaxEscuela.php',
        type: 'POST',
        dataType: 'json',
        data: {id:id}
      })
      .done(function(lista) {
        for (let item of lista) {
          escuela.numero=item.numero,
          escuela.cue= item.cue,
          escuela.nombre= item.nombre


        }
        //estado='1'
        resolve(escuela)

      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        //console.log(escuela)
      });
      //resolve(true)
      //if (estado=='1') {
      //  resolve(escuela)
      //}
    })
  }
//return 'hola mundo'

// modal para listar escuelas con predio compartidos desde el buscador de escuela viejo


function modalEscuelasPredio(escuelaDatos) {
         
  // console.log('llega al modal predio')
    
    $(`<div class="modal fade" id="myModalM${escuelaDatos.escuelaId}"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Escuela N° ${escuelaDatos.numero}</h4>
      </div>
      <div class="modal-body">
        <p><b>CUE : </b>${escuelaDatos.cue}</p>
        <p><b>N° :</b> ${escuelaDatos.numero}</p>
        <p><b>Nombre :</b> ${escuelaDatos.nombre}</p>
        <p><b>Direccion:</b> ${escuelaDatos.domicilio}</p>
        <p><b>Localidad :</b> ${escuelaDatos.localidad}</p>
        <hr>
        <p style="text-align:center;"><b>${escuelaDatos.perfil} A CARGO</b> </p> 
        <p>${escuelaDatos.apellidoEtt}, ${escuelaDatos.nombreEtt}</p>
        <p>${escuelaDatos.telefonoEtt}</p>
       

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn btn-primary" id="">Cargar</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
*/


  `).appendTo('#escPredio')


    $('[id ^=myModalM]').modal('show')  // importante para modal
    $('[id ^=myModalM]').on('hide.bs.modal',function(){ // importante para modal
    $('[id ^=myModalM]').remove() // importante para modal

    })

  }


