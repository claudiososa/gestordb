<?php
//// inclusión de clase TipoInforme
include_once("includes/mod_cen/clases/TipoInforme.php");
//// inclusión de clase Referente
include_once("includes/mod_cen/clases/referente.php");

include_once("includes/mod_cen/clases/TipoPermisos.php");

$tipoReferente = new Referente();
$buscarTipoReferente = $tipoReferente->tipoReferente();

if(isset($_POST["buscarCategoria"]) && $_POST["nombre"]<>""){

  $categoria = new TipoInforme(null,$_POST["nombre"]);
  $buscar_categoria = $categoria->buscar();
  $dato_categoria = mysqli_fetch_object($buscar_categoria);
  //$cantidad_encontrado = mysql_num_rows($buscar_categoria);
  //if($cantidad_encontrado > 0){
    while ($fila = mysql_fetch_object($dato_categoria)) {
      echo $fila->nombre."<br>";
    }
//  }
  echo "buscando...";
}else{
  //// inclusión de formulario para Buscar Categoria
  include_once("includes/mod_cen/formularios/f_buscar_editar_categoria_informe.php");
}
