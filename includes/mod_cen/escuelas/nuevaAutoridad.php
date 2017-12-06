<?php

include_once("includes/mod_cen/clases/TipoAutoridades.php");
include_once("includes/mod_cen/clases/Autoridades.php");



 

if(isset($_POST["guardar_nuevaAutoridad"])  ){


  
  $nuevaAutoridad = new Autoridades(null,$_POST["escuelaId"],$_POST["tipoId"],$_POST["personaId"],$_POST["mañana"],$_POST["intermedio"],$_POST["tarde"],$_POST["vespertino"],$_POST["noche"],$_POST["extendida"]);

  $guardar = $nuevaAutoridad->agregar();

  if ($guardar== 1){
   
    $variablephp = "index.php?mod=slat&men=escuelas&id=30";


?>

              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php


  }else{
    echo "Error al guardar";
  }
}else{


 include_once("includes/mod_cen/clases/TipoAutoridades.php");

  $objTipo= new TipoAutoridades();
  $tipoA= $objTipo->buscar();
  
 include_once("includes/mod_cen/formularios/f_nuevaAutoridad.php");
}
?>