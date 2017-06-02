<?php
	include_once('includes/mod_cen/clases/persona.php');
	include_once('includes/mod_cen/clases/referente.php');
	//$c_referente= new Referente();

	if($_SESSION['tipo']=='DirectorNivelSecundario'){
		$c_referente= new Referente(null,null,'Supervisor-Secundaria',null,null,null,null,'Activo');	
	}else{
		$c_referente= new Referente(null,null,null,null,null,null,null,'Activo');
	}

	$b_referente= $c_referente->buscar();

	if(isset($_POST['referenteId'])) {

		//session_start();
		//cargamos valores session

		$c_referente= new Referente($_POST['referenteId'],null,null,null,null,null,null,null);
		//$c_referente= new Referente($_POST['referenteId']);


		$b_referente= $c_referente->buscar();
		$d_referente=mysqli_fetch_object($b_referente);

		$c_persona= new Persona($d_referente->personaId);
		$b_persona=$c_persona->buscar();
		$d_persona=mysqli_fetch_object($b_persona);

		$_SESSION["username"]=$d_persona->dni;
		$_SESSION["referenteId"]=$d_referente->referenteId;
		//$referente= new Referente($elemento->referenteId);

		$referente = $c_referente->getContacto();
		$_SESSION["tipo"]=$referente->getTipo();
		//$persona="SELECT referentes.referenteId,personas.nombre,personas.apellido,personas.personaId FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE referenteId=".$elemento->referenteId."";
		//$result=$conexion->query($persona);
		//$dato=mysqli_fetch_object($result);
		$_SESSION["nombre"]=$d_persona->nombre;
		$_SESSION["personaId"]=$d_persona->personaId;


		echo '<script type="text/javascript">';
   	echo 'function redireccion(){';
		echo 'window.location="index.php"};';
		echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
		echo '</script>';

	}else {
	include_once('includes/mod_cen/formularios/f_loginc.php');
	}
?>
