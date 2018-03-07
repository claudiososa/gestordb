<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>
<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/leido.php");

// create object informe and search of last 20 informe
$informes= new informe();

$b_informe = $informes->buscar(20,'Supervisor-Nivel-Superior');

////////////////////////////////////////////////

// create object mis_informes and filter of my report, last 10
$mis_informes= new informe(null,null,$_SESSION["referenteId"]);

$b_mis_informe = $mis_informes->buscar(10);

echo '<div class="container">';
?>

<?php
	echo '<div class="row">';
		echo '<div class="col-md-6">';



if(mysqli_num_rows($b_mis_informe)>0){
	?>

	<div class="panel panel-primary">
		<div class="panel-heading" id="panel1">
          <span class="panel-title clickable">
			<h4>Mis Informes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="index.php?mod=slat&men=informe&id=6&referenteId=<?php echo $_SESSION["referenteId"] ?>" class="pull-center"><font color="SkyBlue">Ver Todos</font></a><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php


	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Leido</th>";
	echo "<th>Nº</th>";
	echo "<th>Prioridad</th>";
	echo "</tr>";
	echo "</thead>";
  echo "<tbody>";
	while ($fila=mysqli_fetch_object($b_mis_informe)){

		$escuela= new Escuela($fila->escuelaId);
		$buscar_escuela= $escuela->buscar();
		$dato_escuela= mysqli_fetch_object($buscar_escuela);


		$referente = new Referente($_SESSION["referenteId"]);
		$b_referente = $referente->buscar();

		$dato_referente= mysqli_fetch_object($b_referente);

		$persona = new Persona($dato_referente->personaId);

		$b_persona = $persona->buscar();

		$dato_persona=mysqli_fetch_object($b_persona);



		echo "<tr>";
		?>

		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
		<?php
		//$leyo=0;
		$leyo=false;
		//echo $fila->informeId."-- ".$dato_referente->etjcargo."<br>";
		$leido= new Leido(null,$fila->informeId,$dato_referente->etjcargo);
		$dato_leido=$leido->buscar();
		$leyo = mysqli_num_rows($dato_leido);
		$leido= new Leido(null,$fila->informeId,$dato_referente->etjcargo2);
		$dato_leido=$leido->buscar();
		$leyo1 = mysqli_num_rows($dato_leido);

		if($leyo || $leyo1){		
			echo "<td><a href='#' class='btn btn-success'>L&nbsp;</a></td>";
		}else {
			echo  "<td><a href='#' class='btn btn-danger'>N L</a></td>";
		}
		//echo "<td>vio</td>";
		echo "<td>".$dato_escuela->numero."</td>";
		echo "<td>".$fila->prioridad."</td>";
		echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<?php

}
echo "</div>";
echo "<div class='col-md-6'>";


if(mysqli_num_rows($b_informe)>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel2"><span class="panel-title clickable">
			<h4>Ultimos informes creados<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php

	echo "<table id='myTable1' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Nº</th>";
	echo "<th>Creado por...</th>";
	echo "<th>Prioridad</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($fila=mysqli_fetch_object($b_informe)){

		$escuela= new Escuela($fila->escuelaId);
		$buscar_escuela= $escuela->buscar();
		$dato_escuela= mysqli_fetch_object($buscar_escuela);

		$referente = new Referente($fila->referenteId);
		$b_referente = $referente->buscar();

		$dato_referente= mysqli_fetch_object($b_referente);

		$persona = new Persona($dato_referente->personaId);

		$b_persona = $persona->buscar();

		$dato_persona=mysqli_fetch_object($b_persona);
		echo "<tr>";
		?>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
		<?php
		echo "<td>".$dato_escuela->numero."</td>";
		echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
		echo "<td>".$fila->prioridad."</td>";
		echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<?php

}
echo "</div>";
echo "</div>";
echo "<div class='col-md-12'>";



?>

<script type="text/javascript">
$(document).ready(function()
		{
				//$("#myTable").tablesorter();
				$("#myTable").tablesorter( {sortList: [[0,1]]} );
				//$("#myTable1").tablesorter();
				$("#myTable1").tablesorter( {sortList: [[0,1]]} );
		}
);
</script>
<div class="row">

<div class="panel panel-primary">
	<div class="panel-heading" id="panel3"><span class="panel-title clickable">
		<h4>Documentación<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4>
	</span>
	</div>
	<div class="panel-body">

				<?php
				require_once("includes/mod_cen/documentos/documento.php")
				?>
</div>
</div>
</div>
