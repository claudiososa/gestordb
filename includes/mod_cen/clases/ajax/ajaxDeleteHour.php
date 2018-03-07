<?php
  include_once('../CursoFacilitadores.php');
  include_once('../HorarioFacilitadores.php');


  //verifica que venga desde pedido post desde ajax determinado
  if (isset($_POST['id']))
  {
    $curso = new CursoFacilitadores();

    $hora = new HorarioFacilitadores();
    $dato = $hora->buscarId($_POST['id']);


    $buscarCurso = $hora->buscarCursoId($dato['id']);
    //Maestro::debbugPHP($buscarCurso);


//    $curso = new CursoFacilitadores();
    //$cantidadenCurso = $hora->buscarCursoId($dato);

    if ($buscarCurso['cantidad'] == 1) {
      if ($buscarCurso['id'] <> 1) {
        $eliminarCursoId = $curso->borrar($dato['id']);
      }

      $eliminarHora = $hora->borrar($_POST['id']);
      //Maestro::debbugPHP($eliminarCursoId);
    }else{
      $eliminarHora = $hora->borrar($_POST['id']);
    }


    //$curso = ;
    //$new = $curso->agregar();
  	$list=array();
    $list=[
      'dato'=>'si'
    ];
    $json = json_encode($list);
        echo $json;
  }
  ?>
