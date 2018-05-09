$(document).ready(function() {

/**
 * Metodo clic para id / informeId
 */
$('[id ^=informeId],[id ^=inforalta],[id ^=informedi],[id ^=infornorm]').on('click', function()
 {

   let informeActual ={
     informeId: "",
     escuelaNombre: "",
     escuelaNumero: "",
     escuelaCue: "",
     fecha: "",
     prioridad: "",
     categoria:  "",
     subcategoria:  "",
     titulo: "",
     contenido: "",
     escuelaId: "",
     etjPortada: "",
     referente: ""
   }

          //$('[id ^=if]').on('click', function(){
     //let idPrueba = $(this).attr('id').substr(9);
     let informeId = $(this).attr('id').substr(9);
     //alert(informeId)
     $.ajax({
       url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
       type: 'POST',
       dataType: 'json',
       data: {informeId:informeId,referenteId:referenteId2}
     })
     .done(function(lista) {
       for (let item of lista) {
           //console.log('item. nombre'+item.nombre)
           informeActual.escuelaNombre=item.nombre
           informeActual.escuelaNumero=item.numero
           informeActual.escuelaCue=item.cue
           informeActual.fecha=item.fecha
           informeActual.prioridad=item.prioridad
           informeActual.categoria=item.categoria
           informeActual.subcategoria=item.subcategoria
           informeActual.titulo=item.titulo
           informeActual.contenido=item.contenido
           informeActual.escuelaId=item.escuelaId
           informeActual.informeId=informeId
           informeActual.etjPortada='si'
           informeActual.referente=item.referente

       }
     })

     .fail(function() {
       console.log("error");
     })
     .always(function() {
       formPersona(informeActual)
     });

 });





  function pad(num, largo, char) {
    char = char || '0';
    num = num + '';
    return num.length >= largo ? num : new Array(largo - num.length + 1).join(char) + num;
  }


});
