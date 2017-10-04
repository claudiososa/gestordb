$(document).ready(function() {
  $('#buttomSearchDate').click(function(event) {
    let year =$('#year option:selected').val()
    let month =$('#month option:selected').val()
//    alert(month)
    $.ajax({
      url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
      type: 'POST',
      dataType: 'json',
      data: {year:year,month:month,referenteId:referenteId}
    })
    .done(function(list) {
      console.log("success");
      $('#bodyTablaCargo').empty()

      for (let item of list) {
        $('#bodyTablaCargo').prepend(`<tr><td><a href='index.php?mod=slat&men=referentes&id=2&personaId=${item.personaId}&referenteId=${item.referenteId}'>${item.apellido},${item.nombre}</a></td><td><a class="btn btn-success" href="?mod=slat&men=informe&id=6&referenteId=${item.referenteId}">${item.cantidad}</a></td><td><a class="btn btn-success" href="?mod=slat&men=informe&date&id=6&referenteId=${item.referenteId}">${item.totalMes}</a></td>`)
      }
      $("#informe_etj").tablesorter();

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  });
});
