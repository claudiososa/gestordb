$(document).ready(function() {

  $('[id ^=informes]').on('click', function(){

    let escuelaId = $(this).attr('id').substr(8)
    //alert(escuelaId)
    let $this = $(this)
    let existe = $('.tableinformes'+escuelaId).attr('class')

    if (typeof(existe)==='undefined') {
        console.log('definicion de existe'+existe)
        //$this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
        //console.log(escuelaId)
        let myReport ='all'

        $.ajax({
          url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
          type: 'POST',
          dataType: 'json',
          data: {myReport:myReport,referenteId:referenteId2,escuelaId: escuelaId}
        })
        .done(function(lista) {

          let itemEscuela = 0
          let tableinforme = 0

          for (let item of lista) {
              tableinforme=pad(item.escuelaId,4,0)

          }

          console.log('item Escuela Id = '+tableinforme)
          $('#info'+escuelaId).parent().parent().after(`<tr class="tableinformes${tableinforme}"><td colspan="5"><table id=tableinformes${tableinforme}
          class="table">
          <thead>
            <tr class='success'>
              <th>Titulo</th>
              <th>Leido</th>
              <th>Respuestas</th>
              <th>Fecha</th>
              <th>Prioridad</th>
            </tr>
          </thead>
          <tbody>`)

          for (let item of lista) {
              //alert(item.escuelaId)
              console.log(item.cantidad)
            if (item.cantidad > 0) {
              let escuelaIdconCero = pad(item.escuelaId,4,0)
              let escuela = item.escuelaId
              console.log('cantidad de leido'+item.cantidadLeido)
              $('#tableinformes'+escuelaIdconCero).find('tbody').after(`<tr class="trinformes${escuelaIdconCero}">
              <td>${item.titulo}</td>
              <td><a id='eInforme' href=''>${item.cantidadLeido}</a></td>
              <td><a id='eInforme' href=''>${item.cantidadRespuesta}</a></td>
              <td><a id='eInforme' href=''>${item.fecha}</a></td>
              <td><a id='eInforme' href=''>${item.prioridad}</a></td>
              </tr>`)

            }else{
              alert('Esta escuela no tiene informes creados')
            }
          }

          //$('#info'+escuelaId).parent().parent().html(`</tbody>hola mundo</table>`)


          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    }else{
        //$('.trinformes'+escuelaId).remove()

        $('.tableinformes'+escuelaId).remove()
        //$('.trautoridad'+escuelaId).closest('tr').remove()
        $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');

        console.log('variable existe'+existe)
        existe.stop
        console.log('variable existe'+existe)
    }

    //alert('fila')
  })

  //evento al hacer click en el td con id que inicia en row // corresponde a Autoridades
  $('[id ^=row]').on('click', function(){

    let escuelaId = $(this).attr('id').substr(3)
    //alert(escuelaId)
    let $this = $(this)

    let existeAutoridad = $('.tableAutoridades'+escuelaId).attr('class')
    //let existe = $('.trautoridad'+escuelaId).attr('class')

    if (typeof(existeAutoridad)==='undefined') {
        //console.log(existe)
        $this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
        console.log(escuelaId)
        let all ='all'
        $.ajax({
          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
          type: 'POST',
          dataType: 'json',
          data: {all:all,escuelaId: escuelaId}
        })
        .done(function(lista) {
          let tableinforme = 0

          for (let item of lista) {
              tableAuto=pad(item.escuelaId,4,0)

          }

          $('#autoridad'+escuelaId).parent().parent().after(`<tr class="tableAutoridades${tableAuto}"><td colspan="5">
          <table id=tableAutoridades${tableAuto} class="table">
          <thead>
            <tr class='success'>
              <th>Tipo</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>`)

          let itemEscuela = 0

          for (let item of lista) {

            let escuelaIdconCero = pad(item.escuelaId,4,0)
            let escuela = item.escuelaId


            if (item.cantidad > 0) {

              $('#tableAutoridades'+escuelaIdconCero).find('tbody').after(`<tr class="trinformes${escuelaIdconCero}">
              <td>${item.cargo}</td>
              <td><a id='eInforme' href=''>${item.apellido},${item.nombre}</a></td>
              <td><a id='eInforme' href=''>${item.telefono}</a></td>
              <td><a id='eInforme' href=''>${item.email}</a></td>
              <td><a id='eAutoridad' href=''>Modificar</a></td>
              </tr>`)




              /*$('#autoridad'+escuelaId).parent().parent().after(`<tr class="trautoridad${item.escuelaId}"><td>${item.cargo}</td><td>${item.apellido}, ${item.nombre}</td><td>${item.telefono}</td><td>${item.email}</td><td><a id='eAutoridad' href=''>Modificar</a></td></tr>`)
              itemEscuela++
              if (itemEscuela==item.cantidad) {
                $('#autoridad'+escuelaId).parent().parent().after(`<tr class="trautoridad${item.escuelaId}"><td colspan="5">listado de autoridades</td></tr>`)

              }*/
              $('.trautoridad'+item.escuelaId).hide()
              $('.trautoridad'+item.escuelaId).fadeIn('slideUp')
              if (item.id=='0') {
                //alert(item.nombre)
                console.log('no encontrado')
              }else{

                //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
              }
            }else{
              alert('Esta escuela no tiene autoridad asignada')
            }
          }



          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    }else{

        $('.tableAutoridades'+escuelaId).remove()
        //$('.trautoridad'+escuelaId).closest('tr').remove()
        $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');

        //console.log(existe)
    }







    //alert('fila')
  })

  function pad(num, largo, char) {
    char = char || '0';
    num = num + '';
    return num.length >= largo ? num : new Array(largo - num.length + 1).join(char) + num;
  }
});
