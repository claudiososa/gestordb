<?php

include_once('includes/mod_cen/clases/Mensajes.php');
include_once('includes/mod_cen/clases/MensajesLeidos.php');
$cantidadMensajes=0;
//creo un objeto nuevo del tipo Mensajes, con el atributo referenteId seteado. Ademas busco si el referente actual tiene mensajes recibidos
$objMensaje = new Mensajes();
$misMensajes = $objMensaje->buscar();

while ($fila = mysqli_fetch_object($misMensajes)) {
  //echo $fila->destinatario.'<br>';
  $arrayDestino = explode(',',$fila->destinatario);
  foreach ($arrayDestino as $key => $value) {
    //echo $arrayDestino[$key].'<br>';
    if ($arrayDestino[$key]==$_SESSION['referenteId']) {
      $leer = new MensajesLeidos(null,$fila->mensajeId,$_SESSION['referenteId']);
      $buscarLeido = $leer->buscar();

      if(mysqli_num_rows($buscarLeido)==0){
        $cantidadMensajes++;
      }

    }
  }
}
//$cantidadMensajes=mysqli_num_rows($misMensajes);
if ($cantidadMensajes>0) {
  echo '<p class="alert alert-danger"><span class="glyphicon glyphicon glyphicon-exclamation-sign"></span> <a href="index.php?men=mensajes&id=2" class="alert-link">&nbsp&nbsp&nbsp&nbspTienes '.$cantidadMensajes.' mensajes sin leer </a></p>';
}

if (isset($_GET['saved']) AND $_GET['id']==2) {
  echo '<p class="alert alert-success">El mensaje fue enviado...</p>';
}

?>
