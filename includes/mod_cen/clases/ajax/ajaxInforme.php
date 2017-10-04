<?php
  include_once('../maestro.php');
  include_once('../informe.php');
  include_once('../referente.php');
  //Maestro::debbugPHP($referenteId);
/*  $list=array(
    'cantidad'=>'2',
    'totalMes'=>'33',
    'nombre'=>'juan',
    'apellido'=>'perez'
  );
  $json = json_encode($list);

  echo $json;

*/

  if (isset($_POST['year']) && isset($_POST['month'])){

  	//include_once("includes/mod_cen/clases/maestro.php");
  	$list=array();
  	//$informe = new informe();
  	//Maestro::debbugPHP($informe);
  	$referenteId=$_POST['referenteId'];

  	$referente= new Referente($referenteId);
    Maestro::debbugPHP($referente);

  	$resultado_facilitador_acargo = $referente->Cargo("Activo");


  	while ($fila = mysqli_fetch_object($resultado_facilitador_acargo)) {

  		$informeFacil= new informe(null,null,$fila->referenteId);
      //Maestro::debbugPHP($informeFacil);
  		//$buscar_informe=$informeFacil->buscar();
  		//$cantidad=mysqli_num_rows($buscar_informe);

  		//$buscarMesActualInforme=$informe->summary('mesAñoReferente',null,null,null,$_POST['month'],$_POST['year'],null,$fila->referenteId);
  		//$totalMes=mysqli_num_rows($buscarMesActualInforme);


  		$temporal=array(
  			'cantidad'=>'2',
  			'totalMes'=>'33',
  			'nombre'=>'juan',
  			'apellido'=>'perez'
  		);
  		/*
  		$temporal=array(
  			'cantidad'=>$cantidad,
  			'totalMes'=>$totalMes,
  			'nombre'=>$fila->nombre,
  			'apellido'=>$fila->apellido
  		);


  		array_push($list,$temporal);

  	}


  //	array_push($list,$temporal);
    /*
    $list=array(
      'cantidad'=>'2',
      'totalMes'=>'33',
      'nombre'=>'juan',
      'apellido'=>'perez'
    );

    $json = json_encode($list);

  	echo $json;
  }
  */

  }
  ?>
