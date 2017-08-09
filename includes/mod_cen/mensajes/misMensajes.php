<style type="text/css">
.btn-default {
  color: #ffffff;
  background-color: #529e8b;
  border-color: #529e8b;
}.table > thead > tr > th {
    vertical-align: bottom;
    border-bottom: 2px solid #068587;
    color: #068587;
    background-color: #f5f5f5;

}.table > tbody > tr > td {

  border-top: 1px solid #068587;
}

</style>
<div class="container">

  <?php
  /*  if (isset($_GET['enviados'])) {
      echo '<p><h3>Mis Mensajes Enviados</h3> <a class="btn btn-success" href="index.php?men=mensajes&id=1">Mensaje Nuevo</a></p>';
    }else{
      echo '<p><h3>Mis Mensajes Recibidos</h3> <a class="btn btn-success" href="index.php?men=mensajes&id=1">Mensaje Nuevo</a></p>';
    }*/
    if (isset($_GET['enviados']))
    {
      echo '<div class="panel panel-default">';
      echo '<div class="panel-heading">';
      echo '<label class="control-label" for=""><a class="btn btn-default" align="" href="index.php?men=mensajes&id=1"><span class="glyphicon glyphicon glyphicon-edit"></span>&nbspNuevo Mensaje</a></label>';
      echo "&nbsp";
      echo '<label class="control-label" for=""><a class="btn btn-default" href="index.php?men=mensajes&id=2"><span class="glyphicon glyphicon glyphicon-bell"></span>&nbspMensajes Recibidos</a></label>';
      echo '</div>';
      echo '<div class="panel-body">';
      echo '</div>';
    }else{
      echo '<div class="panel panel-default">';
      echo '<div class="panel-heading">';
      echo '<label class="control-label" for=""><a class="btn btn-default" href="index.php?men=mensajes&id=1"><span class="glyphicon glyphicon glyphicon-edit"></span>&nbspNuevo Mensaje</a></label>';
      echo "&nbsp";
      echo '<a class="btn btn-default" href="index.php?men=mensajes&id=2&enviados"><span class="glyphicon glyphicon glyphicon-send"></span>&nbspMensajes Enviados</a>';
      echo '</div>';
      echo '<div class="panel-body">';
      echo '</div>';
}

    /*if ($_GET['id']==3){
      echo '<label class="control-label" for=""><h3>Mensaje</h3><a class="btn btn-success" href="index.php?men=mensajes&id=2">Ver Mis Mensajes</a></label>';
    }elseif ($_GET['id']==1) {
      echo '<label class="control-label" for=""><h3>Nuevo Mensaje</h3></label>';
    }*/


    if (isset($_GET['enviados'])) {
      echo '<p><h4><font color="#068587"><span class="glyphicon glyphicon glyphicon-send"></span>&nbspMensajes Enviados</font></h4></p>';
    }else{
      echo '<p><h4><font color="#068587"><span class="glyphicon glyphicon glyphicon-bell"></span>&nbspMensajes Recibidos</font></h4></p>';

    }
    ?>




<table class="table">
  <thead>
    <tr>
    <th>De</th>
    <th>Asunto</th>
    <th>Fecha</th>
    </tr>
  </thead>
<tbody>



<?php
include_once ('includes/mod_cen/clases/Mensajes.php');
include_once ('includes/mod_cen/clases/MensajesAdjunto.php');
$cantidadMensajes=0;
//creo un objeto nuevo del tipo Mensajes, con el atributo referenteId seteado. Ademas busco si el referente actual tiene mensajes recibidos
if (isset($_GET['enviados'])) {
  $objMensaje = new Mensajes(null,$_SESSION['referenteId']);
  $misMensajes = $objMensaje->buscar();

  while ($fila = mysqli_fetch_object($misMensajes)) {
        $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
        $buscar_adjunto = $adjunto->buscar();
        $cantAdjunto = mysqli_num_rows($buscar_adjunto);

        echo '<tr>';
        echo '<td>'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</td>';
        if ($cantAdjunto==0) {
          echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';
        }else{
          echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></td>';
        }

        //echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';

        echo '<td>'.date("d-m-Y H:i:s", strtotime($fila->fechaHora)).'</td>';
        echo '</tr>';
        $cantidadMensajes++;



  }
}else{


$objMensaje = new Mensajes();
$misMensajes = $objMensaje->buscar();

while ($fila = mysqli_fetch_object($misMensajes)) {
  //echo $fila->destinatario.'<br>';
  $arrayDestino = explode(',',$fila->destinatario);
  //var_dump($arrayDestino);
  foreach ($arrayDestino as $key => $value) {
    //echo $arrayDestino[$key].'<br>';
    if ($arrayDestino[$key]==$_SESSION['referenteId']) {
      $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
      $buscar_adjunto = $adjunto->buscar();
      $cantAdjunto = mysqli_num_rows($buscar_adjunto);
      echo '<tr>';
      echo '<td>'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</td>';

      if ($cantAdjunto==0) {
        echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';
      }else{
        echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></td>';
      }


      echo '<td>'.date("d-m-Y H:i:s", strtotime($fila->fechaHora)).'</td>';
      echo '</tr>';
      $cantidadMensajes++;

    }
  }
}
}
//$cantidadMensajes=mysqli_num_rows($misMensajes);
echo '</div>';
?>
</tbody>
</table>
</div>
