<?php
  include_once('../persona.php');  
  include_once('../maestro.php');
  


        $arrayPrincipal=array();
      
        $item=array();
        
        $item=[  'id' => '1',
                 'nombre' => 'Maestro Primaria',
                 'fecha_inicio'=>date(Y-m-d),
                 'fecha_final'=>date(Y-m-d),
                 'estado'=>'continua',
                 'escuelaId'=>'0232'
                ];
      
      array_push($arrayPrincipal,$item);

      $json = json_encode($arrayPrincipal);
      
      echo $json;
      
