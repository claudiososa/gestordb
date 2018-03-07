<?php
		include_once('includes/mod_cen/clases/escuela.php');
		include_once('includes/mod_cen/clases/localidades.php');
		
		$location=new Localidad();
		$resultado=$location->buscar();
		
		//if(isset($_POST['cue'])) {
		//	echo $_POST['cue'];
		//}
		if(isset($_POST['cue']))
		{
			$escuela= new Escuela(null,null,$_POST['cue']);
			$buscar_escu= $escuela->buscarcue();			
			if($buscar_escu==1) {
				echo "<h1>Error el cue existe imposible crear escuela</h1>";			
			}else {
				$referenteId=1;
				$cue=$_POST['cue'];
 				$numero=$_POST['numero'];
 				$nombre=$_POST['nombre'];
 				$domicilio=$_POST['domicilio'];
				$nivel=$_POST['nivel'];
				$localidadId=$_POST['localidadId'];
 				$turnos=$_POST['turnos'];	
 				$telefono=$_POST['telefono'];
 					
				$crearEscuela= new Escuela(null,$referenteId,$cue,$numero,$nombre,$domicilio,$nivel,$localidadId,$turnos,$telefono);						
				$nueva_escuela= $crearEscuela->agregar();	
 		
 				echo "Los datos fueron guardados correctamente";			
				echo '<script type="text/javascript">';
				echo 'function redireccion(){';
				echo 'window.location="index.php?men=escuelas&id=1"};';
				echo 'setTimeout ("redireccion()",1000 ); //el tiempo expresado en milisegundos';
				echo '</script>';				
			}
		}			
		include_once("includes/mod_cen/formularios/f_escuela_crear.php");		
?>
		