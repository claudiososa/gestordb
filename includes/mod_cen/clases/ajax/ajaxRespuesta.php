<?php
  include_once('../imgRespuesta.php');
  include_once('../respuesta.php');
  include_once('../maestro.php');

  if (isset($_POST['informeIdBuscar']))
  {
    $respuesta =  new Respuesta(null,$_POST['informeIdBuscar']);
    $buscarRespuesta = $respuesta->buscar();
    $list=array();
    while ($row = mysqli_fetch_object($buscarRespuesta)) {
      $temporal=array(
        'id'=>$row->respuestaId,
        'contenido'=>$row->contenido,
        'nombre'=>$row->nombre,
        'apellido'=>$row->apellido,
        'fecha'=>$row->fechaCarga,
      );
      array_push($list,$temporal);
    }
    $json = json_encode($list);
  //    Maestro::debbugPHP($json);
    echo $json;
  }


  if (isset($_POST['informeId']))
  {
    //Maestro::debbugPHP($_POST['informeId']);
    $fecha=date("Y-m-d H:i:s");
    $nuevaRespuesta =  new Respuesta(null,$_POST['informeId'],$_POST['referenteId'],$_POST['contenido'],$fecha,$fecha,$fecha);
    //Maestro::debbugPHP($nuevaRespuesta);
    $guardar_respuesta=$nuevaRespuesta->agregar();
    Maestro::debbugPHP($_FILES['input-img']);

    foreach ($_FILES['file'] as $key) {
      $cantidadElmentos=count($_FILES['input-img']['name']);

      for ($i=0; $i < $cantidadElmentos ; $i++) {
        # code...
        $img1 = $_FILES['input-img']['tmp_name'][$i];
        $img1 = $_FILES['input-img']['name'][$i];
      //  echo 'dato'.img1;
        $dir_subida = './img/respuestas/';

        if($_FILES['input-img']['type'][$i]=='image/jpeg'){
          $nombreArchivo='doc_'.$guardar_respuesta.'_'.$i.'.jpg';
          $nombreArchivoMediano='doc_'.$guardar_respuesta.'_'.$i.'m.jpg';
          $tipoArchivo='image/jpeg';
        } elseif($_FILES['input-img']['type'][$i]=='application/pdf') {
          $nombreArchivo='doc_'.$guardar_respuesta.'_'.$i.'.pdf';
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
          $imagen = new ImgRespuesta(null,$guardar_respuesta,$nombreArchivo,$tipoArchivo);
          $agregarImg = $imagen->agregar();
          echo "El fichero es válido y se subió con éxito.\n";
        }	 else {
   echo "¡Posible ataque de subida de ficheros!\n";
        }

      }
      break;
    }

      $list=array();
      $temporal=array(
        'estado'=>'guardado'
      );

      array_push($list,$temporal);
      $json = json_encode($list);
    //    Maestro::debbugPHP($json);
      echo $json;
    //}

  }
/*
  $list=array();
  $temporal=array(
    'estado'=>'guardado'
  );

  array_push($list,$temporal);
  $json = json_encode($list);
  //Maestro::debbugPHP($json);
  echo $json;
