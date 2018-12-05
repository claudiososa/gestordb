<?php
	include_once('includes/mod_cen/clases/persona.php');
	include_once('includes/mod_cen/clases/referente.php');
	include_once("includes/mod_cen/clases/TipoReferentes.php");

	//$c_referente= new Referente();

	switch ($_SESSION['tipo']) {
		case 'DirectorNivelSecundario':
			$c_referente= new Referente(null,null,'Supervisor-Secundaria',null,null,null,null,'Activo');
			break;
		case 'Supervisor-General-Secundaria':
			$c_referente= new Referente(null,null,'Supervisor-Secundaria',null,null,null,null,'Activo');
			break;
		case 'SupervisorGeneralSuperior':
				$c_referente= new Referente(null,null,'Supervisor-Nivel-Superior',null,null,null,null,'Activo');
				break;
		case 'DirectorNivelSuperior':
				$c_referente= new Referente(null,null,'Supervisor-Nivel-Superior',null,null,null,null,'Activo');
				break;
		case 'Coordinador':
			$c_referente= new Referente(null,null,null,null,null,null,null,'Activo');
			break;
		case 'ETJ':
				$c_referente= new Referente(null,null,'ETT',null,null,null,null,'Activo');
				break;
		case 'COORCONECT':
				$c_referente= new Referente(null,null,'ETT',null,null,null,null,'Activo');
				break;
		case 'CU':
				$c_referente= new Referente(null,null,'CAS',null,null,null,null,'Activo');
				break;		
		case 'admin':
				$c_referente= new Referente(null,null,null,null,null,null,null,'Activo');
				break;
		default:
			# code...
			break;
	}


	$b_referente= $c_referente->buscar();

	if(isset($_POST['referenteId'])) {

		//session_start();
		//cargamos valores session
		//var_dump($_POST['referenteId']);

		$c_referente= new Referente($_POST['referenteId'],null,null,null,null,null,null,null);
		//$c_referente= new Referente($_POST['referenteId']);


		$b_referente= $c_referente->buscar();

		$d_referente=mysqli_fetch_object($b_referente);

		$c_persona= new Persona($d_referente->personaId);
		$b_persona=$c_persona->buscar();
		$d_persona=mysqli_fetch_object($b_persona);


		$_SESSION["username"]=$d_persona->dni;
		$_SESSION["nombre"]=$d_persona->nombre;
		$_SESSION["apellido"]=$d_persona->apellido;
		$_SESSION["personaId"]=$d_persona->personaId;

		$_SESSION["referenteId"]=$_POST['referenteId'];
		//var_dump($_SESSION['referenteId']);
		//$referente= new Referente($elemento->referenteId);

		$referente = $c_referente->getContacto();
		$_SESSION["tipo"]=$referente->getTipo();

		$tipoReferente = new TipoReferentes(null,$_SESSION["tipo"]);
		$buscarTipo = $tipoReferente->buscar();
		$datoTipo=mysqli_fetch_object($buscarTipo);

		$_SESSION["tipoNumero"]=$datoTipo->tipoId;
		//$persona="SELECT referentes.referenteId,personas.nombre,personas.apellido,personas.personaId FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE referenteId=".$elemento->referenteId."";
		//$result=$conexion->query($persona);
		//$dato=mysqli_fetch_object($result);



		echo '<script type="text/javascript">';
   	echo 'function redireccion(){';
		echo 'window.location="index.php"};';
		echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
		echo '</script>';



	}else {
	include_once('includes/mod_cen/formularios/f_loginc.php');
	}
?>
