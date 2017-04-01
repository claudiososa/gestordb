<?php
include_once("includes/mod_cen/clases/conexionPdo.php");
include_once("includes/mod_cen/clases/conexion.php");
include_once("includes/mod_cen/clases/vicedirector.php");
//include_once("includes/mod_cen/clases/personas.php");
//include_once("includes/mod_cen/clases/referente.php");




if (isset($_POST['guardar_vicedirector'])) {
  //var_dump($_POST);
  $vicedirector =  new ViceDirector(

                null,
                $_POST["escuelaId"],
                $_POST["personaId"],
                $_POST["turno"],
                $_POST["fechaModif"],
                $_POST["userModif"]

                 );
  
  $guardar = $vicedirector->agregar();
  echo $guardar;
}

include("includes/mod_cen/formularios/f_AltaViceDirector.php");


 ?>