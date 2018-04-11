function buscarDatosEscuela(){
  //let escuela ={}
  let id = escuela.escuelaId

  $.ajax({
    url: 'includes/mod_cen/clases/ajax/ajaxEscuela.php',
    type: 'POST',
    dataType: 'json',
    data: {id:id}
  })
  .done(function(lista) {
    for (let item of lista) {      
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
