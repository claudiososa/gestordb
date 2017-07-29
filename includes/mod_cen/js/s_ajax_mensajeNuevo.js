$(document).ready(function () {

  let referentes = 'si'
  $.ajax({
    url: 'includes/mod_cen/clases/Mensajes.php',
    type: 'post',
    dataType: 'html',
    data: {referentes:referentes},
    success: function(data, textStatus, xhr) {
      alert(data)
      //$("#divsubtipo").html(data);
    }

  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });


  $("#input-img").fileinput({
      browseClass: "btn btn-success btn-block",
      allowedFileExtensions: ["jpg", "pdf"],
      maxFileCount: 5,
      showCaption: true,
      initialCaption: "Seleccione archivos para informe",
      showRemove: false,
      maxFileSize: 1024,
      maxFilePreviewSize: 1024,
      showUpload: false
  });


  $("#input-24").fileinput({


          initialPreview: [
              'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
              'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg'
          ],
          initialPreviewAsData: true,
          initialPreviewConfig: [
              {caption: "Moon.jpg", size: 930321, width: "120px", key: 1},
              {caption: "Earth.jpg", size: 1218822, width: "120px", key: 2}
          ],
          showCaption: false,
        showRemove: false,
        showDelete: false,

        showUpload: false

      });



  $("#formInforme").submit(function(event){
    var fecha = $("#fechaVisita").val();
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


    if(tipo=="1" && fecha==""){
        alert("Debe ingresar Fecha de Visita");
      event.preventDefault();
}

  });


    $("#tipo").change(function (ev){
      //ev.preventDefault();
      var opcion = $(this).val();
      if (opcion==2) {
        $("#fechaVisita").attr("disabled","disabled");
        $("#fechaVisita").val("");
      }else if (opcion==1) {
        $("#fechaVisita").removeAttr("disabled");

      }

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
