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


  $('[id ^=informes]').on('click', function(){

    let escuelaId = $(this).attr('id').substr(8)
    //alert(escuelaId)
    let $this = $(this)
    let existe = $('.tableinformes'+escuelaId).attr('class')

    if (typeof(existe)==='undefined') {
        //console.log('definicion de existe'+existe)
        //$this.find('i').removeClass('.glyphicon glyphicon-chevron-down').addClass('.glyphicon glyphicon-chevron-up');
        //console.log(escuelaId)
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
             tableinforme=pad(item.escuelaId,4,0)
             cant= item.cantidad

               }

         if (cant > 0) {


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


        }else{   // entra por que no tiene informes cargados


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



       }

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
              </tr>`)
              //</tbody></table>`)
              $('.trautoridad'+item.escuelaId).hide()
              $('.trautoridad'+item.escuelaId).fadeIn('slideUp')
             }else{
               $('#tableAutoridades'+escuelaIdconCero).find('thead').after(`<tbody><tr class="trinformes${escuelaIdconCero}">
               <td>${item.cargo}</td>
               <td colspan="3">Sin Asignar</td>
               </tr>`)
            }
          }

          //$('#tableAutoridades'+escuelaIdconCero).find('thead').after(`</tbody></table>`)

          $('[id ^=idAuto]').click( function(){
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
                          <h4 class="modal-title">Datos de Director</h4>
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

              /////validacion formulario
              function validarpersona(){
                        let letras=  /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ_\s]+$/;
                        let num =  /^[0-9]+$/;
                        let correo = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}|[.][a-zA-Z]{2,4}$/;
                        $("#txtapellido").keyup(function(event){
                          if( $('#txtapellido').val() != "" && (letras.test($('#txtapellido').val() ))){
                              $(".error").removeClass('show').fadeOut();

                              $('.ctxtapellido').removeClass('has-error').addClass('has-success')
                              $('.validacion').attr('for','txtapellido')
                              $('#txtapellido').attr('aria-describedby','helpBlock2')

                            //  return true;

                          }else{
                            $('.ctxtapellido').addClass('has-error')
                            $('.validacion').attr('for','txtapellido')
                            $('#txtapellido').attr('aria-describedby','helpBlock2')
                            $('.error').addClass('show').addClass('help-block').attr('id','help-block2')
                          //  return true;
                          }


                        })



                        $("#txtnombre").keyup(function(event){
                            if( $(this).val() != "" && (letras.test($(this).val() ))){
                                $(".errorn").removeClass('show').fadeOut();

                                $('.ctxtnombre').removeClass('has-error').addClass('has-success')
                                $('.validacionn').attr('for','txtnombre')
                                $('#txtnombre').attr('aria-describedby','helpBlock3')

                                return true;

                            }else{
                              $('.ctxtnombre').addClass('has-error')
                              $('.validacionn').attr('for','txtnombre')
                              $('#txtnombre').attr('aria-describedby','helpBlock3')
                              $('.errorn').addClass('show').addClass('help-block').attr('id','help-block3')
                              return true;
                            }

                         });

                        $("#txtcuil").keyup(function(event){
                           if( $(this).val() != "" && (num.test($(this).val() ))){
                               $(".errorc").removeClass('show').fadeOut();

                               $('.ctxtcuil').removeClass('has-error').addClass('has-success')
                               $('.validacionc').attr('for','txtcuil')
                               $('#txtcuil').attr('aria-describedby','helpBlock4')

                               return true;

                           }else{
                             $('.ctxtcuil').addClass('has-error')
                             $('.validacionc').attr('for','txtcuil')
                             $('#txtcuil').attr('aria-describedby','helpBlock4')
                             $('.errorc').addClass('show').addClass('help-block').attr('id','help-block4')
                             return true;
                           }

                        });
                        $("#txttelefonoM").keyup(function(event){
                          if( $(this).val() != "" && (num.test($(this).val() ))){
                              $(".errort").removeClass('show').fadeOut();

                              $('.ctxttelefonoM').removeClass('has-error').addClass('has-success')
                              $('.validaciont').attr('for','txttelefonoM')
                              $('#txttelefonoM').attr('aria-describedby','helpBlock5')

                              return true;

                          }else{
                            $('.ctxttelefonoM').addClass('has-error')
                            $('.validaciont').attr('for','txttelefonoM')
                            $('#txttelefonoM').attr('aria-describedby','helpBlock5')
                            $('.errort').addClass('show').addClass('help-block').attr('id','help-block5')
                            return true;
                          }

                        });


                        $("#txtemail").keyup(function(event){
                           if( $(this).val() != "" && (correo.test($(this).val() ))){
                               $(".errore").removeClass('show').fadeOut();

                               $('.ctxtemail').removeClass('has-error').addClass('has-success')
                               $('.validacione').attr('for','txtemail')
                               $('#txtemail').attr('aria-describedby','helpBlock6')

                               return true;

                           }else{
                             $('.ctxtemail').addClass('has-error')
                             $('.validacione').attr('for','txtemail')
                             $('#txtemail').attr('aria-describedby','helpBlock6')
                             $('.errore').addClass('show').addClass('help-block').attr('id','help-block6')
                             return true;
                           }

                        });


                        if ($('#txtdni').val() == '' || !num.test($('#txtdni').val()) ) {
                        //alert('Apellido: Ingrese solo letras')

                          $('.ctxtdni').addClass('has-error')
                          $('.validaciod').attr('for','txtdni')
                          $('#txtdni').attr('aria-describedby','helpBlock9')
                          $('.errord').removeClass('hide').addClass('help-block').attr('id','help-block9')
                          return false
                        }else{
                          $('.ctxtdni').removeClass('has-error').addClass('has-success')
                          $('.validaciond').attr('for','txtdni')
                          $('#txtdni').attr('aria-describedby','helpBlock9')
                          $('.errord').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block9')

                        }

                        if ($('#txtapellido').val() == '' || !letras.test($('#txtapellido').val()) ) {
                      //alert('Apellido: Ingrese solo letras')

                        $('.ctxtapellido').addClass('has-error')
                        $('.validacion').attr('for','txtapellido')
                        $('#txtapellido').attr('aria-describedby','helpBlock2')
                        $('.error').removeClass('hide').addClass('help-block').attr('id','help-block2')
                        return false
                      }else{
                        $('.ctxtapellido').removeClass('has-error').addClass('has-success')
                        $('.validacion').attr('for','txtapellido')
                        $('#txtapellido').attr('aria-describedby','helpBlock2')
                        $('.error').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block2')

                      }
                    if( $('#txtnombre').val() == '' || !letras.test($('#txtnombre').val())){
                            //  alert('Apellido: Ingrese solo letras')
                        $('.ctxtnombre').addClass('has-error')
                        $('.validacionn').attr('for','txtnombre')
                        $('#txtnombre').attr('aria-describedby','helpBlock3')
                        $('.errorn').removeClass('hide').addClass('help-block').attr('id','help-block3')

                        return false
                    }else{
                        $('.ctxtnombre').removeClass('has-error').addClass('has-success')
                        $('.validacionn').attr('for','txtnombre')
                        $('#txtnombre').attr('aria-describedby','helpBlock3')
                        $('.errorn').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block3')

                      }
                      if( $('#txtcuil').val() == '' || !num.test($('#txtcuil').val())){
                              //  alert('Apellido: Ingrese solo letras')
                          $('.ctxtcuil').addClass('has-error')
                          $('.validacionc').attr('for','txtcuil')
                          $('#txtcuil').attr('aria-describedby','helpBlock4')
                          $('.errorc').removeClass('hide').addClass('help-block').attr('id','help-block4')

                         return false
                      }else{
                          $('.ctxtcuil').removeClass('has-error').addClass('has-success')
                          $('.validacionc').attr('for','txtcuil')
                          $('#txtcuil').attr('aria-describedby','helpBlock4')
                          $('.errorc').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block4')

                        }

                        if( $('#txttelefonoM').val() == '' || !num.test($('#txttelefonoM').val())){

                                //  alert('Apellido: Ingrese solo letras')
                            $('.ctxttelefonoM').addClass('has-error')
                            $('.validaciont').attr('for','txttelefonoM')
                            $('#txttelefonoM').attr('aria-describedby','helpBlock5')
                            $('.errort').removeClass('hide').addClass('help-block').attr('id','help-block5')

                        return false
                        }else{
                            $('.ctxttelefonoM').removeClass('has-error').addClass('has-success')
                            $('.validaciont').attr('for','txttelefonoM')
                            $('#txttelefonoM').attr('aria-describedby','helpBlock5')
                            $('.errort').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block5')

                          }
                          if ($('#localidad').val() == '0') {
                            //alert('Seleccione Localidad')

                            $('.clocalidad').addClass('has-error')
                            $('.validacionl').attr('for','localidad')
                            $('#localidad').attr('aria-describedby','helpBlock8')
                            $('.errorl').removeClass('hide').addClass('help-block').attr('id','help-block8')

                       return false
                        }else{
                            $('.clocalidad').removeClass('has-error').addClass('has-success')
                            $('.validacionl').attr('for','localidad')
                            $('#localidad').attr('aria-describedby','helpBlock8')
                            $('.errorl').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block8')

                          }

                          if( $('#txtemail').val() == '' || !correo.test($('#txtemail').val())){
                                  //  alert('Apellido: Ingrese solo letras')
                              $('.ctxtemail').addClass('has-error')
                              $('.validacione').attr('for','txtemail')
                              $('#txtemail').attr('aria-describedby','helpBlock6')
                              $('.errore').removeClass('hide').addClass('help-block').attr('id','help-block6')

                    return false
                          }else{
                              $('.ctxtemail').removeClass('has-error').addClass('has-success')
                              $('.validacione').attr('for','txtemail')
                              $('#txtemail').attr('aria-describedby','helpBlock6')
                              $('.errore').addClass('hide').removeClass('show').addClass('help-block').attr('id','help-block6')

                            }


              return true;

              }
                    ////////////////////////////////////////////////
              if (validarpersona()) {
                //alert ('validacion correcta')

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



  function pad(num, largo, char) {
    char = char || '0';
    num = num + '';
    return num.length >= largo ? num : new Array(largo - num.length + 1).join(char) + num;
  }


});
