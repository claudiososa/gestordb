$(document).ready(function () {
    $('#botonAccion').click(function (e) { 
        e.preventDefault();
        
        if ($(this).val()==='Modificar') {
            let id = $('#id').val()
            let nombre = $('#nombre').val()            
            $.ajax({            
                type: "POST",
                url: "includes/mod_cen/admin/ajax/programa.php",
                data: {editarNombre:nombre,editarId:id},
                dataType: "json",
                success: function (data) {
                    $(`#rowPrograma${data.id}`).remove();
                    $('#listadoProgramas').prepend(`<div class='col-md-12' id='rowPrograma${data.id}'><p class='alert alert-dark'><button class='btn btn-success' id='editar${data.id}'>Editar</button> ${data.nombre}</p></div>`)
                    // $().appendTo('#listadoProgramas');
                    $('#titulo').empty().text('Crear programa')
                    $('#nombre').val('')
                    $('#id').val('')
                    $('#botonAccion').val('Crear')

                    console.log(`Editando --- id:${data.id}--Nombre:${data.nombre}`)        
                }
            });
        }else if($(this).val()==='Crear'){
            let nombre = $('#nombre').val()
            $.ajax({            
                type: "POST",
                url: "includes/mod_cen/admin/ajax/programa.php",
                data: {nombre:nombre},
                dataType: "json",
                success: function (data) {
                    $('#listadoProgramas').prepend(`<div class='col-md-12' id='rowPrograma${data.id}'><p class='alert alert-dark'><button class='btn btn-success' id='editar${data.id}'>Editar</button> ${data.nombre}</p></div>`).fadeIn('slow')
                    $(`#rowPrograma${data.id}`).effect("highlight", {color:"#ff0000"}, 3000);
                    // $().appendTo('#listadoProgramas');
                    console.log(`id:${data.id}--Nombre:${data.nombre}`)
                    $('#nombre').val('').focus()        
                }
            });
        }
        
        // console.log('llego bien a click crearPrograma')
    });
    $('body').on('click','[id ^=editar]', function (e) { 
    // $('[id ^=editar]').on('click', function (e) { 
        e.preventDefault();
        let id = $(this).attr('id').substr(6)
        
        $.ajax({            
            type: "POST",
            url: "includes/mod_cen/admin/ajax/programa.php",
            data: {id:id},
            dataType: "json",
            success: function (data) {
                // $('#listadoProgramas').prepend(`<div class='col-md-12'><p class='alert alert-dark'>${data.nombre}</p></div>`)
                // $().appendTo('#listadoProgramas');
                $('#titulo').empty().text('Modificar programa')
                $('#nombre').val(data.nombre)
                $('#id').val(data.id)
                $('#botonAccion').val('Modificar')
                $('#nombre').focus()
                console.log(data.nombre)        
            }
        });
        // console.log('llego bien a click crearPrograma')
    });
});