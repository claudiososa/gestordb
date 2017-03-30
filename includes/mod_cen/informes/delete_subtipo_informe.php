<?php

include_once("includes/mod_cen/clases/SubTipoInforme.php");

include_once("includes/mod_cen/informes/listarSubTipo.php");

include_once("includes/mod_cen/clases/categoria.php");


if(isset($_POST["delete_sub_categoria"]) ){
  

 //echo "voy a eliminar el registro";
      
      $subtipo=new SubTipoInforme( $_GET["subTipoId"], NULL, NULL, NULL, NULL, NULL,NULL);
      $borrado=$subtipo->eliminar();

    //$cartel=$_GET["prueba"];
    echo $borrado; 
    
     
      $variablephp = "index.php?mod=slat&men=referentes&id=12";


?>
           
              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php 
      
      

    }else{
  //// inclusión de formulario para Modificar sub-Categoria
  include_once("includes/mod_cen/formularios/f_Delete_SubTipoInforme.php");


}
?>