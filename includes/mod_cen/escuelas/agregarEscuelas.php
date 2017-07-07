<?php

include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/localidades.php");


if(isset($_POST["guardar_escuela"]) AND $_POST["nombre"]<>"" AND $_POST["cue"]<>"" ){



$nuevaEscuela = new Escuela(null,
													'0001',
													$_POST["cue"],
													$_POST["numero"],
													$_POST["nombre"],
													$_POST["domicilio"],
													$_POST["nivel"],
													$_POST["localidadId"],
													null,
													$_POST["telefono"],
													null);


$nuevo= $nuevaEscuela->agregar();

var_dump($nuevaEscuela);

if ($nuevo == 1) {

	echo "Se agrego con Exito la Escuela";
	# code...
}else{

echo " Error al Guardar: ".$nuevo;

}



}else{

 // include_once("includes/mod_cen/clases/TipoInforme.php");

  //$oTipo= new TipoInforme();
  //$b_referente= $oTipo->buscar();

	$location=new Localidad();
	$resultado= $location->buscar();

  include_once("includes/mod_cen/formularios/f_NuevaEscuela.php");
}
?>
