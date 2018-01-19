<?php
  include_once('../persona.php');
  include_once('../Autoridades.php');
  include_once('../maestro.php');


  //verifica que venga desde pedido post desde ajax determinado
    //Maestro::debbugPHP($_POST['dni']);

  if (isset($_POST['btnSave'])) {//si accede a este archivo desde el boton guardar pantalla autoridad de la escuela
    $arrayPrincipal=array();
    if ($_POST['update']=='1') {
      $persona = new Persona($_POST['personaId'],$_POST['apellido'],$_POST['nombre'],null,$_POST['cuil'],null,$_POST['telefonoM'],
                             null,$_POST['email'],null,null,null,$_POST['localidad']);
      $modificarPersona = $persona->updateShort();

      $escuelaId = $_POST['escuelaId'];
      $personaId = $modificarPersona;
      $tipoId = $_POST['tipoId'];

      $autoridad =  new Autoridades(null, $escuelaId, $tipoId, $personaId);
      $existeAutoridad = $autoridad->buscarAutoridad2();
      Maestro::debbugPHP($existeAutoridad);

      if ($existeAutoridad > 0) {
        $autoridad->autoridadesId = $existeAutoridad;

        $agregarAutoridad = $autoridad->editar();
        Maestro::debbugPHP($agregarAutoridad);
      }else{
        $agregarAutoridad = $autoridad->agregar();
      }


       # code...
      $item=['status' => 'update'
            ];
    }else{
      //Maestro::debbugPHP($_POST['update']);
      $persona = new Persona($_POST['personaId'],$_POST['apellido'],$_POST['nombre'],$_POST['txtdni'],$_POST['cuil'],null,$_POST['telefonoM'],
                             null,$_POST['email'],null,null,null,$_POST['localidad']);
      $modificarPersona = $persona->addShort();  # code...
      $item=['status' => 'new'
            ];
    }

    array_push($arrayPrincipal,$item);
    $json = json_encode($arrayPrincipal);
    //Maestro::debbugPHP($json);
    echo $json;

  }


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
