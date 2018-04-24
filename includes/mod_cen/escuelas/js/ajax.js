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
