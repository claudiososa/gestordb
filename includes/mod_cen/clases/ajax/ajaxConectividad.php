<?php
  include_once('../escuela.php');  
  include_once('../Conectividad.class.php');  
  include_once('../maestro.php');
  
  if(isset($_POST['escuela_id'])){

    $escuela = new Escuela($_POST['escuela_id']);
    $buscar_escuela = $escuela->buscar();
    
    $dato = mysqli_fetch_object($buscar_escuela);

    $arrayPrincipal=array();
    $item=array();
        
    $item=[  'escuela_id' => $dato->escuelaId,
             'conectividad' => $dato->conectividad,
             'rti'=> $dato->rti,
             'pc_escritorio'=> $dato->pc_escritorio
            ];
  
    array_push($arrayPrincipal,$item);
    $json = json_encode($arrayPrincipal);
    //Maestro::debbugPHP($arrayPrincipal);
    echo $json;  
  }

  if(isset($_POST['escuela_id_conectividad'])){

    $conectividad = new Conectividad(null,$_POST['escuela_id_conectividad']);
    $buscar_conectividad = $conectividad->buscar();

    //Maestro::debbugPHP($buscar_conectividad);

    $arrayPrincipal=array();

    while ($row = mysqli_fetch_object($buscar_conectividad)) {
      $item=array();
        
      $item=['conectividad_servicio_id' => $row->conectividad_servicio_id,             
             ];
    
      array_push($arrayPrincipal,$item);
    }
    
    $json = json_encode($arrayPrincipal);
    //Maestro::debbugPHP($arrayPrincipal);
    echo $json;  
  }