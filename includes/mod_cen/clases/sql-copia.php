<?php
include_once("conexionv2.php");

$bd=Conexion::getInstance();


$grabardirector="UPDATE escuelas, coordenadas SET escuelas.ubicacion = CONCAT(coordenadas.lat,", ",coordenadas.lng) WHERE escuelas.numero = coordenadas.num";
$resultado=$bd->ejecutar($grabardirector);

