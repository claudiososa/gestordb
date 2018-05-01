<?php
  include_once('../persona.php');
  include_once('../Autoridades.php');
  include_once('../maestro.php');
  include_once('../escuela.php');
  include_once('../EscuelaTipoAutoridad.php');
  include_once('../TipoAutoridades.php');




  //verifica que venga desde pedido post desde ajax determinado


    if (isset($_POST['all'])) {//buscar todas las autoridades de una escuela

      $escuela = new Escuela($_POST['escuelaId']);
      $buscarEscuela = $escuela->buscarUnico();
      //Maestro::debbugPHP($buscarEscuela);
      //Maestro::debbugPHP($_POST['escuelaId']);

      $tipoAuto = new EscuelaTipoAutoridad(null,$buscarEscuela->nivel);
      $posibleAutoridades = $tipoAuto->buscar();
      $cant = mysqli_num_rows($posibleAutoridades);
      //Maestro::debbugPHP($cant);
      /**
       * recorre por todas las autoridades posibles para este tipo de escuela segun le nivel
       */
      $arrayPrincipal=array();
      while ($fila = mysqli_fetch_object($posibleAutoridades))
      {
        $item=array();
        $autoridad =  new Autoridades(null,$_POST['escuelaId'],$fila->tipoAutoridad);
        $existeAutoridad = $autoridad->buscarAutoridad3($fila->tipoAutoridad);

        $cantidad = mysqli_num_rows($existeAutoridad);
        //Maestro::debbugPHP($existeAutoridad);
        if ($cantidad > 0) {//mayor a cero significa que esta escuela ya tenia autoridad registrada para este tipo de autoridad

          while ($row = mysqli_fetch_object($existeAutoridad))
          {
            //Maestro::debbugPHP($row);
            $item=['id' => $row->personaId,
                   'nombre' => $row->nombre,
                   'apellido' => $row->apellido,
                   'dni' => $row->dni,
                   'cuil' => $row->cuil,
                   'telefono' => $row->telefonoM,
                   'email' => $row->email,
                   'localidad' => $row->localidadId,
                   'cargo'=>$row->cargoAutoridad,
                   'escuelaId'=>$_POST['escuelaId'],
                   'cantidad'=>$cantidad,
                   'idCargo'=>$row->tipoId
                 ];
            array_push($arrayPrincipal,$item);
          }
        }else{
          $tipo =  new TipoAutoridades($fila->tipoAutoridad);
          $buscarTipo = $tipo->buscar();
          $datoTipo = mysqli_fetch_object($buscarTipo);

          $item=['id' => '0',
                 'nombre' => 'Sin Asignar',
                 'cargo'=>$datoTipo->cargoAutoridad,
                 'escuelaId'=>$_POST['escuelaId'],
                 'idCargo'=>$datoTipo->tipoId
                ];
          array_push($arrayPrincipal,$item);

        }

      }

      $json = json_encode($arrayPrincipal);
      Maestro::debbugPHP($json);
      echo $json;
      }


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


      if ($existeAutoridad > 0) {//mayor a cero significa que esta escuela ya tenia autoridad registrada
        $autoridad->autoridadesId = $existeAutoridad;

        $autoridad2 = new Autoridades($existeAutoridad,$escuelaId,$tipoId,$personaId);

        $editarAutoridad = $autoridad2->editar();

      }else{
        $agregarAutoridad = $autoridad->agregar();
      }


       # code...
      $item=['status' => 'update'
            ];
    }else{
      $dato ='hola';

      $persona = new Persona(null,$_POST['apellido'],$_POST['nombre'],$_POST['txtdni'],$_POST['cuil'],null,$_POST['telefonoM'],
                             null,$_POST['email'],null,null,null,$_POST['localidad']);

      $modificarPersona = $persona->addShort();  # code...



      $escuelaId = $_POST['escuelaId'];
      $personaId = $modificarPersona;
      $tipoId = $_POST['tipoId'];

      $autoridad =  new Autoridades(null, $escuelaId, $tipoId, $personaId);
      $existeAutoridad = $autoridad->buscarAutoridad2();


      if ($existeAutoridad > 0) {//mayor a cero significa que esta escuela ya tenia autoridad registrada
        $autoridad->autoridadesId = $existeAutoridad;

        $autoridad2 = new Autoridades($existeAutoridad,$escuelaId,$tipoId,$personaId);

        $editarAutoridad = $autoridad2->editar();

      }else{
        $autoridad = new Autoridades(null,$escuelaId,$tipoId,$personaId);
        $agregarAutoridad = $autoridad->agregar();
      }
      $item=['status' => 'new'
            ];
    }

    array_push($arrayPrincipal,$item);
    $json = json_encode($arrayPrincipal);

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

    echo $json;
  }
  ?>
