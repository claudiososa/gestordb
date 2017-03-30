<?php

include_once("clases/persona.php");
include_once("clases/referente.php");

$personaId=$_POST["personaId"];
$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];
$dni=$_POST["dni"];
$cuil=$_POST["cuil"];
$telefonoC=$_POST["telefonoC"];
$telefonoM=$_POST["telefonoM"];
$direccion=$_POST["direccion"];
$email=$_POST["email"];
$email2=$_POST["email2"];
$facebook=$_POST["facebook"];
$twitter=$_POST["twitter"];
$localidadId=$_POST["localidadId"];
$cpostal=$_POST["cpostal"];
$ubicacion=$_POST["ubicacion"];			
$persona=new Persona($personaId,$apellido,$nombre,$dni,$cuil,$telefonoC,$telefonoM,$direccion,$email,$email2,$facebook,$twitter,$localidadId,$cpostal,$ubicacion);
$salida= $persona->editar();
if ($salida == 1)
	{
	
	if($_SESSION["tipo"]=="Coordinador") 
		{
			//echo "Los datos fueron guardados correctamente";
			echo '<script type="text/javascript">';
   		echo 'function redireccion(){';
			echo 'window.location="index.php?men=personas&id=1"};';
			echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
			echo '</script>';
		
		}else {
			$crear_r=new Referente($_SESSION["referenteId"],null,null,null,null,null,null);
   		$buscar=$crear_r->buscar();
   		$objeto=mysqli_fetch_object($buscar);
			//echo $objeto->personaId;   		
   		if($personaId==$objeto->personaId) {
   				//echo "Los datos fueron guardados correctamente";
					echo '<script type="text/javascript">';
   				echo 'function redireccion(){';   		
					echo 'window.location="index.php?men=personas&id=2&personaId='.$personaId.'"};';
					echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
					echo '</script>';
			}else {
					//?men=referentes&id=2&personaId=0019&referenteId=0019
					//echo "Los datos fueron guardados correctamente";
					echo '<script type="text/javascript">';
   				echo 'function redireccion(){';   		
					echo 'window.location="index.php?men=referentes&id=2&personaId='.$personaId.'&referenteId='.$objeto->referenteId.'"};';
					echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
					echo '</script>';
						
			}
			
		}		
		
	}
	else{
		echo $salida;
}

?>			
