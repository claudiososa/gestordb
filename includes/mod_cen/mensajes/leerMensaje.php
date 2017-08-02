<!--<script src="includes/mod_cen/js/s_ajax_mensajeNuevoDesactivar.js"></script>-->
<?php
include_once("includes/mod_cen/clases/Mensajes.php");
include_once("includes/mod_cen/clases/MensajesLeidos.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/MensajesAdjunto.php");

echo '<div class="container">';
  echo '<label class="control-label" for=""><a class="btn btn-success" href="index.php?men=mensajes&id=2">Mensajes Recibidos</a></label>';
  echo "<a class='btn btn-warning' href='index.php?men=mensajes&id=2&enviados'>Mis Mensajes Enviados</a>";
  //echo '<p><h3>Mensajes Nuevo</h3></p>';
echo '</div">';

$encontrado = 0;
$mensaje = new Mensajes($_GET['mensajeId']);
$buscarMensaje = $mensaje->buscar();

if (mysqli_num_rows($buscarMensaje)==0) {
  echo 'Acceso Denegado';
}else{

$datoMensaje = mysqli_fetch_object($buscarMensaje);

$adjunto = new MensajesAdjunto(null,$datoMensaje->mensajeId);
$buscar_adjunto = $adjunto->buscar();



$acceso=0;
  //echo $fila->destinatario.'<br>';
  $arrayDestino = explode(',',$datoMensaje->destinatario);
  foreach ($arrayDestino as $key => $value) {
    //echo $arrayDestino[$key].'<br>';
    if ($arrayDestino[$key]==$_SESSION['referenteId']) {
      $acceso++;
    }
  }

  if ($datoMensaje->referenteId==$_SESSION['referenteId']) {
    $acceso++;
  }

  if ($acceso==0) {
    echo 'Acceso Denegado';
  }else{



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
/*
    foreach ($_FILES['input-img'] as $key)
    {

      $cantidadElmentos=count($_FILES['input-img']['name']);

      for ($i=0; $i < $cantidadElmentos ; $i++) {
        # code...
        $img1 = $_FILES['input-img']['tmp_name'][$i];
        $img1 = $_FILES['input-img']['name'][$i];

        $dir_subida = './documentacion/';
        //echo $_FILES['input-img']['type'][$i];

        switch ($_FILES['input-img']['type'][$i]) {
          case 'application/pdf':
            $nombreArchivo=$_POST["tituloDoc"].'.pdf';
            break;
          case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
              $nombreArchivo=$_POST["tituloDoc"].'.xlsx';
              break;
          case 'application/vnd.ms-excel':
                  $nombreArchivo=$_POST["tituloDoc"].'.xls';
                  break;
         case 'application/msword':
                  $nombreArchivo=$_POST["tituloDoc"].'.doc';
                  break;
         case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                 $nombreArchivo=$_POST["tituloDoc"].'.docx';
                 break;
         case 'image/jpeg':
                  $nombreArchivo=$_POST["tituloDoc"].'.jpg';
                  break;
         case 'image/png':
                 $nombreArchivo=$_POST["tituloDoc"].'.png';
                 break;
         case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                 $nombreArchivo=$_POST["tituloDoc"].'.pptx';
                 break;


          default:
            # code...
            break;
        }

        $fichero_subido = $dir_subida . $nombreArchivo;

*/
    //    if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
          /*if($_FILES['input-img']['type'][$i]=='image/jpeg'){
            $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
            copy($fichero_subido,$nuevoArchivo);
          }*/
          //$imagen = new Img(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
          //$agregarImg = $imagen->agregar();
      //    echo "El fichero es válido y se subió con éxito.\n";
    //    }	 else {
  // echo "¡Posible ataque de subida de ficheros!\n";
    //    }

  //    }
  //    break;
//    }

  //    if($guardar_mensaje>0){

    //      include_once("includes/mod_cen/mensajes/email_script.php");
      //    }


}else{
  $fecha=date("Y-m-d H:i:s");
  $leer = new MensajesLeidos(null,$_GET['mensajeId'],$_SESSION['referenteId'],$fecha);
  $agregarLeido = $leer->agregar();


	$mensajeValidado = new Mensajes($_GET['mensajeId']);

  $buscarMensaje=$mensajeValidado->buscar();
  $datoValidado=mysqli_fetch_object($buscarMensaje);
  $nuevo=1;
	include_once("includes/mod_cen/formularios/f_mensaje.php");

}
}
}
