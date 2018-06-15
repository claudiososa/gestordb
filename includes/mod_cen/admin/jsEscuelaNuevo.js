$(document).ready(function() {

  /** al clickear la escuela muestra info de la misma**/

  ///// one= agrega contenido una sola vez
  $('#escSinFoto').one('click', function(event) {
    /* Act on the event */
    $('#ver').show()
  })

    /**planied**/
  $('#planied').on('click',function(event) {
    /* Act on the event */
  // alert('hola planied')
 $('#bodyProgramas').empty()
   $('#programas').show(function() {
//
//     //  agrega contenido al body del panel
      $(`<p>informes totales planied: (13)</p>
      <br>
      <div class="row">

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 align="center">ETJ: MARCO MAMANI</h3>
            <hr class='hrStyle'>
            <div class="row">
            <div class="col-md-8">
            <h4><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbsp25652325 / 21-52658985-5</h4>
            <h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="">&nbsp&nbsp&nbsp15265897</h4>

            <h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbspemail@gmail.com</h4>
            <h4><img src="img/iconos/pruebaFotoPerfil/casa.png"alt="">&nbsp&nbsp&nbsp4258698</h4>
            <h4><img src="img/iconos/pruebaFotoPerfil/casa (5).png" alt="">&nbsp&nbsp&nbsp'.$persona->getDireccion().'</h4>
            <h4><img src="img/iconos/pruebaFotoPerfil/facebook (1).png" alt="">&nbsp&nbsp&nbsp'.$persona->getFacebook().'</h4>
            <img src="img/iconos/pruebaFotoPerfil/gorjeo.png" alt="">&nbsp&nbsp&nbsp'.$persona->getTwitter().'</h4>
            <h4>Informes PLANIED: (5)</h4>

            </div>

            <div class="col-md-4">
            <img src="img/iconos/pruebaFotoPerfil/foto-perfil.jpg" alt="..." class="img-circle img-responsive">
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            <h3 align="center">ETT: VIDAURRE JULIO</h3>
            <hr class='hrStyle'>
          </div>
        </div>
      </div>

      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3 align="center">RTI</h3>
              <hr class='hrStyle'>
            </div>
          </div>
      </div>
      </div>`).appendTo('#bodyProgramas')
   });


  });
// #######SUPER####
  $('#super').on('click',function(event) {
    /* Act on the event */
  // alert('hola super')
   $('#bodyProgramas').empty()
  $('#programas').show(function() {
//
//     //  agrega contenido al body del panel
      $('<p>Informes Supervision:(12)</p>').appendTo('#bodyProgramas')
  });

  });



  // #######PMI####
    $('#pmi').on('click',function(event) {
      /* Act on the event */
    // alert('hola super')
     $('#bodyProgramas').empty()
    $('#programas').show(function() {
  //
  //     //  agrega contenido al body del panel
        $('<p>pmi</p>').appendTo('#bodyProgramas')
    });

    });


    // #######AUTORIDADES####
      $('#autoridadesEsc').on('click',function(event) {
        /* Act on the event */
      // alert('hola super')
       $('#bodyProgramas').empty()
      $('#programas').show(function() {
    //
    //     //  agrega contenido al body del panel
          $('<p>autop</p>').appendTo('#bodyProgramas')
      });

      });


})
