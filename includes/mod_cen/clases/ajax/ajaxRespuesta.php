<?php
  include_once('../respuesta.php');
  include_once('../maestro.php');


  if (isset($_POST['informeId']))
  {
    Maestro::debbugPHP($_POST['informeId']);
    $fecha=date("Y-m-d H:i:s");
    $respuesta =  new Respuesta(null,$_POST['informeId'],$_POST['referenteId'],'hola mundo',$fecha,$fecha,$fecha);
    $nuevaRespuesta = $respuesta->agregar();
    //Maestro::debbugPHP($nuevaRespuesta);
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

  $list=array();
  $temporal=array(
    'estado'=>'guardado'
  );

  array_push($list,$temporal);
  $json = json_encode($list);
  //Maestro::debbugPHP($json);
  echo $json;
