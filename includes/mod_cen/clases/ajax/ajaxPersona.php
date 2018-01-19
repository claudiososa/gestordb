<?php
  include_once('../persona.php');
  include_once('../Autoridades.php');
  include_once('../maestro.php');


  //verifica que venga desde pedido post desde ajax determinado
    //Maestro::debbugPHP($_POST['dni']);

  if (isset($_POST['search'])) {
    $autoridad =  new Autoridades(null,$_POST['escuelaId'],$_POST['tipoId']);
    $existeAutoridad = $autoridad->buscarAutoridad3();
    $arrayPrincipal=array();
    if ($existeAutoridad > 0) {//mayor a cero significa que esta escuela ya tenia autoridad registrada
      $persona = new Persona($existeAutoridad);

      $buscarPersona = $persona->buscar();
      $datoPersona = mysqli_fetch_object($buscarPersona);
      $item=array();

      $item=['id' => $datoPersona->personaId,
             'nombre' => $datoPersona->nombre,
             'apellido' => $datoPersona->apellido,
             'dni' => $datoPersona->dni,
             'cuil' => $datoPersona->cuil,
             'telefono' => $datoPersona->telefonoM,
             'email' => $datoPersona->email,
             'localidad' => $datoPersona->localidadId,
           ];
      array_push($arrayPrincipal,$item);
      $json = json_encode($arrayPrincipal);
      Maestro::debbugPHP($json);
    }else{
      $item=['id' => '0',
            ];
      array_push($arrayPrincipal,$item);
      $json = json_encode($arrayPrincipal);
    }
    echo $json;

  }



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

      if ($existeAutoridad > 0) {//mayor a cero significa que esta escuela ya tenia autoridad registrada
        $autoridad->autoridadesId = $existeAutoridad;

        $autoridad2 = new Autoridades($existeAutoridad,$escuelaId,$tipoId,$personaId);

        $editarAutoridad = $autoridad2->editar();
        Maestro::debbugPHP($editarAutoridad);
      }else{
        $agregarAutoridad = $autoridad->agregar();
      }


       # code...
      $item=['status' => 'update'
            ];
    }else{
      $dato ='hola';
      Maestro::debbugPHP($dato);
      //Maestro::debbugPHP($_POST['update']);

      $persona = new Persona(null,$_POST['apellido'],$_POST['nombre'],$_POST['txtdni'],$_POST['cuil'],null,$_POST['telefonoM'],
                             null,$_POST['email'],null,null,null,$_POST['localidad']);
      //Maestro::debbugPHP($persona);
      $modificarPersona = $persona->addShort();  # code...
      Maestro::debbugPHP($modificarPersona);


      $escuelaId = $_POST['escuelaId'];
      $personaId = $modificarPersona;
      $tipoId = $_POST['tipoId'];

      $autoridad =  new Autoridades(null, $escuelaId, $tipoId, $personaId);
      $existeAutoridad = $autoridad->buscarAutoridad2();
      //Maestro::debbugPHP($existeAutoridad);

      if ($existeAutoridad > 0) {//mayor a cero significa que esta escuela ya tenia autoridad registrada
        $autoridad->autoridadesId = $existeAutoridad;

        $autoridad2 = new Autoridades($existeAutoridad,$escuelaId,$tipoId,$personaId);

        $editarAutoridad = $autoridad2->editar();
        //Maestro::debbugPHP($editarAutoridad);
      }else{
        $autoridad = new Autoridades(null,$escuelaId,$tipoId,$personaId);
        $agregarAutoridad = $autoridad->agregar();
      }
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
