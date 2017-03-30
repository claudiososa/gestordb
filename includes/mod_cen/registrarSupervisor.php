<?php 
include('clases/conexionv2.php');
/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Conexion::getInstance();
if(trim($_POST['txtidpersona'])!=""){//Si existe la persona en la base
	$grabarsupervisor="UPDATE escuelas SET supervisor_id=".$_POST['txtidpersona']." WHERE escuelaId=".$_POST['txtidesacuela'];
	$resultado=$bd->ejecutar($grabarsupervisor);
	$sentencia="UPDATE personas SET apellido ='".strtoupper($_POST['txtapellido'])."', nombre ='".strtoupper($_POST['txtnombre'])."', dni= ".$_POST['txtdni'].", cuil=".$_POST['txtcuit'].", telefonoC = '".$_POST['txttelefono1']."', telefonoM = '".$_POST['txttelefono2']."', direccion= '".strtoupper($_POST['txtdomicilio'])."', email = '".$_POST['txtemail1']."', email2 = '".$_POST['txtemail2']."', facebook = '".$_POST['txtfacebook']."', twitter = '".$_POST['txttwitter']."', localidadId = ".round($_POST['cblocalidad'],0).", cpostal = '".$_POST['txtcp']."' WHERE personaId =".$_POST['txtidpersona'];
	$resultado=$bd->ejecutar($sentencia);
}
else//No existe la persona en la base de datos
{
	$grabarpersona=$sentencia="INSERT INTO personas (apellido,nombre,dni,cuil,telefonoC,telefonoM,direccion,email,email2,facebook,twitter,localidadId,cpostal) VALUES ('". strtoupper($_POST['txtapellido'])."','". strtoupper($_POST['txtnombre'])."',". $_POST['txtdni'].",".$_POST['txtcuit'].",'". $_POST['txttelefono1']."','". $_POST['txttelefono2']."','". strtoupper($_POST['txtdomicilio'])."','". $_POST['txtemail1']."','". $_POST['txtemail2']."','".$_POST['txtfacebook']."','". $_POST['txttwitter']."',".round($_POST['cblocalidad'],0).",'". $_POST['txtcp']."')";
	$resultado=$bd->ejecutar($grabarpersona);
	$idpersona=$bd->lastID();
	$grabarsupervisor="UPDATE escuelas SET supervisor_id=".$idpersona." WHERE escuelaId=".$_POST['txtidesacuela'];
	$resultado=$bd->ejecutar($grabarsupervisor);
}
?>
<!--Redirecciono por javascrit-->
<script type="text/javascript">
	window.location="../../index.php?mod=slat&men=user&id=3";
</script>