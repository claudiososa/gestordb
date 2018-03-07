<?php
include_once("includes/mod_cen/clases/conexionPdo.php");
include_once("includes/mod_cen/clases/conexion.php");
include_once("includes/mod_cen/clases/vicedirector.php");
include_once("includes/mod_cen/clases/referente.php");




if (isset($_POST['delete_vicedirector'])) {
  //var_dump($_POST);
  

 
  $vicedirector =  new ViceDirector($_GET["vicedirectorId"], NULL, NULL, NULL, NULL, NULL);
  
  $borrado = $vicedirector->eliminar();
  echo $borrado;

 

 $variablephp = "index.php?mod=slat&men=personas&id=9";


?>
           
              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php 


}


include("includes/mod_cen/formularios/f_BajaViceDirector.php");

 
 ?>