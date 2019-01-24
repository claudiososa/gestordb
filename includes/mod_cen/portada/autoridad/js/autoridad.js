$(document).ready(function () {
    $('#departamento').change(function (e) { 
        e.preventDefault();        
        let select = $(this).find("option:selected").text()        
        $('#cardDepartamento').empty();
        $('<p>'+select+'</p>').appendTo('#cardDepartamento');        
    });
    
});