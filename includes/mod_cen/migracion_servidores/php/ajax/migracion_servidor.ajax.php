<?php
  include_once('../../../clases/MigracionServidores.class.php');    
  include_once('../../../clases/maestro.php');
  //Maestro::debbugPHP($_POST);    
//agregar nueva registracion de migracion
//en el caso que exista solo se edita los datos, fechas, observaciones y referente
//*****************************************************
  if (isset($_POST['ajaxGuardarMigracion'])) {

    $migra = new MigracionServidores(null,$_POST['escuelaId']);

    $buscarMigra = $migra->buscar('cantidad');   
    $evento = '';

    $migracion = new MigracionServidores (null,
                                          $_POST['escuelaId'],
                                          $_POST['dateMigracion'],
                                          $_POST['referenteId'],
                                          $_POST['observaciones']);

    if($buscarMigra > 0){//si la registracion ya fue creada anteriormente
        $buscarMigra = $migra->buscar('unico');

        $migracion->id = $buscarMigra->id;

        $accion = $migracion->editar();

        $evento = 'Modificado correctamente';
       
    }else {// si los datos corresponden a una registracion nueva
        $accion = $migracion->agregar();
        $evento = 'Guardado correctamente';
    }
    
    $arrayPrincipal=array();
    
    $item=array();
      $item=['aviso' => $evento                 
               ];
      
    array_push($arrayPrincipal,$item);
        //Maestro::debbugPHP($arrayPrincipal);    
    $json = json_encode($arrayPrincipal);
    echo $json;

    }else if (isset($_POST['ajaxConsulta'])){
      $migra = new MigracionServidores(null,$_POST['escuelaId']);

      $buscarMigra = $migra->buscar('cantidad');   

      $evento = '';

    if($buscarMigra > 0){//si la registracion ya fue creada anteriormente
        $buscarMigra = $migra->buscar('unico');

        $arrayPrincipal=array();
    
        $item=array();
          $item=['dateMigracion' => $buscarMigra->fecha_registracion,
                  'observaciones' => $buscarMigra->observaciones
                   ];
          
        array_push($arrayPrincipal,$item);
            //Maestro::debbugPHP($arrayPrincipal);    
        $json = json_encode($arrayPrincipal);
        echo $json;

        $evento = 'Modificado correctamente';
       
    } 
  }    