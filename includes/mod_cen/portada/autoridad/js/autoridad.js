$(document).ready(function () {
     
    let mapa1 = {
        departamento:{
            description:'Departamento',
            data:''
            },
        localidad:{
                description:'Localidad',
                data:''
                },
        nivel:{
                description:'Nivel',
                data:''
               },
    }
    
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
                //console.log("ok");            
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

        $('#cardDepartamento').empty()
        if (departamentoId != '0' ) {            
            mapa1.departamento.data = select         
            $(`<p><div>${mapa1.departamento.description} <b>${mapa1.departamento.data}</b> </div></p>`).appendTo('#cardDepartamento');
        }
        
    });
    

    $('#localidad').change(function (e) { 
        e.preventDefault();                
        let select = $(this).find("option:selected").text()        
        let localidadId = $(this).val()  
        let departamento = $('#departamento').val()
        $('#escuelaListado').empty()
        //$('#divNivel').show()

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
                    console.log(item)                 
                    console.log(item['Primaria Común'])
                   
                    $(`<option value="Primaria Común">Primaria Común (${item['Primaria Común']})</option>`).appendTo("#nivel")
                    $(`<option value="Secundaria Común">Secundaria Común (${item['Secundaria Común']})</option>`).appendTo("#nivel")
                    $(`<option value="Secundaria Técnica">Secundaria Técnica (${item['Secundaria Técnica']})</option>`).appendTo("#nivel")
                    $(`<option value="Secundaria Rural">Secundaria Rural (${item['Secundaria Rural']})</option>`).appendTo("#nivel")
                    $(`<option value="ISFD">ISFD (${item['ISFD']})</option>`).appendTo("#nivel")
                    $(`<option value="BSPA">BSPA (${item['BSPA']})</option>`).appendTo("#nivel")
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
        } 
        if (localidadId != '0') {
            mapa1.localidad.data = select
            $('#cardDepartamento').empty()
            $(`<p><div>${mapa1.departamento.description} <b>${mapa1.departamento.data}</b> / ${mapa1.localidad.description} <b>${mapa1.localidad.data}</b>  </div></p>`).appendTo('#cardDepartamento');    
        }
    
    });

    $('#nivel').change(function (e) { 
        e.preventDefault();        
        let select = $(this).find("option:selected").text()        
        let localidad = $('#localidad').val()        
        let nivel = $(this).val()
        let nDepartamento = $('#departamento').val()
        
            $.ajax({
                url:'includes/mod_cen/portada/autoridad/ajax/ajaxEscuela.php',
                type: 'POST',
                dataType:'json',
                data:{nivel:nivel,localidad:localidad,nDepartamento:nDepartamento}
        
            })
            .done(function (lista){
                
                $('#escuelaListado').empty()
                // $('#divNivel').show()
                for(let item of lista)
                {
                    $(`<div><p class="alert alert-dark">
                    <button id="idEscuela${item.escuelaId}" type="button" class="btn btn-primary">
                    ${item.numero} <span class="badge badge-light"></span>
                    </button>    
                    ${item.cue}  ${item.nombre}</p></div><div style="display:none" id="detalleEscuela${item.escuelaId}">Datos Datos</div>`).appendTo("#escuelaListado");                                     
                }
                $('#escuelaListado').show(1000)
                
                eventoClickEscuela()
                
            })
            .fail(function(){
                console.log('error')
            })
            
            if (nivel != '0') {
                mapa1.nivel.data = select              
                $('#cardDepartamento').empty()                
                $(`<p><div>${mapa1.departamento.description} <b>${mapa1.departamento.data}</b> 
                          / ${mapa1.localidad.description} <b>${mapa1.localidad.data}</b>  
                          / ${mapa1.nivel.description} <b>${mapa1.nivel.data}</b>  
                 </div></p>`).appendTo('#cardDepartamento');    
                
           }                     
        
    });
   
});