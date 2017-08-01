<script src="includes/mod_cen/js/s_ajax_mensajeNuevo.js"></script>
<?php
include_once("includes/mod_cen/clases/Mensajes.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/MensajesAdjunto.php");

$nuevo=0;
if(isset($_POST['save_report']))//Si presiona el boton enviar del formulario de mensaje nuevo ingresa aqui
  {
  //var_dump($_POST);
  $arrayDestino=unserialize($_POST['referentes']);
  $destinatarios = implode(',',$arrayDestino);
  //var_dump($arrayDestino);
  //foreach ($arrayDestino as $key => $value) {
  //  echo $arrayDestino[$key].'<br>';
  //}
  //echo $destinatarios;
  //creo objeto mensaje
  $fecha=date("Y-m-d H:i:s");
  $mensaje= new Mensajes(null,
                            $_SESSION["referenteId"],
                            $_POST["asunto"],
                            $_POST["contenido"],
                            $destinatarios,
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
          /*if($_FILES['input-img']['type'][$i]=='image/jpeg'){
            $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
            copy($fichero_subido,$nuevoArchivo);
          }*/
          //$imagen = new Img(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
          //$agregarImg = $imagen->agregar();
      //    echo "El fichero es válido y se subió con éxito.\n";

      $adjunto = new MensajesAdjunto(null,$guardar_mensaje,$nombreArchivo,'pdf');
      $agregarAdjunto = $adjunto->agregar();

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


}else{
	$mensaje = new Mensajes();
  $nuevo=1;
	include_once("includes/mod_cen/formularios/f_mensaje.php");

}
