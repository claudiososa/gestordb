function eventoClickEscuela(){
    $('[id ^=idEscuela]').on('click', function (e) { 
        e.preventDefault();        
        let escuelaId = $(this).attr('id').substr(9)
        $(`#detalleEscuela${escuelaId}`).toggle()
        
    });
}
