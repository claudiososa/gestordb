<?php
	include_once('includes/mod_cen/clases/localidades.php');
	include_once('includes/mod_cen/clases/maestro.php');
	include_once('includes/mod_cen/clases/escuela.php');
	include_once('includes/mod_cen/clases/rti.php');
	$datoestado= Maestro::estructura('estado','rtixescuela');//Cargo los estados posibles de un RTI x institución
	$objlocalidad= new Localidad(null,null,null);//Cargo Localidades
	$datoturno= Maestro::estructura('turno','rtixescuela');//Cargo los turnos posibles de un RTI x institución
	$dato_localidad=$objlocalidad->buscar();
	$row_localidad= mysqli_fetch_object($dato_localidad);
	$enejercicio=0;//seteo la información resúmen
	$afectacion=0;
	$licencia=0;
	$renuncia=0;
	$total=0;
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();
	$objescuela= new Escuela($_GET['escuelaId']);
	$dato_escuela=$objescuela->buscar();
	$escuela=mysqli_fetch_object($dato_escuela);
	$dato_rti=Rti::existeRtixinstitucion($_GET['escuelaId']);//Tómo datos de la escuela
	//Encabezado de página
	echo "<div class='table-responsive'>";
	echo "<div class='container'>";
	echo "<div><h3>Referentes TIC Institucional</h3></div>";
	echo "<div>RTI Escuela Número ".$escuela->numero." - ".$escuela->nombre."</div>";

	//Tabla con RTI
	echo "<table class='table table-hover table-striped table-condensed '>";

	echo "<tr ><th>DNI</th>";
	echo "<th>Apellido</th>";
	echo "<th>Nombre</th>";
	echo "<th>Turno</th>";
	echo "<th>Teléfono1</th>";
	echo "<th>Teléfono2</th>";
	echo "<th>Email</th>";
	echo "<th>Estado</th>";

	echo "</tr>";
	while ($fila = mysqli_fetch_object($dato_rti))
	{
		$total=$total+1;
		echo "<tr  class='editarrtidc'>";
		echo "<td>".$fila->dni."</td>";
		echo "<td>".$fila->apellido."</td>";
		echo "<td>".$fila->nombre."</td>";
		echo "<td>".$fila->turno."</td>";
		echo "<td>".$fila->telefonoC."</td>";
		echo "<td>".$fila->telefonoM."</td>";
		echo "<td>".$fila->email."</td>";
		echo "<td>".$fila->estado."</td>";
		//echo "<td><input type='button' name='cmddetalle".$fila->rtiId."' class='editarrti' id='".$fila->rtiId."' 	value='Editar' /></td>";
		switch($fila->estado)
		{
			case 'EN EJERCICIO':
				$enejercicio=$enejercicio+1;
				break;
			case 'AFECTACION':
				$afectacion=$afectacion+1;
				break;
			case 'LICENCIA':
				$licencia=$licencia+1;
				break;
			case 'RENUNCIA':
				$renuncia=$renuncia+1;
				break;
		}

	}
	echo "</table>";
	echo "</div>";
	echo "</div>";
	//Tabla con Resumen
	echo "<div class='table-responsive'>";
	echo "<div class='container'>";
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr  class='editarrtidc'>";
	echo "<td>TOTAL: ".$total."&nbsp;&nbsp;&nbsp;    =&nbsp;&nbsp;EJERCICIO: ".$enejercicio."&nbsp;&nbsp;+&nbsp;&nbsp;AFECTACION: ".$afectacion."&nbsp;&nbsp;+&nbsp;&nbsp;LICENCIA: ".$licencia."&nbsp;&nbsp;    +&nbsp;&nbsp;RENUNCIA: ".$renuncia." </td>";
	echo "</tr>";
	echo "</table>";
	echo "</div>";
	echo "</div>";
?>
