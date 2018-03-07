
<?php

include_once("includes/mod_cen/clases/SubTipoInforme.php");

include_once("includes/mod_cen/informes/listarSubtipo.php");

include_once("includes/mod_cen/clases/categoria.php");


if(isset($_POST["modificar_sub_categoria"]) ){


 //echo "voy a modificar";
      $fecha=date("Y-m-d");


      $subtipo=new SubTipoInforme( $_GET["subTipoId"], $_POST["tipoId"], $_POST["nombre"], $_POST["descripcion"], $_POST["estado"],$fecha,$_SESSION["referenteId"]);
      $editado=$subtipo->editar();

    //$cartel=$_GET["prueba"];
    echo $editado;


      $variablephp = "index.php?mod=slat&men=informe&id=13";


?>

              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php



    }else{
  //// inclusión de formulario para Modificar sub-Categoria
  include_once("includes/mod_cen/formularios/f_Modif_SubTipoInforme.php");


}
?>
