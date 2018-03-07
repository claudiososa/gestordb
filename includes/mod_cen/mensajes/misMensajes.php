<link href="includes/mod_cen/mensajes/estilos/botones-estilos.css" rel="stylesheet" type="text/css" />
<div class="container">
  <?php
    /**
     * Botones de encabezados, Nuevo mensaje y enviados.
     */
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

    if (isset($_GET['enviados'])) {
      echo '<div class="container"><p><h4><font color="#068587">&nbspMensajes Enviados</font></h4></p></div>';
    }else{
      echo '<div class="container"><p><h4><font color="#068587">&nbspMensajes Recibidos</font></h4></p></div>';

    }
//**********************************
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
//include_once ('includes/mod_cen/clases/MensajeHilo.php');
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

  /*************************************************************************************
   * Mostrar todos los mensajes en Bandeja de entrada para el usuario Logueado
   * @var Mensajes
   */
  $objMensaje = new Mensajes();
  $misMensajes = $objMensaje->buscarHilo();

  while ($fila =mysqli_fetch_object($misMensajes)) {
    $cantAdjunto=0;
    if ($fila->referenteId<>(int)$_SESSION['referenteId'])
    {
      $respuestas = new MensajesResp();
      $cantidadRespuestas = $respuestas->buscarIntervenciones(null,'cantidad',$fila->mensajeHiloId);

      $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
      $buscar_adjunto = $adjunto->buscar();
      $cantAdjunto = mysqli_fetch_object($buscar_adjunto);
      echo '<div class="estilo1">';
      echo '<div class="row">';
      echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
      echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
      if ($cantAdjunto==0) {
        echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.' ('.$cantidadRespuestas.')</a></h4></div>';
      }else{
        echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.' ('.$cantidadRespuestas.')</a>&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></h4></div>';
      }
      echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';
      echo '</div>';
      echo '</div>';
      //echo 'no es dueno';
      //echo '<br>'.$cantidadRespuestas;

    }else{
      //echo 'si es dueno';
      $respuestas = new MensajesResp();
      //$cantidadRespuestas = $respuestas->buscarIntervenciones($fila->mensajeId,'cantidad');

      $cantidadRespPropias = $respuestas->buscarIntervenciones($fila->mensajeId,'cantidad',$fila->mensajeHiloId);
      //var_dump($cantidadRespPropias);
      if ($cantidadRespPropias > 1) {
        $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
        $buscar_adjunto = $adjunto->buscar();
        echo '<div class="estilo1">';
        echo '<div class="row">';
        echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
        echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
        if ($cantAdjunto==0) {
          echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.' ('.$cantidadRespPropias.')</a></h4></div>';
        }else{
          echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.' ('.$cantidadRespPropias.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';
        }
        echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';
        echo '</div>';
        echo '</div>';
        //echo 'no es dueno';
        echo '<br>'.$cantidadRespuestas;
      }
    }
  }
/*
  while ($fila = mysqli_fetch_object($misMensajes))
  {    //$paraLogueado=0;
      //$arrayDestino = explode(',',$fila->destinatario);
      //var_dump($arrayDestino);
      echo 'llego aqui como no dueno del mensaje'
        if ($fila->referenteId<>(int)$_SESSION['referenteId'])
            {//se encuentra en Destinatario PERO NO es el creado del MENSAJE

              //echo 'es destinatario pero no es dueno';
              /*$paraLogueado=1;
              $propio=1;
              $hilo = new MensajeHilo(null,$fila->mensajeId);
              $buscarHilo = $hilo->buscar();
              $intervenciones=mysqli_num_rows($buscarHilo);

              $hilo2 = new MensajeHilo();
              $arrayBuscarHilo=$hilo2->buscarHilo($fila->mensajeId,$_SESSION['referenteId']);
              //var_dump($arrayBuscarHilo);
              $mensajeResp = new MensajesResp();
              $encontrarRespuestas=$mensajeResp->buscarRespuestas($arrayBuscarHilo);
              $intervenciones=mysqli_num_rows($encontrarRespuestas);
              $intervenciones++;
              //$intervenciones++;

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
          }else{//se encuentra en Destinatario Y ADEMAS es el creado del MENSAJE
              $mensajeResp = new MensajesResp();
              $intervenciones=$mensajeResp->respuestasParaMensaje($fila->mensajeId,'cantidad');

              if ($intervenciones>0) //si existe por lo menos una respuesta ingresa aqui
              {
                $intervenciones++;
                $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
                $buscar_adjunto = $adjunto->buscar();
                $cantAdjunto = mysqli_num_rows($buscar_adjunto);
                echo '<div class="estilo1">';
                echo '<div class="row">';
                echo '<div class="col-md-4 col-xs-6">Yo..</div>';
                //echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
                echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
                if ($cantAdjunto==0) {
                  echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</a></h4></div>';
                }else{
                  echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';
                }
                echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';
                echo '</div>';
                echo '</div>';
            }
          //}
          }

    //}
  }//Cierra While de Mensajes Originales*/
}
?>
</div> <!--cierre de row-->
</div>
