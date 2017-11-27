<style type="text/css">
hr {
		border-top: 2px solid #567CA4;
	}

</style>
<?php
	include_once("includes/mod_cen/clases/persona.php");
	include_once("includes/mod_cen/clases/localidades.php");
	include_once("includes/mod_cen/clases/departamentos.php");
	include_once("includes/mod_cen/clases/referente.php");
	include_once("includes/mod_cen/clases/rtixescuela.php");

	$referenteId=$_SESSION['referenteId'];

	$referente= new Referente();
	$resultado = $referente->Tipo("ETJ","Activo");
?>
<div class="container">


			<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/reunion (1).png"></div><h4><b>Todos los ETJ</b> <img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-mis-etj.png"></h4>
 <hr>
 </div>

 <br><br>
<?php


	echo '<div class="table-responsive">';
	echo '<div class="container">';
	//$fila=mysqli_fetch_object($resultado);
	echo "<table class='table table-bordered'>";

	echo "<tr class='info'><td>Apellidos, Nombre</td>";
	echo "<td>RTI Cargo</td>";
	echo "<td>Escuelas</td>";
	echo "<td>Localidad, Departamento</td>";
	echo "<td>Teléfono</td>";
	echo "</tr>";

	while ($fila = mysqli_fetch_object($resultado))
	{

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
<center>
 <img class="img-responsive img-circle" onclick="history.back()"  src="includes/mod_cen/portada/imgPortadas/back/flecha-mis-etj.png"></center>
<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {

    formats: ['xls',],
		ignoreCols: 3,
		filename: 'MisEtt',
		bootstrap: true,

	});





</script>
