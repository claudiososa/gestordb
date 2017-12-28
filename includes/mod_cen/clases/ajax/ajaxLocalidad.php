<?php
  include_once('../localidades.php');

  //verifica que venga desde pedido post desde ajax determinado
  if (isset($_POST['local']))
  {
    $local = new Localidad();

    $buscarLocalidad = $local->buscar();
    $arrayPrincipal=array();

    while ($row = mysqli_fetch_object($buscarLocalidad)) {
      $item=array();

      $item=['id' => $row->localidadId,
                'nombre' => $row->nombre];
      array_push($arrayPrincipal,$item);
    }
    //$dato=mysqli_fetch_object($buscarCurso);


    //array_push($list,$temporal);
    $json = json_encode($arrayPrincipal);
    Maestro::debbugPHP($json);
    echo $json;
  }
  ?>
