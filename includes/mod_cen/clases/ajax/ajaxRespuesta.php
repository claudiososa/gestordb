<?php
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
    Maestro::debbugPHP($nuevaRespuesta);
    $nuevaRespuesta->agregar();
    //Maestro::debbugPHP($nueva);
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
