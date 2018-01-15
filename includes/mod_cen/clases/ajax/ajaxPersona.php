<?php
  include_once('../persona.php');
  include_once('../maestro.php');


  //verifica que venga desde pedido post desde ajax determinado
    Maestro::debbugPHP($_POST['dni']);
  if (isset($_POST['dni']))
  {
    $persona = new Persona(null,null,null,$_POST['dni']);

    $buscarPersona = $persona->buscar();
    $resultadoCantidad = mysqli_num_rows($buscarPersona);
    $arrayPrincipal=array();
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
      $json = json_encode($arrayPrincipal);
    }else{
      $item=['id' => '0',
            ];
      array_push($arrayPrincipal,$item);
      $json = json_encode($arrayPrincipal);
    }
    Maestro::debbugPHP($json);
    echo $json;
  }
  ?>
