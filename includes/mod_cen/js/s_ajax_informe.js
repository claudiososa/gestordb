$(document).ready(function () {

  $("#formInforme").submit(function(event){

    var tipo = $("#tipo").val();
    var subtipo = $("#subtipo").val();
    if(tipo=="0"){
      alert("Debe seleccionar una categoría");
      event.preventDefault();
    }
    if(subtipo=="0"){
      alert("Debe seleccionar una subcategoría");
      event.preventDefault();  
    }

  });


    $("#tipo").change(function (ev){
      //ev.preventDefault();
      var opcion = $(this).val();

      if(opcion!=0){
      $.ajax({
        url:"includes/mod_cen/clases/SubTipoInforme.php",
        method:  'post',
        data:  {opcion:opcion},
        success: function(data, textStatus, xhr) {
        //  alert(data);
          $("#divsubtipo").html(data);
        }
      });
    }else{
      var divAnterior ='<div class="col-md-12" id="divsubtipo">'+
         '<select  class="form-control" id="subtipo" name="subtipo">'+
               '<option selected value="0">Seleccione</option>'+
         '</select></div>';
      $("#divsubtipo").html(divAnterior);
    }
    });
});
