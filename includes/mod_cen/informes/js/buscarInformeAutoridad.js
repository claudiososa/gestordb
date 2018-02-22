$(document).ready(function() {


//alert (valor)
$('#linea').click(function(event) {
  let valor = $(this).val()
//alert (valor)


$.ajax({
  url: 'includes/mod_cen/informes/buscarInformesAutoridad.php',
  type: 'POST',
  dataType: 'json',
  data: {valor: 'valor'}
})
.done(function() {
for (let item of lista) {

    $('#linea').val(7)

console.log("success");


}
})
.fail(function() {
  console.log("error");
})
.always(function() {
  console.log("complete");
});

  });

})
