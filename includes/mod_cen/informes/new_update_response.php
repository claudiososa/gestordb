<script src="includes/mod_cen/js/s_ajax_informe.js"></script>

<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/respuesta.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/imgRespuesta.php");
$nuevo=0;

if(isset($_POST['save_report']))
{
    if(!isset($_POST["edit_report"])){
    //creo objeto informe
    // en esta seccion de codigo se crea y guarda la respuesta

    $fecha=date("Y-m-d H:i:s");
    //$fechaVisita=$_POST[""]date("Y-m-d");
	  $respuesta= new Respuesta(null,$_POST["informeId"],$_SESSION["referenteId"],$_POST["contenido"],
		$_POST["fechaVisita"],$fecha,null);
    $guardar_respuesta=$respuesta->agregar();

/////////////////////////////////////////////////////////////////
    var_dump($_POST);
      foreach ($_FILES['input-img'] as $key) {
        $cantidadElmentos=count($_FILES['input-img']['name']);

        for ($i=0; $i < $cantidadElmentos ; $i++) {
          # code...
          $img1 = $_FILES['input-img']['tmp_name'][$i];
          $img1 = $_FILES['input-img']['name'][$i];

          $dir_subida = './img/respuestas/';

          if($_FILES['input-img']['type'][$i]=='image/jpeg'){
            $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.jpg';
            $nombreArchivoMediano='doc_'.$guardar_informe.'_'.$i.'m.jpg';
            $tipoArchivo='image/jpeg';
          } elseif($_FILES['input-img']['type'][$i]=='application/pdf') {
            $nombreArchivo='doc_'.$guardar_informe.'_'.$i.'.pdf';
            $tipoArchivo='application/pdf';
          }
          //$fichero_subido = $dir_subida . basename($_FILES['input-img']['name'][0]);
          $fichero_subido = $dir_subida . $nombreArchivo;
    //      echo $fichero_subido;


    //echo '<pre>';
          if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
            if($_FILES['input-img']['type'][$i]=='image/jpeg'){
              $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
              copy($fichero_subido,$nuevoArchivo);
            }
            $imagen = new ImgRespuesta(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
            $agregarImg = $imagen->agregar();
            echo "El fichero es válido y se subió con éxito.\n";
          }	 else {
     echo "¡Posible ataque de subida de ficheros!\n";
          }

        }
        break;
      }

////////////////////////////////////////////////////////////////////////////////
        if($guardar_respuesta>0){          // entra si se agrego la respuesta


            include_once("includes/mod_cen/informes/email_script_resp.php");
        }
    }else{
    	$fecha=date("Y-m-d H:i:s");
    	$respuesta= new Respuesta($_POST["contenido"],$_POST["fechaVisita"],$fecha);
    	$guardar_respuesta=$respuesta->editar();
        if($guardar_respuesta>1){
					  $informeId= $_POST["informeId"];
					$variablephp = "index.php?mod=slat&men=informe&id=3&informeId='$informeId'";
            ?>    <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()", 18000);
                    </script>
            <?php
        }
    }
    //echo "llego post";
  //  echo $_GET["escuelaId"];
   // echo $_SESSION["referenteId"];

}else{
	//sino entre por post, entonces debe cargarse formulario de informe
	//echo "no llego post";
	// crea objeto escuela, de acuerdo al id de escuela provisto por GET

	$dato_informe = new Informe($_GET["informeId"]);
	$buscar_informe = $dato_informe->buscar();
	$informe = mysqli_fetch_object($buscar_informe);

	$escuela= new Escuela($informe->escuelaId);
	$buscar_escuela=$escuela->buscar();
	$dato_escuela=mysqli_fetch_object($buscar_escuela);

	$respuesta = new Respuesta();
    $nuevo=1;

	//$dato_informe = mysqli_fetch_object($informe);

	include_once("includes/mod_cen/formularios/f_respuesta.php");

}
