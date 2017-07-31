<?php
include_once ('includes/mod_cen/clases/Mensajes.php');
include_once ('includes/mod_cen/clases/MensajesLeidos.php');
$cantidadMensajes=0;
//creo un objeto nuevo del tipo Mensajes, con el atributo referenteId seteado. Ademas busco si el referente actual tiene mensajes recibidos
$objMensaje = new Mensajes();
$misMensajes = $objMensaje->buscar();

while ($fila = mysqli_fetch_object($misMensajes)) {
  //echo $fila->destinatario.'<br>';
  $arrayDestino = split(',',$fila->destinatario);
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
  echo '<p class="alert alert-danger">Tienes '.$cantidadMensajes.' mensajes sin leer</p>';
}
?>
