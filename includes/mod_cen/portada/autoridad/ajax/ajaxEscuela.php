<?php
  include_once('../../../clases/escuela.php');
  include_once('../../../clases/localidades.php');
  // include_once('../../../clases/departamentos.php');
  include_once('../../../clases/CompartePredio.php');
  include_once('../../../clases/maestro.php');

//devolver cantidad de escuelas de acuerdo de nivel
//*****************************************************
if (isset($_POST['localidadId'])) {
    $arrayPrincipal=array();
    if ($_POST['localidadId']=='todos') {
        $escuela =  new Escuela();
    }else{
        $escuela =  new Escuela(null,null,null,null,null,null,null,$_POST['localidadId']);
    }
    

    $niveles = ['Primaria Común','Primaria Especial','Secundaria Común','Secundaria Técnica','Secundaria Rural','ISFD','BSPA'];
    $item=array();

    foreach ($niveles as $value) {
        if ($_POST['localidadId']=='todos') {
            $totalNivel = $escuela->buscarNivel($value,'todos');  
        }else{
            $totalNivel = $escuela->buscarNivel($value);  
        }
        
        $item=['descripcion' => $value,
           'total' => $totalNivel           
         ];
        
        array_push($arrayPrincipal,$item);
    }   

    $json = json_encode($arrayPrincipal);
    echo $json;
  }

  //devolver el total de escuelas x nivel de un departamento completo
//**************************************************************************
if (isset($_POST['departamento'])) {
    $arrayPrincipal=array();

    $localidad = new Localidad(null,null,$_POST['departamento']);
    $buscarLocalidad = $localidad->buscar();

    $niveles = ['Primaria Común','Primaria Especial','Secundaria Común','Secundaria Técnica','Secundaria Rural','ISFD','BSPA'];
    $nivelesTotal = ['Primaria Común' => 0,
                     'Primaria Especial' => 0,
                     'Secundaria Común' => 0,
                     'Secundaria Técnica' => 0,
                     'Secundaria Rural' => 0,
                     'ISFD' => 0,
                     'BSPA' => 0
                    ];
    $item=array();

    while ($fila = mysqli_fetch_object($buscarLocalidad)) {       
        $escuela =  new Escuela(null,null,null,null,null,null,null,$fila->localidadId);
        foreach ($niveles as $value) {
            $totalNivel = $escuela->buscarNivel($value);
            $nivelesTotal[$value] = $nivelesTotal[$value]+$totalNivel;

            // $item = [                
            //     'descripcion' => $value,
            //     'total' => $totalNivel           
            //     ];
                
        }
        
    }
    array_push($arrayPrincipal,$nivelesTotal);        
    $json = json_encode($arrayPrincipal, JSON_UNESCAPED_UNICODE);
    
    echo $json;
  }

  //devolver listado de escuelas de acuerdo de nivel
//*****************************************************

  if (isset($_POST['nivel'])) {

    $arrayPrincipal=array();    

    if (isset($_POST['nDepartamento'])) {
      if ($_POST['localidad']=='todos') {
        $localidades = new Localidad(null,null,$_POST['nDepartamento']);
        $buscarLocalidades = $localidades->buscar();
        $arrayLocalidades = array();

        while ($row = mysqli_fetch_object($buscarLocalidades)) {
          array_push($arrayLocalidades,$row->localidadId);
        }
        $escuela =  new Escuela(null,null,null,null,null,null,$_POST['nivel']);
        
        $listaEscuela = $escuela->buscarAjax($arrayLocalidades);
        // Maestro::debbugPHP($listaEscuela);
      }else{
        $escuela =  new Escuela(null,null,null,null,null,null,$_POST['nivel'],$_POST['localidad']);
        $listaEscuela = $escuela->buscarAjax();
      }      
    }    

    
    
    $item=array();

    while ($row = mysqli_fetch_object($listaEscuela)) {
        $item = [
                'escuelaId' => $row->escuelaId,
                'cue' => $row->cue,
                'numero' => $row->numero,
                'nombre' => $row->nombre
                ];
     
     array_push($arrayPrincipal,$item);
    }

    $json = json_encode($arrayPrincipal);
    //Maestro::debbugPHP($json);
    echo $json;
  }



//buscar datos de escuela de acuerdo a un escuelaId especifico
//*****************************************************
  if (isset($_POST['id'])) {
      $arrayPrincipal=array();
      $escuela =  new Escuela($_POST['id']);
      $datoEscuela = $escuela->buscarUnico();
      $item=array();
          $item=['escuelaId' => $datoEscuela->escuelaId,
                 'nombre' => $datoEscuela->nombre,
                 'cue' => $datoEscuela->cue,
                 'numero' => $datoEscuela->numero
               ];

      array_push($arrayPrincipal,$item);       
      $json = json_encode($arrayPrincipal);
      echo $json;
    }


    //buscar datos de escuela de acuerdo a numero enviado
    //*****************************************************
      if (isset($_POST['numeroEscuela'])) {
        $arrayPredios=array();
        $predio = new CompartePredio(null,$_POST['escuelaId']);
        //busca el escuelaId de la escuela Seleccionada para agregar al predio
        $buscar = $predio->buscarPredio('count');

        if ($buscar > 0) {//sino encuentra  el escuelaId en tabla Predio,
          $datoPredio = mysqli_fetch_object($predio->buscarPredio());
          $predio->escuelaId='';
          $predio->predio = $datoPredio->predio;
          $buscarPredios =$predio->buscar();

          while ($row = mysqli_fetch_object($buscarPredios)) {
            if ($row->escuelaId <> $_POST['escuelaId']) {
              array_push($arrayPredios,$row->escuelaId);
            }

          }
          //$buscarPredios = mysqli_fetch_object($predio->buscar());

        }

          $arrayPrincipal=array();
          $escuela =  new Escuela($_POST['escuelaId'],null,null,$_POST['numeroEscuela']);
          $datoEscuela = $escuela->buscar2(null,$arrayPredios);
          //Maestro::debbugPHP($arrayPredios);
          //Maestro::debbugPHP($datoEscuela);
          while ($fila = mysqli_fetch_object($datoEscuela)) {
            $item=array();

                $item=['escuelaId' => $fila->escuelaId,
                       'nombre' => $fila->nombre,
                       'domicilio' => $fila->domicilio,
                       'cue' => $fila->cue,
                       'numero' => $fila->numero
                     ];
            array_push($arrayPrincipal,$item);
          }
          $json = json_encode($arrayPrincipal);
          echo $json;
        }
