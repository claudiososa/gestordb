$(document).ready(function () {
    $('#departamento').change(function (e) { 
        e.preventDefault();        
        let select = $(this).find("option:selected").text()        
        let departamentoId = $(this).val()        
        $('#cardDepartamento').empty();  
        $('#nivel').empty()
        $('#divNivel').hide()
        $('#escuelaListado').hide()
        $('<p>Departamento: '+select+'</p>').appendTo('#cardDepartamento');    

        if (departamentoId==='todos') {
            $('#divLocalidad').hide()   
            let localidadId = 'todos'        
            $.ajax({
                url:'includes/mod_cen/portada/autoridad/ajax/ajaxEscuela.php',
                type: 'POST',
                dataType:'json',
                data:{localidadId:localidadId}
        
            })
            .done(function (lista){
                $('#nivel').empty()
                $('#divNivel').show(500)
                $(`<option value="0">Seleccone Nivel</option>`).appendTo("#nivel");                   
    
                
                for(let item of lista)
                {
                    $(`<option value="${item.descripcion}">${item.descripcion} (${item.total})</option>`).appendTo("#nivel");                   
                }
            })
            .fail(function(){
    
            })

        }else{        
            
            $.ajax({
                url: 'includes/mod_cen/portada/autoridad/ajax/ajaxLocalidad.php',
                type: 'POST',
                dataType: 'json',
                data: {departamentoId:departamentoId}
            })
            .done(function(lista) {    
                console.log("ok");            
                $('#localidad').empty()
                $(`<option value='0'>Seleccione Localidad</option>`).appendTo("#localidad");
                $(`<option value='todos'>Todas las localidades</option>`).appendTo("#localidad");
            for (let item of lista) {//lista de las localidad para el departamento seleccionado
                $(`<option value="${item.id}">${item.descripcion}</option>`).appendTo("#localidad");                   
            }      
            $('#divLocalidad').show(500)
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {      
            });
        }
    });
    

    $('#localidad').change(function (e) { 
        e.preventDefault();        
        let select = $(this).find("option:selected").text()        
        let localidadId = $(this).val()  
        let departamento = $('#departamento').val()
        if (localidadId==='todos') {//si fue seleccionad a la opcion todas las localidades
            $.ajax({
                url:'includes/mod_cen/portada/autoridad/ajax/ajaxEscuela.php',
                type: 'POST',
                dataType:'json',
                data:{departamento:departamento}
        
            })
            .done(function (lista){
                $('#nivel').empty()
                $('#divNivel').show(500)
                $(`<option value="0">Seleccone Nivel</option>`).appendTo("#nivel");                   

                
                for(let item of lista)
                {
                    if (item.total > 0) {
                        $(`<option value="${item.descripcion}">${item.descripcion} (${item.total})</option>`).appendTo("#nivel");                       
                    }
                    
                }
            })
            .fail(function(){

            })            
        }else{
            $.ajax({
                url:'includes/mod_cen/portada/autoridad/ajax/ajaxEscuela.php',
                type: 'POST',
                dataType:'json',
                data:{localidadId:localidadId}
        
            })
            .done(function (lista){
                $('#nivel').empty()
                $('#divNivel').show(500)
                $(`<option value="0">Seleccone Nivel</option>`).appendTo("#nivel");                   

                
                for(let item of lista)
                {
                    if (item.total > 0) {
                        $(`<option value="${item.descripcion}">${item.descripcion} (${item.total})</option>`).appendTo("#nivel");                       
                    }
                    
                }
            })
            .fail(function(){

            })
            // alert (localidadId)
            // $('#cardDepartamento').empty();  
            // $('<p>'+select+'</p>').appendTo('#cardDepartamento');    
        } 
    });

    $('#nivel').change(function (e) { 
        e.preventDefault();        
        let select = $(this).find("option:selected").text()        
        let localidad = $('#localidad').val()        
        let nivel = $(this).val()        
        $.ajax({
            url:'includes/mod_cen/portada/autoridad/ajax/ajaxEscuela.php',
            type: 'POST',
            dataType:'json',
            data:{nivel:nivel,localidad:localidad}
    
        })
        .done(function (lista){
            $('#escuelaListado').empty()
            // $('#divNivel').show()
            for(let item of lista)
            {
                $(`<p class="alert alert-dark">
                <button type="button" class="btn btn-primary">
                ${item.numero} <span class="badge badge-light"></span>
                </button>    
                ${item.cue}  ${item.nombre}</p>`).appendTo("#escuelaListado");                 
                // $(`<br>${item.numero}--${item.cue}--${item.nombre}`).appendTo("#escuelaListado");                 
            }
            $('#escuelaListado').show(1000)
        })
        .fail(function(){

        })
        // alert (localidadId)
        // $('#cardDepartamento').empty();  
        // $('<p>'+select+'</p>').appendTo('#cardDepartamento');    
 
    });
});