$(document).ready(function(){
    var escuelaId = 0
    let accion = ''
    let nombre=''
    let numero=''
    let cue =''
    $('[id ^=registrar],[id ^=editar]').click(function(){
      
      let editar = $(this).attr('id')
      
      if (editar === 'editar') {
        accion = 'editar'
       
        escuelaId = $(this).parent().siblings('.id').text()
        nombre = $(this).parent().siblings('.nombre').text()
        numero = $(this).parent().siblings('.numero').text()
        cue = $(this).parent().siblings('.cue').text()        
        
      }else{
        accion = 'registrar'
        escuelaId = $(this).parent().siblings('.id').text()
        nombre = $(this).parent().siblings('.nombre').text()
        numero = $(this).parent().siblings('.numero').text()
        cue = $(this).parent().siblings('.cue').text()
 
        
      }
      //asignacion de datos en campos cue,numero,nombre        
      $('#numero').val(numero)
      $('#nombre').val(nombre)
      $('#cue').val(cue)  
       
    })    
    
    $('#modalRegistrar').on('shown.bs.modal', function(){//evento al mostrar el modal / modalRegistrar      
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

        $('#misMigraciones').empty()

        let ajaxMisMigraciones = ''
        $.ajax({            
          url: 'includes/mod_cen/migracion_servidores/php/ajax/mis_migraciones.ajax.php',
          type: 'POST',
          dataType: 'html',
          data: {
                ajaxMisMigraciones:ajaxMisMigraciones,
                referenteId:referenteId
                }
                
        })
        .done(function(data) {
          console.log("success");   
          console.log(data);            
            $(data).appendTo('#misMigraciones')
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });



        


       
    });
});   
