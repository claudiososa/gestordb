<?php

include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/localidades.php");


if(isset($_POST["guardar_escuela"]) AND $_POST["nombre"]<>"" AND $_POST["cue"]<>"" ){

echo" se guardo!!";

}else{

 // include_once("includes/mod_cen/clases/TipoInforme.php");

  //$oTipo= new TipoInforme();
  //$b_referente= $oTipo->buscar();

	$location=new Localidad();
	$resultado= $location->buscar();

  include_once("includes/mod_cen/formularios/f_NuevaEscuela.php");
}
?>








