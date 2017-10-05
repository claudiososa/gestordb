<?php
  include_once('../informe.php');
  include_once('../referente.php');

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
