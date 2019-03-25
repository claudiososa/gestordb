<?php
  include_once('../persona.php');  
  include_once('../maestro.php');
  include_once('../EscuelaCarrera.class.php');
  include_once('../Carreras.class.php');


  if(isset($_POST['listaCarreras'])){

    $escuelaCarrera = new EscuelaCarrera($_POST['idCarrera']);
    $buscar = $escuelaCarrera->buscar(null,null,'unico');
    $dato = mysqli_fetch_object($buscar);

    $carreras = new Carreras();
  
    $buscarCarrera = $carreras->buscar();
    //Maestro::debbugPHP($buscarEscuelaCarrera);    
    $html = "";
    while( $row =  mysqli_fetch_object($buscarCarrera) ){

      if( $row->id == $dato->carrera_id)
      {
        $html .= "<option value='$row->id' selected>$row->nombre</option>";
      }else{
        $html .= "<option value='$row->id'>$row->nombre</option>";
      }
    }
         
    //$json = json_encode($arrayPrincipal);
    Maestro::debbugPHP($html);
    echo $html;
  }elseif(isset($_POST['estados'])){
    
    $escuelaCarrera = new EscuelaCarrera($_POST['idCarrera']);
    $buscar = $escuelaCarrera->buscar(null,null,'unico');
    $dato = mysqli_fetch_object($buscar);
    //Maestro::debbugPHP($dato);   
    switch ($dato->estado) {
      case 'continua':
        $html = '<option value="continua" selected>Continua</option>
                 <option value="cerrada">Cerrada</option>';
        break;
      
      default:
        $html = '<option value="continua">Continua</option>
                <option value="cerrada" selected>Cerrada</option>';
        break;
    }    
    echo $html;

  }elseif(isset($_POST['fecha'])){
    $escuelaCarrera = new EscuelaCarrera($_POST['idCarrera']);
    $buscar = $escuelaCarrera->buscar(null,null,'unico');
    $row = mysqli_fetch_object($buscar);

    $arrayPrincipal=array();
    $item=array();
        
    $item=[  'id' => $row->id,
             'nombre' => $row->nombre,
             'fecha_inicio'=> $row->fecha_inicio,
             'fecha_final'=> $row->fecha_final,    
             'escuelaId'=>$row->escuelaId
            ];
  
    array_push($arrayPrincipal,$item);
    $json = json_encode($arrayPrincipal);
    Maestro::debbugPHP($arrayPrincipal);
    echo $json;  
  }elseif(isset($_POST['btnSave'])){
    $escuelaCarrera = new EscuelaCarrera($_POST['escuelaCarreraId'],
                                         $_POST['escuelaId'],
                                         $_POST['carreraId'],
                                         $_POST['fechaInicio'],
                                         $_POST['fechaFinal'],
                                         $_POST['estado']);

   $actualizar = $escuelaCarrera->editar(); 

   $arrayPrincipal=array();
   
   $item=array();
         
   $item=[  'action' => 'exitoso'              
             ];
   array_push($arrayPrincipal,$item);
   $json = json_encode($arrayPrincipal);
   //Maestro::debbugPHP($arrayPrincipal);
   echo $json;

  }else {$escuelaCarrera = new EscuelaCarrera(null,$_POST['escuelaId']);
  
  $buscarEscuelaCarrera = $escuelaCarrera->buscar();
  //Maestro::debbugPHP($buscarEscuelaCarrera);
  $arrayPrincipal=array();
  
  while( $row =  mysqli_fetch_object($buscarEscuelaCarrera) ){
    $item=array();
        
    $item=[  'id' => $row->id,
             'nombre' => $row->nombre,
             'fecha_inicio'=> $row->fecha_inicio,
             'fecha_final'=> $row->fecha_final,
             'estado'=> $row->estado,
             'escuelaId'=>$row->escuelaId
            ];
  
    array_push($arrayPrincipal,$item);
  }
       
  $json = json_encode($arrayPrincipal);
  //Maestro::debbugPHP($arrayPrincipal);
  echo $json;
 }
  
      
