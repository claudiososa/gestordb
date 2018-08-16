<?php
  include_once('../informe.php');
  include_once('../img.php');
  include_once('../referente.php');
  include_once('../respuesta.php');
  include_once('../leido.php');
  include_once('../maestro.php');


  if (isset($_POST['buscarInforme']))//devuelve la lista de archivos adjuntos
  {
    $informe =  new informe();
    $informe->titulo=$_POST['titulo'];
    if ($_POST['categoria']<>"0") {
      $informe->nuevoTipo=$_POST['categoria'];
    }
    if ($_POST['subcategoria']<>"0") {
      $informe->subTipo=$_POST['subcategoria'];
    }

    if ($_POST['numero']<>'') {
    $buscarInforme = $informe->buscar(null,null,null,null,null,$_POST['numero']);
  }else {
    $buscarInforme = $informe->buscar();
  }


    //Maestro::debbugPHP($buscarInforme);
    $list=array();
    while ($datoInforme = mysqli_fetch_object($buscarInforme)) {

      $temporal=array(
        'informeId2'=>$datoInforme->informeId,
        'escuelaId'=>$datoInforme->escuelaId,
        'numero'=>$datoInforme->numero,
        'cue'=>$datoInforme->cue,
        'nombre'=>$datoInforme->nombre,
        'categoria'=>$datoInforme->tipoNombre,
        'subcategoria'=>$datoInforme->subNombre,
        'fecha' =>$datoInforme->fechaVisita,
        'prioridad' =>$datoInforme->prioridad,
        'titulo' =>$datoInforme->titulo,
        'contenido' =>$datoInforme->contenido,
        'referente' =>$datoInforme->referenteId
      );

      array_push($list,$temporal);
    }

    $json = json_encode($list);
      //Maestro::debbugPHP($json);
    echo $json;
  }
