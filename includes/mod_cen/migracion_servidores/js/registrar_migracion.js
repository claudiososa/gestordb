$(document).ready(function(){
    var escuelaId = 0
    let accion = ''
    $('[id ^=registrar],[id ^=editar]').click(function(){
      
      let editar = $(this).attr('id').substr(0,6)
      if (editar === 'editar') {
        accion = 'editar'
       // alert($(this).attr('id').substr(0,6))
        escuelaId = $(this).parent().siblings('.idEditar').text()
        let nombre = $(this).parent().siblings('.nombreEditar').text()
        let numero = $(this).parent().siblings('.numeroEditar').text()
        let cue = $(this).parent().siblings('.cueEditar').text()
 
        //asignacion de datos en campos cue,numero,nombre        
        $('#numeroEditar').val(numero)
        $('#nombreEditar').val(nombre)
        $('#cueEditar').val(cue)
        
        //alert(escuelaId)
      }else{
        accion = 'registrar'
        escuelaId = $(this).parent().siblings('.id').text()
        let nombre = $(this).parent().siblings('.nombre').text()
        let numero = $(this).parent().siblings('.numero').text()
        let cue = $(this).parent().siblings('.cue').text()
 
        //asignacion de datos en campos cue,numero,nombre        
        $('#numero').val(numero)
        $('#nombre').val(nombre)
        $('#cue').val(cue)
      }
      
      //alert(escuelaId)
       
       
    })    
    
    $('#modalRegistrar,#modalEditar').on('shown.bs.modal', function(){//evento al mostrar el modal / modalRegistrar
      alert(escuelaId)
      let ajaxConsulta = ''
      $.ajax({            
        url: 'includes/mod_cen/migracion_servidores/php/ajax/migracion_servidor.ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {ajaxConsulta:ajaxConsulta,              
              escuelaId: escuelaId,
             }
      })
      .done(function(lista) {
        if (accion ==='editar') {
          console.log("datos para editar");            
          for (let item of lista) {          
            $('#dateMigracionEditar').val(item.dateMigracion)
            $('#observacionesEditar').val(item.observaciones)
            // console.log(item.aviso)
          }  
        }else{
          console.log("datos para editar");            
          for (let item of lista) {          
            $('#dateMigracion').val(item.dateMigracion)
            $('#observaciones').val(item.observaciones)
            // console.log(item.aviso)
          }
        }
        
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    });
  
  
    /**
     * AL PRESIONAR EL BOTON X GUARDAR
     * Este evento puede realizar una de dos tareas,
     * Guardar o editar, segun corresponda.
     */
  
  
    $('#guardarMigracion,#editarMigracion').click(function(){
        alert (escuelaId)
        $('#modalRegistrar').modal('hide')
        $('#modalEditar').modal('hide')



        if (accion ==='editar') {
          var dateMigracion = $('#dateMigracionEditar').val()        
          var observaciones = $('#observacionesEditar').val()          
        }else{
          var dateMigracion = $('#dateMigracion').val()        
          var observaciones = $('#observaciones').val()          
        }
        


        let ajaxGuardarMigracion = ''
        $.ajax({            
            url: 'includes/mod_cen/migracion_servidores/php/ajax/migracion_servidor.ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {ajaxGuardarMigracion:ajaxGuardarMigracion,
                  referenteId:referenteId,
                  escuelaId: escuelaId,
                  dateMigracion:dateMigracion,
                  observaciones:observaciones}
          })
          .done(function(lista) {
            console.log("success");            
            for (let item of lista) {
                console.log(item.aviso)
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
