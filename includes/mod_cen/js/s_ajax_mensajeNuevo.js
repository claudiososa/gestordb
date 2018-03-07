$(document).ready(function () {
  usuarioActual = usuarioActual.trim()
  //alert(usuarioActual.length)
  //console.log(usuarioActual)
  //console.log(usuarioActual.trim().length)
  //array que guarda el referenteId de cada usuario a quien se
  //enviara el mensaje actual
  let arrayDestinatario = []
  let ETT = []
  let ETJ = []
  let Facilitador = []
  let coordinadorFacilitador = []
  //funcion que se ejecuta al seleccionar  una opcion del combo
  //llamado grupo el cual contiene los tipos de referentes posibles a enviara
  // por el usuario logueado actualmente
  $("#grupo").change(function() {
    //tipoReferente almacena la opcion seleccionada (value) Por ejemplo
    //ETT, ETJ, etc
    let tipoReferente = $("#grupo option:selected").val()

    $.ajax({
      url: 'includes/mod_cen/clases/MensajesNuevoAjax.php',
      type: 'POST',
      dataType: 'json',
      data: {tipoReferente: tipoReferente}

    })
  .done(function(data) {
      //console.log("success");
      let tipoGrupo =$("#grupo option:selected").val()
      $('#grupo > option[value="no"]').prop('selected','true')
      if ($(`#${tipoGrupo}`).length==0){
        $('#para').append(`<p id="${tipoGrupo}" class="btn btn-success">Grupo ${tipoGrupo}<img id="eliminar${tipoGrupo}" src="img/iconos/delete.png" alt="Eliminar"> </p>`)
        $('#para').append(`<p id="grupo${tipoGrupo}"></p>`)
        $(`#grupo${tipoGrupo}`).hide()

        $(`#${tipoGrupo}`).click(function(){
          $(`#grupo${tipoGrupo}`).toggle(500)
        });


        switch (tipoGrupo) {
          case 'ETT':
//                let ETT = []
                $(`#eliminar${tipoGrupo}`).click(function(){
                  $(`#${tipoGrupo}`).toggle(500)
                  $(`#${tipoGrupo}`).remove()
                  $(`#grupo${tipoGrupo}`).remove()
                  for (item in  ETT){
                    let datoEncontrado = arrayDestinatario.indexOf(ETT[item])
                    if (datoEncontrado > -1) {
                      let referenteId = ETT[item]
                      $(`#${referenteId}`).remove()
                      console.log(arrayDestinatario.splice(datoEncontrado,1))
                    }
                  }
                });
            break;
            case 'ETJ':
                  //let ETJ = []
                  $(`#eliminar${tipoGrupo}`).click(function(){
                    $(`#${tipoGrupo}`).toggle(500)
                    $(`#${tipoGrupo}`).remove()
                    $(`#grupo${tipoGrupo}`).remove()
                    for (item in  ETJ){
                      let datoEncontrado = arrayDestinatario.indexOf(ETJ[item])
                      if (datoEncontrado > -1) {
                        let referenteId = ETJ[item]
                        $(`#${referenteId}`).remove()
                        console.log(arrayDestinatario.splice(datoEncontrado,1))
                      }
                    }
                  });
              break;
              case 'Facilitador':
                    //let ETJ = []
                    $(`#eliminar${tipoGrupo}`).click(function(){
                      $(`#${tipoGrupo}`).toggle(500)
                      $(`#${tipoGrupo}`).remove()
                      $(`#grupo${tipoGrupo}`).remove()
                      for (item in  Facilitador){
                        let datoEncontrado = arrayDestinatario.indexOf(Facilitador[item])
                        if (datoEncontrado > -1) {
                          let referenteId = Facilitador[item]
                          $(`#${referenteId}`).remove()
                          console.log(arrayDestinatario.splice(datoEncontrado,1))
                        }
                      }
                    });
                break;
                case 'coordinadorFacilitador':
                      //let ETJ = []
                      $(`#eliminar${tipoGrupo}`).click(function(){
                        $(`#${tipoGrupo}`).toggle(500)
                        $(`#${tipoGrupo}`).remove()
                        $(`#grupo${tipoGrupo}`).remove()
                        for (item in  coordinadorFacilitador){
                          let datoEncontrado = arrayDestinatario.indexOf(coordinadorFacilitador[item])
                          if (datoEncontrado > -1) {
                            let referenteId = coordinadorFacilitador[item]
                            $(`#${referenteId}`).remove()
                            console.log(arrayDestinatario.splice(datoEncontrado,1))
                          }
                        }
                      });
                  break;
          default:
        }


      for (let item of data) {
            switch (tipoGrupo) {
                case 'ETT':
                      if (item.id!=usuarioActual) {
                        ETT.push(item.id);
                      }

                      break;
                case 'ETJ':
                      if (item.id!=usuarioActual) {
                        ETJ.push(item.id);
                      }
                      break;
                case 'Facilitador':
                      if (item.id!=usuarioActual) {
                        Facilitador.push(item.id);
                      }
                      break;
                case 'coordinadorFacilitador':
                      if (item.id!=usuarioActual) {
                        coordinadorFacilitador.push(item.id);
                      }
                      break;
                default:
              }

              if ($(`#${tipoGrupo}`).length > 0){
                if (item.id!=usuarioActual) {
                  $(`#grupo${tipoGrupo}`).append(`<p id='${item.id}'> - ${item.value} - ${item.email} -  <img id="eliminarDelGrupo${item.id}" src="img/iconos/delete.png" alt="Eliminar"> </p>`)

                  $(`#eliminarDelGrupo${item.id}`).click(function () {
                  //  console.log(ui.item.value);
                    $(`#${item.id}`).remove()
                    console.log(arrayDestinatario.splice(arrayDestinatario.indexOf(item.id),1));
                    serialize(arrayDestinatario);
                  });
                }
              }

              if (arrayDestinatario.indexOf(item.id) == -1) {
                  if (item.id!=usuarioActual) {
                    arrayDestinatario.push(item.id);
                  }
              }else{
                $(`#${item.id}`).hide()
              }

              serialize(arrayDestinatario);
            }


      }

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

  });


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
       //verifica si valor ReferenteId seleccionad se encuentra dentro del arrayDestinatario
       //en el caso que el mismo ya se encuentra en el array no agregar contenido
       // al parrado con id destinatario
      if (arrayDestinatario.indexOf(ui.item.id) == -1) {
        console.log(ui.item.id);
        //console.log(arrayDestinatario.indexOf(ui.item.id));
        console.log(ui.item.id.length)
        if (ui.item.id != usuarioActual) {
          $('#destinatario').append(`<p id='${ui.item.id}'> - ${ui.item.value} - ${ui.item.email} -  <img id="eliminar${ui.item.id}" src="img/iconos/delete.png" alt="Eliminar"> </p>`);

        $(`#eliminar${ui.item.id}`).click(function () {
        //  console.log(ui.item.value);
          $(`#${ui.item.id}`).remove()
          console.log(arrayDestinatario.splice(arrayDestinatario.indexOf(ui.item.id),1));
          serialize(arrayDestinatario);
        });

        if (ui.item.id!=usuarioActual) {
          arrayDestinatario.push(ui.item.id);
        }
        //$('#asunto').attr.value('mesa');
        serialize(arrayDestinatario);
        //console.log($('#birds').val('seleccinodo'));
        $('#birds').val('');
        return false;
      }  
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
