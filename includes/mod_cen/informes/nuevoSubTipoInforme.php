<?php

include_once("includes/mod_cen/clases/SubTipoInforme.php");

include_once("includes/mod_cen/clases/referente.php");







if(isset($_POST["guardar_sub_categoria"]) AND $_POST["nombre"]<>"" AND $_POST["descripcion"]<>"" AND $_POST["estado"]<>"" ){



  echo "<br><br>";

  $fecha=date("Y-m-d");

 $dato_ref_esc =  new Referente($_SESSION["referenteId"]);
                    $buscar_dato_ref_esc =  $dato_ref_esc->buscar();
                    $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
                    $ref_esc_per= $ref_esc->personaId;

  $Subcateg= new SubTipoInforme(null,$_POST["tipoId"],$_POST["nombre"],$_POST["descripcion"],$_POST["estado"],$fecha,$ref_esc_per);

  $guardar = $Subcateg->agregar();

  if ($guardar== 1){
    $variablephp = "index.php?mod=slat&men=referentes&id=12";
    $variablephp = "index.php?mod=slat&men=informe&id=13";

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

  include_once("includes/mod_cen/clases/TipoInforme.php");

  $oTipo= new TipoInforme();
  $b_referente= $oTipo->buscar();

  include_once("includes/mod_cen/formularios/f_nuevoSubTipoInforme.php");
}
?>
