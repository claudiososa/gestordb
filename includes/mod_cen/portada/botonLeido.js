$(document).ready(function() {
  //$("tr[id]).hide();
  $('#tablePrincipal tr#fila1673').hide();

  $("button[id]").click(function() {
  //alert($(this).parent().parent().attr('id'));
    let idTr = $(this).parent().parent().attr('id').substring(11)
    //alert(idTr)
    idTr = '#tr.'+idTr
    //alert(idTr)
    /* Act on the event */
    //$("tr[id] , tbody[id]").show();

    $('tr#tr.1673').hide();

});


});
