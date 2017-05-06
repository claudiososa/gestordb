<?php
include_once('includes/mod_cen/clases/conexionv2.php');
//	echo '<p> <strong>Autoridad:</strong></p>';
if($_POST){

	var_dump($_POST);

	/*Creamos la instancia del objeto. Ya estamos conectados*/
	$bd=Conexion2::getInstance();
	if(trim($_POST['txtidpersona'])!=""){//Si existe la persona en la base
		//var_dump($_POST);
		$grabarrti="UPDATE rtixescuela SET turno=".$_POST['cbestado']." WHERE rtiID=".$_POST['idrti'];
		$resultado=$bd->ejecutar($grabarrti);
		$sentencia="UPDATE personas SET apellido ='".strtoupper($_POST['txtapellido'])."', nombre ='".strtoupper($_POST['txtnombre'])."', dni= ".$_POST['txtdni'].", cuil=".$_POST['txtcuit'].", telefonoC = '".$_POST['txttelefono1']."', telefonoM = '".$_POST['txttelefono2']."', direccion= '".strtoupper($_POST['txtdomicilio'])."', email = '".$_POST['txtemail1']."', email2 = '".$_POST['txtemail2']."', facebook = '".$_POST['txtfacebook']."', twitter = '".$_POST['txttwitter']."', localidadId = ".round($_POST['cblocalidad'],0).", cpostal = '".$_POST['txtcp']."' WHERE personaId =".$_POST['txtidpersona'];
		$resultado=$bd->ejecutar($sentencia);
		var_dump($resultado);
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
			var variablejs = "<?php echo $variablephp; ?>" ;
			function redireccion(){window.location="index.php?mod=slat&men=referentes&id=8&escuelaId=0040";}
			setTimeout ("redireccion()",20000);
					</script>
	<?php
}
	include_once('includes/mod_cen/clases/escuela.php');
  include_once('includes/mod_cen/clases/localidades.php');
  include_once('includes/mod_cen/clases/maestro.php');
  include_once('includes/mod_cen/clases/rti.php');

	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();

	$datoestado= Maestro::estructura('estado','rtixescuela');//Cargo los estados posibles de un RTI x institución
  $datoturno= Maestro::estructura('turno','rtixescuela');//Cargo los turnos posibles de un RTI x institución

  $dato_rti=Rti::existeRtixinstitucion($_GET['escuelaId'],$_GET['rtiId'],$_GET['personaId']);//Tómo datos de la escuela
  $info_rti = mysqli_fetch_object($dato_rti);
  //$cantidad_rti = mysqli_num_rows($dato_rti);


  $objlocalidad= new Localidad(null,null,null);
	$objescuela= new Escuela($_GET['escuelaId']);
	$dato_escuela=$objescuela->buscar();
	$dato_localidad=$objlocalidad->buscar();
	$row_rscondicioniva = mysqli_fetch_object($dato_localidad);
	$escuela=mysqli_fetch_object($dato_escuela);





	if(isset($_GET['personaId'])){
		include_once('includes/mod_cen/clases/persona.php');
		$idpersona=round($_GET['personaId'],0);
		$objpersona= new Persona($idpersona);
		$dato_persona=$objpersona->buscar();
		$persona=mysqli_fetch_object($dato_persona);
		}
?>

<script type="text/javascript" src="includes/mod_cen/rti/js/validacionrti.js"></script>

<style type="text/css">
#cmdbuscar {
	text-align: left;
}
/*input[type="text"] {
     /*width: 100%;
     box-sizing: border-box;
     -webkit-box-sizing:border-box;
     -moz-box-sizing: border-box;

}*/
#form1 {
	font-weight: bold;
}
</style>


<div class="container">
<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo 'Escuela Número '.$escuela->numero.' - '.$escuela->nombre;?>
	</div>
	<div class="panel-body">
<?php
	include_once 'includes/mod_cen/formularios/f_rtiEditar.php';
 ?>
</div>
</div>
</div>
<?php
if(isset($_GET['personaId'])){
?>
<script type="text/javascript" src="includes/mod_cen/rti/js/ajaxEditarRti.js"></script>
<?php
}
?>
