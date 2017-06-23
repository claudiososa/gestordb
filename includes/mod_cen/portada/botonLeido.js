$(document).ready(function() {
  //oculta todos los tr de la tabla con id tablaPrincipal
  //donde el id contenga la palabra fila
  $('#tablaPrincipal tr[id*=fila]').hide();

//si presiona algun boton de leido dentro de la lista de todos los informes que muestra la tabla
  $("button[id]").click(function() {

    let idTr = $(this).parent().parent().attr('id').substring(11)
    idTr = 'fila'+idTr
   if( $('#'+idTr).is(':visible') ){
    $('#'+idTr).hide();
  }else{
    $('#'+idTr).show();
  }

});


});
