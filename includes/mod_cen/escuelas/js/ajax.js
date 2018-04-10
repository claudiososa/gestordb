function buscarDatosEscuela(escuela){
  //let escuela ={}

  let id = escuela.escuelaId
  let numero =''
  let nombre =''
  let cue =''
  //console.log('escuelaId de funcion buscarDatosEscuela'+id)
  $.ajax({
    url: 'includes/mod_cen/clases/ajax/ajaxEscuela.php',
    type: 'POST',
    dataType: 'json',
    data: {id:id}
  })
  .done(function(lista) {
    for (let item of lista) {
      numero=item.numero
      escuela.numero=item.numero
      escuela.cue= item.cue,
      escuela.nombre= item.nombre,
      //console.log(escuela)
      //return escuela
      /*escuela ={
          escuelaId:item.escuelaId,
          numero: item.numero,
          cue: item.cue,
          nombre: item.nombre
        }*/
    }


  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    //console.log(escuela)
  });

}
