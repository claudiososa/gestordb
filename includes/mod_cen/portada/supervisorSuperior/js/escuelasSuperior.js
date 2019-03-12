$(document).ready(function() {

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
              informeActual.informeId=informeId
          }
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
  
  // para predio
  
  $('[id ^=mpredio]').click( function(){
  
    let idEscuelaPredio = $(this).attr('id').substr(7)
    let escuelaDatos ={
        escuelaId: "",
        nombre: "",
        numero: "",
        cue: "",
        domicilio:"",
        localidad:"",
        perfil:"",
        nombreEtt:"",
        apellidoEtt:"",
        telefonoEtt:""
            
      }
  
      $.ajax({
          url: 'includes/mod_cen/clases/ajax/ajaxPredio.php',
          type: 'POST',
          dataType: 'json',
          data: {idEscuelaPredio:idEscuelaPredio}
        })
        .done(function(lista) {
          for (let item of lista) {
            
              escuelaDatos.escuelaId=item.escuelaId
              escuelaDatos.nombre=item.nombre
              escuelaDatos.numero=item.numero
              escuelaDatos.cue=item.cue
              escuelaDatos.domicilio=item.domicilio
              escuelaDatos.localidad=item.localidad
              escuelaDatos.perfil=item.perfil
              escuelaDatos.nombreEtt=item.nombreEtt
              escuelaDatos.apellidoEtt=item.apellidoEtt
              escuelaDatos.telefonoEtt=item.telefonoEtt
           
             //console.log (item.cue)
             
          }
              
  
        })
  
        .fail(function() {
          console.log("error");
        })
        .always(function() {
         modalEscuelasPredio(escuelaDatos)
        // alert(matriculaActual.numero)
       });
  
    });
  
  
  // para predio
  
  
    $('[id ^=informes],[id ^=informeM]').on('click', function(){
  
      let escuelaId = $(this).attr('id').substr(8)
      let click = $(this).attr('id').substr(0,8) // guarda el id del elemento donde se hizo clic, puede ser informes o informeM
      let existe
      let $this = $(this)
  
      if (click=='informes') {//almacena en variable existe, la clase de la tableinformes en el caso que no existe dicha tabla se guarda comno undefined
        existe = $('.tableinformes'+escuelaId).attr('class')
      }else{
        //alert('ingresa  por informeM')
        existe = $('.tableinformeM'+escuelaId).attr('class')
        //alert(existe)
      }
  
      if (typeof(existe)==='undefined')
      {
          console.log('definicion de existe'+existe)
          let myReport ='all'
          //let reports ='conectar'
          $.ajax({
            url: 'includes/mod_cen/clases/ajax/ajaxInforme.php',
            type: 'POST',
            dataType: 'json',
            data: {myReport:myReport,reports:reports,referenteId:referenteId2,escuelaId: escuelaId}
          })
          .done(function(lista) {
  
           let itemEscuela = 0
           let tableinforme = 0
           let cant = 0
  
  
           for (let item of lista) {
                tableinforme=pad(item.escuelaId,4,0)
                cant= item.cantidad
           }
  
           if (cant > 0) {
  
              if (click=='informes') {
                 // console.log('item Escuela Id = '+cant)
               $('#info'+escuelaId).parent().parent().after(`<tr class="tableinformes${tableinforme} warningStyle"><td colspan="6"><table id=tableinformes${tableinforme}
               class="table StyleTable">
               <thead>
                 <tr class='warningStyle'>
                   <th><h4>Informes</h4></th>
                   <th>&nbsp</th>
                   <th>&nbsp</th>
                   <th>&nbsp</th>
  
                   <th><button type='button' class='btn btn-warning' id=nuevoInforme${tableinforme} >Crear Nuevo Informe</button></th>
  
                 </tr>
  
               </thead>
  
  
  
               <thead>
                 <tr>
                   <th>Titulo</th>
                   <th>Leido</th>
                   <th>Resp.</th>
                   <th>Fecha</th>
                   <th>Prioridad</th>
                 </tr>
               </thead>
               <tbody>`)
  
            }else{
  
               $('#infoM'+escuelaId).parent().parent().after(`<div class="list-group tableinformeM${tableinforme}" id="tableinformeM${tableinforme}"><br><button type='button' class='btn btn-warning' id=nuevoInforme${escuelaId} >Crear Nuevo Informe</button><br><div>`)
  
            }
  
  
          }else{   // entra por que no tiene informes cargados
  
            if (click=='informes') {
         //  console.log('item Escuela Id = '+cant)
           $('#info'+escuelaId).parent().parent().after(`<tr class="tableinformes${tableinforme} warningStyle"><td colspan="6"><table id=tableinformes${tableinforme}
           class="table StyleTable">
           <thead>
             <tr class='warningStyle'>
               <th><h4>Informes</h4></th>
               <th>&nbsp</th>
               <th>&nbsp</th>
               <th>&nbsp</th>
               <th><button type='button' class='btn btn-warning' id=nuevoInforme${escuelaId} >Crear Nuevo Informe</button></th>
             </tr>
           </thead>
  
           <thead>
             <tr>
               <th>Titulo</th>
               <th>Leido</th>
               <th>Resp.</th>
               <th>Fecha</th>
               <th>Prioridad</th>
             </tr>
           </thead>
           <tbody>`)
  
         }else{
            $('#infoM'+escuelaId).parent().parent().after(`<p tableinformeM${tableinforme}" id="tableinformeM${tableinforme}">Sin informes</p><button type='button' class='btn btn-warning' id=nuevoInforme${escuelaId} >Crear Nuevo Informe</button>`)
         }
  
       }
  
            for (let item of lista) {
                //alert(item.escuelaId)
                //console.log(item.cantidad)
              if (item.cantidad > 0) {
                let escuelaIdconCero = pad(item.escuelaId,4,0)
                let escuela = item.escuelaId
  
                if (click=='informes') {
                //console.log('cantidad de leido'+item.cantidadLeido)
                $('#tableinformes'+escuelaIdconCero).find('tbody').after(`<tr class="trinformes${escuelaIdconCero}">
  
                <td><a class="btn btn-default" role="button" id='if${item.informeId}'>${item.titulo}</a></td>
                <td>${item.cantidadLeido}</td>
                <td>${item.cantidadRespuesta}</td>
                <td>${item.fecha}</td>
                <td>${item.prioridad}</td>
  
                </tr>`)
              }else{
                $('#tableinformeM'+escuelaIdconCero).find('div').after(`<a  class="list-group-item">
                <h5 class="list-group-item-heading trinformes${escuelaIdconCero}"id='if${item.informeId}'><b>${item.titulo}</b></h5>
                <p class="list-group-item-text">${item.fecha} Prioridad:${item.prioridad}</p><br><p class="btn-group" role="group">
                <button type="button" class="btn btn-default"disabled="true">Leido: ${item.cantidadLeido}</button><button type="button" disabled="true"class="btn btn-default">Resp.: ${item.cantidadRespuesta}</button></p></a>`)
              }
  
  
              }else{
                //alert('Esta escuela no tiene informes creados')
              }
            }
  
  
            $('[id ^=nuevoInforme]').click( function(){
  
  
                let idPrueba = $(this).attr('id');
                let escuela_id = idPrueba.substr(12)
                let escuela = {escuelaId:escuela_id,
                               numero:'',
                               cue:'',
                               nombre:''
                  }
                buscarDatosEscuela(escuela)//consulta a tabla escuela... ajax.js
  
                .then(function(escuela){
                  informeNuevo(escuela)//inicia modal para carga de informe
  
                 })
                .catch(error=> console.log(error + ' Noooo'))
  
  
            });
  
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
                      informeActual.informeId=informeId
                      informeActual.escuelaId=item.escuelaId
  
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
  
            console.log("error al tratar de traer los informes para listar ");
          })
          .always(function() {
            //console.log("complete");
          });
      }else{
          //$('.trinformes'+escuelaId).remove()
  
          $('.tableinformes'+escuelaId).remove()
          $('.tableinformeM'+escuelaId).remove()
          //$('.trautoridad'+escuelaId).closest('tr').remove()
          $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');
  
          //console.log('variable existe'+existe)
          existe.stop
          //console.log('variable existe'+existe)
      }
  
      //alert('fila')
    })
  
    /**
     * Boton de Predio de cada Escuela
     */
    $('[id ^=predios],[id ^=predioM]').on('click', function(){
      let escuelaId = $(this).attr('id').substr(7)
  
  
      //alert(escuelaId)
      let click = $(this).attr('id').substr(0,7)// guarda el id del elemento donde se hizo clic, puede ser informes o informeM
  
      let existe
      let $this = $(this)
  
      if (click=='predios') {//almacena en variable existe, la clase de la tablepredios en el caso que no existe dicha tabla se guarda comno undefined
        existe = $('.tablepredios'+escuelaId).attr('class')
      }else{
      //  alert('ingresa  por informeM')
        existe = $('.tablepredioM'+escuelaId).attr('class')
        //alert(existe)
      }
  
  
      if (typeof(existe)==='undefined')
      {
        $('#pre'+escuelaId).prop('disabled',true)
  
          console.log('definicion de existe'+existe)
          let predio ='all'
          //let reports ='conectar'
          $.ajax({
            url: 'includes/mod_cen/clases/ajax/ajaxPredio.php',
            type: 'POST',
            dataType: 'json',
            data: {predio:predio,referenteId:referenteId2,escuelaId: escuelaId}
          })
          .done(function(lista) {
            $('#pre'+escuelaId).prop('disabled',false)
          let itemEscuela = 0
          let tablepredio = 0
          let cant = 0
  
  
          for (let item of lista)
          {
             tablepredio=pad(item.escuelaActual,4,0)
             //console.log('tablepredio'+tablepredio)
             cant= item.cantidad
          //  console.log('cant'+cant)
          }
  
  
           if (cant > 0) {
  // entra por aqui si en desktop hay predios cargados
              if (click=='predios') {
  
  //                console.log('item Escuela Id = '+cant)
               $('#pre'+escuelaId).parent().parent().after(`<tr class="tablepredios${tablepredio} warning"><td colspan="7"><table id='tablepredios${tablepredio}'
               class="table StyleTable">
               <thead>
                 <tr class='warningStyle'>
                   <th><h4>Comparte Predio</h4></th>
                   <th>&nbsp</th>
                   <th>&nbsp</th>
                   <th>&nbsp</th>
  
                   <th><button type='button' class='btn btn-warning' id='nuevoPredio${tablepredio}' >Agregar Nueva Institución</button></th>
  
                 </tr>
  
               </thead>
  
  
  
               <thead>
                 <tr>
                   <th>Escuela</th>
                   <th>Dirección</th>
                   <th>Número</th>
                   <th>CUE</th>
                   <th>Acción</th>
                 </tr>
               </thead>
               <tbody id='bodyPredio${tablepredio}'></tbody>`)
  
            }else{
  // <button type='button' class='btn btn-warning' id=nuevoPredio${escuelaId} >Crear Nuevo Predio</button><br>
  
  //entra por aqui si vista movil tiene informes cargados
  // ##### !!!! Revisar paddings / eliminar <br> #####
  //###### !!!!! Modal de busqueda de escuelas predios cambiar heights/paddings/margin
               $('#preM'+escuelaId).parent().after(`<div class='container'>
  
               <button type='button' class='btn btn-warning btnPredioM${tablepredio}' id="nuevoPredio${tablepredio}" >Nuevo Predio</button><br><br>
               <div class="list-group tablepredioM${tablepredio} table-responsive" id="tablepredioM${tablepredio}">
  
               <table class="table table-bordered"id="tablepredios${tablepredio}">
               <thead>
                 <tr>
                   <th>Escuela</th>
                   <th>Dirección</th>
                   <th>N°</th>
                   <th>CUE</th>
                   <th>Acción</th>
                 </tr>
               </thead>
               <tbody id='bodyPredio${tablepredio}'></tbody><div></div>`)
  
            }
  
  
          }else{   // entra por que no tiene informes cargados vista desktop
            //alert(cant)
          if (click=='predios') {
         //  console.log('item Escuela Id = '+cant)
           $('#pre'+escuelaId).parent().parent().after(`<tr class="tablepredios${escuelaId} warningStyle"><td colspan="7"><table id=tablepredios${escuelaId}
           class="table StyleTable">
           <thead>
             <tr class='warningStyle'>
               <th><h4>Predios</h4></th>
               <th>&nbsp</th>
               <th>&nbsp</th>
               <th>&nbsp</th>
               <th><button type='button' class='btn btn-warning' id=nuevoPredio${escuelaId} >Crear Nuevo Predio</button></th>
             </tr>
           </thead>
  
           <thead>
             <tr>
               <th>Escuela</th>
               <th>Dirección</th>
               <th>Numero</th>
               <th>CUE</th>
               <th>Acción</th>
             </tr>
           </thead>
           <tbody id='bodyPredio${escuelaId}'></tbody>`)
           //<tbody id='bodyPredio${item.escuelaId}'></tbody>`)
  
         }else{
           //entra por aqui si vista movil no tiene predios cargados
          //  ################# modificar estructura de tabla
           $('#preM'+escuelaId).parent().after(`<div class='container'>
           <button type='button' class='btn btn-warning btnPredioM${tablepredio}' id="nuevoPredio${tablepredio}" >Nuevo Predio</button><br><br>
           <div class="list-group tablepredioM${tablepredio} table-responsive" id="tablepredioM${tablepredio}">
  
           <table class="table table-bordered"id="tablepredios${tablepredio}">
           <thead>
             <tr>
               <th>Escuela</th>
               <th>Dirección</th>
               <th>N°</th>
               <th>CUE</th>
               <th>Acción</th>
             </tr>
           </thead>
  
           <tbody id='bodyPredio${escuelaId}'></tbody></div></div>`)
            //$('#preM'+escuelaId).parent().parent().after(`<p tableinformeM${tableinforme}" id="tableinformeM${tableinforme}">Sin informes</p><button type='button' class='btn btn-warning' id=nuevoPredio${escuelaId} >Crear Nuevo Predio1</button>`)
         }
  
       }
  
            for (let item of lista) {
                //alert(item.escuelaId)
                //console.log(item.cantidad)
              if (item.cantidad > 0) {
                let escuelaIdconCero = pad(item.escuelaActual,4,0)
                let escuela = item.escuelaId
                //alert(item.escuelaId)
                //if (click=='predios') {
                //console.log('cantidad de leido'+item.cantidadLeido)
                //$('#tablepredios'+escuelaIdconCero).find('tbody').after(`<tr class="trpredios${escuelaIdconCero}">
  
  
                $(`<tr id="predio${item.predioId}" class="trpredios${escuelaIdconCero}">
                <td>${item.nombre}</td>
                <td>${item.domicilio}</td>
                <td>${item.numero}</td>
                <td>${item.cue}</td>
                <td><a id='quitar${item.numero}${escuelaIdconCero}${item.predioId}' class='btn btn-danger'>Quitar</a></td>
                </tr>`).appendTo('#bodyPredio'+escuelaIdconCero)
              // }else{
              //   $('#tableinformeM'+escuelaIdconCero).find('div').after(`<a  class="list-group-item">
              //   <h5 class="list-group-item-heading trinformes${escuelaIdconCero}"id='if${item.informeId}'><b>${item.titulo}</b></h5>
              //   <p class="list-group-item-text">${item.fecha} Prioridad:${item.prioridad}</p><br><p class="btn-group" role="group">
              //   <button type="button" class="btn btn-default"disabled="true">Leido: ${item.cantidadLeido}</button><button type="button" disabled="true"class="btn btn-default">Resp.: ${item.cantidadRespuesta}</button></p></a>`)
              // }
  
  
              }else{
                //alert('Esta escuela no tiene informes creados')
              }
            }
  
  
            $('[id ^=nuevoPredio]').click( function(){
  
                let idPrueba = $(this).attr('id');
                let escuela_id = idPrueba.substr(11)
                let escuela = {escuelaId:escuela_id,
                               numero:'',
                               cue:'',
                               nombre:''
                  }
                 buscarDatosEscuela(escuela)//consulta a tabla escuela... ajax.js
  
                .then(function(escuela){
                  predioNuevo(escuela)//inicia modal para carga de informe
  
                 })
                .catch(error=> console.log(error + ' Noooo'))
  
  
            });
            $('[id ^=quitar]').on("click", function(){
  //console.log('quitar predio')
            //$('[id ^=quitar]').click( function(){
              quitarPredioId = $(this).attr('id').substr(14)
              //alert (quitarPredioId)
              numEscuela = $(this).attr('id').substr(6,4)
              let confirma = confirm(`Confirma que desea eliminar la escuela ${numEscuela} del Predio `)
  
              if (confirma == true) {
                $.ajax({
                  url: 'includes/mod_cen/clases/ajax/ajaxPredio.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {quitarPredioId:quitarPredioId}
                })
                .done(function(data) {
                  for (let item of data) {
                    $('#predio'+item.predioId).hide('slow/400/fast', function() {
  
                    });
                    //alert("El predio"+item.predioId+"+eliminado")
                  }
                  console.log("success");
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
              }
  
  
            })
  
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
                      informeActual.informeId=informeId
                      informeActual.escuelaId=item.escuelaId
  
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
  
            console.log("error al tratar de traer los informes para listar ");
          })
          .always(function() {
            //console.log("complete");
          });
      }else{
          //$('.trinformes'+escuelaId).remove()
  
          $('.tablepredios'+escuelaId).remove()
          $('.tablepredioM'+escuelaId).remove()
          $( '.btnPredioM'+escuelaId).remove()
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
            <th><h4>RTI</h4></th>
           <th>&nbsp</th>
           <th>&nbsp</th>
           <th>&nbsp</th>
           <th>&nbsp</th>
  
  
           </tr>
          </thead>
  
  
            <table id=tableRti${tableAuto} class="table StyleTable1">
  
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acción</th>
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
      console.log('escuelaId de row'+escuelaId)
      let $this = $(this)
      let existeAutoridad = $('.tableAutoridades'+escuelaId).attr('class')
  
      if (typeof(existeAutoridad)==='undefined') {
          $this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
          let all ='all'
          $.ajax({
            url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
            type: 'POST',
            dataType: 'json',
            data: {all:all,escuelaId: escuelaId}
          })
          .done(function(lista) {
            //alert(lista)
            let tableinforme = 0
  
            for (let item of lista) {
                tableAuto=pad(item.escuelaId,4,0)
  
            }
            console.log('tableAuto'+tableAuto)
            $('#autoridad'+escuelaId).parent().parent().after(`<tr class="tableAutoridades${tableAuto} success"><td colspan="6"><table class="table StyleTable1">
            <thead>
            <tr class='success'>
            <th><h4>Autoridades</h4></th>
            <th>&nbsp</th>
            <th>&nbsp</th>
            <th>&nbsp</th>
            <th>&nbsp</th>
  
  
           </tr>
           </thead>
  
  
          <table id=tableAutoridades${tableAuto} class="table StyleTable1">
  
          <thead>
          <tr>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Acción</th>
              </tr>
            </thead>
            `)
            let itemEscuela = 0
  
            for (let item of lista) {
  
              let escuelaIdconCero = pad(item.escuelaId,4,0)
              let escuela = item.escuelaId
  
              if (item.id != '0') {
  
                $('#tableAutoridades'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
                <td>${item.cargo}</td>
                <td><a id='eInforme' href=''>${item.apellido},${item.nombre}</a></td>
                <td><a id='eInforme' href=''>${item.telefono}</a></td>
                <td><a id='eInforme' href=''>${item.email}</a></td>
                <td id='${item.escuelaId}'><img class='img-responsive' src='img/iconos/lapiz (4).png'  id='idAuto${item.idCargo}'></td>
                </tr>`)
                //</tbody></table>`)
                $('.trautoridad'+item.escuelaId).hide()
                $('.trautoridad'+item.escuelaId).fadeIn('slideUp')
               }else{
                 $('#tableAutoridades'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
                 <td>${item.cargo}</td>
                 <td colspan="3">Sin Asignar</td>
                 <td id='${item.escuelaId}'><img class='img-responsive' src='img/iconos/lapiz (4).png'  id='idAuto${item.idCargo}'></td>
                 </tr>`)
              }
            }
  
            //$('#tableAutoridades'+escuelaIdconCero).find('thead').after(`</tbody></table>`)
  
            $('[id ^=idAuto]').click( function(){
              //alert('hola autoridad')
                let idAutoridad = $(this).attr('id')
                $('#tipoId').val(idAutoridad)
  
                let escuelaActual= $(this).parent().attr('id')
  
                console.log(idAutoridad)
                formPersona22()
  
  
                function formPersona22()
                {
                  //let escuelaId =  $('#escuelaId').val()
                  escuelaId=escuelaActual
                  console.log(escuelaId)
                  $('#padreIr').append(`
                    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Datos personales</h4>
                          </div>
  
                          <div class="modal-body" id="modal-body" >
                          <form action="" method="post" id="form1">
                            <div class="form-group">
                              <div class="col-md-12">
                                <div class="col-md-6"><label for="" class="control-label validaciond">Nro. de Documento</label>
                                <input  class="form-control" name="txtdni" type="text" maxlength="8" id="txtdni" autofocus="autofocus" required />
                                <span class="hide errord">Campo Obligatorio. Ingrese solo números (8)</span>
                                </div>
                                <div class="col-md-6 buscar"><br>
                                <button type="button" class="btn btn-danger" id="btnBuscarDni">Buscar</button>
  
                                </div>
  
                              </div>
                              <div class="col-md-12">
                                  <input name="txtidpersona" type="hidden" id="statusDni" value="0" />
                                  <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                                  <input name="txtidesacuela" type="hidden" id="txtescuelaid" value="${escuelaId}"/>
                                  <input type="hidden" name="iddirector" id="iddirector" value="" />
  
                          ￼    </div>
                            </div>
                            <div class="form-group ctxtapellido">
                              <div class="col-md-12">
                                <label for="" class="control-label validacion">Apellido</label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" placeholder="Ingrese solo letras" type="text" name="txtapellido" id="txtapellido" class="hades" required />
                                  <span class="hide error">Campo Obligatorio. Ingrese solo letras</span>
                              </div>
  
                            </div>
  
                            <div class="form-group ctxtnombre">
                              <div class="col-md-12">
                                <label for="" class="control-label validacionn">Nombre</label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" type="text" name="txtnombre" placeholder="Ingrese solo letras" id="txtnombre" class="hades" required />
                                <span class="hide errorn">Campo Obligatorio. Ingrese solo letras</span>
                              </div>
                            </div>
  
                            <div class="form-group ctxtcuil ">
                              <div class="col-md-12">
                                <label for="" class="control-label validacionc">CUIL</label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" type="number" maxlength="11" placeholder="Ingrese solo Números sin guiones" name="txtcuil" id="txtcuil" class="hades" required/>
                                <span class="hide errorc">Campo Obligatorio. Ingrese solo números sin guiones.</span>
                              </div>
                            </div>
  
                            <div class="form-group clocalidad ">
                              <div class="col-md-12">
                                <label for="" class="control-label validacionl">Localidad</label>
                              </div>
                              <div class="col-md-12">
                                <select class="form-control" name="localidad" id="localidad">
  
                                <option value="0">Seleccione...</option>
  
  
                                `)
                                $.ajax({
                                  url: 'includes/mod_cen/clases/ajax/ajaxLocalidad.php',
                                  type: 'POST',
                                  dataType: 'json',
                                  data: {local: 'local'}
                                })
                                .done(function(lista) {
                                  for (let item of lista) {
                                    $('#localidad').append(`<option value="${item.id}">${item.nombre}</option>`)
                                  }
                                  console.log("success");
                                })
                                .fail(function() {
                                  console.log("error");
                                })
                                .always(function() {
                                  console.log("complete");
                                });
  
  
                                $("#modal-body").append(`
  
                                    </select>
  
                              </div>
  
                            </div>
  
                            <div class="form-group ctxttelefonoM">
                              <div class="col-md-12">
                                <label for="" class="control-label validaciont">Teléfono </label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" type="number" placeholder="Ingrese solo números sin puntos" name="txttelefonoM" id="txttelefonoM" class="hades" required />
                                <span class="hide errort">Campo Obligatorio. Ingrese telefono, solo números sin puntos</span>
                              </div>
                            </div>
  
                            <div class="form-group ctxtemail">
                              <div class="col-md-12">
                                <label for="" class="control-label validacione">Email </label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" placeholder="Ingrese email con formato válido. Ej: email@gmail.com" type="text" name="txtemail" id="txtemail" class="hades" required />
                                <span class="hide errore">Campo Obligatorio. Ingrese email con formato válido. Ej: email@gmail.com</span>
                              </div>
                            </div>
  
                          </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    `)
                  $('#myModal').modal('show')
                  $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad').hide()
                  $('#myModal').on('hide.bs.modal', function(){
                    $('#myModal').remove()
                  })
  
                  $('#myModal').on('shown.bs.modal', function(){
                    $('#txtdni').focus()
  
                    let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                    let escuelaId = $('#txtescuelaid').val()
                    console.log('desde txtescuelaid'+escuelaId)
                    let tipoId = $('#tipoId').val().substr(6)
                    $('#btnEditar').hide()
                      $('#btnSave').hide()
                    //let idPrueba = $(this).attr('id');
                    //let tipoId = $('#idAuto').attr('id')
  
                    console.log('desde tipoId'+tipoId)
                    let search ='search'
                    $.ajax({
                      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                      type: 'POST',
                      dataType: 'json',
                      data: {search:search,escuelaId: escuelaId,tipoId:tipoId}
                    })
                    .done(function(lista) {
                      for (let item of lista) {
  
                        if (item.id=='0') {
                          console.log('no encontrado')
                          //  $('#btnSave').show()
                          camposOcultos.hide()
                          // $('#btnEditar').hide()
                          // $('#btnSave').hide()
                          $('#statusDni').val('0')
                          $('#txtidpersona').val('')
                          $('#txtnombre').val('')
                          $('#txtapellido').val('')
                          $('#txtcuil').val('')
                          $('#txttelefonoM').val('')
                          $('#txtemail').val('')
                          $('#localidad').val('0')
                        }else{
                          $('#btnEditar').show()
                          $('#statusDni').val('1')
                          console.log('encontrado')
                          camposOcultos.show()
                          $('#btnBuscarDni').hide()
                          $('#btnSave').hide()
                          $('.buscar').append('<button type="button" class="btn btn-primary" id="btnNew">Nueva Autoridad</button>')
  
                          $('#btnNew').click(function(event) {
                            $(this).hide()
                            camposOcultos.hide()
                            $(' #btnBuscarDni').show()
                            $('#btnEditar').hide()
                            $('#statusDni, #localidad').val('0')
                            $('#txtdni').val('').focus()
                            $('#txtidpersona, #txtnombre, #txtapellido, #txtcuil, #txttelefonoM, #txtemail').val('')
                          });
  
  
                          $('#txtdni').val(item.dni)
                          $('#txtidpersona').val(item.id)
                          $('#txtnombre').val(item.nombre)
                          $('#txtapellido').val(item.apellido)
                          $('#txtcuil').val(item.cuil)
                          $('#txttelefonoM').val(item.telefono)
                          $('#txtemail').val(item.email)
                          let selected = $('#localidad option:selected').val();
                          $("#localidad option[value="+ selected +"]").attr("selected",false);
                          console.log(selected)
                          $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                          //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
                  })
  
                  $('#btnSave, #btnEditar').on('click',function(){
  
  
  
                    console.log('boton guardar')
  
                    // $('#btnEditar').hide()
                    //   $('#btnSave').hide()
                    let id = $('#txtidpersona').val()
                    let nombre = $('#txtnombre').val()
                    let apellido = $('#txtapellido').val()
                    let cuil = $('#txtcuil').val()
                    let telefonoM = $('#txttelefonoM').val()
                    let email = $('#txtemail').val()
                    let localidad = $('#localidad').val()
                    let txtdni = $('#txtdni').val()
                    let escuelaId = $('#txtescuelaid').val()
                    let tipoId = $('#tipoId').val()
                    //let tipoId = $('#modulo').val()
                    console.log('txtdni' + txtdni)
                    let update = $('#statusDni').val()
  
                    console.log('Estado de update '+update)
  
  
                      ////////////////////////////////////////////////
                if (validarpersona()) {
            //   alert ('validacion correcta')
  
                  let tipoIdSave = $('#tipoId').val().substr(6)
  
                    $.ajax({
                      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                            btnSave:'btnSave',
                            escuelaId:escuelaId,
                            tipoId:tipoIdSave,
                            update: update,
                            personaId:id,
                            nombre:nombre,
                            apellido:apellido,
                            txtdni:txtdni,
                            cuil:cuil,
                            telefonoM:telefonoM,
                            email:email,
                            localidad:localidad}
                    })
                    .done(function(lista) {
  
  
                      for (let item of lista) {
                        if (item.status=='new') {
  
  
                          console.log('se creo con exito')
                        }else{
                          console.log('se actualizo con exito')
                        }
                          //$('#myModal').remove()
                          $('#myModal').modal('hide')
  
                      }
                      console.log("success");
                    })
                    .fail(function() {
                      console.log("error Guardar");
                    })
                    .always(function() {
                      console.log("complete");
                    });
  
                }
                    //$('#myModal').remove()
                    //$('#myModal').hide()
  
                  })
  
  
  
  
  
                  $('#btnBuscarDni').click(function() {
                    let dni = $('#txtdni').val()
                      let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                      camposOcultos.show()
  
  
                    //$('#localidad option:selected').remove();
  
                    //$json = json_encode($arrayPrincipal);
                    $.ajax({
                      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                      type: 'POST',
                      dataType: 'json',
                      data: {dni: dni}
                    })
                    .done(function(lista) {
                      for (let item of lista) {
  
                        if (item.id=='0') {
                          console.log('no encontrado')
                          $('#btnSave').show()
  
                          $('#statusDni').val('0')
                          $('#txtidpersona').val('')
                          $('#txtnombre').val('')
                          $('#txtapellido').val('')
                          $('#txtcuil').val('')
                          $('#txttelefonoM').val('')
                          $('#txtemail').val('')
                          $('#localidad').val('0')
                        }else{
                          $('#statusDni').val('1')
                          $('#btnSave').show()
                          console.log('encontrado')
  
                          $('#txtidpersona').val(item.id)
                          $('#txtnombre').val(item.nombre)
                          $('#txtapellido').val(item.apellido)
                          $('#txtcuil').val(item.cuil)
                          $('#txttelefonoM').val(item.telefono)
                          $('#txtemail').val(item.email)
                          let selected = $('#localidad option:selected').val();
                          $("#localidad option[value="+ selected +"]").attr("selected",false);
                          console.log(selected)
                          $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                          //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
  
                    console.log('hola dni')
                  });
                }
                //   console.log('llego a idauto')
               })
  
  
            console.log("success");
          })
  
          .fail( function( jqXHR, textStatus, errorThrown ) {
            if (jqXHR.status === 0) {
  
     alert('Not connect: Verify Network.');
  
   } else if (jqXHR.status == 404) {
  
     alert('Requested page not found [404]');
  
   } else if (jqXHR.status == 500) {
  
     alert('Internal Server Error [500].');
  
   } else if (textStatus === 'parsererror') {
  
     alert('Requested JSON parse failed.');
  
   } else if (textStatus === 'timeout') {
  
     alert('Time out error.');
  
   } else if (textStatus === 'abort') {
  
     alert('Ajax request aborted.');
  
   } else {
  
     alert('Uncaught Error: ' + jqXHR.responseText);
  
   }
  
            console.log("erroraaaa");
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
  
  //////////////////////autoridad movil/////////////
  
            $('[id ^=autorM]').click( function(){
              //alert('hola autoridad')
                let idAutoridad = $(this).attr('id')
          //    console.log('id autoridad'+idAutoridad)
           $('#tipoId').val(idAutoridad)
          console.log('tipo autoridad' + $('#tipoId').val())
                let escuelaActual= $(this).parent().attr('id')
  
                //console.log('escuela'+escuelaActual)
                formPersona22()
  
  
                function formPersona22()
                {
                  //let escuelaId =  $('#escuelaId').val()
                  escuelaId=escuelaActual
                  console.log('holaa'+escuelaId)
                  $('#padreIr').append(`
                    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Datos personales</h4>
                          </div>
  
                          <div class="modal-body" id="modal-body" >
                          <form action="" method="post" id="form1">
                            <div class="form-group">
                              <div class="col-md-12">
                                <div class="col-md-6"><label for="" class="control-label validaciond">Nro. de Documento</label>
                                <input  class="form-control" name="txtdni" type="text" maxlength="8" id="txtdni" autofocus="autofocus" required />
                                <span class="hide errord">Campo Obligatorio. Ingrese solo números (8)</span>
                                </div>
                                <div class="col-md-6 buscar"><br>
                                <button type="button" class="btn btn-danger" id="btnBuscarDni">Buscar</button>
  
                                </div>
  
                              </div>
                              <div class="col-md-12">
                                  <input name="txtidpersona" type="hidden" id="statusDni" value="0" />
                                  <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                                  <input name="txtidesacuela" type="hidden" id="txtescuelaid" value="${escuelaId}"/>
                                  <input type="hidden" name="iddirector" id="iddirector" value="" />
  
                          ￼    </div>
                            </div>
                            <div class="form-group ctxtapellido">
                              <div class="col-md-12">
                                <label for="" class="control-label validacion">Apellido</label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" placeholder="Ingrese solo letras" type="text" name="txtapellido" id="txtapellido" class="hades" required />
                                  <span class="hide error">Campo Obligatorio. Ingrese solo letras</span>
                              </div>
  
                            </div>
  
                            <div class="form-group ctxtnombre">
                              <div class="col-md-12">
                                <label for="" class="control-label validacionn">Nombre</label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" type="text" name="txtnombre" placeholder="Ingrese solo letras" id="txtnombre" class="hades" required />
                                <span class="hide errorn">Campo Obligatorio. Ingrese solo letras</span>
                              </div>
                            </div>
  
                            <div class="form-group ctxtcuil ">
                              <div class="col-md-12">
                                <label for="" class="control-label validacionc">CUIL</label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" type="number" maxlength="11" placeholder="Ingrese solo Números sin guiones" name="txtcuil" id="txtcuil" class="hades" required/>
                                <span class="hide errorc">Campo Obligatorio. Ingrese solo números sin guiones.</span>
                              </div>
                            </div>
  
                            <div class="form-group clocalidad ">
                              <div class="col-md-12">
                                <label for="" class="control-label validacionl">Localidad</label>
                              </div>
                              <div class="col-md-12">
                                <select class="form-control" name="localidad" id="localidad">
  
                                <option value="0">Seleccione...</option>
  
  
                                `)
                                $.ajax({
                                  url: 'includes/mod_cen/clases/ajax/ajaxLocalidad.php',
                                  type: 'POST',
                                  dataType: 'json',
                                  data: {local: 'local'}
                                })
                                .done(function(lista) {
                                  for (let item of lista) {
                                    $('#localidad').append(`<option value="${item.id}">${item.nombre}</option>`)
                                  }
                                  console.log("success");
                                })
                                .fail(function() {
                                  console.log("error");
                                })
                                .always(function() {
                                  console.log("complete");
                                });
  
  
                                $("#modal-body").append(`
  
                                    </select>
  
                              </div>
  
                            </div>
  
                            <div class="form-group ctxttelefonoM">
                              <div class="col-md-12">
                                <label for="" class="control-label validaciont">Teléfono </label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" type="number" placeholder="Ingrese solo números sin puntos" name="txttelefonoM" id="txttelefonoM" class="hades" required />
                                <span class="hide errort">Campo Obligatorio. Ingrese telefono, solo números sin puntos</span>
                              </div>
                            </div>
  
                            <div class="form-group ctxtemail">
                              <div class="col-md-12">
                                <label for="" class="control-label validacione">Email </label>
                              </div>
                              <div class="col-md-12">
                                <input class="form-control" placeholder="Ingrese email con formato válido. Ej: email@gmail.com" type="text" name="txtemail" id="txtemail" class="hades" required />
                                <span class="hide errore">Campo Obligatorio. Ingrese email con formato válido. Ej: email@gmail.com</span>
                              </div>
                            </div>
  
                          </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    `)
                  $('#myModal').modal('show')
                  $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad').hide()
                  $('#myModal').on('hide.bs.modal', function(){
                    $('#myModal').remove()
                  })
  
                  $('#myModal').on('shown.bs.modal', function(){
                    $('#txtdni').focus()
  
                    let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                    let escuelaId = $('#txtescuelaid').val()
  
                    console.log('desde txtescuelaid'+escuelaId)
                    let tipoId = $('#tipoId').val().substr(6)
                    $('#btnEditar').hide()
                      $('#btnSave').hide()
                    //let idPrueba = $(this).attr('id');
                    //let tipoId = $('#idAuto').attr('id')
                    console.log( 'tipo id de modal'+tipoId)
  
                    console.log('desde tipoId'+tipoId)
                    let search ='search'
                    $.ajax({
                      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                      type: 'POST',
                      dataType: 'json',
                      data: {search:search,escuelaId: escuelaId,tipoId:tipoId}
                    })
                    .done(function(lista) {
                      for (let item of lista) {
  
                        if (item.id=='0') {
                          console.log('no encontrado')
                          //  $('#btnSave').show()
                          camposOcultos.hide()
                          // $('#btnEditar').hide()
                          // $('#btnSave').hide()
                          $('#statusDni').val('0')
                          $('#txtidpersona').val('')
                          $('#txtnombre').val('')
                          $('#txtapellido').val('')
                          $('#txtcuil').val('')
                          $('#txttelefonoM').val('')
                          $('#txtemail').val('')
                          $('#localidad').val('0')
                        }else{
                          $('#btnEditar').show()
                          $('#statusDni').val('1')
                          console.log('encontrado')
                          camposOcultos.show()
                          $('#btnBuscarDni').hide()
                          $('#btnSave').hide()
                          $('.buscar').append('<button type="button" class="btn btn-primary" id="btnNew">Nueva Autoridad</button>')
  
                          $('#btnNew').click(function(event) {
                            $(this).hide()
                            camposOcultos.hide()
                            $(' #btnBuscarDni').show()
                            $('#btnEditar').hide()
                            $('#statusDni, #localidad').val('0')
                            $('#txtdni').val('').focus()
                            $('#txtidpersona, #txtnombre, #txtapellido, #txtcuil, #txttelefonoM, #txtemail').val('')
                          });
  
  
                          $('#txtdni').val(item.dni)
                          $('#txtidpersona').val(item.id)
                          $('#txtnombre').val(item.nombre)
                          $('#txtapellido').val(item.apellido)
                          $('#txtcuil').val(item.cuil)
                          $('#txttelefonoM').val(item.telefono)
                          $('#txtemail').val(item.email)
                          let selected = $('#localidad option:selected').val();
                          $("#localidad option[value="+ selected +"]").attr("selected",false);
                          console.log(selected)
                          $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                          //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
                  })
  
                  $('#btnSave, #btnEditar').on('click',function(){
  
  
  
                    console.log('boton guardar')
  
                    // $('#btnEditar').hide()
                    //   $('#btnSave').hide()
                    let id = $('#txtidpersona').val()
                    let nombre = $('#txtnombre').val()
                    let apellido = $('#txtapellido').val()
                    let cuil = $('#txtcuil').val()
                    let telefonoM = $('#txttelefonoM').val()
                    let email = $('#txtemail').val()
                    let localidad = $('#localidad').val()
                    let txtdni = $('#txtdni').val()
                    let escuelaId = $('#txtescuelaid').val()
                    let tipoId = $('#tipoId').val()
                    //let tipoId = $('#modulo').val()
                    console.log('txtdni' + txtdni)
                    let update = $('#statusDni').val()
  
                    console.log('Estado de update '+update)
  
  
                      ////////////////////////////////////////////////
                if (validarpersona()) {
            //   alert ('validacion correcta')
  
                  let tipoIdSave = $('#tipoId').val().substr(6)
  
                    $.ajax({
                      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                            btnSave:'btnSave',
                            escuelaId:escuelaId,
                            tipoId:tipoIdSave,
                            update: update,
                            personaId:id,
                            nombre:nombre,
                            apellido:apellido,
                            txtdni:txtdni,
                            cuil:cuil,
                            telefonoM:telefonoM,
                            email:email,
                            localidad:localidad}
                    })
                    .done(function(lista) {
  
  
                      for (let item of lista) {
                        if (item.status=='new') {
  
  
                          console.log('se creo con exito')
                        }else{
                          console.log('se actualizo con exito')
                        }
                          //$('#myModal').remove()
                          $('#myModal').modal('hide')
  
                      }
                      console.log("success");
                    })
                    .fail(function() {
                      console.log("error Guardar");
                    })
                    .always(function() {
                      console.log("complete");
                    });
  
                }
                    //$('#myModal').remove()
                    //$('#myModal').hide()
  
                  })
  
  
  
  
  
                  $('#btnBuscarDni').click(function() {
                    let dni = $('#txtdni').val()
                      let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                      camposOcultos.show()
  
  
                    //$('#localidad option:selected').remove();
  
                    //$json = json_encode($arrayPrincipal);
                    $.ajax({
                      url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                      type: 'POST',
                      dataType: 'json',
                      data: {dni: dni}
                    })
                    .done(function(lista) {
                      for (let item of lista) {
  
                        if (item.id=='0') {
                          console.log('no encontrado')
                          $('#btnSave').show()
  
                          $('#statusDni').val('0')
                          $('#txtidpersona').val('')
                          $('#txtnombre').val('')
                          $('#txtapellido').val('')
                          $('#txtcuil').val('')
                          $('#txttelefonoM').val('')
                          $('#txtemail').val('')
                          $('#localidad').val('0')
                        }else{
                          $('#statusDni').val('1')
                          $('#btnSave').show()
                          console.log('encontrado')
  
                          $('#txtidpersona').val(item.id)
                          $('#txtnombre').val(item.nombre)
                          $('#txtapellido').val(item.apellido)
                          $('#txtcuil').val(item.cuil)
                          $('#txttelefonoM').val(item.telefono)
                          $('#txtemail').val(item.email)
                          let selected = $('#localidad option:selected').val();
                          $("#localidad option[value="+ selected +"]").attr("selected",false);
                          console.log(selected)
                          $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                          //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
  
                    console.log('hola dni')
                  });
                }
                //   console.log('llego a idauto')
              })//fin vista movil

        //evento al hacer click en el td con id que inicia en row // corresponde a Carreras
        $('[id ^=carr]').on('click', function(){
          
          let escuelaId = $(this).attr('id').substr(4)
          console.log('escuelaId de carr'+escuelaId)
          let $this = $(this)
          let existeCarrera = $('.tableCarreras'+escuelaId).attr('class')
      
          if (typeof(existeCarrera)==='undefined') {//si no existe la tabla  - tablecarreras
              $this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
              let all ='all'
              $.ajax({
                url: 'includes/mod_cen/clases/ajax/ajaxCarreras.php',
                type: 'POST',
                dataType: 'json',
                data: {all:all,escuelaId: escuelaId}
              })
              .done(function(lista) {
                //alert(lista)
                let tableinforme = 0
      
                for (let item of lista) {
                    tableCarrera=pad(item.escuelaId,4,0)
      
                }
                console.log('tableCarrera'+tableCarrera)
                $('#carr'+escuelaId).parent().parent().after(`<tr class="tableCarreras${tableCarrera} success"><td colspan="6"><table class="table StyleTable1">
                <thead>
                <tr class='success'>
                <th><h4>Carreras</h4></th>
                <th>&nbsp</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
                <th>&nbsp</th>
      
      
               </tr>
               </thead>
      
      
              <table id=tableCarreras${tableCarrera} class="table StyleTable1">
      
              <thead>
              <tr>                    
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Cierre</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                `)
                let itemEscuela = 0
      
                for (let item of lista) {
      
                  let escuelaIdconCero = pad(item.escuelaId,4,0)
                  let escuela = item.escuelaId
      
                  if (item.id != '0') {
      
                    $('#tableCarreras'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
                    <td>${item.id}</td>
                    <td><a id='eInforme' href=''>${item.nombre}</a></td>
                    <td><a id='eInforme' href=''>${item.fecha_inicio}</a></td>
                    <td><a id='eInforme' href=''>${item.fecha_final}</a></td>
                    <td><a id='eInforme' href=''>${item.estado}</a></td>
                    <td id='${item.escuelaId}'><img class='img-responsive' src='img/iconos/lapiz (4).png'  id='idCarrera${item.idCarrera}'></td>
                    </tr>`)
                    //</tbody></table>`)
                    $('.trautoridad'+item.escuelaId).hide()
                    $('.trautoridad'+item.escuelaId).fadeIn('slideUp')
                   }else{
                     $('#tableCarreras'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
                     <td>${item.id}</td>
                     <td colspan="3">Sin Asignar</td>
                     <td id='${item.escuelaId}'><img class='img-responsive' src='img/iconos/lapiz (4).png'  id='idAuto${item.idCarrera}'></td>
                     </tr>`)
                  }
                }
      
                //$('#tableAutoridades'+escuelaIdconCero).find('thead').after(`</tbody></table>`)
      
                $('[id ^=idCarrera]').click( function(){
                  //alert('hola autoridad')
                    let idCarrera = $(this).attr('id')
                    $('#tipoId').val(idCarrera)
      
                    let escuelaActual= $(this).parent().attr('id')
      
                    console.log(idAutoridad)
                    formCarrera()
      
      
                    function formCarrera()
                    {
                      //let escuelaId =  $('#escuelaId').val()
                      escuelaId=escuelaActual
                      console.log(escuelaId)
                      $('#padreIr').append(`
                        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Datos personales</h4>
                              </div>
      
                              <div class="modal-body" id="modal-body" >
                              <form action="" method="post" id="form1">
                                <div class="form-group">
                                  <div class="col-md-12">
                                    <div class="col-md-6"><label for="" class="control-label validaciond">Nro. de Documento</label>
                                    <input  class="form-control" name="txtdni" type="text" maxlength="8" id="txtdni" autofocus="autofocus" required />
                                    <span class="hide errord">Campo Obligatorio. Ingrese solo números (8)</span>
                                    </div>
                                    <div class="col-md-6 buscar"><br>
                                    <button type="button" class="btn btn-danger" id="btnBuscarDni">Buscar</button>
      
                                    </div>
      
                                  </div>
                                  <div class="col-md-12">
                                      <input name="txtidpersona" type="hidden" id="statusDni" value="0" />
                                      <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                                      <input name="txtidesacuela" type="hidden" id="txtescuelaid" value="${escuelaId}"/>
                                      <input type="hidden" name="iddirector" id="iddirector" value="" />
      
                              ￼    </div>
                                </div>
                                <div class="form-group ctxtapellido">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacion">Nombre Carrera</label>
                                  </div>
                                  <div class="col-md-12">
                                    <select id="selectCarrera">
                                    </select>
                                  </div>
      
                                </div>
      
                                <div class="form-group ctxtnombre">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacionn">Fecha de Inicio</label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" type="text" name="txtnombre" placeholder="Ingrese solo letras" id="txtnombre" class="hades" required />
                                    <span class="hide errorn">Campo Obligatorio. Ingrese solo letras</span>
                                  </div>
                                </div>
      
                                <div class="form-group ctxtcuil ">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacionc">Fecha Final</label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" type="number" maxlength="11" placeholder="Ingrese solo Números sin guiones" name="txtcuil" id="txtcuil" class="hades" required/>
                                    <span class="hide errorc">Campo Obligatorio. Ingrese solo números sin guiones.</span>
                                  </div>
                                </div>
      
                                <div class="form-group clocalidad ">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacionl">Estado</label>
                                  </div>
                                  <div class="col-md-12">
                                    <select class="form-control" name="localidad" id="localidad">
      
                                    <option value="0">Seleccione...</option>
      
      
                                    `)
                                    $.ajax({
                                      url: 'includes/mod_cen/clases/ajax/ajaxLocalidad.php',
                                      type: 'POST',
                                      dataType: 'json',
                                      data: {local: 'local'}
                                    })
                                    .done(function(lista) {
                                      for (let item of lista) {
                                        $('#localidad').append(`<option value="${item.id}">${item.nombre}</option>`)
                                      }
                                      console.log("success");
                                    })
                                    .fail(function() {
                                      console.log("error");
                                    })
                                    .always(function() {
                                      console.log("complete");
                                    });
      
      
                                    $("#modal-body").append(`
      
                                        </select>
      
                                  </div>
      
                                </div>    
                                
                              </form>
                              </div>
                              <div class="modal-footer">                                
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        `)
                      $('#myModal').modal('show')
                      $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad').hide()
                      $('#myModal').on('hide.bs.modal', function(){
                        $('#myModal').remove()
                      })
      
                      $('#myModal').on('shown.bs.modal', function(){
                        $('#txtdni').focus()
      
                        let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                        let escuelaId = $('#txtescuelaid').val()
                        console.log('desde txtescuelaid'+escuelaId)
                        let tipoId = $('#tipoId').val().substr(6)
                        $('#btnEditar').hide()
                          $('#btnSave').hide()
                        //let idPrueba = $(this).attr('id');
                        //let tipoId = $('#idAuto').attr('id')
      
                        console.log('desde tipoId'+tipoId)
                        let search ='search'
                        $.ajax({
                          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {search:search,escuelaId: escuelaId,tipoId:tipoId}
                        })
                        .done(function(lista) {
                          for (let item of lista) {
      
                            if (item.id=='0') {
                              console.log('no encontrado')
                              //  $('#btnSave').show()
                              camposOcultos.hide()
                              // $('#btnEditar').hide()
                              // $('#btnSave').hide()
                              $('#statusDni').val('0')
                              $('#txtidpersona').val('')
                              $('#txtnombre').val('')
                              $('#txtapellido').val('')
                              $('#txtcuil').val('')
                              $('#txttelefonoM').val('')
                              $('#txtemail').val('')
                              $('#localidad').val('0')
                            }else{
                              $('#btnEditar').show()
                              $('#statusDni').val('1')
                              console.log('encontrado')
                              camposOcultos.show()
                              $('#btnBuscarDni').hide()
                              $('#btnSave').hide()
                              $('.buscar').append('<button type="button" class="btn btn-primary" id="btnNew">Nueva Autoridad</button>')
      
                              $('#btnNew').click(function(event) {
                                $(this).hide()
                                camposOcultos.hide()
                                $(' #btnBuscarDni').show()
                                $('#btnEditar').hide()
                                $('#statusDni, #localidad').val('0')
                                $('#txtdni').val('').focus()
                                $('#txtidpersona, #txtnombre, #txtapellido, #txtcuil, #txttelefonoM, #txtemail').val('')
                              });
      
      
                              $('#txtdni').val(item.dni)
                              $('#txtidpersona').val(item.id)
                              $('#txtnombre').val(item.nombre)
                              $('#txtapellido').val(item.apellido)
                              $('#txtcuil').val(item.cuil)
                              $('#txttelefonoM').val(item.telefono)
                              $('#txtemail').val(item.email)
                              let selected = $('#localidad option:selected').val();
                              $("#localidad option[value="+ selected +"]").attr("selected",false);
                              console.log(selected)
                              $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                              //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
                      })
      
                      $('#btnSave, #btnEditar').on('click',function(){
                        console.log('boton guardar')
                             let id = $('#txtidpersona').val()
                        let nombre = $('#txtnombre').val()
                        let apellido = $('#txtapellido').val()
                        let cuil = $('#txtcuil').val()
                        let telefonoM = $('#txttelefonoM').val()
                        let email = $('#txtemail').val()
                        let localidad = $('#localidad').val()
                        let txtdni = $('#txtdni').val()
                        let escuelaId = $('#txtescuelaid').val()
                        let tipoId = $('#tipoId').val()
                        //let tipoId = $('#modulo').val()
                        console.log('txtdni' + txtdni)
                        let update = $('#statusDni').val()
      
                        console.log('Estado de update '+update)
      
      
                          ////////////////////////////////////////////////
                    if (validarpersona()) {
                //   alert ('validacion correcta')
      
                      let tipoIdSave = $('#tipoId').val().substr(6)
      
                        $.ajax({
                          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {
                                btnSave:'btnSave',
                                escuelaId:escuelaId,
                                tipoId:tipoIdSave,
                                update: update,
                                personaId:id,
                                nombre:nombre,
                                apellido:apellido,
                                txtdni:txtdni,
                                cuil:cuil,
                                telefonoM:telefonoM,
                                email:email,
                                localidad:localidad}
                        })
                        .done(function(lista) {
      
      
                          for (let item of lista) {
                            if (item.status=='new') {
      
      
                              console.log('se creo con exito')
                            }else{
                              console.log('se actualizo con exito')
                            }
                              //$('#myModal').remove()
                              $('#myModal').modal('hide')
      
                          }
                          console.log("success");
                        })
                        .fail(function() {
                          console.log("error Guardar");
                        })
                        .always(function() {
                          console.log("complete");
                        });
      
                    }
                        //$('#myModal').remove()
                        //$('#myModal').hide()
      
                      })
      
      
      
      
      
                      $('#btnBuscarDni').click(function() {
                        let dni = $('#txtdni').val()
                          let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                          camposOcultos.show()
      
      
                        //$('#localidad option:selected').remove();
      
                        //$json = json_encode($arrayPrincipal);
                        $.ajax({
                          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {dni: dni}
                        })
                        .done(function(lista) {
                          for (let item of lista) {
      
                            if (item.id=='0') {
                              console.log('no encontrado')
                              $('#btnSave').show()
      
                              $('#statusDni').val('0')
                              $('#txtidpersona').val('')
                              $('#txtnombre').val('')
                              $('#txtapellido').val('')
                              $('#txtcuil').val('')
                              $('#txttelefonoM').val('')
                              $('#txtemail').val('')
                              $('#localidad').val('0')
                            }else{
                              $('#statusDni').val('1')
                              $('#btnSave').show()
                              console.log('encontrado')
      
                              $('#txtidpersona').val(item.id)
                              $('#txtnombre').val(item.nombre)
                              $('#txtapellido').val(item.apellido)
                              $('#txtcuil').val(item.cuil)
                              $('#txttelefonoM').val(item.telefono)
                              $('#txtemail').val(item.email)
                              let selected = $('#localidad option:selected').val();
                              $("#localidad option[value="+ selected +"]").attr("selected",false);
                              console.log(selected)
                              $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                              //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
      
                        console.log('hola dni')
                      });
                    }
                    //   console.log('llego a idauto')
                   })
      
      
                console.log("success");
              })
      
              .fail( function( jqXHR, textStatus, errorThrown ) {
                if (jqXHR.status === 0) {
      
         alert('Not connect: Verify Network.');
      
       } else if (jqXHR.status == 404) {
      
         alert('Requested page not found [404]');
      
       } else if (jqXHR.status == 500) {
      
         alert('Internal Server Error [500].');
      
       } else if (textStatus === 'parsererror') {
      
         alert('Requested JSON parse failed.');
      
       } else if (textStatus === 'timeout') {
      
         alert('Time out error.');
      
       } else if (textStatus === 'abort') {
      
         alert('Ajax request aborted.');
      
       } else {
      
         alert('Uncaught Error: ' + jqXHR.responseText);
      
       }
      
                console.log("erroraaaa");
              })
              .always(function() {
                console.log("complete");
              });
          }else{
      
              $('.tableCarreras'+escuelaId).remove()
              //$('.trautoridad'+escuelaId).closest('tr').remove()
              $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');
      
              //console.log(existe)
          }
      
        })//fin de clic en Carreras 'id= carr'
      
      //////////////////////autoridad movil/////////////
      
                $('[id ^=autorM]').click( function(){
                  //alert('hola autoridad')
                    let idAutoridad = $(this).attr('id')
              //    console.log('id autoridad'+idAutoridad)
               $('#tipoId').val(idAutoridad)
              console.log('tipo autoridad' + $('#tipoId').val())
                    let escuelaActual= $(this).parent().attr('id')
      
                    //console.log('escuela'+escuelaActual)
                    formPersona22()
      
      
                    function formPersona22()
                    {
                      //let escuelaId =  $('#escuelaId').val()
                      escuelaId=escuelaActual
                      console.log('holaa'+escuelaId)
                      $('#padreIr').append(`
                        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Datos personales</h4>
                              </div>
      
                              <div class="modal-body" id="modal-body" >
                              <form action="" method="post" id="form1">
                                <div class="form-group">
                                  <div class="col-md-12">
                                    <div class="col-md-6"><label for="" class="control-label validaciond">Nro. de Documento</label>
                                    <input  class="form-control" name="txtdni" type="text" maxlength="8" id="txtdni" autofocus="autofocus" required />
                                    <span class="hide errord">Campo Obligatorio. Ingrese solo números (8)</span>
                                    </div>
                                    <div class="col-md-6 buscar"><br>
                                    <button type="button" class="btn btn-danger" id="btnBuscarDni">Buscar</button>
      
                                    </div>
      
                                  </div>
                                  <div class="col-md-12">
                                      <input name="txtidpersona" type="hidden" id="statusDni" value="0" />
                                      <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
                                      <input name="txtidesacuela" type="hidden" id="txtescuelaid" value="${escuelaId}"/>
                                      <input type="hidden" name="iddirector" id="iddirector" value="" />
      
                              ￼    </div>
                                </div>
                                <div class="form-group ctxtapellido">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacion">Apellido</label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" placeholder="Ingrese solo letras" type="text" name="txtapellido" id="txtapellido" class="hades" required />
                                      <span class="hide error">Campo Obligatorio. Ingrese solo letras</span>
                                  </div>
      
                                </div>
      
                                <div class="form-group ctxtnombre">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacionn">Nombre</label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" type="text" name="txtnombre" placeholder="Ingrese solo letras" id="txtnombre" class="hades" required />
                                    <span class="hide errorn">Campo Obligatorio. Ingrese solo letras</span>
                                  </div>
                                </div>
      
                                <div class="form-group ctxtcuil ">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacionc">CUIL</label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" type="number" maxlength="11" placeholder="Ingrese solo Números sin guiones" name="txtcuil" id="txtcuil" class="hades" required/>
                                    <span class="hide errorc">Campo Obligatorio. Ingrese solo números sin guiones.</span>
                                  </div>
                                </div>
      
                                <div class="form-group clocalidad ">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacionl">Localidad</label>
                                  </div>
                                  <div class="col-md-12">
                                    <select class="form-control" name="localidad" id="localidad">
      
                                    <option value="0">Seleccione...</option>
      
      
                                    `)
                                    $.ajax({
                                      url: 'includes/mod_cen/clases/ajax/ajaxLocalidad.php',
                                      type: 'POST',
                                      dataType: 'json',
                                      data: {local: 'local'}
                                    })
                                    .done(function(lista) {
                                      for (let item of lista) {
                                        $('#localidad').append(`<option value="${item.id}">${item.nombre}</option>`)
                                      }
                                      console.log("success");
                                    })
                                    .fail(function() {
                                      console.log("error");
                                    })
                                    .always(function() {
                                      console.log("complete");
                                    });
      
      
                                    $("#modal-body").append(`
      
                                        </select>
      
                                  </div>
      
                                </div>
      
                                <div class="form-group ctxttelefonoM">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validaciont">Teléfono </label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" type="number" placeholder="Ingrese solo números sin puntos" name="txttelefonoM" id="txttelefonoM" class="hades" required />
                                    <span class="hide errort">Campo Obligatorio. Ingrese telefono, solo números sin puntos</span>
                                  </div>
                                </div>
      
                                <div class="form-group ctxtemail">
                                  <div class="col-md-12">
                                    <label for="" class="control-label validacione">Email </label>
                                  </div>
                                  <div class="col-md-12">
                                    <input class="form-control" placeholder="Ingrese email con formato válido. Ej: email@gmail.com" type="text" name="txtemail" id="txtemail" class="hades" required />
                                    <span class="hide errore">Campo Obligatorio. Ingrese email con formato válido. Ej: email@gmail.com</span>
                                  </div>
                                </div>
      
                              </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btnEditar">Editar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        `)
                      $('#myModal').modal('show')
                      $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad').hide()
                      $('#myModal').on('hide.bs.modal', function(){
                        $('#myModal').remove()
                      })
      
                      $('#myModal').on('shown.bs.modal', function(){
                        $('#txtdni').focus()
      
                        let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                        let escuelaId = $('#txtescuelaid').val()
      
                        console.log('desde txtescuelaid'+escuelaId)
                        let tipoId = $('#tipoId').val().substr(6)
                        $('#btnEditar').hide()
                          $('#btnSave').hide()
                        //let idPrueba = $(this).attr('id');
                        //let tipoId = $('#idAuto').attr('id')
                        console.log( 'tipo id de modal'+tipoId)
      
                        console.log('desde tipoId'+tipoId)
                        let search ='search'
                        $.ajax({
                          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {search:search,escuelaId: escuelaId,tipoId:tipoId}
                        })
                        .done(function(lista) {
                          for (let item of lista) {
      
                            if (item.id=='0') {
                              console.log('no encontrado')
                              //  $('#btnSave').show()
                              camposOcultos.hide()
                              // $('#btnEditar').hide()
                              // $('#btnSave').hide()
                              $('#statusDni').val('0')
                              $('#txtidpersona').val('')
                              $('#txtnombre').val('')
                              $('#txtapellido').val('')
                              $('#txtcuil').val('')
                              $('#txttelefonoM').val('')
                              $('#txtemail').val('')
                              $('#localidad').val('0')
                            }else{
                              $('#btnEditar').show()
                              $('#statusDni').val('1')
                              console.log('encontrado')
                              camposOcultos.show()
                              $('#btnBuscarDni').hide()
                              $('#btnSave').hide()
                              $('.buscar').append('<button type="button" class="btn btn-primary" id="btnNew">Nueva Autoridad</button>')
      
                              $('#btnNew').click(function(event) {
                                $(this).hide()
                                camposOcultos.hide()
                                $(' #btnBuscarDni').show()
                                $('#btnEditar').hide()
                                $('#statusDni, #localidad').val('0')
                                $('#txtdni').val('').focus()
                                $('#txtidpersona, #txtnombre, #txtapellido, #txtcuil, #txttelefonoM, #txtemail').val('')
                              });
      
      
                              $('#txtdni').val(item.dni)
                              $('#txtidpersona').val(item.id)
                              $('#txtnombre').val(item.nombre)
                              $('#txtapellido').val(item.apellido)
                              $('#txtcuil').val(item.cuil)
                              $('#txttelefonoM').val(item.telefono)
                              $('#txtemail').val(item.email)
                              let selected = $('#localidad option:selected').val();
                              $("#localidad option[value="+ selected +"]").attr("selected",false);
                              console.log(selected)
                              $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                              //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
                      })
      
                      $('#btnSave, #btnEditar').on('click',function(){
      
      
      
                        console.log('boton guardar')
      
                        // $('#btnEditar').hide()
                        //   $('#btnSave').hide()
                        let id = $('#txtidpersona').val()
                        let nombre = $('#txtnombre').val()
                        let apellido = $('#txtapellido').val()
                        let cuil = $('#txtcuil').val()
                        let telefonoM = $('#txttelefonoM').val()
                        let email = $('#txtemail').val()
                        let localidad = $('#localidad').val()
                        let txtdni = $('#txtdni').val()
                        let escuelaId = $('#txtescuelaid').val()
                        let tipoId = $('#tipoId').val()
                        //let tipoId = $('#modulo').val()
                        console.log('txtdni' + txtdni)
                        let update = $('#statusDni').val()
      
                        console.log('Estado de update '+update)
      
      
                          ////////////////////////////////////////////////
                    if (validarpersona()) {
                //   alert ('validacion correcta')
      
                      let tipoIdSave = $('#tipoId').val().substr(6)
      
                        $.ajax({
                          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {
                                btnSave:'btnSave',
                                escuelaId:escuelaId,
                                tipoId:tipoIdSave,
                                update: update,
                                personaId:id,
                                nombre:nombre,
                                apellido:apellido,
                                txtdni:txtdni,
                                cuil:cuil,
                                telefonoM:telefonoM,
                                email:email,
                                localidad:localidad}
                        })
                        .done(function(lista) {
      
      
                          for (let item of lista) {
                            if (item.status=='new') {
      
      
                              console.log('se creo con exito')
                            }else{
                              console.log('se actualizo con exito')
                            }
                              //$('#myModal').remove()
                              $('#myModal').modal('hide')
      
                          }
                          console.log("success");
                        })
                        .fail(function() {
                          console.log("error Guardar");
                        })
                        .always(function() {
                          console.log("complete");
                        });
      
                    }
                        //$('#myModal').remove()
                        //$('#myModal').hide()
      
                      })
      
      
      
      
      
                      $('#btnBuscarDni').click(function() {
                        let dni = $('#txtdni').val()
                          let camposOcultos = $('.ctxtnombre, .ctxtapellido, .ctxtcuil, .ctxttelefonoM, .ctxtemail, .clocalidad')
                          camposOcultos.show()
      
      
                        //$('#localidad option:selected').remove();
      
                        //$json = json_encode($arrayPrincipal);
                        $.ajax({
                          url: 'includes/mod_cen/clases/ajax/ajaxPersona.php',
                          type: 'POST',
                          dataType: 'json',
                          data: {dni: dni}
                        })
                        .done(function(lista) {
                          for (let item of lista) {
      
                            if (item.id=='0') {
                              console.log('no encontrado')
                              $('#btnSave').show()
      
                              $('#statusDni').val('0')
                              $('#txtidpersona').val('')
                              $('#txtnombre').val('')
                              $('#txtapellido').val('')
                              $('#txtcuil').val('')
                              $('#txttelefonoM').val('')
                              $('#txtemail').val('')
                              $('#localidad').val('0')
                            }else{
                              $('#statusDni').val('1')
                              $('#btnSave').show()
                              console.log('encontrado')
      
                              $('#txtidpersona').val(item.id)
                              $('#txtnombre').val(item.nombre)
                              $('#txtapellido').val(item.apellido)
                              $('#txtcuil').val(item.cuil)
                              $('#txttelefonoM').val(item.telefono)
                              $('#txtemail').val(item.email)
                              let selected = $('#localidad option:selected').val();
                              $("#localidad option[value="+ selected +"]").attr("selected",false);
                              console.log(selected)
                              $("#localidad option[value="+ item.localidad +"]").attr("selected",true);
                              //$('#localidad').append(`<option value="${item.localidad}">${item.nombre}</option>`)
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
      
                        console.log('hola dni')
                      });
                    }
                    //   console.log('llego a idauto')
                  })//fin vista movil          
  
    function pad(num, largo, char) {
      char = char || '0';
      num = num + '';
      return num.length >= largo ? num : new Array(largo - num.length + 1).join(char) + num;
    }
  
  
  });
  