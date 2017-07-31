<?php
include_once("includes/mod_cen/clases/Mensajes.php");
if ($_POST['mensajeId']) {
  $mensaje = new Mensajes($_POST['mensajeId']);
  $buscarMensaje = $mensaje->buscar();
  $datoMensaje = mysqli_fetch_object($buscarMensaje);
  $arrayDestino = split(',',$datoMensaje->destinatario);
  echo json_encode($arrayDestino);
}

?>
