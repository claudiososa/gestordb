$(document).ready(function() {
 


   $("#input-img").fileinput({
      browseClass: "btn btn-success btn-block",
      allowedFileExtensions: ["jpg","png","jpeg"],
      maxFileCount: 1,
      showCaption: true,
      initialCaption: "Seleccione 1 archivo para foto de perfil",
      showRemove: false,
      maxFileSize: 10240,
      maxFilePreviewSize: 2048,
      showUpload: false
       });

// aqui trabajar la modificacion del los datos del perfil [Inicio]

	 $(".saveDatos").click(function(event){

           
          // console.log("dentro del boton saveDatos")
           

              let personaId = $("#personaId").val()         	
              let apellido = $("#apellido").val()
              let nombre = $("#nombre").val()
              let dni = $("#dni").val()
              let cuil = $("#cuil").val()
              let telefonoC = $("#telefonoC").val()
              let telefonoM = $("#telefonoM").val()
              let email = $("#email").val()
              let direccion = $("#direccion").val()
              let facebook = $("#facebook").val()
              let twitter = $("#twitter").val()
              let localidadId = $("#localidadId option:selected").val()
              let cpostal = $("#cpostal").val()
              let ubicacion = $("#ubicacion").val()
              let fotoPerfil = $("#fotoPerfil").val()
                

                           

           $('#formuploadajax').submit (function(e) {
                       
            // console.log("dentro de formuploadajax")

            let paqueteData = new FormData();
            let ins = document.getElementById('input-img').files.length;
                for (var x = 0; x < ins; x++) {
                     paqueteData.append("input-img[]", document.getElementById('input-img').files[x]);
                  } 
        
            
            paqueteData.append('personaId', personaId);        
            paqueteData.append('apellido', apellido);
            paqueteData.append('nombre', nombre);
            paqueteData.append('dni', dni);
            paqueteData.append('cuil', cuil);
            paqueteData.append('telefonoC', telefonoC);
            paqueteData.append('telefonoM', telefonoM);
            paqueteData.append('email', email);
            paqueteData.append('direccion', direccion);
            paqueteData.append('facebook', facebook);
            paqueteData.append('twitter', twitter);
            paqueteData.append('localidadId', localidadId);
            paqueteData.append('cpostal', cpostal);
            paqueteData.append('ubicacion', ubicacion);
            paqueteData.append('fotoPerfil', fotoPerfil);

           
            $.ajax({
                url: 'includes/mod_cen/clases/ajax/personaEditado.php',
                type: 'POST',
                contentType: false,
                processData: false,
                cache:false,
                data: paqueteData
              })
            	

             
           

              .done(function(data) {
                console.log('success');
               		
                // alert('volvemos bien'); 
               
              })
              .fail(function() {
                console.log("error ");
              })
              .always(function() {
                console.log("complete");
              });
       
             
      });  

   });   
  



});   