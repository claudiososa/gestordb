<style type="text/css">
.btn-default {
  color: #ffffff;
  background-color: #529e8b;
  border-color: #529e8b;
}.estilo  {

    padding: 10px;
    outline: 1px solid #529e8b;
    color: #ffffff;
background-color: #529e8b;


 }.estilo1  {

     padding: 10px;
     outline: 1px solid #529e8b;


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
      echo '<label class="control-label" for=""><a class="btn btn-default" href="index.php?men=mensajes&id=2"><span class="glyphicon glyphicon glyphicon-bell"></span>&nbspRecibidos</a></label>';
      echo '</div>';
      echo '<div class="panel-body">';
      echo '</div>';
    }else{
      echo '<div class="panel panel-default">';
      echo '<div class="panel-heading">';
      echo '<label class="control-label" for=""><a class="btn btn-default" href="index.php?men=mensajes&id=1"><span class="glyphicon glyphicon glyphicon-edit"></span>&nbspNuevo Mensaje</a></label>';
      echo "&nbsp";
      echo '<a class="btn btn-default" href="index.php?men=mensajes&id=2&enviados"><span class="glyphicon glyphicon glyphicon-send"></span>&nbspEnviados</a>';
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
      echo '<div class="container"><p><h4><font color="#068587">&nbspMensajes Enviados</font></h4></p></div>';
    }else{
      echo '<div class="container"><p><h4><font color="#068587">&nbspMensajes Recibidos</font></h4></p></div>';

    }
    ?>


<div class="container-fluid">
<div class="estilo hidden-sm hidden-xs">


<div class="row hidden-sm hidden-xs">
  <div class="col-md-4">De</div>
  <div class="col-md-4">Asunto</div>
  <div class="col-md-4">Fecha</div>
</div>
</div>

<?php
include_once ('includes/mod_cen/clases/Mensajes.php');
include_once ('includes/mod_cen/clases/MensajesResp.php');
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
        echo '<div class="estilo1">';
        echo '<div class="row">';

        echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
          echo '<div class="col-md-4 col-xs-6-pull-right">'.date("d-m-Y H:i",  strtotime($fila->fechaHora)).'</div>';
        if ($cantAdjunto==0) {
          echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></h4></div>';
        }else{
          echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></h4>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';
        }

        //echo '<td><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'</a></td>';
echo '</div>';
        echo '</div>';
        $cantidadMensajes++;



  }
}else{
/**
 * Mostrar todos los mensajes en Bandeja de entrada
 * @var Mensajes
 */

//$objMensaje = new Mensajes(null,null,null,null,null,null,0);
$objMensaje = new Mensajes();
//var_dump($objMensaje);

/**
 * $misMensajes / devuelve todos los mensajes con respuesta = 0;
 * se debe fijar el atributo respuesta en 0 y pasar como cuarto parametro 'originales'
 */
//$misMensajes = $objMensaje->buscar(null,null,null,'originales');
$misMensajes = $objMensaje->buscar();

while ($fila = mysqli_fetch_object($misMensajes)) {

//  if ((int)$fila->referenteId!=(int)$_SESSION['referenteId']) {//Si el mensaje fue creado por el usuario logeado ingresa aqui
      //echo '<br><br>Si pertenece<br><br>';
      $arrayDestino = explode(',',$fila->destinatario);

      foreach ($arrayDestino as $key => $value) {
          if ($arrayDestino[$key]==$_SESSION['referenteId']) {
            //&& $fila->respuesta<>0
          $propio=1;
          $mensaje1 = new MensajesResp();
          //$mensajeOriginal=$mensaje1->mensajeIdOriginal($fila->mensajeId,$fila->mensajeId);
          //$intervenciones = $mensaje1->buscarIntervenciones($mensajeOriginal[0]);
          $intervenciones = $mensaje1->buscarIntervenciones($fila->mensajeId);
          $intervenciones++;

          $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
          $buscar_adjunto = $adjunto->buscar();
          $cantAdjunto = mysqli_num_rows($buscar_adjunto);
          echo '<div class="estilo1">';
          echo '<div class="row">';
          echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
          echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
          if ($cantAdjunto==0) {

            echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</a></h4></div>';
          }else{
            echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';

          }
          echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';

          echo '</div>';
          echo '</div>';
          $cantidadMensajes++;

        }else{
            $mensajeResp = new MensajesResp(null,$fila->mensajeId);
            $cantidad=$mensajeResp->buscar(null,null,null,'cantidad');
            $mensajeResp->destinatario=$_SESSION['referenteId'];
            //$mensajeResp->mensajeId=NULL;
            $buscarResp=$mensajeResp->buscar();
            $intervenciones=mysqli_num_rows($buscarResp);

            if ($intervenciones > 0) {
            $intervenciones++;

            //Muestra el mensaje original donde me respondieron al usuario logueado Actual
            echo '<div class="estilo1">';
            echo '<div class="row">';
            echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
            echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
          //  if ($cantAdjunto==0) {

              echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</a></h4></div>';
            //}else{
            //  echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';

            //}
            echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';

            echo '</div>';
            echo '</div>';
            }

        }

    }



/*
      $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
      $buscar_adjunto = $adjunto->buscar();
      $cantAdjunto = mysqli_num_rows($buscar_adjunto);

      $mensajeRespuesta = new Mensajes($fila->mensajeId);
      $datoRespuesta=$mensajeRespuesta->buscarRespuesta($_SESSION['referenteId']);
      //var_dump($datoRespuesta);


      //$mensajeRespuesta->mensajeId=$datoRespuesta[0];
      $intervenciones=$mensajeRespuesta->buscarIntervenciones($fila->mensajeId);
      $intervenciones++;
      //echo $intervenciones;
      echo '<div class="estilo1">';
      echo '<div class="row">';
      echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
      echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
      if ($cantAdjunto==0) {

        echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</a></h4></div>';
      }else{
        echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';

      }
    echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';

      echo '</div>';
      echo '</div>';
*/

  //}else{//Si el mensaje original (con respuesta 0) no pertenece al usuario logueado
  /*  echo '<br><br>No pertenece<br><br>';
    $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
    $buscar_adjunto = $adjunto->buscar();
    $cantAdjunto = mysqli_num_rows($buscar_adjunto);

    $mensajeRespuesta = new Mensajes($fila->mensajeId);
    /*$datoRespuesta=$mensajeRespuesta->buscarRespuesta($_SESSION['referenteId']);
    var_dump($datoRespuesta);


    //$mensajeRespuesta->mensajeId=$datoRespuesta[0];
    //$intervenciones=$mensajeRespuesta->buscarIntervenciones($datoRespuesta[0]);
    $intervenciones=$mensajeRespuesta->buscarIntervenciones($fila->mensajeId);
    $intervenciones++;
    //var_dump($intervenciones);
    echo '<div class="estilo1">';
    echo '<div class="row">';
    echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
    echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
    if ($cantAdjunto==0) {

      echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</a></h4></div>';
    }else{
      echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';

    }
  echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';

    echo '</div>';
    echo '</div>';


    //var_dump($datoRespuesta);
  }*/
}//Cierra While de Mensajes Originales
}
//$cantidadMensajes=mysqli_num_rows($misMensajes);

?>

<br>
</div> <!--cierre de row-->
</div>
