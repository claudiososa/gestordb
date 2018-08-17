$(document).ready(function() {
  $('[id^=perfil]').click(function(event) {
    /* Act on the event */
    let foto= $(this).attr('id').substr(6);
     //foto= foto+'.jpg'
  //  alert (foto)
    //alert(escuelaId)
    //let foto= fotoId.substr(4)
  //alert('hola foto'+foto)
    //alert('holafoto')
    $('#modal-body').html(`<img  src='./img/perfil/${foto}'  alt='perfil'  class=' img-responsive img-circle' style= 'width: 200px; height: 200px;display:block;margin:auto;' >`)
      //$('<p>hola mundo</p>').appendTo('#modalBody')
    $('#fotoPerfil').modal('show')

  })

});
