<?php
//include_once("includes/mod_cen/clases/Mensajes.php");
include_once("conexion.php");
include_once("referente.php");

	$objReferentes= new Referente();

	//$buscarReferentes=$objReferentes->buscarTipoReferente('ETT');

	$resultado= [];

	/*while($fila = mysqli_fetch_object($buscarReferentes))
		{
			$referente=$fila->referenteId;
			$nombre=$fila->nombre;
			$email=$fila->email;
			$nuevoElemento=array('value'=>ucwords($nombre),'id'=>$referente,'email'=>$email);
			array_push($resultado,$nuevoElemento);
		}*/
		//$resultado= [];
		$json = json_encode($resultado);
		echo $json;
