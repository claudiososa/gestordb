<?php
  include_once('../../../clases/localidades.php');
  include_once('../../../clases/maestro.php');


  //verifica que venga desde pedido post desde ajax determinado
  if (isset($_POST['departamentoId']))
  {
    $local = new Localidad(null,null,$_POST['departamentoId']);

    $buscarLocalidad = $local->buscar();
    $arrayPrincipal=array();

    while ($row = mysqli_fetch_object($buscarLocalidad)) {
      $item=array();

      $item=['id' => $row->localidadId,
            'descripcion' => $row->nombre];
      array_push($arrayPrincipal,$item);
    }
    //$dato=mysqli_fetch_object($buscarCurso);
    //array_push($list,$temporal);

    $json = json_encode($arrayPrincipal);
    //Maestro::debbugPHP($json);
    echo $json;
  }
  ?>
