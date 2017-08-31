<!--<script src="includes/mod_cen/js/s_ajax_mensajeNuevoDesactivar.js"></script>-->
<?php
  include_once("includes/mod_cen/clases/Mensajes.php");
  include_once("includes/mod_cen/clases/MensajesResp.php");
  include_once("includes/mod_cen/clases/ContenidoRespuestas.php");
  include_once("includes/mod_cen/clases/MensajeHilo.php");
  include_once("includes/mod_cen/clases/MensajesLeidos.php");
  include_once("includes/mod_cen/clases/referente.php");
  include_once("includes/mod_cen/clases/MensajesAdjunto.php");

  $encontrado = 0;
  $mensaje = new Mensajes($_GET['mensajeId']);
  $buscarMensaje = $mensaje->buscar();
  $datoMensaje = mysqli_fetch_object($buscarMensaje);

  $arrayDestinatario = $arrayDestino = explode(',',$datoMensaje->destinatario);


  echo '<div class="container">';
    echo '<label class="control-label" for=""><a class="btn btn-success" href="index.php?men=mensajes&id=2">Mensajes Recibidos</a></label>';
    echo "<a class='btn btn-warning' href='index.php?men=mensajes&id=2&enviados'>Mis Mensajes Enviados</a>";


    if (count($arrayDestinatario)>2) {
      echo "<a class='btn btn-success' href='index.php?men=mensajes&solo&id=4&mensajeId=".$_GET['mensajeId']."'>Responder</a>";
      echo "<a class='btn btn-success' href='index.php?men=mensajes&todos&id=4&mensajeId=".$_GET['mensajeId']."'>Responder a Todos</a>";
    }else{
      echo "<a class='btn btn-success' href='index.php?men=mensajes&id=4&mensajeId=".$_GET['mensajeId']."'>Responder</a>";
  }
    //echo "<a class='btn btn-success' href='index.php?men=mensajes&id=4&mensajeId=".$mensajeOriginal[0]."&mensajeIdRespuesta=".$mensajeOriginal[1]."'>Responder</a>";
    //echo '<p><h3>Mensajes Nuevo</h3></p>';
  echo '</div">';



  if (mysqli_num_rows($buscarMensaje)==0) {
    echo 'Acceso Denegado';
  }else{

  $adjunto = new MensajesAdjunto(null,$datoMensaje->mensajeId);
  $buscar_adjunto = $adjunto->buscar();

  $acceso=0;
    $arrayDestino = explode(',',$datoMensaje->destinatario);
    foreach ($arrayDestino as $key => $value) {
      if ($arrayDestino[$key]==$_SESSION['referenteId']) {
        $acceso++;
      }
    }

    if ($datoMensaje->referenteId==$_SESSION['referenteId']) {
      $acceso++;
    }

    if ($acceso==0) {//sino un usuario habilitado para leer este mensaje
      echo 'Acceso Denegado';
    }else{//esta  habilitado para leer este mensaje;
      $nuevo=0;
      $fecha=date("Y-m-d H:i:s");
      $leer = new MensajesLeidos(null,$_GET['mensajeId'],$_SESSION['referenteId'],$fecha);
      $agregarLeido = $leer->agregar();
    	$mensajeValidado = new Mensajes();
      $buscarMensaje=$mensajeValidado->buscarHilo($_GET['mensajeId']);
      $datoValidado=mysqli_fetch_object($buscarMensaje);
      $nuevo=1;
    	include_once("includes/mod_cen/formularios/f_mensaje.php");
    }
  }
