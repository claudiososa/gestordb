<?php
  include_once('../escuela.php');
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
          $arrayPrincipal=array();
          $escuela =  new Escuela(null,null,null,$_POST['numeroEscuela']);
          $datoEscuela = $escuela->buscar();
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
