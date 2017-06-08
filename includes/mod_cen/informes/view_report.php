
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/respuesta.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/leido.php");
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/clases/img.php");
include_once("includes/mod_cen/clases/imgRespuesta.php");

$dato_informe = new Informe($_GET["informeId"]);
$buscar_informe = $dato_informe->buscar();
$informe = mysqli_fetch_object($buscar_informe);

$dato_img = new Img(null,$_GET["informeId"]);
$buscar_img = $dato_img->buscar();


//marca el informe como leido.
if(isset($_GET['informeId'])<>""){
  $fecha=date("Y-m-d H:i:s");
  $leido = new Leido(null,$informe->informeId,$_SESSION['referenteId'],$fecha);
  $guardar_leido=$leido->agregar();
}



//$informe = new Informe(null,$_GET["escuelaId"]);
$escuela = new Escuela($informe->escuelaId);
//$escuela = new Escuela($_GET["escuelaId"]);
$buscar_escuela = $escuela->buscar();
$dato_escuela = mysqli_fetch_object($buscar_escuela);

$escuela->localidadId = $dato_escuela->localidadId;

$localidad =$escuela->buscarLocalidad();
$dato_localidad= mysqli_fetch_object($localidad);



$o_informe = new Informe($_GET["informeId"]);
$buscar_informe = $o_informe->buscar();

$informe=mysqli_fetch_object($buscar_informe);
$nuevo=1;
?>
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h5>Informe: <?php echo $informe->titulo ?></h5>
    </div>
    <div class="panel-body ">
    <div class="container">
      Id: <?php echo $informe->informeId ?><br>
       Creado por :<?php
       $referente= new Referente($informe->referenteId);
       $buscar_ref = $referente->Persona($informe->referenteId);
       $dato_ref = mysqli_fetch_object($buscar_ref);
       echo $dato_ref->apellido.", ".$dato_ref->nombre ?><br>
       Fecha de creación: <?php echo $informe->fechaCarga ?><br><br>
    </div>


<div class="col-md-12">
<a class="btn btn-primary" href="index.php?mod=slat&men=informe&id=7&informeId=<?php echo $informe->informeId ?>">Responder</a>
</div>
<?php

$permisos = new TipoPermisos(NULL,
                             NULL,
                             $_SESSION["tipo"]);
$buscarPermisos = $permisos->buscar();
$ver="si";

$listaSubTipo = new SubTipoInforme(NULL,$informe->nuevotipo);
$buscarSubTipo= $listaSubTipo->buscar();
//$datoSubTipo = mysqli_fetch_object($buscarSubTipo);

include_once("includes/mod_cen/formularios/f_informe.php");
?>
  <div class="col-md-12">
      <a class="btn btn-primary" href="index.php?mod=slat&men=informe&id=7&informeId=<?php echo $informe->informeId ?>">Responder</a>

  </div>
</div>
  <br>
<?php
//buscar respuesta de este informe
$respuesta=new Respuesta(null,$_GET['informeId']);
$buscar_respuesta= $respuesta->buscar();

echo '<div class="panel-group">';
while ($fila = mysqli_fetch_object($buscar_respuesta)) {
  $referente= new Referente($fila->referenteId);
  $buscar_referente = $referente->Persona($fila->referenteId);
  $dato_referente = mysqli_fetch_object($buscar_referente);
  $dato_img = new imgRespuesta(null,$fila->respuestaId);
  $buscar_img = $dato_img->buscar();

?>
  <div class="panel panel-info">
    <div class="panel-heading">
      <h5>Respuesta - Fecha <?php echo $fila->fechaCarga." Autor: ".$dato_referente->nombre." ".$dato_referente->apellido ?></h5>
    </div>
    <div class="panel-body">
      <?php echo $fila->contenido ?>
    </div>
    <div class="panel-footer">
    Archivos Adjuntos <br>
    <?php
    while ($fila = mysqli_fetch_object($buscar_img)) {
      echo "<a href='img/respuestas/".$fila->nombre."'>".$fila->nombre."</a><br>";
    }
    ?>
    </div>
  </div>

  <?php


}
//echo "</div>";
echo "</div>";
echo "</div>";

/*
<script type="text/javascript">
var arrayFile = new Array();
<?php
      foreach ($arrayFile as $indice=>$valor)
      {
        ?>
        archivo =
        alert('aqui');
        <?php
        //  echo 'arrayFile['. $i .'] = '. $arrayFile($i) .';\n';
      }
?>
//alert(arrayFile[0]);
</script>
*/
?>
