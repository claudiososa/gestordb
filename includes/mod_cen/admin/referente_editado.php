<?php

include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");

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

$referenteId=$_POST["referenteId"];
$personaId=$_POST["personaId"];
$tipo=$_POST["tipo"];
$rol=$_POST["rol"];
$etjcargo=$_POST["etjcargo"];
$fechaIngreso=$_POST["fechaIngreso"];
$titulo=$_POST["titulo"];
$estado = $_POST["estado"];

$persona=new Persona($personaId,$apellido,$nombre,$dni,$cuil,$telefonoC,$telefonoM,$direccion,$email,$email2,$facebook,$twitter,$localidadId,$cpostal);
$referente=new Referente($referenteId,$personaId,$tipo,$rol,$etjcargo,$fechaIngreso,$titulo,$estado);
$salida= $persona->editar();
$salida2= $referente->editar();

if ($salida == 1 && $salida2 ==1){
	echo "Se edito correctamente";
	echo '<script type="text/javascript">';
    echo 'function redireccion(){';
	echo 'window.location="index.php?men=referentes&id=1"};';
	echo 'setTimeout ("redireccion()", 1500); //el tiempo expresado en milisegundos';
	echo '</script>';
}
else{
	echo $salida."\n".$salida2;
}

?>
