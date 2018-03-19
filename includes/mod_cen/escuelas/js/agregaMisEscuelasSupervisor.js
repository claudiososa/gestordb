$(document).ready(function() {

  //$('#info'+escuelaId).parent().parent().html(`</tbody>hola mundo</table>`)
  $('[id ^=list]').click( function(){

    let informeActual ={
      informeId: "",
      escuelaNombre: "",
      escuelaNumero: "",
      escuelaCue: "",
      fecha: "",
      prioridad: "",
      categoria:  "",
      subcategoria:  "",
      titulo: ""
    }

           //$('[id ^=if]').on('click', function(){
      let idPrueba = $(this).attr('id');
      let informeId = idPrueba.substr(4)
      $.ajax({
        url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
        type: 'POST',
        dataType: 'json',
        data: {informeId:informeId}
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
            informeActual.informeId=informeId

            /*let escuelaNombre = item.nombre
            let escuelaNumero = item.numero
            let escuelaCue = item.cue
            let fecha = item.fecha
            let prioridad = item.prioridad
            let categoria =  item.categoria
            let subcategoria =  item.subcategoria
            let titulo =  item.titulo
            let contenido =  item.contenido*/

        }
        //console.log(informeActual.escuelaNombre)
        //console.log("success Ajax Informe");
      })

      .fail(function() {
        console.log("error");
      })
      .always(function() {
        //console.log(informeActual.escuelaNombre)
        //console.log("success Ajax Informe");
        formPersona(informeActual)



        //console.log("complete");
      });



  });


  //fo

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

          //console.log('item Escuela Id = '+tableinforme)
          $('#info'+escuelaId).parent().parent().after(`<tr class="tableinformes${tableinforme} warningStyle"><td colspan="6"><table id=tableinformes${tableinforme}
          class="table StyleTable">
          <thead>
            <tr class='warningStyle'>
              <th><h4>Informes&nbsp&nbsp  N° Escuela:1111 </h4></th>
              <th>&nbsp</th>
              <th>&nbsp</th>
              <th>&nbsp</th>
              <th><button type='button' class='btn btn-warning'>Crear Nuevo Informe</button></th>

            </tr>
          </thead>

          <thead>
            <tr>
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
              //console.log(item.cantidad)
            if (item.cantidad > 0) {
              let escuelaIdconCero = pad(item.escuelaId,4,0)
              let escuela = item.escuelaId
              //console.log('cantidad de leido'+item.cantidadLeido)
              $('#tableinformes'+escuelaIdconCero).find('tbody').after(`<tr class="trinformes${escuelaIdconCero}">

              <td><a class="btn btn-default" role="button" id='if${item.informeId}'>${item.titulo}</a></td>
              <td>${item.cantidadLeido}</td>
              <td>${item.cantidadRespuesta}</td>
              <td>${item.fecha}</td>
              <td>${item.prioridad}</td>

              </tr>`)

            }else{
              alert('Esta escuela no tiene informes creados')
            }
          }



          //$('#info'+escuelaId).parent().parent().html(`</tbody>hola mundo</table>`)
          $('[id ^=if]').click( function(){

            let informeActual ={
              informeId: "",
              escuelaNombre: "",
              escuelaNumero: "",
              escuelaCue: "",
              fecha: "",
              prioridad: "",
              categoria:  "",
              subcategoria:  "",
              titulo: ""
            }

                   //$('[id ^=if]').on('click', function(){
              let idPrueba = $(this).attr('id');
              let informeId = idPrueba.substr(2)
              $.ajax({
                url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
                type: 'POST',
                dataType: 'json',
                data: {informeId:informeId}
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
                    informeActual.informeId=informeId

                    /*let escuelaNombre = item.nombre
                    let escuelaNumero = item.numero
                    let escuelaCue = item.cue
                    let fecha = item.fecha
                    let prioridad = item.prioridad
                    let categoria =  item.categoria
                    let subcategoria =  item.subcategoria
                    let titulo =  item.titulo
                    let contenido =  item.contenido*/

                }
                //console.log(informeActual.escuelaNombre)
                //console.log("success Ajax Informe");
              })

              .fail(function() {
                console.log("error");
              })
              .always(function() {
                //console.log(informeActual.escuelaNombre)
                //console.log("success Ajax Informe");
                formPersona(informeActual)



                //console.log("complete");
              });



          });

          //console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          //console.log("complete");
        });
    }else{
        //$('.trinformes'+escuelaId).remove()

        $('.tableinformes'+escuelaId).remove()
        //$('.trautoridad'+escuelaId).closest('tr').remove()
        $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');

        //console.log('variable existe'+existe)
        existe.stop
        //console.log('variable existe'+existe)
    }

    //alert('fila')
  })

  //evento al hacer click en el td con id que inicia en tecnico // corresponde a Rti
  $('[id ^=tecnico]').on('click', function(){

    let escuelaId = $(this).attr('id').substr(7)

    let $this = $(this)

    let existeRti = $('.tableRti'+escuelaId).attr('class')
    //let existe = $('.trautoridad'+escuelaId).attr('class')

    if (typeof(existeRti)==='undefined') {
        //console.log(existe)
        $this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
        let escuela = $(this).attr('id').substr(7)
        //console.log('dentro de rti:'+escuela)
        //alert(escuelaId)
        let rti ='rti'
        $.ajax({
          url: 'includes/mod_cen/clases/ajax/ajaxRti.php',
          type: 'POST',
          dataType: 'json',
          data: {rti:rti,escuela:escuela}
        })
        .done(function(lista) {
          let tableinforme = 0

          for (let item of lista) {
              tableAuto=pad(item.escuelaIdxxx,4,0)

          }

          $('#rti'+escuela).parent().parent().after(`<tr class="tableRti${tableAuto} success"><td colspan="6"><table class="table StyleTable1">
          <thead>
          <tr class='success'>
          <th><h4>RTI &nbsp&nbsp&nbsp  N° Escuela:  1454</h4></th>
         <th>&nbsp</th>
         <th>&nbsp</th>
         <th>&nbsp</th>
         <th>&nbsp</th>
         <th><button type='button' class='btn btn-success'>Nueva RTI</button></th>

         </tr>
        </thead>


          <table id=tableRti${tableAuto} class="table StyleTable1">

          <thead>
            <tr>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Accion</th>
            </tr>
          </thead>
          `)

          let itemEscuela = 0

          for (let item of lista) {

            let escuelaIdconCero = pad(item.escuelaIdxxx,4,0)
            let escuela = item.escuelaIdxxx


            if (item.cantidad > 0) {

              $('#tableRti'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
              <td>${item.nombre}</td>
              <td><a id='eRti' href=''>${item.telefonoM}/ ${item.telefonoC}</a></td>
              <td><a id='eRti' href=''>${item.email}</a></td>
              <td><a id='eRti' href=''>${item.turno}</a></td>
              <td><img class='img-responsive' src='img/iconos/lapiz (4).png' id='eAutoridad'></td>

              </tr></tbody></table>`)


              //$('.trautoridad'+item.escuelaId).hide()
              //$('.trautoridad'+item.escuelaId).fadeIn('slideUp')
              if (item.id=='0') {
                //alert(item.nombre)
                console.log('no encontrado')
              }else{

                //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
              }
            }else{
              alert('Esta escuela no tiene RTI asignado')
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
    }else{//si la tabla con datos rti esta visualizada ingresa por aqui
        $('.tableRti'+escuelaId).remove()
        $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');
    }

  })//fin de clic en tecnico


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
        //console.log(escuelaId)
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

          $('#autoridad'+escuelaId).parent().parent().after(`<tr class="tableAutoridades${tableAuto} success"><td colspan="6"><table class="table StyleTable1">
          <thead>
          <tr class='success'>
          <th><h4>Autoridades &nbsp&nbsp&nbsp  N° Escuela:  1454</h4></th>
         <th>&nbsp</th>
         <th>&nbsp</th>
         <th>&nbsp</th>
         <th>&nbsp</th>
         <th><button type='button' class='btn btn-success'>Nueva Autoridad</button></th>

         </tr>
        </thead>


          <table id=tableAutoridades${tableAuto} class="table StyleTable1">

          <thead>
            <tr>
              <th>Tipo</th>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Email</th>
              <th>Accion</th>
            </tr>
          </thead>
          `)



          let itemEscuela = 0

          for (let item of lista) {

            let escuelaIdconCero = pad(item.escuelaId,4,0)
            let escuela = item.escuelaId


            if (item.cantidad > 0) {

              $('#tableAutoridades'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
              <td>${item.cargo}</td>
              <td><a id='eInforme' href=''>${item.apellido},${item.nombre}</a></td>
              <td><a id='eInforme' href=''>${item.telefono}</a></td>
              <td><a id='eInforme' href=''>${item.email}</a></td>
              <td><img class='img-responsive' src='img/iconos/lapiz (4).png' id='eAutoridad'></td>

              </tr></tbody></table>`)




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

  })//fin de clic en row



  function pad(num, largo, char) {
    char = char || '0';
    num = num + '';
    return num.length >= largo ? num : new Array(largo - num.length + 1).join(char) + num;
  }


});
