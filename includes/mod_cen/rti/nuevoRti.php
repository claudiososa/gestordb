<?php
include_once('includes/mod_cen/clases/conexionv2.php');
include_once('includes/mod_cen/clases/rti.php');
include_once('includes/mod_cen/clases/rtixescuela.php');
if($_POST){
	/*Creamos la instancia del objeto. Ya estamos conectados*/
	$bd=Conexion2::getInstance();
	if(trim($_POST['txtidpersona'])!=""){//Si existe la persona en la base
		$sentencia="UPDATE personas SET apellido ='".strtoupper($_POST['txtapellido'])."', nombre ='".strtoupper($_POST['txtnombre'])."', dni= ".$_POST['txtdni'].", cuil=".$_POST['txtcuit'].", telefonoC = '".$_POST['txttelefono1']."', telefonoM = '".$_POST['txttelefono2']."', direccion= '".strtoupper($_POST['txtdomicilio'])."', email = '".$_POST['txtemail1']."', email2 = '".$_POST['txtemail2']."', facebook = '".$_POST['txtfacebook']."', twitter = '".$_POST['txttwitter']."', localidadId = ".round($_POST['cblocalidad'],0).", cpostal = '".$_POST['txtcp']."' WHERE personaId =".$_POST['txtidpersona'];
		$resultado=$bd->ejecutar($sentencia);
    $idPersona=$_POST['txtidpersona'];
    $rti = new Rti (null,$idPersona,null,null,null);
    $encontrarRti=$rti->buscar();
    if(mysqli_num_rows($encontrarRti)>0){
      $datoRti= mysqli_fetch_object($encontrarRti);
      //echo $datoRti->rtiId;
      $rtixescuela = new rtixescuela ($_POST['txtidesacuela'],$datoRti->rtiId,null,null,null);
      $encontrarRtixescuela=$rtixescuela->buscar();
      if(mysqli_num_rows($encontrarRtixescuela)>0){
        $datoRtixescuela= mysqli_fetch_object($encontrarRtixescuela);
        //echo $datoRtixescuela->rtiId;

        $variablephp="index.php?mod=slat&men=referentes&id=8&escuelaId=".$_POST['txtidesacuela'];
        ?>
        <!--Redirecciono por javascrit-->
        <script type="text/javascript">
            alert('Este rti ya existe cargado para esta escuela, imposible crear nuevamente');
            var variablejs = "<?php echo $variablephp; ?>" ;
            function redireccion(){window.location=variablejs;}
            setTimeout ("redireccion()",0);
                </script>
        <?php
       //  $rtixescuela = new rtixescuela ($_POST['txtidesacuela'],$datoRti->rtiId,$_POST['cbestado'],null,$_POST['estado']);
      //  $editarDato = $rtixescuela->editar();
      //  echo $editarDato;
      }else{
        $rtixescuela = new rtixescuela ($_POST['txtidesacuela'],$datoRti->rtiId,$_POST['cbestado'],null,$_POST['estado']);
        $editarDato = $rtixescuela->agregar();
        if($editarDato==1){
        $variablephp="index.php?mod=slat&men=referentes&id=8&escuelaId=".$_POST['txtidesacuela'];
        ?>
        <!--Redirecciono por javascrit-->
        <script type="text/javascript">
            alert('Se Agrego el nuevo RTI');
            var variablejs = "<?php echo $variablephp; ?>" ;
            function redireccion(){window.location=variablejs;}
            setTimeout ("redireccion()",0);
                </script>
        <?php
        }
      //  echo $editarDato;

        //echo 'no se encuentra rtiId en rtixescuela';
      }
    }else{
      $rti = new Rti (null,$idPersona);
      $agregarRti=$rti->agregar();

      $rtixescuela = new rtixescuela ($_POST['txtidesacuela'],$agregarRti,$_POST['cbestado'],null,$_POST['estado']);
      $editarDato = $rtixescuela->agregar();
      if($editarDato==1){
      $variablephp="index.php?mod=slat&men=referentes&id=8&escuelaId=".$_POST['txtidesacuela'];
      ?>
      <!--Redirecciono por javascrit-->
      <script type="text/javascript">
          alert('Se Agrego el nuevo RTI');
          var variablejs = "<?php echo $variablephp; ?>" ;
          function redireccion(){window.location=variablejs;}
          setTimeout ("redireccion()",0);
              </script>
      <?php


    }
}




		//var_dump($resultado);
	}
	else//No existe la persona en la base de datos
	{
		$grabarpersona="INSERT INTO personas (personaId,apellido,nombre,dni,cuil,telefonoC,telefonoM,direccion,email,email2,facebook,twitter,localidadId,cpostal) VALUES (NULL,'". strtoupper($_POST['txtapellido'])."','". strtoupper($_POST['txtnombre'])."',". $_POST['txtdni'].",".$_POST['txtcuit'].",'". $_POST['txttelefono1']."','". $_POST['txttelefono2']."','". strtoupper($_POST['txtdomicilio'])."','". $_POST['txtemail1']."','". $_POST['txtemail2']."','".$_POST['txtfacebook']."','". $_POST['txttwitter']."',".round($_POST['cblocalidad'],0).",'". $_POST['txtcp']."')";
		$resultado=$bd->ejecutar($grabarpersona);
		$idpersona=$bd->lastID();
    $rti = new Rti (null,$idpersona);
    $agregarRti=$rti->agregar();

    $rtixescuela = new rtixescuela ($_POST['txtidesacuela'],$agregarRti,$_POST['cbestado'],null,$_POST['estado']);
    $editarDato = $rtixescuela->agregar();
    if($editarDato==1){
    $variablephp="index.php?mod=slat&men=referentes&id=8&escuelaId=".$_POST['txtidesacuela'];
    ?>
    <!--Redirecciono por javascrit-->
    <script type="text/javascript">
        alert('Se Agrego el nuevo RTI');
        var variablejs = "<?php echo $variablephp; ?>" ;
        function redireccion(){window.location=variablejs;}
        setTimeout ("redireccion()",0);
            </script>
    <?php
	}

}
}
	include_once('includes/mod_cen/clases/escuela.php');
  include_once('includes/mod_cen/clases/localidades.php');
  include_once('includes/mod_cen/clases/maestro.php');
  include_once('includes/mod_cen/clases/rti.php');

	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();

	$datoestado= Maestro::estructura('estado','rtixescuela');//Cargo los estados posibles de un RTI x institución
  $datoturno= Maestro::estructura('turno','rtixescuela');//Cargo los turnos posibles de un RTI x institución

  //$dato_rti=Rti::existeRtixinstitucion($_GET['escuelaId'],$_GET['rtiId'],$_GET['personaId']);//Tómo datos de la escuela
  //$info_rti = mysqli_fetch_object($dato_rti);
  //$cantidad_rti = mysqli_num_rows($dato_rti);


  $objlocalidad= new Localidad(null,null,null);
	$objescuela= new Escuela($_GET['escuelaId']);
	$dato_escuela=$objescuela->buscar();
	$dato_localidad=$objlocalidad->buscar();
	$row_rscondicioniva = mysqli_fetch_object($dato_localidad);
	$escuela=mysqli_fetch_object($dato_escuela);
?>

<script type="text/javascript" src="includes/mod_cen/rti/js/validacionrti.js"></script>



<div class="container">
<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo 'Escuela Número '.$escuela->numero.' - '.$escuela->nombre;?>
	</div>
	<div class="panel-body">
<?php
	include_once 'includes/mod_cen/formularios/f_rtinuevo.php';
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
