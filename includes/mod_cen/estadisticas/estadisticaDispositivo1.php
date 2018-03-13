
<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script> 
<?php
//require_once("includes/mod_cen/clases/informe.php");
//require_once("includes/mod_cen/clases/persona.php");
//require_once("includes/mod_cen/clases/referente.php");
//require_once("includes/mod_cen/clases/leido.php");
include_once("includes/mod_cen/clases/Dispositivo.php");
//include_once("includes/mod_cen/clases/referente.php");



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
		echo '<div class="col-md-12">';



  
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel1">
          <span class="panel-title clickable">
			<h4 align="center">Accesos por Perfiles &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php


			//$dispositivo2=new Dispositivo();
			//$listado_disp2=$dispositivo2->buscar(null,null,null,"SMARTPHONE");
			//$cant=mysqli_num_rows($listado_disp2);


	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Perfil</th>";
	echo "<th colspan=2>COMPUTADORA</th>";
	echo "<th colspan=2>SMARTPHONE</th>";
	echo "<th colspan=2>TABLET</th>";
	echo "<th> TOTAL MES</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td></td>";
	echo "<td>Gral</td>";
	echo "<td>Mes</td>";
	echo "<td>Gral</td>";
	echo "<td>Mes</td>";
	echo "<td>Gral</td>";
	echo "<td>Mes</td>";
    echo "</tr>";
	echo "</tr>";
	echo "</tr>";
	echo "</thead>";
    echo "<tbody>";

	$lista= array("ETT","ETJ","Coordinador","Facilitador","CoordinadorFacilitador","ATT","CoordinadorPmi","Supervisor-Secundaria","Supervisor-General-Secundaria","DirectorNivelSecundario","Supervisor-Nivel-Superior","SupervisorGeneralSuperior","DirectorNivelSuperior","SupervisorAdultos","SupervisorGeneralAdultos","DirectorNivelAdultos","ETTPL","CPPL");

	foreach ($lista as $value) {


			// obtencion de fechas
			$inicioMes=date("y")."-".date("m")."-01";
			$hoy=date("Y-m-d");


			// cantidad gral compu
			$compu=new Dispositivo();
			$listado_compu=$compu->buscar(null,null,null,"COMPUTADORA",$value);
			$cant_compu=mysqli_num_rows($listado_compu);

			// cantidad x mes de compu
			
			$compu2=new Dispositivo();
			$listado_compu2=$compu2->buscar(null,$inicioMes,$hoy,"COMPUTADORA",$value);
			$cant_compu2=mysqli_num_rows($listado_compu2);

			// TOTAL DISTINTOS X MES
			//$compu3=new Dispositivo();
			//$listado_compu3=$compu3->buscar2(null,$inicioMes,$hoy,"COMPUTADORA",$value);
			//$cant_compu3=mysqli_num_rows($listado_compu3);


			// cantidad gral de smartphone
			$smart=new Dispositivo();
			$listado_smart=$smart->buscar(null,null,null,"SMARTPHONE",$value);
			$cant_smart=mysqli_num_rows($listado_smart);

			// cantidad x mes de smartphone
			$smart2=new Dispositivo();
			$listado_smart2=$smart2->buscar(null,$inicioMes,$hoy,"SMARTPHONE",$value);
			$cant_smart2=mysqli_num_rows($listado_smart2);


			// cantidad gral de tablet
			$tablet=new Dispositivo();
			$listado_tablet=$tablet->buscar(null,null,null,"TABLET",$value);
			$cant_tablet=mysqli_num_rows($listado_tablet);

			// cantidad x mes de tablet

			$tablet2=new Dispositivo();
			$listado_tablet2=$tablet2->buscar(null,$inicioMes,$hoy,"TABLET",$value);
			$cant_tablet2=mysqli_num_rows($listado_tablet2);

			$total=$cant_compu2+$cant_smart2+$cant_tablet2;
			echo "<tr>";
			echo "<td>".$value."</td>";
	        echo "<td>".$cant_compu."</td>";
	        echo "<td>".$cant_compu2."</td>";
	        echo "<td>".$cant_smart."</td>";
	        echo "<td>".$cant_smart2."</td>";
	        echo "<td>".$cant_tablet."</td>";
	        echo "<td>".$cant_tablet2."</td>";
	        echo "<td>".$total."</td>";
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
/*echo "<div class='col-md-6'>";



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
	



	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div> */
 ?>
 <?php

// fin de columna derecha 2
echo "</div>";
echo "</div>";




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
