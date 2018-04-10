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
