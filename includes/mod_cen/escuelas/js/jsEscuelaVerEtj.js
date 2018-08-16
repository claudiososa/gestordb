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
         }

         $('#bodyProgramas'+escuela).empty()

         let personaId= listaReferentes[0].personaId
         console.log('foto'+personaId);
         let persona= new Persona(personaId);
         let persona = persona->getContacto();

         $('#programas'+escuela).show(function() {
        //     //  agrega contenido al body del panel

            $(`<div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-body" id='informes'>
                      <h3>Informes planied</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <h3 align="center">ETT: ${listaReferentes[0].apellido}, ${listaReferentes[0].personaId}</h3>
                      <hr>
                      <div class="row">
                      <div class="col-md-8">
                      <h4><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbspDni: ${listaReferentes[0].dni} / ${listaReferentes[0].cuil}</h4>
                      <h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="celularImg">&nbsp&nbsp&nbsp${listaReferentes[0].telefonoM}</h4>
                      <h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp ${listaReferentes[0].email}</h4>

                      <h4>Informes PLANIED: (5)</h4>
                      </div>

                    <div class="col-md-4">
                      <img id='fotoJulio' src="img/iconos/pruebaFotoPerfil/foto-perfil.jpg" alt="..." class="img-circle img-responsive">
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

                      <h4>Informes PLANIED: (5)</h4>
                      </div>

                    <div class="col-md-4">
                      <img src="img/iconos/pruebaFotoPerfil/foto-perfil.jpg" alt="..." class="img-circle img-responsive">
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
                let nombre= listaReferentes[i]["nombre"]
                // let apellido =listaReferentes[i]["apellido"]
                // let telefonoM =listaReferentes[i]["telefonoM"]
                // let email =listaReferentes[i]["email"]
                alert ('rti:'+nombre)
              }

                //$nomArchivoFoto.=".jpg";

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
                        let escuelaId= $(this).parent().parent().parent().parent().attr('id');
                        //alert(escuelaId)
                        let escuela= escuelaId.substr(3)
                        /* Act on the event */
                        // alert('hola super')
                        $('#bodyProgramas'+escuela).empty()
                        $('#programas'+escuela).show(function() {
                          //  agrega contenido al body del panel
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
                        //  agrega contenido al body del panel
                        $('<p>informes de escuela del futuro</p>').appendTo('#bodyProgramas'+escuela)

                        });

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
});
