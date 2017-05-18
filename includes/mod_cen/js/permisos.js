$(document).ready(function () {
  
  

  $("#formDoc").submit(function(event){
   
    var tipo = $("#tipo").val();
    var subtipo = $("#subtipo").val();
    if(tipo=="0"){
      alert("Debe seleccionar una categoría");
      event.preventDefault();
    }else{
    if(subtipo=="0"){
      alert("Debe seleccionar un permiso");
      event.preventDefault();
    }
      }
    

  });


    $("#tipo").change(function (ev){
      //ev.preventDefault();
      var opcion = $(this).val();
     // alert(opcion);
     
      //alert("hola mundo");
      if(opcion!=0){
      $.ajax({
       
        url:"includes/mod_cen/clases/PermisoCategoriaDoc.php",
        method:  'post',
        data:  {opcion:opcion},
        success: function(data, textStatus, xhr) {
         //alert(data);
         $("#permisodoc").html(data);
          //alert(data);
        }
      });
    }
    });
});
