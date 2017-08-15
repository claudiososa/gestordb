$(document).ready(function () {
  let arrayDestinatario = [];

  var row = '<?php echo $datoRemitente->nombre;?>'
  alert(row)
  function serialize(arr)
  {
    var res = 'a:'+arr.length+':{';
    for(i=0; i<arr.length; i++)
    {
    res += 'i:'+i+';s:'+arr[i].length+':"'+arr[i]+'";';
    }
    res += '}';

    $('#destino').val(res);
    //return res;
  }


   function log( message ) {
     $( "<div>" ).text( message ).prependTo( "#log" );
     $( "#log" ).scrollTop( 0 );
   }

   $( "#birds" ).autocomplete({
     source: function( request, response ) {
       $.ajax( {
         url: "includes/mod_cen/clases/MensajesAjax.php",
         dataType: "json",
         data: {
           term: request.term
         },
         success: function( data ) {
           //console.log(data);
           response( data );
         }
       } );
     },
     minLength: 2,
     select: function( event, ui ) {

      if (arrayDestinatario.indexOf(ui.item.id) == -1) {
        console.log(ui.item.id);
        console.log(arrayDestinatario.indexOf(ui.item.id));
        $('#destinatario').append(`<p id='${ui.item.id}'> - ${ui.item.value} - ${ui.item.email} -  <img id="email${ui.item.id}" src="img/iconos/delete.png" alt="Eliminar"> </p>`);
        $('#email'+ui.item.id).click(function () {
          console.log(ui.item.value);
        });

        arrayDestinatario.push(ui.item.id);
        //$('#asunto').attr.value('mesa');
        serialize(arrayDestinatario);
        console.log($('#birds').val('seleccinodo'));
        $('#birds').val('');
        return false;
      }else{
        $('#birds').val('');
        return false;
      }

      // alert('Selecciono' + ui.item.value);


      console.log(arrayDestinatario);

    //   log( "Selected: " + ui.item.value + " aka " + ui.item.id );
     }
   } );

   $("#input-img").fileinput({
       browseClass: "btn btn-success btn-block",
       allowedFileExtensions: ["pdf","xlsx","docx","pptx","xls","doc","jpg","png"],
       maxFileCount: 5,
       showCaption: true,
       initialCaption: "Seleccione 1 archivo para crear documento nuevo",
       showRemove: false,
       maxFileSize: 10240,
       maxFilePreviewSize: 2048,
       showUpload: false
   });


   $("#input-24").fileinput({


           initialPreview: [
               'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
               'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg'
           ],
           initialPreviewAsData: true,
           initialPreviewConfig: [
               {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
               {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
           ],
           showCaption: false,
         showRemove: false,
         showDelete: false,

         showUpload: false

       });


       //$('a').on('click', function(e){
               //alert('click');
        //   });


       //$('[id^=ema]').on('click', function () {
       $('#0037').click(function () {
         console.log('casa');
       //$('#0037').click(function () {
           //console.log($(this).val());
           //alert('hola');
           /*var detalle = $(this).val();
           $.post("includes/mod_cen/clases/c_productos.php", { detalle: detalle, venta: venta }, function(data){
             var resultado = JSON.parse(data);
             var dato = resultado['estado'];
             var total = resultado['total'];
             $('#'+dato).remove();
             $('#total').text("Total:    "+total);
           });*/
       });

});
