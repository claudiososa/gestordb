<?php
include_once('includes/mod_cen/clases/conexionV3.php');
//	echo '<p> <strong>Autoridad:</strong></p>';
	//echo 'no llego post';
if($_POST){
  //var_dump($_POST);

  $nuevaConexion=new Conexion3();
  $conexion=$nuevaConexion->getConexion();
  foreach ($_POST as $key => $value) {

    if(($_POST[$key]<>'rtiId') AND ($_POST[$key]<>'Eliminar'))
    
    echo '<br><br>'.$_POST[$key];
  }

}
