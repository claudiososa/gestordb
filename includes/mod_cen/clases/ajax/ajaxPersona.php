<?php
  include_once('../persona.php');
  include_once('../maestro.php');


  //verifica que venga desde pedido post desde ajax determinado
  if (isset($_POST['dni']))
  {
    $persona = new Persona(null,null,null,$_POST['dni']);

    $buscarPersona = $persona->buscar();
    $resultadoCantidad = mysqli_num_rows($buscarPersona);
    if ($resultadoCantidad > 0) {
      $datoPersona = mysqli_fetch_object($buscarPersona);
      $item=array();

      $item=['id' => $datoPersona->personaId,
             'nombre' => $datoPersona->nombre,
             'apellido' => $datoPersona->apellido,
             'cuil' => $datoPersona->cuil,
             'telefono' => $datoPersona->telefonoM,
             'email' => $datoPersona->email,
             'localidad' => $datoPersona->localidadId,
           ];
      array_push($arrayPrincipal,$item);
    }



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
