
<style type="text/css">
hr {
    border-top: 2px solid #84DBFF;
  }

</style>

<?php
	include_once("includes/mod_cen/clases/persona.php");
	include_once("includes/mod_cen/clases/localidades.php");
	include_once("includes/mod_cen/clases/departamentos.php");
	include_once("includes/mod_cen/clases/referente.php");
	include_once("includes/mod_cen/clases/rtixescuela.php");
	include_once("includes/mod_cen/clases/informe.php");

	$referenteId=$_SESSION['referenteId'];

	$referente= new Referente($referenteId);
	$resultado = $referente->Cargo("Activo");

echo '<div class="container wow flipInX">';
echo'<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/equipo (1).png"></div><h4><b>Mis ETT</b><img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-videos.png"></h4>';

echo '<hr>';
echo '</div>';
echo '<div class="container ">';
echo'<br>';
echo'<br>';
echo'<br>';

	echo '<div class="table-responsive">';

	//$fila=mysqli_fetch_object($resultado);
	echo "<table class='table table-bordered'>";

	echo "<tr><td>Apellidos, Nombre</td>";
	echo "<td>RTI Cargo</td>";
	echo "<td>Escuelas</td>";
	echo "<td>Directores</td>";
	echo "<td>Informes</td>";
	echo "<td>Localidad, Departamento</td>";
	echo "<td>Teléfono</td>";
	echo "</tr>";

	while ($fila = mysqli_fetch_object($resultado))
	{
		//
		//Filtro de informes de acuerdo al ett seleccionado.
		//

		$informe_ett= new informe(null,null,$fila->referenteId);
		$buscar_informe=$informe_ett->buscar();
		$cantidad=mysqli_num_rows($buscar_informe);

		////////////////////////////////////////

		$escuela= new Escuela(null,$fila->referenteId);
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
		echo "<td>"."<a href='index.php?mod=slat&men=user&id=6&referenteId=".$fila->referenteId."'>Ver <b>(".$cant_rti. ")</b></a></td>";
		echo "<td>"."<a href='index.php?mod=slat&men=user&id=5&referenteId=".$fila->referenteId."'>Escuelas <b>(".$cantidad_escuela.")</b></a></td>";
		//echo "<td>"."<a href='index.php?mod=slat&men=user&id=20&referenteId=".$fila->referenteId."'>Directores<b>(".$cantidad_escuela.")</b></a></td>";
		echo "<td>"."<a class='btn btn-primary' href='index.php?mod=slat&men=user&id=20&referenteId=".$fila->referenteId."'>Directores</a></td>";
		//echo "<td> directores</td>";
		echo '<td><a class="btn btn-primary" href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'">'.$cantidad.'</a></td>';
		echo "<td>".$dato_localidad->nombre.", <b>".$dato_depa->descripcion."</b></td>";

		echo "<td>".$fila->telefonoM."</td>";
		//echo "<td>"."<a href='index.php?men=referentes&id=3&referenteId=".$fila->referenteId."'>Editar</a>"."</td>";
		echo "</tr>";
		echo "\n";
	}
	echo "</table>";
	echo "</div>";
	echo "</div>";
?>
<br>


<br>
<center>
 <img class="img-responsive img-circle wow bounceInRight" onclick="history.back()"  src="includes/mod_cen/portada/imgPortadas/back/flecha-videos.png"></center>
<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {

    formats: ['xls',],
		ignoreCols: 3,
		filename: 'MisEtt',
		bootstrap: true,

	});





</script>
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>
