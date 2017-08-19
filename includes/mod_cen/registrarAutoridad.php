<?php
/*function error($numero,$texto){
$ddf = fopen('error.log','a');
fwrite($ddf,"[".date("r")."] Error $numero: $texto\r\n");
fclose($ddf);
}*/

include('clases/conexionv2.php');
/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Conexion2::getInstance();

if(trim($_POST['txtidpersona'])!=""){//Si existe la persona en la base
	if(trim($_POST['iddirector'])==""){//Si NO existe el director para la escuela
		$grabardirector="INSERT INTO directores (escuelaId,personaId,tipoautoridad_id)
			VALUES (".$_POST['txtidesacuela'].",".$_POST['txtidpersona'].",".$_POST['cbtipoautoridad'].")";
		$resultado=$bd->ejecutar($grabardirector);
	}
	else//Existe Autoridad para la escuela
	{
		//$modificardirector="UPDATE directores SET tipoautoridad_id='".$_POST['cbtipoautoridad']."' WHERE directorId =".$_POST['iddirector'];
		$modificardirector="UPDATE directores SET personaId='".$_POST['txtidpersona']."',tipoautoridad_id='".$_POST['cbtipoautoridad']."' WHERE directorId =".$_POST['iddirector'];
		$resultado=$bd->ejecutar($modificardirector);
	}
	$sentencia="UPDATE personas SET apellido ='".strtoupper($_POST['txtapellido'])."', nombre ='".strtoupper($_POST['txtnombre'])."', dni= ".$_POST['txtdni'].", cuil=".$_POST['txtcuit'].", telefonoC = '".$_POST['txttelefono1']."', telefonoM = '".$_POST['txttelefono2']."', direccion= '".strtoupper($_POST['txtdomicilio'])."', email = '".$_POST['txtemail1']."', email2 = '".$_POST['txtemail2']."', facebook = '".$_POST['txtfacebook']."', twitter = '".$_POST['txttwitter']."', localidadId = ".round($_POST['cblocalidad'],0).", cpostal = '".$_POST['txtcp']."' WHERE personaId =".$_POST['txtidpersona'];
	$resultado=$bd->ejecutar($sentencia);
}
else//No existe la persona en la base de datos
{

	$grabarpersona="INSERT INTO personas (apellido,nombre,dni,cuil,telefonoC,telefonoM,direccion,email,email2,facebook,twitter,localidadId,cpostal)
															VALUES ('". strtoupper($_POST['txtapellido'])."',
															'". strtoupper($_POST['txtnombre'])."',
															". $_POST['txtdni'].",
															".$_POST['txtcuit'].",
															'0',
															'". $_POST['txttelefono2']."',
															'". strtoupper($_POST['txtdomicilio'])."',
															'". $_POST['txtemail1']."',
															'',
															'".$_POST['txtfacebook']."',
															'". $_POST['txttwitter']."',
															".round($_POST['cblocalidad'],0).",
															'". $_POST['txtcp']."')";
	//error('010',$grabarpersona);
	$resultado=$bd->ejecutar($grabarpersona);
	$idpersona=$bd->lastID();
	$grabardirector="INSERT INTO directores (escuelaId,personaId,tipoautoridad_id)
		VALUES (".$_POST['txtidesacuela'].",".$idpersona.",".$_POST['cbtipoautoridad'].")";
	$resultado=$bd->ejecutar($grabardirector);
}

if(isset($_POST['dirUpdate'])){

	?>
<!--Redirecciono por javascrit a mis ett-->

		<script type="text/javascript">
	
			window.location='../../index.php?mod=slat&men=user&id=2';
		</script>

<?php 
		} 
?>

<!--Redirecciono por javascrit a mis escuelas-->

		<script type="text/javascript">
	
			window.location='../../index.php?mod=slat&men=user&id=3';
		</script>
