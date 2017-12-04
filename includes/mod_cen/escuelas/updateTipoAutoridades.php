
<?php

include_once("includes/mod_cen/clases/TipoAutoridades.php");



if(isset($_POST["modificarTipoAutoridad"]) ){





      $tipoAutoridad=new TipoAutoridades( $_GET["tipoId"], $_POST["cargoAutoridad"], $_POST["login"]);
      $editado=$tipoAutoridad->editar();

    
    echo $editado;


      $variablephp = "index.php?mod=slat&men=escuelas&id=27";


?>

              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php



    }else{
  //// inclusión de formulario para Modificar tipo autoridad
  include_once("includes/mod_cen/formularios/f_Modif_TipoAutoridades.php");


}
?>
