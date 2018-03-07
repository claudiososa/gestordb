<?php
include_once 'Mensajes.php';
//echo date('d-m-Y H:i:s');
///echo '<br>';
//$mensaje = new Mensajes(null,'0022','Primer Mensaje','Mensaje de Prueba','0024,0032,0033',date('Y-m-d H:i:s'));

$mensaje = new Mensajes();
//$mensaje->referenteId='22';
var_dump($mensaje);
$buscarMensaje = $mensaje->buscar();

$cantidad = mysqli_num_rows($buscarMensaje);
//$resultado = ;
while ($fila = mysqli_fetch_object($buscarMensaje)) {
  var_dump($fila);
}

//Guardar un mensaje nuevoTipo
/*$guardando = $mensaje->agregar();
if($guardando>0){
  echo $guardando;
  echo 'Se guardo correctamente';
}*/



 ?>
