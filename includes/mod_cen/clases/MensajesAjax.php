<?php
include_once('conexion.php');
include_once("referente.php");

	$objReferentes=new Referente(null,null,null,null,null,null,null,'Activo');
	//$objReferentes=new Referente();
	//$objReferentes->estado='Activo';

	$buscarReferentes=$objReferentes->buscar($_GET['term']);

	$resultado= [];

	while($fila = mysqli_fetch_object($buscarReferentes))
		{
			$referente=$fila->referenteId;
			$nombre=$fila->nombre;
			$email=$fila->email;
			$nuevoElemento=array('value'=>ucwords($nombre),'id'=>$referente,'email'=>$email);
			array_push($resultado,$nuevoElemento);
		}
		$json = json_encode($resultado);
		echo $json;
