<?php
	include_once("includes/mod_cen/clases/persona.php");
	include_once("includes/mod_cen/clases/localidades.php");
	include_once("includes/mod_cen/clases/departamentos.php");
	include_once("includes/mod_cen/clases/referente.php");
	include_once("includes/mod_cen/clases/rtixescuela.php");

	$referenteId=$_SESSION['referenteId'];

	$referente= new Referente();
	$resultado = $referente->Tipo("ATT","Activo");


	echo '<div class="table-responsive">';
	echo '<div class="container">';
	//$fila=mysqli_fetch_object($resultado);
	echo "<div class='panel panel-primary'>";
		echo "<div class='panel-heading'><h4>Todos los ETT</h4></div>";

		echo "<div class='panel-body'>";
		echo "<table id='ett' class='table table-hover table-striped table-condensed tablesorter'>";
		echo "<thead>";
			echo "<tr>";
				echo "<th>Apellidos, Nombre</th>";
				//echo "<th>RTI</th>";
				echo "<th>Escuelas</th>";
				echo "<th>Localidad</th>";
				echo "<th>Departamento</th>";
				echo "<th>Teléfono</th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($fila = mysqli_fetch_object($resultado))
		{

			$escuela= new Escuela(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$fila->referenteId);
			$buscar_escuela = $escuela->buscar();
			$cantidad_escuela = mysqli_num_rows($buscar_escuela);

			$cant_rti=0;

			while ($fila2 = mysqli_fetch_object($buscar_escuela))
			{
				$rti = new rtixescuela($fila2->escuelaId);
				$b_rti = $rti->buscar();

				$cant_rti =  $cant_rti+mysqli_num_rows($b_rti);
			}

			//$cant_rti=$cant_rti+1;


			$localidad= new Localidad($fila->localidadId);
			$buscar_localidad=$localidad->buscar();
			$dato_localidad=mysqli_fetch_object($buscar_localidad);

			$depa = departamentos::nombre_depa($dato_localidad->departamento);
			//$departamento = new Departamentos($dato_localidad->departamento);


			//$buscar_departamento = $departamento->buscar();
			$dato_depa = mysqli_fetch_object($depa);

			echo "<tr>";
			echo "<td><a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila->personaId."&referenteId=".$fila->referenteId."'>".$fila->apellido.", ".$fila->nombre."</a></td>";
			//echo "<td>".$fila->tipo."</td>";
			//echo "<td>"."<a class='btn btn-success' href='index.php?mod=slat&men=user&id=6&referenteId=".$fila->referenteId."'>".$cant_rti. "</a></td>";
			echo "<td>"."<a class='btn btn-primary'  href='index.php?mod=slat&men=user&id=5&referenteId=".$fila->referenteId."'>".$cantidad_escuela."</a></td>";
			echo "<td>".$dato_localidad->nombre."</td>";
			echo "<td>".$dato_depa->descripcion."</td>";
			echo "<td>".$fila->telefonoM."</td>";
			//echo "<td>"."<a href='index.php?men=referentes&id=3&referenteId=".$fila->referenteId."'>Editar</a>"."</td>";
			echo "</tr>";
			echo "\n";
		}
		echo "</tbody>";
		echo "</table>";

		echo "</div>";
	echo "</div>";




	echo "</div>";
	echo "</div>";
?>
<script type="text/javascript">
$(document).ready(function()
		{
			//$("#myTable").tablesorter();
			$("#ett").tablesorter( {sortList: [[0,0]]} );

		}
);
</script>
