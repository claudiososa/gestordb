<?php
include_once('../../../clases/DocumentoEscuelaCategoria.php');
include_once('../../../clases/DocumentoEscuelaPermiso.php');
include_once('../../../clases/maestro.php');

if ($_POST['nombre']) {
    

    $arrayPrincipal=array();

    $categoria = new DocumentoEscuelaCategoria(null,$_POST['nombre']);          
    $crearCategoria = $categoria->agregar();
    
    //creando permisos de tipo de referente para la categoria agregada
    $arrayTipoReferente=['32','33'];

    $permiso = new DocumentoEscuelaPermiso(null,$crearCategoria);

    foreach ($arrayTipoReferente as $value) {
        $permiso->id_tipoReferentes = $value;
        $agregarPermiso = $permiso->agregar();
    }
    //...........................................


    if ($crerCategoria <> '0') {
        $arrayResponse= [
            'id' =>$crearCategoria,
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

    $categoria = new DocumentoEscuelaCategoria($_POST['id']);          
    $buscarCategoria = $categoria->buscar(null,null,$_POST['id']);
    
    $dato = mysqli_fetch_object($buscarCategoria);

    //Maestro::debbugPHP($dato);
    if ($dato > 0) {
        $arrayResponse= [
            'id' =>$dato->id,
            'nombre' => $dato->description
        ];

    }else{
        $arrayResponse= [
            'id' => 0,
            'nombre' => 'Error al crear'
        ];        
    }
    $json = json_encode($arrayResponse, JSON_UNESCAPED_UNICODE);
    
    echo $json;    
}

if ($_POST['editarId']) {
    $arrayPrincipal=array();
    $categoria = new DocumentoEscuelaCategoria($_POST['editarId'],$_POST['editarNombre'],1);          
    $editarCategoria = $categoria->editar();    
    
    if ($_POST['editarId'] == $editarCategoria) {
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