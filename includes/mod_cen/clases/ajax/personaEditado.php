<?php


  include_once('../persona.php');
  include_once('../maestro.php');



if (isset($_POST['dni'])) {

   $fotoPerfil=$_POST['fotoPerfil'];



 // codigo para subir foto de perfil INICIO ********************

  foreach ($_FILES['input-img'] as $key) {


  $cantidadElmentos=count($_FILES['input-img']['name']);



    for ($i=0; $i < $cantidadElmentos ; $i++) {

      $img1 = $_FILES['input-img']['tmp_name'][$i];
      $img1 = $_FILES['input-img']['name'][$i];

      $dir_subida = '../../../../img/perfil/';

      switch ($_FILES['input-img']['type'][$i]) {

       case 'image/jpeg':
                $nombreArchivo=$_POST["personaId"].'.jpg';
                break;
       case 'image/png':
               $nombreArchivo=$_POST["personaId"].'.jpg';
               break;


        default:

          break;
      }


      $fichero_subido = $dir_subida . $nombreArchivo;

         //Maestro::debbugPHP($_FILES['input-img']);

      if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {

            echo "El fichero es válido y se subió con éxito.\n";
            $fotoPerfil=$nombreArchivo;

      }else {
      echo "¡Posible ataque de subida de ficheros!\n";


      }


    }
    break;
  }

// fin de codigo para subir foto de perfil *********************



  $persona=new Persona($_POST['personaId'],$_POST['apellido'],$_POST['nombre'],
	$_POST['dni'],$_POST['cuil'],$_POST['telefonoC'],$_POST['telefonoM'],
	$_POST['direccion'],$_POST['email'],null,$_POST['facebook'],$_POST['twitter'],
	$_POST['localidadId'],$_POST['cpostal'],$_POST['ubicacion'],$fotoPerfil);

    $salida= $persona->editar();


$estado= [];
$temporal=array('dni'=>'ok');
	array_push($estado,$temporal);
	$json = json_encode($estado);
	echo $json;


 }

?>
