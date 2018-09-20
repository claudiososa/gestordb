$(document).ready(function() {
  /** al clickear la escuela muestra info de la misma**/
  ///// one= agrega contenido una sola vez
  /*toggle de titulo de escuela*/
  $('[id ^=escuela]').on('click',function(event) {
    /* Act on the event */
    let escuelaId= $(this).attr('id');
    //alert(escuelaId)
    let escuela= escuelaId.substr(7)
    $('#ver' +escuela).toggle()
    console.log('hola escuela')
  })
  /*toggle de titulo de escuela*/

  /**Contenido sección Planied**/
  $('[id^=planied]').on('click',function(event) {
  /* Act on the event */
    let escuelaId= $(this).parent().parent().parent().parent().attr('id');
    //alert(escuelaId)
    let escuela= escuelaId.substr(3)
    // escuela tiene el dato: escuelaId
    let listaReferentes=[]
    //alert(escuela)
    // desde aqui empezamos

    $.ajax({
        url: 'includes/mod_cen/clases/ajax/ajaxPlaniedReferentes.php',
        type: 'POST',
        dataType: 'json',
        data: {escuela:escuela}
      })
      .done(function(lista) {
        //console.log(item.nombre)
        // console.log(lista[1].apellido);
        for (let item of lista) {
          //referenteETT.personaId=item.personaId
           listaReferentes.push(item)
           console.log(item.apellido)
            console.log(item.fotoPerfil)

        //    console.log(listaReferentes.fotoPerfil)
          //  if (listaReferentes.fotoPerfil == undefined) {
          //    listaReferentes.fotoPerfil.push(item.fotoPerfil)="0000.jpg"
          //    console.log('vacio')
          //  }
           //
          //  let personaId= item.fotoPerfil;
          //  console.log(personaId)

         }

         $('#bodyProgramas'+escuela).empty()

           $('#programas'+escuela).show(function() {
        //     //  agrega contenido al body del panel

            $(`<div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-body" id="informes${escuela}">
                      <h3 id="info${escuela}" >Informes planied</h3>

                    </div>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <h3 align="center">ETT: ${listaReferentes[0].apellido}, ${listaReferentes[0].nombre}</h3>
                      <hr>
                      <div class="row">
                      <div class="col-md-8">
                      <h4><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbspDni: ${listaReferentes[0].dni} / ${listaReferentes[0].cuil}</h4>
                      <h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="celularImg">&nbsp&nbsp&nbsp${listaReferentes[0].telefonoM}</h4>
                      <h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp ${listaReferentes[0].email}</h4>


                      </div>

                    <div class="col-md-4">
                      <img src='./img/perfil/${listaReferentes[0].fotoPerfil}'  alt='perfil'  class=' img-responsive img-circle' style= 'width: 120px; height: 120px;' >
                    </div>
                    </div>
                  </div>
                </div>
              </div>

                <div class="col-md-6">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <h3 align="center">ETJ: ${listaReferentes[1].apellido}, ${listaReferentes[1].nombre}</h3>
                      <hr class='hrStyle'>
                      <div class="row">
                      <div class="col-md-8">
                      <h4><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbspDni: ${listaReferentes[1].dni} / ${listaReferentes[1].cuil}</h4>
                      <h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="celularImg">&nbsp&nbsp&nbsp${listaReferentes[1].telefonoM}</h4>
                      <h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp ${listaReferentes[1].email}</h4>


                      </div>

                    <div class="col-md-4">
                        <img src='./img/perfil/${listaReferentes[1].fotoPerfil}'  alt='perfil'  class=' img-responsive img-circle' style= 'width: 120px; height: 120px;' >
                    </div>
                    </div>
                    </div>
                  </div>
                </div>

                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-body" id='bodyRti${escuela}'>
                        <h3 align="center">RTI</h3>
                        <hr class='hrStyle'>

                      </div>
                    </div>
                </div>
                </div>`).appendTo('#bodyProgramas'+escuela)
                /*RTI*/

                for(var i=2;i<listaReferentes.length;i++){
                   let rti= {
                     nombre: listaReferentes[i]["nombre"],
                     apellido:listaReferentes[i]["apellido"],
                     telefonoM:listaReferentes[i]["telefonoM"],
                     email:listaReferentes[i]["email"]
                     }
                      // let apellido =listaReferentes[i]["apellido"]
                      // let telefonoM =listaReferentes[i]["telefonoM"]
                      // let email =listaReferentes[i]["email"]
                      //  alert ('rti:'+nombre)
                    ////  console.log(rti)
                      $(`<p>${rti.apellido} ${rti.nombre}, <br> Cel:${rti.telefonoM}<br> Email: ${rti.email}</p><br>`).appendTo('#bodyRti'+escuela)
                  }

                //$nomArchivoFoto.=".jpg";
                $('[id ^=nuevoInforme]').click(function(){
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
// aqui se listan informes de la escuela
                      $('[id ^=informes').on('click',function(event) {
                      //  alert('hola')
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

                      if (typeof(existe)==='undefined')  {
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                           for (let item of lista) {
                               tableinforme=pad(item.escuelaId,4,0)
                               cant= item.cantidad

                                 }

                           if (cant > 0) {

                              if (click=='informes') {
                            //     console.log('item Escuela Id = '+cant)
                            $(`<table class="table table-hover tableinformes${tableinforme}" id=tableinformes${tableinforme}><thead>
                                      <tr style="font-size:15px;">
                                        <th>Titulo</th>
                                        <th>Leido</th>
                                        <th>Resp.</th>
                                        <th>Fecha</th>
                                        <th>Prioridad</th>
                                      </tr>
                                    </thead>

                               `).appendTo('#info'+escuelaId)

                            }
                          }else{   // entra por que no tiene informes cargados

                            if (click=='informes') {
                         //  console.log('item Escuela Id = '+cant)
                         $(`<table class="table table-hover tableinformes${tableinforme}" id=tableinformes${tableinforme}><thead>
                                   <tr style="font-size:15px;">
                                     <th>Titulo</th>
                                     <th>Leido</th>
                                     <th>Resp.</th>
                                     <th>Fecha</th>
                                     <th>Prioridad</th>
                                   </tr>
                                 </thead>

                            `).appendTo('#info'+escuelaId)


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
                                $('#tableinformes'+escuelaIdconCero).find('thead').after(`<tbody><tr style="font-size:15px;"><td id='if${item.informeId}'>${item.titulo}</td>
                                <td>${item.cantidadLeido}</td>
                                <td>${item.cantidadRespuesta}</td>
                                <td>${item.fecha}</td>
                                <td>${item.prioridad}</td></tr><tbody></table><tr class="trinformes${escuelaIdconCero}">`)
                              }


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
                        //  $this.find('i').removeClass('.glyphicon glyphicon-chevron-up').addClass('.glyphicon glyphicon-chevron-down');

                          //console.log('variable existe'+existe)
                          existe.stop
                          //console.log('variable existe'+existe)
                      }

                      //alert('fila')

                      });

             });
      })
      .fail(function() {
        console.log("error en php");
      })
      .always(function() {
        //console.log(informeActual.escuelaNombre)
        //console.log("success Ajax Informe");
        //formPersona(informeActual)
        //console.log("complete");
      });
      // aqui terminamos
      //alert('hola planied')

});

              // #######SUPER####
                      $('[id ^=super]').on('click',function(event) {
                        /* Act on the event */
                       console.log('hola super')
                       let escuelaId= $(this).parent().parent().parent().parent().attr('id');
                       //alert(escuelaId)
                       let escuela= escuelaId.substr(3)
                       //alert (escuela)
                       $('#bodyProgramas'+escuela).empty()
                       $('#programas'+escuela).show(function() {
                       //  agrega contenido al body del panel
                          $('<p>Informes Supervision:(12)</p>').appendTo('#bodyProgramas'+escuela)
                       });

                      });

                    // #######AUTORIDADES####
                      $('[id ^=autoridadesEsc]').on('click',function(event) {
                        let escuelaId= $(this).parent().parent().parent().parent().attr('id').substr(3);
                      // alert(escuelaId)
                        //let escuela= escuelaId.substr(3)
                        let $this = $(this)
                        let existeAutoridad = $('.tableAutoridades'+escuelaId).attr('class')
                        /* Act on the event */
                        // alert('hola super')
                        $('#bodyProgramas'+escuelaId).empty()
                        $('#programas'+escuelaId).show(function() {

                          //  agrega contenido al body del panel
                          if (typeof(existeAutoridad)==='undefined') {
                            console.log('definicion de existeAuto'+existeAutoridad)
                            let all ='all'

                              $.ajax({
                                url: 'includes/mod_cen/clases/ajax/ajaxPlaniedReferentes.php',
                                type: 'POST',
                                dataType: 'json',
                                data: {all:all,escuelaId: escuelaId}
                              })
                              .done(function(lista) {
                                let tableinforme = 0

                                for (let item of lista) {
                                  //  tableAuto=pad(item.escuelaId,4,0)
                                    let escuelaIdconCero = pad(item.escuelaId,4,0)
                                    let escuela = item.escuelaId
                                    if (item.id != '0') {

                                      $('#bodyProgramas'+escuelaIdconCero).after(`<tbody><tr class="trinformes${escuelaIdconCero}">
                                      <td>${item.cargo}</td>
                                      <td><a id='eInforme' href=''>${item.apellido},${item.nombre}</a></td>
                                      <td><a id='eInforme' href=''>${item.telefono}</a></td>
                                      <td><a id='eInforme' href=''>${item.email}</a></td>
                                      <td id='${item.escuelaId}'><img class='img-responsive' src='img/iconos/lapiz (4).png'  id='idAuto${item.idCargo}'></td>
                                      </tr>`).appendTo('#bodyProgramas'+escuelaId)
                                      //</tbody></table>`)
                                      $('.trautoridad'+item.escuelaId).hide()
                                      $('.trautoridad'+item.escuelaId).fadeIn('slideUp')
                                     }else{
                                       $('#tableAutoridades'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
                                       <td>${item.cargo}</td>
                                       <td colspan="3">Sin Asignar</td>
                                       <td id='${item.escuelaId}'><img class='img-responsive' src='img/iconos/lapiz (4).png'  id='idAuto${item.idCargo}'></td>
                                       </tr>`).appendTo('#bodyProgramas'+escuelaId)
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


                          }
                        //  $('<p>autoridades de escuelas (director vice o autoridad a cargoas)</p>').appendTo('#bodyProgramas'+escuelaId)

                        });

                      });

                      //###### ESSCUELA FUTURO

                      // $('[id ^=futuro').on('click',function(event) {
                      //   let escuelaId= $(this).parent().parent().parent().parent().attr('id');
                      //   //alert(escuelaId)
                      //   let escuela= escuelaId.substr(3)
                      //   /* Act on the event */
                      //   // alert('hola super')
                      //   $('#bodyProgramas'+escuela).empty()
                      //   $('#programas'+escuela).show(function() {
                      //   //  agrega contenido al body del panel
                      //   $('<p>informes de escuela del futurosa</p>').appendTo('#bodyProgramas'+escuela)
                      //
                      //   });
                      //
                      // });



function pad(num, largo, char) {
  char = char || '0';
  num = num + '';
  return num.length >= largo ? num : new Array(largo - num.length + 1).join(char) + num;
}

});
