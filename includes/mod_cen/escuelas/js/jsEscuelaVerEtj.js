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

$('#bodyProgramas'+escuela).empty()
 $('#programas'+escuela).show(function() {
//
//     //  agrega contenido al body del panel


    $(`<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
      <h3>informes planied</h3>

      </div>
    </div>
    </div>
    </div>

    <div class="row">

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <h3 align="center">ETT: ${listaReferentes[0].apellido}</h3>
          <hr>

          <div class="row">
          <div class="col-md-8">
          <h4><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbsp25652325 / 21-52658985-5</h4>
          <h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="">&nbsp&nbsp&nbsp15265897</h4>

          <h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp ${listaReferentes[0].email}</h4>
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
          <h3 align="center">ETJ: ${listaReferentes[1].apellido}</h3>
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
    </div>`).appendTo('#bodyProgramas'+escuela)
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
    //
    //     //  agrega contenido al body del panel
          $('<p>informes de escuela del futuro</p>').appendTo('#bodyProgramas'+escuela)

      });

      });


});
