<?php
include_once("includes/mod_cen/clases/conexionPdo.php");
include_once("includes/mod_cen/clases/conexion.php");
include_once("includes/mod_cen/clases/vicedirector.php");
include_once("includes/mod_cen/clases/referente.php");




if (isset($_POST['guardar_vicedirector'])) {
  //var_dump($_POST);
  

$fecha=date("Y-m-d");

$userM =  new Referente($_SESSION["referenteId"]);
                    $buscar_dato_ref_esc =  $userM->buscar();
                    $ref_esc = mysqli_fetch_object($buscar_dato_ref_esc);
                    $ref_esc_per= $ref_esc->personaId;


$vicedirector =  new ViceDirector(

                null,
                $_GET["escuelaId"],
                $_POST["personaId"],
                $_POST["turno"],
                $fecha,
                $ref_esc_per);
  
  $guardar = $vicedirector->agregar();
  echo $guardar;
}


include("includes/mod_cen/formularios/f_AltaViceDirector.php");

 
 ?>