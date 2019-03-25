$(document).ready(function(){
    var escuelaId = 0
    $('[id ^=registrar]').click(function(){
       escuelaId = $(this).parent().siblings('.id').text()
       let nombre = $(this).parent().siblings('.nombre').text()
       let numero = $(this).parent().siblings('.numero').text()
       let cue = $(this).parent().siblings('.cue').text()

       //asignacion de datos en campos cue,numero,nombre        
       $('#numero').val(numero)
       $('#nombre').val(nombre)
       $('#cue').val(cue)
       
    })    
    
    $('#modalRegistrar').on('shown.bs.modal', function(){
       
    });
  
  
    /**
     * AL PRESIONAR EL BOTON X (eliminar) DE PROFESOR
     */
  
  
    $('#guardarMigracion').click( function (){
        $('#modalRegistrar').modal('hide')
        console.log(escuelaId)
        console.log('guarando..')
        let date = $('#date').val()
        let observaciones = $('#observaciones').val()
        
        $.ajax({            
            url: 'includes/mod_cen/clases/ajax/migracionServidor.php',
            type: 'POST',
            dataType: 'json',
            data: {escuelaId: escuelaId,date:date,observaciones:observaciones}
          })
          .done(function(lista) {
            console.log("success");            
            for (let item of lista) {
                
            }
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
    });
});   
