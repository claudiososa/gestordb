<script type="text/javascript" src="includes/mod_cen/portada/botonLeido.js"></script>
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/leido.php");

if(isset($_GET['prioridad'])){
	$informe = new Informe(null,null,$_GET["referenteId"],$_GET["prioridad"]);
	$buscar_informe = $informe->buscar();
}elseif(isset($_GET['date'])){
		$mesAc=date("m");
		$informe = new Informe();
	  $buscar_informe=$informe->summary('mesAñoReferente',null,null,null,$_GET['month'],$_GET['year'],null,$_GET["referenteId"]);
}else{
	$informe = new Informe(null,null,$_GET["referenteId"]);
	$buscar_informe = $informe->buscar();
}






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
	<?php echo "<h3>Informes creados por ".$dato_referente->apellido.", ".$dato_referente->nombre."</h3><br>";	?>
	<table id='tablaPrincipal' class='table table-hover table-striped table-condensed '>


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

			<?php echo "<tr id= 'encabezado.$fila->informeId'>";?>
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
				echo "<td><button id= 'leido.$fila->informeId' class='btn btn-success'>&nbsp;&nbsp;Leido&nbsp;&nbsp;&nbsp;</button></td>";
			}else {
				echo  "<td><a href='#' class='btn btn-danger'>No Leido</a></td>";
			}
			?>

			<td><?php echo $fila->prioridad;?></td>


		</tr>

		<?php
		//}
		echo "<tr></tr>";
		echo "<tr id= 'fila$fila->informeId' >";
		echo '<td colspan=8>';
		echo "<table>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Usuario</th>";
		echo "</tr>";
		echo "</thead>";
	  echo "<tbody>";
		$leido= new Leido(null,$fila->informeId);
		$todosLosLeidos=$leido->buscar(null,'distinto');
		while ($dato = mysqli_fetch_object($todosLosLeidos)) {
			# code...
			echo '<tr>';
			echo '<td>'.$dato->nombre.' '.$dato->apellido.'</td>';
			echo '</tr>';
		}

	  echo "</tbody>";
		echo "</table>";
		echo '</td>';
		echo "</tr>";
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
		$('#tablaPrincipal tr[id*=fila]').hide();

	//si presiona algun boton de leido dentro de la lista de todos los informes que muestra la tabla
	  $("button[id]").click(function() {

	    let idTr = $(this).parent().parent().attr('id').substring(11)
	    idTr = 'fila'+idTr
	   if( $('#'+idTr).is(':visible') ){
	    $('#'+idTr).hide();
	  }else{
	    $('#'+idTr).show();
	  }

	});


);
</script>
