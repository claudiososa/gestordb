<script src="includes/mod_cen/js/s_ajax_mensajeResponder.js"></script>
<?php
include_once("includes/mod_cen/clases/MensajesResp.php");
include_once("includes/mod_cen/clases/Mensajes.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/MensajesAdjunto.php");

echo '<div class="container">';
  echo '<label class="control-label" for=""><a class="btn btn-success" href="index.php?men=mensajes&id=2">Mensajes Recibidos</a></label>';
  echo "<a class='btn btn-warning' href='index.php?men=mensajes&id=2&enviados'>Mis Mensajes Enviados</a>";
  echo '<p><h3>Responder Mensaje</h3></p>';
echo '</div">';

$nuevo=0;
if(isset($_POST['save_report']))//Si presiona el boton enviar del formulario de mensaje nuevo ingresa aqui
  {
  //$arrayDestino=unserialize($_POST['referentes']);
  //$destinatarios = implode(',',$arrayDestino);
  $fecha=date("Y-m-d H:i:s");
  $mensaje= new MensajesResp(null,
                            $_POST["mensajeId"],
                            $_SESSION["referenteId"],
                            $_POST["asunto"],
                            $_POST["contenido"],
                            $_POST["destinatario"],
                            $fecha
                          );
    $guardar_mensaje=$mensaje->agregar(); // hasta aqui guarda el mensaje nuevo

///////////////////  guardar archivo adjunto ////////////////

    foreach ($_FILES['input-img'] as $key)
    {

      $cantidadElmentos=count($_FILES['input-img']['name']);

      for ($i=0; $i < $cantidadElmentos ; $i++) {
        # code...
        $img1 = $_FILES['input-img']['tmp_name'][$i];
        $img1 = $_FILES['input-img']['name'][$i];

        $dir_subida = './img/mensajes/';
        //echo $_FILES['input-img']['type'][$i];

        switch ($_FILES['input-img']['type'][$i]) {
          case 'application/pdf':
            $nombreArchivo=$img1;
            break;
          case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
              $nombreArchivo=$img1;
              break;
          case 'application/vnd.ms-excel':
                  $nombreArchivo=$img1;
                  break;
         case 'application/msword':
                  $nombreArchivo=$img1;
                  break;
         case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                 $nombreArchivo=$img1;
                 break;
         case 'image/jpeg':
                  $nombreArchivo=$img1;
                  break;
         case 'image/png':
                 $nombreArchivo=$img1;
                 break;
         case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                 $nombreArchivo=$img1;
                 break;


          default:
            # code...
            break;
        }

        $fichero_subido = $dir_subida . $nombreArchivo;

        if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
          $adjunto = new MensajesAdjunto(null,$guardar_mensaje,$nombreArchivo,'pdf');
          $agregarAdjunto = $adjunto->agregar();
          echo $agregarAdjunto;
        }	 else {
          // echo "¡Posible ataque de subida de ficheros!\n";
        }

      }
      break;
    }

      if($guardar_mensaje>0){
          echo 'imagen guardada';
    //      include_once("includes/mod_cen/mensajes/email_script.php");
  }else{
    echo 'imagen NO GUARDAD';
  }

  $variablephp = "index.php?men=mensajes&id=2&saved";

  ?>  <script type="text/javascript">
        var variablejs = "<?php echo $variablephp; ?>" ;
        function redireccion(){window.location=variablejs;}
        setTimeout ("redireccion()",0);
      </script>
  <?php


}else{
  $mensajeValidado = new Mensajes($_GET['mensajeId']);

  $buscarMensaje=$mensajeValidado->buscar();
  $datoValidado=mysqli_fetch_object($buscarMensaje);
  $nuevo=1;
	include_once("includes/mod_cen/formularios/f_mensaje_respuesta.php");

}
