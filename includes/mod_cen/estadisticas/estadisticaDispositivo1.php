
<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>
<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/leido.php");
include_once("includes/mod_cen/clases/Dispositivo.php");
include_once("includes/mod_cen/clases/referente.php");



echo '<div class="container">';

	echo '<div class="row">';
		echo '<div class="col-md-6">';



   // inicio de ultimos 10 accesos
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel1">
          <span class="panel-title clickable">
			<h4>Ultimos 10 Accesos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php


			$dispositivo=new Dispositivo();
			$listado_disp=$dispositivo->buscar(10);


	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Acceso</th>";
	echo "<th>Referente</th>";
	echo "<th>Fecha y Hora </th>";
	echo "<th>Dispositivo </th>";
	echo "<th>Perfil</th>";
	echo "</tr>";
	echo "</thead>";
  echo "<tbody>";
	while ($fila=mysqli_fetch_object($listado_disp)){

	
		echo "<tr>";
		echo "<td>".$fila->estadisAccesoId."</td>";
        echo "<td>".$fila->apellido.", ".$fila->nombre."</td>";
		echo "<td>".$fila->fechaHoraAcceso."</td>";
		echo "<td>".$fila->dispositivo."</td>";
		echo "<td>".$fila->tipo."</td>";
		echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<?php

// fin de ultimos 10 Accesos
echo "</div>";
echo "<div class='col-md-6'>";



	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel2"><span class="panel-title clickable">
			<h4>Accesos Totales por Dispositivos<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php


			$dispositivo2=new Dispositivo();
			$listado_disp2=$dispositivo2->buscar(null,null,null,"SMARTPHONE");
			$cant=mysqli_num_rows($listado_disp2);

	
	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Dispositivo</th>";
	echo "<th>Cantidad Gral</th>";
	echo "<th>Mes Actual</th>";
	echo "</tr>";
	echo "</thead>";
    echo "<tbody>";
	
	$lista= array("COMPUTADORA","SMARTPHONE","TABLET");

	foreach ($lista as $value) {

			$dispositivo2=new Dispositivo();
			$listado_disp2=$dispositivo2->buscar(null,null,null,$value);
			$cant2=mysqli_num_rows($listado_disp2);

			//$mes=date("m");
			$inicioMes=date("y")."-".date("m")."-01";
			$hoy=date("Y-m-d");

			$dispositivo3=new Dispositivo();
			$listado_disp3=$dispositivo3->buscar(null,$inicioMes,$hoy,$value);
			$cant3=mysqli_num_rows($listado_disp3);

			echo "<tr>";
			echo "<td>".$value."</td>";
	        echo "<td>".$cant2."</td>";
	        echo "<td>".$cant3."</td>";
			echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>

<?php

 // fin de columna derecha
echo "</div>";
echo "</div>";
//echo "<div class='col-md-12'>";



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

<?php   //dsde aqui

	echo '<div class="row">';
		echo '<div class="col-md-6">';



  $B=mysqli_num_rows($b_mis_informe); // inicio de informes
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel1">
          <span class="panel-title clickable">
			<h4>Accesos Conectar Igualdad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php


			$dispositivo2=new Dispositivo();
			$listado_disp2=$dispositivo2->buscar(null,null,null,"SMARTPHONE");
			$cant=mysqli_num_rows($listado_disp2);

	
	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Dispositivo</th>";
	echo "<th>ETJ</th>";
	echo "<th>ETT</th>";
	echo "</tr>";
	echo "</thead>";
    echo "<tbody>";
	
	$lista= array("COMPUTADORA","SMARTPHONE","TABLET");

	foreach ($lista as $value) {

			$dispositivoETJ=new Dispositivo();
			$listado_dispETJ=$dispositivoETJ->buscar(null,null,null,$value,"ETJ");
			$cantETJ=mysqli_num_rows($listado_dispETJ);

			$dispositivoETT=new Dispositivo();
			$listado_dispETT=$dispositivoETT->buscar(null,null,null,$value,"ETT");
			$cantETT=mysqli_num_rows($listado_dispETT);


			echo "<tr>";
			echo "<td>".$value."</td>";
	        echo "<td>".$cantETJ."</td>";
	        echo "<td>".$cantETT."</td>";
			echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<?php

// fin de informes
echo "</div>";
echo "<div class='col-md-6'>";


$d=mysqli_num_rows($b_informe);
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel2"><span class="panel-title clickable">
			<h4>OTROS<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php

	echo "<table id='myTable3' class='table table-hover table-striped table-condensed tablesorter'>";
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

// fin de columna derecha 2
echo "</div>";
echo "</div>";
//echo "<div class='col-md-12'>";



?>
<script type="text/javascript">
$(document).ready(function()
		{
				//$("#myTable").tablesorter();
				$("#myTable2").tablesorter( {sortList: [[0,1]]} );
				//$("#myTable1").tablesorter();
				$("#myTable3").tablesorter( {sortList: [[0,1]]} );
		}
);
</script>