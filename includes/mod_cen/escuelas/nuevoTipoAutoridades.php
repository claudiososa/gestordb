<?php

include_once("includes/mod_cen/clases/TipoAutoridades.php");






if(isset($_POST["guardar_tipo_autoridad"]) AND $_POST["cargoAutoridad"]<>"" AND $_POST["login"]<>"" ){


  
  $nuevaAutoridad = new TipoAutoridades(null,$_POST["cargoAutoridad"],$_POST["login"]);

  $guardar = $nuevaAutoridad->agregar();

  if ($guardar== 1){
   
    $variablephp = "index.php?mod=slat&men=escuelas&id=27";


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

  

  include_once("includes/mod_cen/formularios/f_nuevoTipoAutoridades.php");
}
?>
