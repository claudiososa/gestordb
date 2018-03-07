<?php
include_once("includes/mod_cen/clases/conexionPdo.php");
include_once("includes/mod_cen/clases/conexion.php");
include_once("includes/mod_cen/clases/persona.php");

if (isset($_POST['guardar_persona'])) {
  var_dump($_POST);
  $persona =  new Persona(
                null,
                $_POST["apellido"],
                $_POST["nombre"],
                $_POST["dni"],
                $_POST["cuil"],
                $_POST["telefonoC"],
                $_POST["telefonoM"],
                $_POST["direccion"],
                $_POST["email"],
                $_POST["email2"],
                $_POST["facebook"],
                $_POST["twitter"],
                $_POST["localidadId"],
                $_POST["cpostal"],
                $_POST["ubicacion"]
  );
  $guardar = $persona->agregar();
  echo $guardar;
}

include("includes/mod_cen/formularios/f_AltaPersona.php");


 ?>
