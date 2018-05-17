<?php
  include_once('../informe.php');
  include_once('../img.php');
  include_once('../referente.php');
  include_once('../respuesta.php');
  include_once('../leido.php');
  include_once('../maestro.php');


  if (isset($_POST['informeAdjunto']))//devuelve la lista de archivos adjuntos
  {
    $img =  new Img(null,$_POST['informeAdjunto']);
    $buscarAdjunto = $img->buscar();
    $list=[];

    while ($row = mysqli_fetch_object($buscarAdjunto)) {
      $temporal = [
        'nombre'=>$row->nombre,
      ];
      array_push($list,$temporal);
    }

    $json = json_encode($list);
  //    Maestro::debbugPHP($json);
    echo $json;
  }


  if (isset($_POST['ajaxLeido']))
  {
    $informe_ett = new informe();
    $informesNoLeidos = $informe_ett->summary('noLeido',null,null,null,null,'2018',null,$_POST['referenteId'],null,$_POST['etj']);
    $totalNoLeidos= mysqli_num_rows($informesNoLeidos);

    $list=array();
    $temporal=array(
      'total'=>$totalNoLeidos
    );

    array_push($list,$temporal);
    $json = json_encode($list);
      //Maestro::debbugPHP($json);
    echo $json;
  }

  if (isset($_POST['informeId']))
  {
    $fecha=date("Y-m-d H:i:s");
    $leido = new Leido(null,$_POST['informeId'],$_POST['referenteId'],$fecha);
    $guardar_leido=$leido->agregar();

    $informe =  new informe($_POST['informeId']);
    $buscarInforme = $informe->buscarUnico();
    //Maestro::debbugPHP($buscarInforme);
    $datoInforme = mysqli_fetch_object($buscarInforme);

    $list=array();
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
    $json = json_encode($list);
      //Maestro::debbugPHP($json);
    echo $json;
  }

  if (isset($_POST['myReport']))
  {
  	$list=array();
    $informe = new informe(null,$_POST['escuelaId']);
    if (isset($_POST['reports'])){
      //if ($_POST['reports']=="conectar") {
        $arrayReferente= ['ETT','ETJ','Coordinador'];
        $buscarInforme= $informe->buscar(null,null,$arrayReferente,null,'ASC');
        //Maestro::debbugPHP($buscarInforme);
      //}
//      $buscarInforme = $informe->buscarInforme();
    }else{
      $buscarInforme = $informe->buscarInforme($_POST['referenteId']);
    }

    //$buscarInforme = $informe->buscarInforme();
    $cantidadInformes=mysqli_num_rows($buscarInforme);
    $respuesta = new Respuesta();
    $leido = new Leido();

    while ($fila = mysqli_fetch_object($buscarInforme))
    {
  		//$buscar_informe=$informe->search($fila->referenteId);
      $respuesta->informeId=$fila->informeId;
      $buscarRespuesta = $respuesta->buscar();
      $cantidadRespuesta = mysqli_num_rows($buscarRespuesta);

      $leido->referenteId=$_POST['referenteId'];
      $leido->informeId=$fila->informeId;
      $buscarLeido = $leido->buscarLeido();
      $cantidadLeido = mysqli_num_rows($buscarLeido);
      //Maestro::debbugPHP($buscarLeido);

  		$temporal=array(
        'informeId'=>$fila->informeId,
        'referenteId'=>$fila->referenteId,
  			'titulo'=>substr($fila->titulo,0,35).'...',
        'escuelaId'=>$fila->escuelaId,
        'cantidad'=>$cantidadInformes,
        'cantidadRespuesta' =>$cantidadRespuesta,
        'cantidadLeido' =>$cantidadLeido,
        'fecha' =>Maestro::formatoFecha($fila->fechaVisita),
        'fechaCarga'=>Maestro::formatoFecha($fila->fechaCarga),
        'prioridad' =>$fila->prioridad

  		);

  		array_push($list,$temporal);
  	}

    $json = json_encode($list);
    //Maestro::debbugPHP($json);
  	echo $json;
  }

  //verifica que venga desde pedido post desde ajax determinado
  if (isset($_POST['year']) && isset($_POST['month']))
  {
  	$list=array();
  	$informe = new informe();

    // busqueda de los referentes a cargo del perfil Coordinador
  	$referenteId=$_POST['referenteId'];
    //Maestro::debbugPHP($referenteId);
  	//$referente= new Referente($referenteId);
    $referente= new Referente();
  	$resultado_facilitador_acargo = $referente->Cargo2("Activo",$referenteId);

    // recorrido por cada referente a cargo
    while ($fila = mysqli_fetch_object($resultado_facilitador_acargo))
    {

  		$buscar_informe=$informe->search($fila->referenteId);
  		$cantidad=mysqli_num_rows($buscar_informe);

  		$cantidadMes=$informe->summary('mesAñoReferente',null,null,null,$_POST['month'],$_POST['year'],null,$fila->referenteId);
      //Maestro::debbugPHP($buscarMesActualInforme);
  		$totalMes=mysqli_num_rows($cantidadMes);

  		$temporal=array(
        'personaId'=>$fila->personaId,
        'referenteId'=>$fila->referenteId,
  			'cantidad'=>$cantidad,
  			'totalMes'=>$totalMes,
  			'nombre'=>$fila->nombre,
  			'apellido'=>$fila->apellido,
        'year'=>$_POST['year'],
        'month'=>$_POST['month']
  		);

  		array_push($list,$temporal);
  	}

    $json = json_encode($list);
//    Maestro::debbugPHP($json);
  	echo $json;
  }
  ?>
