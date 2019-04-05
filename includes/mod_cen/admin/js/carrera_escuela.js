$(document).ready(function () {

    $('form').keypress(function(e){   
        if(e == 13){
            $('#botonAccion').click();
        }
      });
    
      $('input').keypress(function(e){
        if(e.which == 13){            
            $('#botonAccion').click();
          return false;
        }
      });
  

    $('#programa').change(function (e) { 
        e.preventDefault();
        $('#escuelasEncontradas').empty()
        $('#numero').focus()
    });

    
    $('#botonAccion').click(function (e) { 
        e.preventDefault();
            let numero = $('#numero').val()
            let programa_id = $('#programa').val()
            // alert(programa_id)
            let nombrePrograma = $('#programa').find("option:selected").text()        
            $.ajax({            
                type: "POST",
                url: "includes/mod_cen/admin/ajax/carrera_escuela.php",
                data: {numero:numero,programa_id:programa_id},
                dataType: "json",
                success: function (data) {
                    $('#escuelasEncontradas').empty()
                    
                    for (let item of data) {
                        
                        if (item.id=='0') {                            
                            $('#escuelasEncontradas').prepend(`<div class='col-md-12' id='rowEscuela${item.id}'>
                            <div class='alert alert-success'>
                                No se encontra escuela con al informacion proporcionada
                            </div></div>`)
                        } else {
                            if (item.estado==='1' && item.programa_id===$('#programa').val()) {
                                $('#escuelasEncontradas').prepend(`<div class='col-md-12' id='rowEscuela${item.id}'>
                                <div class='alert alert-warning'>
                                    ${item.numero} - ${item.cue} - ${item.nombre}<br>
                                    <button class='btn btn-success' id='quitar${item.id}'>Ya pertenece a: ${nombrePrograma}</button> 
                                </div></div>`)
                            }else{
                                $('#escuelasEncontradas').prepend(`<div class='col-md-12' id='rowEscuela${item.id}'>
                                    <div class='alert alert-dark'>
                                        ${item.numero} - ${item.cue} - ${item.nombre}<br>
                                        <button class='btn btn-success' id='agregar${item.id}'>Agregar</button> 
                                    </div></div>`)

                            }
                            $(`#agregar${item.id}`).focus()
                            $(`#numero`).val('')
                            // $(`#rowPrograma${data.id}`).effect("highlight", {color:"#ff0000"}, 3000);
                            // $().appendTo('#listadoProgramas');
                            console.log(`id:${item.id}--Nombre:${item.nombre}--Nombre:${item.estado}`)    
                        
                    }
                }   
                    // $('#nombre').val('').focus()        
                }
            });               
        
    });//fin evento click para botonAccion


    $('body').on('click','[id ^=agregar]', function (e) {    
        e.preventDefault();
        let id = $(this).attr('id').substr(7)
        let idPrograma = $('#programa').val()
        $.ajax({            
            type: "POST",
            url: "includes/mod_cen/admin/ajax/carrera_escuela.php",
            data: {id:id,idPrograma:idPrograma},
            dataType: "json",
            success: function (data) {
                $('#ultimasAgregadas').prepend(`<div class='col-md-12' id='rowAgregada${data.id}'>
                <p class='alert alert-dark'>${data.numero} - ${data.cue} - ${data.nombre}</p>
             </div>`)                
                $('#escuelasEncontradas').empty()
                $('#numero').focus()
                console.log(data.id)        
            }
        });
        // console.log('llego bien a click crearPrograma')
    });
});