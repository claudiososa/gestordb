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
	include_once("includes/mod_cen/clases/EscuelaReferentes.php");

	$referenteId=$_SESSION['referenteId'];

	$referente= new Referente();
	$resultado = $referente->Tipo("ETT","Activo");



?>

	<div class="container wow flipInX">


				<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/equipo (3).png"></div><h4><b>Todos los ETT</b> <img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-videos.png"></h4>
	 <hr>
	 </div>

	 <br><br>
<?php
	echo '<div class="table-responsive">';
	echo '<div class="container">';
	//$fila=mysqli_fetch_object($resultado);
	//echo "<div class='panel panel-primary'>";
	//echo "<div class='panel-heading'><h4>Todos los ETT</h4></div>";

	//echo "<div class='panel-body'>";
		echo "<table id='ett' class='table table-bordered'>";
		//echo "<thead>";
			echo "<tr>";
			echo "<th>Foto</th>";
				echo "<th>Apellidos, Nombre</th>";
				echo "<th>RTI Cargo</th>";
				echo "<th>Escuelas</th>";
				echo "<th>Localidad</th>";
				echo "<th>Departamento</th>";
				echo "<th>Teléfono</th>";
			echo "</tr>";
		//echo "</thead>";
		echo "<tbody>";
		while ($fila = mysqli_fetch_object($resultado))
		{

			/* Modificaciones para leer de la tabla escuela referentes */
			// ***** aqui se modifico la busqueda en tabla escuelaReferentes  ******//

		//$escuelas= new Escuela(null,$registro->referenteId);
		//$buscarEscuelas=$escuelas->buscar();
		$escuela=new EscuelaReferentes(null,null,'19',$fila->referenteId); // buscamos las escuelas del ETT
		$buscar_escuela=$escuela->buscar2();// devuelve todos los datos de las escuelas del ETT
		$cantidad_escuela=mysqli_num_rows($buscar_escuela); // Guardamos la Cantidad de Escuelas de cada ETT

		$personaId= $fila->personaId;
		$persona= new Persona($personaId);
		$persona = $persona->getContacto();
		$nomArchivoFoto="./img/perfil/";
    if ($persona->getFotoPerfil() == "") {
        $nomArchivoFoto.= "0000.jpg";
    }else {
        $nomArchivoFoto.= $persona->getFotoPerfil();
        //$nomArchivoFoto.=".jpg";
          }
		// ***** fin de modificaciones  ******//////


/*
			$escuela= new Escuela(null,$fila->referenteId);
			$buscar_escuela = $escuela->buscar();
			$cantidad_escuela = mysqli_num_rows($buscar_escuela);
*/
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
			  echo "<td><img src='$nomArchivoFoto'  alt='perfil'  class=' img-responsive img-circle' style= 'width: 55px; height: 55px;' ></td>";
			echo "<td><a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila->personaId."&referenteId=".$fila->referenteId."'>".$fila->apellido.", ".$fila->nombre."</a></td>";
			//echo "<td>".$fila->tipo."</td>";
			echo "<td>"."<a class='btn btn-success' href='index.php?mod=slat&men=user&id=6&referenteId=".$fila->referenteId."'>".$cant_rti. "</a></td>";
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

	//	echo "</div>";
	//  echo "</div>";




	echo "</div>";
	echo "</div>";
?>
<center>
 <img class="img-responsive img-circle wow bounceInRight" onclick="history.back()"  src="includes/mod_cen/portada/imgPortadas/back/flecha-videos.png"></center>

<script type="text/javascript">
$(document).ready(function()
		{
			//$("#myTable").tablesorter();
			$("#ett").tablesorter( {sortList: [[0,0]]} );

		}
);
</script>
<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {

    formats: ['xls',],
		ignoreCols: 3,
		filename: 'MisEtt',
		bootstrap: true,

	});





</script>
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>
