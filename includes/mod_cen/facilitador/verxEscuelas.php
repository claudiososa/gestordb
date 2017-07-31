<?php
	include_once('includes/mod_cen/clases/localidades.php');
	include_once('includes/mod_cen/clases/FacilEscuelas.php');

	$facilitador = new FacilEscuelas(null,$_GET['escuelaId']);
	$buscarFacil= $facilitador->buscar();
	//$datoFacilitador =  mysqli_fetch_object($buscarFacil);
	//$cantFaciliador = mysqli_num_rows($buscarFacil);
	//Encabezado de página
	echo '<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">';

	echo "Facilitador Escuela Número ".$escuela->numero." - ".$escuela->nombre;
echo '</div>
<div class="panel-body">';
	//Tabla con RTI
	echo "<table class='table'>";
	echo "<tr><th colspan='4'><h4>Facilitador Instituciona - Escuela del Futuro</h4></th></tr>";
	echo "<tr ><th>Apellido</th>";
	echo "<th>Nombre</th>";
	echo "<th>Turno</th>";
	echo "<th>Teléfono</th>";
	echo "<th>Teléfono 2</th>";
	echo "<th>Email</th>";
	echo "</tr>";
	while ($fila = mysqli_fetch_object($buscarFacil))
	{

		$total=$total+1;
		echo "<tr  class='editarrtidc'>";
		echo "<td>".$fila->apellido."</td>";
		echo "<td>".$fila->nombre."</td>";
		echo "<td>".$fila->turno."</td>";
		echo "<td>".$fila->telefonoC."</td>";
		echo "<td>".$fila->telefonoM."</td>";
		echo "<td>".$fila->email."</td>";

	echo "</table>";

	echo '</div></div>';

?>
