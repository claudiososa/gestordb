<?php
	include_once("includes/mod_cen/clases/persona.php");
	include_once("includes/mod_cen/clases/escuela.php");
	include_once("includes/mod_cen/clases/piso.php");
	//var_dump($_POST);
	$escuelaId=$_POST["escuelaId"];
	$referenteId=$_POST["referenteId"];
	$cue=$_POST["cue"];
	$numero=$_POST["numero"];
	$nombre=$_POST["nombre"];
	$domicilio=$_POST["domicilio"];
	$nivel=$_POST["nivel"];
	$localidadId=$_POST["localidadId"];
	$telefono=$_POST['telefono'];
	$ubicacion=$_POST['ubicacion'];
	$sitio=$_POST['sitio'];
	$facebook=$_POST['facebook'];
	$twitter=$_POST['twitter'];
	$youtube=$_POST['youtube'];
	$email=$_POST['email'];


	//echo strlen($_POST['turnoactual']);
	$turnosactual=str_split($_POST['turnoactual']);


	if(isset($_POST['tm'])) {
			$turnos[0]="s";
		}else {
			$turnos[0]="n";}

	if(isset($_POST['tt'])) {
			$turnos[1]="s";
		}else {
			$turnos[1]="n";}

	if(isset($_POST['tv'])) {
			$turnos[2]="s";
		}else {
			$turnos[2]="n";}

	if(isset($_POST['tn'])) {
			$turnos[3]="s";
		}else {
			$turnos[3]="n";}

	if(isset($_POST['tj'])) {
			$turnos[4]="s";
		}else {
			$turnos[4]="n";}


	foreach ($turnosactual AS $clave=>$valor){
		$turnosactual[$clave]=$turnos[$clave];
	}

	$turnos= implode('',$turnos);
	//echo $turnos;

	$escuela=new Escuela($escuelaId,
											$referenteId,
											$cue,
											$numero,
											$nombre,
											$domicilio,
											$nivel,
											$localidadId,
											$turnos,
											$telefono,
											null,
											$ubicacion,
											$sitio,
											$facebook,
											$twitter,
											$youtube,null,null,null,null,null,
											$email);
	$salida= $escuela->editar();

	if ($salida == 1){
		//echo "Se edito correctamente";
	}
	else{
		echo $salida;
	}
	$variablephp = "?men=escuelas&id=2&escuelaId=".$escuelaId."";

	?>
	<script type="text/javascript">
		var variablejs = "<?php echo $variablephp; ?>" ;
	   function redireccion(){window.location=variablejs;}
	   setTimeout ("redireccion()", 0);
	</script>
