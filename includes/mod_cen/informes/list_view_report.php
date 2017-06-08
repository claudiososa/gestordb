<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/TipoInforme.php");

if(isset($_POST["escuelaId"])){
	$informe = new Informe(null,$_POST["escuelaId"]);
}else{
	$informe = new Informe(null,$_GET["escuelaId"]);
}

$escuela = new Escuela($informe->escuelaId);
$buscar_escuela = $escuela->buscar();
$dato_escuela = mysqli_fetch_object($buscar_escuela);


if ($_GET['tipo']) {
  switch ($_GET['tipo']) {
    case 'conectar':
      $arrayTipo = array('ETT','ETJ','Coodinador');
      break;
    case 'pmi':
        $arrayTipo = array('ATT','CoordinadorPmi');
        break;
    default:
      # code...
      break;
  }
    $buscar_informe = $informe->buscar(null,null,$arrayTipo);
}else{
  $buscar_informe = $informe->buscar();
}

//$informe = mysqli_fetch_object($buscar_informe);



echo '<div class="container">';
$cantidad=mysqli_num_rows($buscar_informe);
if ($cantidad>0){

	echo "<h2>Informes para ".$dato_escuela->nombre."</h2><br>";

	?>
	<div class="table-responsive">
	<table class='table table-hover table-striped table-condensed '>
		<tr>
			<th>Id</th>
			<th>Fecha creación</th>
			<th>Tipo</th>
			<th>Título</th>
			<th>Fecha de Visita</th>
			<th>Creado por...</th>
			<th>Última modificación</th>
		</tr>
	<?php
	while ($fila=mysqli_fetch_object($buscar_informe))
	{
		$referente= new Referente($fila->referenteId);
		$buscar_referente = $referente->buscar();
		$dato_referente= mysqli_fetch_object($buscar_referente);

		$persona= new Persona($dato_referente->personaId);
		$buscar_persona=$persona->buscar();
		$dato_persona=mysqli_fetch_object($buscar_persona);

		$tipoInforme = new TipoInforme($fila->nuevotipo);
		$buscarTipoInforme = $tipoInforme->buscar();
		$datoTipoInforme = mysqli_fetch_object($buscarTipoInforme);

	?>

		<tr>
			<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
			<td><?php echo $fila->fechaCarga;?></td>
			<td><?php echo $datoTipoInforme->nombre;?></td>
			<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
			<td><?php echo $fila->fechaVisita;?></td>
			<td><?php echo $dato_persona->apellido.", ".$dato_persona->nombre;?></td>
			<td><?php echo $fila->fechaModificado;?></td>


		</tr>
		<?php
	}
	echo "</table>";

	echo "</div>";
}else{
	echo "No existe Informes para esta Institución";
}
echo "</div>";
