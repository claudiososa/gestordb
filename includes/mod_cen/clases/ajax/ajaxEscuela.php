<?php
  include_once('../escuela.php');
  include_once('../CompartePredio.php');
  include_once('../maestro.php');


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
        //$json = json_encode($arrayPrincipal);
      //  Maestro::debbugPHP($arrayPrincipal);

      //  array_push($arrayPrincipal,$item);
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
          Maestro::debbugPHP($datoEscuela);
          while ($fila = mysqli_fetch_object($datoEscuela)) {
            $item=array();

                $item=['escuelaId' => $fila->escuelaId,
                       'nombre' => $fila->nombre,
                       'cue' => $fila->cue,
                       'numero' => $fila->numero
                     ];
            array_push($arrayPrincipal,$item);
          }
          $json = json_encode($arrayPrincipal);
          echo $json;
        }
