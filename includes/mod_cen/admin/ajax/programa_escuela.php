<?php
include_once('../../clases/Programa_escuela.php');
include_once('../../clases/escuela.php');
include_once('../../clases/maestro.php');

if ($_POST['numero']) {
    
    $arrayPrincipal=array();
    $escuela = new Escuela(null,null,null,$_POST['numero']);      
    $buscarEscuela = $escuela->buscarProgramas($_POST['programa_id']);    
    //Maestro::debbugPHP($buscarEscuela);
    if ($buscarEscuela=='0') {
        $item= [
            'id' => 0,
            'nombre' => 'Error al crear'
        ];        
        array_push($arrayPrincipal,$item);
    }else{
        while ($row = mysqli_fetch_object($buscarEscuela)) {
            $item=array();

            // if($row->programa_id == null)
            // {
                $item= [
                    'id' =>$row->escuelaId,
                    'nombre' => substr($row->nombre,0,65).'...',
                    'numero' => $row->numero,
                    'cue' => $row->cue,
                    'estado' => $row->estado,
                    'programa_id' => $row->programa_id
                ];
                array_push($arrayPrincipal,$item);
            // }elseif ($row->programa_id<>$_POST['programa_id'] ) 
            
            // {
            //     $item= [
            //         'id' =>$row->escuelaId,
            //         'nombre' => substr($row->nombre,0,65).'...',
            //         'numero' => $row->numero,
            //         'cue' => $row->cue,
            //         'estado' => $row->estado,
            //         'programa_id' => $row->programa_id
            //     ];
            //     array_push($arrayPrincipal,$item);
            // }
               
               //else{
            //     $item= [
            //         'id' =>$row->escuelaId,
            //         'nombre' => substr($row->nombre,0,65).'...',
            //         'numero' => $row->numero,
            //         'cue' => $row->cue,
            //         'estado' => '2',
            //         'programa_id' => $row->programa_id
            //     ];
            //     array_push($arrayPrincipal,$item);
            // }
        }
    }
    
    
    
    $json = json_encode($arrayPrincipal, JSON_UNESCAPED_UNICODE);
//    Maestro::debbugPHP($json);
    echo $json;    
}

if ($_POST['id']) {    

    $programa_escuela = new Programa_escuela(null,$_POST['id'],$_POST['idPrograma'],1);      
    $escuela = new Escuela($_POST['id']);
    $buscarEscuela = $escuela->buscar();

    $datoEscuela = mysqli_fetch_object($buscarEscuela);

    $agregarEscuela = $programa_escuela->agregar();

    $item = [
           'id' =>$agregarEscuela,
           'numero' =>$datoEscuela->numero,
           'cue' =>$datoEscuela->cue,
           'nombre' =>substr($datoEscuela->nombre,0,25)
           ];
    
    $json = json_encode($item, JSON_UNESCAPED_UNICODE);
    
    echo $json;    
}

