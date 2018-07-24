$(document).ready(function() {
  /** al clickear la escuela muestra info de la misma**/

  ///// one= agrega contenido una sola vez
  $('[id ^=escuela]').on('click',function(event) {
    /* Act on the event */
    let escuelaId= $(this).attr('id');
    //alert(escuelaId)
    let escuela= escuelaId.substr(7)
    $('#ver' +escuela).toggle()

})
/**planied**/
$('[id ^=planied]').on('click',function(event) {
/* Act on the event */
let escuelaId= $(this).parent().parent().parent().parent().attr('id');
//alert(escuelaId)
let escuela= escuelaId.substr(3)
//alert(escuelaId)

//alert('hola planied')

$('#bodyProgramas'+escuela).empty()
 $('#programas'+escuela).show(function() {
//
//     //  agrega contenido al body del panel
  //<input class="btn btn-primary" type="submit" value="ir" id="btn_ir">

    $(`<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body" id="informes${escuela}">
      <p>informes planied</p>

      <div class="form-group">
       <div class="" id="padreIr">

       </div>
      </div>
      </div>
    </div>
    </div>
    </div>

    `).appendTo('#bodyProgramas'+escuela)

    $('[id ^=informes]').on('click', function(event) {
      alert('hola informes')
      //event.preventDefault();
      /* Act on the event */
      let escuelaId = $(this).attr('id').substr(8)
      let click = $(this).attr('id').substr(0,8) // guarda el id del elemento donde se hizo clic, puede ser informes o informeM
      let existe
      let $this = $(this)

      if (click=='informes') {//almacena en variable existe, la clase de la tableinformes en el caso que no existe dicha tabla se guarda comno undefined
        existe = $('.tableinformes'+escuelaId).attr('class')
      }

          if (typeof(existe)==='undefined')
          {
              console.log('definicion de existe'+existe)
              let myReport ='all'
              let reports ='conectar'
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
                   tableinforme=item.escuelaId
                   cant= item.cantidad
                   console.log(tableinforme)
                     }

               if (cant > 0) {

                  if (click=='informes') {
                      console.log('item Escuela ID= '+cant)
                      $('#informes'+escuela).after(`<tr class="tableinformes${tableinforme} warningStyle"><td ><table id=tableinformes${tableinforme}
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



                }


              }

          //     else{   // entra por que no tiene informes cargados
          //
          //       if (click=='informes') {
          //     console.log('item Escuela Id = '+cant)
          //
          //
          //    }
          //
          //  }

                for (let item of lista) {
                    //alert(item.escuelaId)
                    //console.log(item.cantidad)
                  if (item.cantidad > 0) {
                    let escuelaIdconCero = item.escuelaId
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
                  }


                  }else{
                    //alert('Esta escuela no tiene informes creados')
                  }
                }


        $('[id ^=nuevoInforme]').click( function(){
                                  //alert('nuevo informe')
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



                      }
                      //console.log(informeActual.escuelaNombre)
                      //console.log("success Ajax Informe");
                    })

                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                  //  console.log(informeActual.escuelaId)
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
          }


    });
 });




});

// #######SUPER####
$('[id ^=super]').on('click',function(event) {
    /* Act on the event */
   //alert('hola super')
   let escuelaId= $(this).parent().parent().parent().parent().attr('id');
   //alert(escuelaId)
   let escuela= escuelaId.substr(3)
   //alert (escuela)
   $('#bodyProgramas'+escuela).empty()
  $('#programas'+escuela).show(function() {
//
//     //  agrega contenido al body del panel
      $('<p>Informes Supervision:(12)</p>').appendTo('#bodyProgramas'+escuela)
  });

  });



  // // #######PMI####
  //   $('[id ^=pmi]').on('click',function(event) {
  //     let escuelaId= $(this).parent().parent().parent().parent().attr('id');
  //     //alert(escuelaId)
  //     let escuela= escuelaId.substr(3)
  //     /* Act on the event */
  //   // alert('hola super')
  //    $('#bodyProgramas'+escuela).empty()
  //   $('#programas'+escuela).show(function() {
  // //
  // //     //  agrega contenido al body del panel
  //       $('<p>pmi</p>').appendTo('#bodyProgramas'+escuela)
  //   });
  //
  //   });


    // #######AUTORIDADES####
      $('[id ^=autoridadesEsc]').on('click',function(event) {
        let escuelaId= $(this).parent().parent().parent().parent().attr('id');
        //alert(escuelaId)
        let escuela= escuelaId.substr(3)
        /* Act on the event */
      // alert('hola super')
       $('#bodyProgramas'+escuela).empty()
      $('#programas'+escuela).show(function() {
    //
    //     //  agrega contenido al body del panel
          $('<p>autoridades de escuelas (director vice o autoridad a cargo)</p>').appendTo('#bodyProgramas'+escuela)

      });

      });

      //###### ESSCUELA FUTURO

      $('[id ^=futuro').on('click',function(event) {
        let escuelaId= $(this).parent().parent().parent().parent().attr('id');
        //alert(escuelaId)
        let escuela= escuelaId.substr(3)
        /* Act on the event */
      // alert('hola super')
       $('#bodyProgramas'+escuela).empty()
       $('#programas'+escuela).show(function() {
    //    //     //  agrega contenido al body del panel
          $('<p>informes de escuela del futuro</p>').appendTo('#bodyProgramas'+escuela)

      });

      });


});
