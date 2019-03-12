<?php
include_once('../../clases/Carreras.class.php');
include_once('../../clases/maestro.php');

if ($_POST['nombre']) {
    $arrayPrincipal=array();

    $programa = new Carreras(null,$_POST['nombre'],1);          
    $crearPrograma = $programa->agregar();
    if ($crerPrograma <> '0') {
        $arrayResponse= [
            'id' =>$crearPrograma,
            'nombre' => $_POST['nombre']
        ];

    }else{
        $arrayResponse= [
            'id' => 0,
            'nombre' => 'Error al crear'
        ];        
    }
    $json = json_encode($arrayResponse, JSON_UNESCAPED_UNICODE);
    // Maestro::debbugPHP($json);
    echo $json;    
}

if ($_POST['id']) {
    $arrayPrincipal=array();

    $programa = new Carreras($_POST['id']);          
    $buscarPrograma = $programa->buscar(null,null,$_POST['id']);
    $dato = mysqli_fetch_object($buscarPrograma);

    if ($dato > 0) {
        $arrayResponse= [
            'id' =>$dato->id,
            'nombre' => $dato->nombre
        ];

    }else{
        $arrayResponse= [
            'id' => 0,
            'nombre' => 'Error al crear'
        ];        
    }
    $json = json_encode($arrayResponse, JSON_UNESCAPED_UNICODE);
    //Maestro::debbugPHP($json);
    echo $json;    
}

if ($_POST['editarId']) {
    $arrayPrincipal=array();
    $programa = new Carreras($_POST['editarId'],$_POST['editarNombre'],1);          
    $editarPrograma = $programa->editar();    
    
    if ($_POST['editarId'] == $editarPrograma) {
        $arrayResponse= [
            'id' =>$_POST['editarId'],
            'nombre' => $_POST['editarNombre']
        ];

    }else{
        $arrayResponse= [
            'id' => 0,
            'nombre' => 'Error al crear'
        ];        
    }
    $json = json_encode($arrayResponse, JSON_UNESCAPED_UNICODE);
    //Maestro::debbugPHP($editarPrograma);
    echo $json;    
}