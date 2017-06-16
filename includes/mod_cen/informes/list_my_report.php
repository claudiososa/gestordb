<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/leido.php");

if(isset($_GET['prioridad'])){
	$informe = new Informe(null,null,$_GET["referenteId"],$_GET["prioridad"]);
}else{
	$informe = new Informe(null,null,$_GET["referenteId"]);
}



$buscar_informe = $informe->buscar();


$referente= new Referente($_GET["referenteId"]);
$buscar_referente = $referente->buscar();
$dato_referente= mysqli_fetch_object($buscar_referente);

$persona= new Persona($dato_referente->personaId);
$buscar_persona=$persona->buscar();
$dato_persona=mysqli_fetch_object($buscar_persona);

$cantidad=mysqli_num_rows($buscar_informe);
if ($cantidad>0){


	?>
	<div class="table-responsive">
	<div class='container'>
	<?php echo "<h3>Informes creados por ".$dato_persona->apellido.", ".$dato_persona->nombre."</h3><br>";	?>
	<table id='myTable' class='table table-hover table-striped table-condensed '>


		<thead>
			<tr>
				<th>Id</th>
				<th>Fecha creación</th>
				<th>Tipo</th>
				<th>Título</th>
				<th>Escuela</th>
				<th>Fecha de Visita</th>
				<th>ETJ</th>
				<th>Prioridad</th>
			</tr>
		</thead>
		<tbody>
	<?php
	while ($fila=mysqli_fetch_object($buscar_informe))
	{

		$referente = new Referente($_GET["referenteId"]);
		$b_referente = $referente->buscar();

		$dato_referente= mysqli_fetch_object($b_referente);
		//if($dato_referente->tipo<>"Supervisor"){

	?>

		<tr>
			<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
			<td><?php echo $fila->fechaCarga;?></td>
			<td><?php echo $fila->tipo;?></td>
			<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
			<td><?php echo $fila->numero;?></td>
			<td><?php echo $fila->fechaVisita;?></td>
			<?php
			$leido= new Leido(null,$fila->informeId,$dato_referente->etjcargo);
			$dato_leido=$leido->buscar();
			$leyo=mysqli_num_rows($dato_leido);
			$leido= new Leido(null,$fila->informeId,$dato_referente->etjcargo2);
			$dato_leido=$leido->buscar();
			$leyo1 = mysqli_num_rows($dato_leido);

			if($leyo || $leyo1){		
				echo "<td><a href='#' class='btn btn-success'>&nbsp;&nbsp;Leido&nbsp;&nbsp;&nbsp;</a></td>";
			}else {
				echo  "<td><a href='#' class='btn btn-danger'>No Leido</a></td>";
			}
			?>

			<td><?php echo $fila->prioridad;?></td>


		</tr>

		<?php
		//}
	}
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
	echo "</div>";

}else{
	echo "No existe Informes para esta Institución";
}


?>
<script type="text/javascript">
$(document).ready(function()
		{
			//$("#myTable").tablesorter();
			$("#myTable").tablesorter( {sortList: [[0,1]]} );
			//$("#myTable1").tablesorter();
			//$("#myTable1").tablesorter( {sortList: [[0,1]]} );
			//$("#informe_ett").tablesorter( {sortList: [[1,1]]} );
		}
);
</script>
