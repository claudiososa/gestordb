<?php

include_once("clases/persona.php");
include_once("clases/rti.php");
include_once("clases/cargo.php");

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

$rtiId=$_POST["rtiId"];
$capacitacionTec=$_POST["capacitacionTec"];
$capacitacionPed=$_POST["capacitacionPed"];
$titulo=$_POST["titulo"];

$numescuela=$_POST['numescuela'];

$aux = 1;
while($aux<=$numescuela){
	$nom1 = "cargoId$aux";
	$$nom1 = $_POST['cargoId'.$aux];
	
	$nom2 = "escuelaId$aux";
	$$nom2 = $_POST['escuelaId'.$aux];
	
	$nom3 = "turno$aux";
	$$nom3 = $_POST['turno'.$aux];
	
	$nom = "cargo$aux";
	$$nom = new Cargo($$nom1,$rtiId,$$nom2,$$nom3);
	
	$nom4 = "salida$aux";
	$$nom4 = $$nom->editar();
	
	
	$aux=$aux+1;
}
			
			
$persona=new Persona($personaId,$apellido,$nombre,$dni,$cuil,$telefonoC,$telefonoM,$direccion,$email,$email2,$facebook,$twitter,$localidadId,$cpostal);
$rti=new Rti($rtiId,$personaId,$titulo,$capacitacionTec,$capacitacionPed);

$out1= $persona->editar();
$out2= $rti->editar();

$aux=1;
while($aux<=$numescuela){
	$nombre4 = "salida$aux";
	$sum =$sum + $$nombre4;
	$aux = $aux + 1;
}
$sum = $sum + $out1 + $out2;


if ($sum == $numescuela+2){
	echo "Se edito correctamente";
	echo '<script type="text/javascript">';
    echo 'function redireccion(){';
	echo 'window.location="index.php?men=rtis&id=2&rtiId='.$rtiId.'"};';
	echo 'setTimeout ("redireccion()", 1500); //el tiempo expresado en milisegundos';
	echo '</script>';
}
else{
	echo $out1."\n".$out2."\n";
	$aux = 1;
	while($aux<=$numescuela){
		$nombre4 = "salida$aux";
		echo $$nombre4."\n";
		$aux = $aux + 1;
	} 
}

?>			

