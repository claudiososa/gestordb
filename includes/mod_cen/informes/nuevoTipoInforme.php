<?php
//// inclusión de clase TipoInforme
include_once("includes/mod_cen/clases/TipoInforme.php");
//// inclusión de clase Referente
include_once("includes/mod_cen/clases/referente.php");

include_once("includes/mod_cen/clases/TipoPermisos.php");

$tipoReferente = new Referente();
$buscarTipoReferente = $tipoReferente->tipoReferente();
//$datoTipo = mysqli_fetch_object($buscarTipoReferente);

//// Verifica is se envia por post guardar_categoria y si el nombre tiene algun dato cargado
if(isset($_POST["guardar_categoria"]) AND $_POST["nombre"]<>""){
  var_dump($_POST["tipo"]);
  echo "<br><br>";
  $fecha=date("Y-m-d H:i:s");
  $categoria = new TipoInforme(null,$_POST["nombre"],$_POST["descripcion"],$_POST["estado"],$fecha,$_SESSION["referenteId"]);
  $guardar = $categoria->agregar();
  if ($guardar>0){
    if (is_array($_POST["tipo"])) {
      foreach ($_POST["tipo"] as $value) {
        $permisos = new TipoPermisos(null,$guardar,$value);
        $crearPermiso = $permisos->agregar();
        if($crearPermiso==1){
          echo "Se creo permiso".$value," ".$guardar;
        }
        /*echo "<br>";
        echo "holaaaaaa";
        echo $value;*/
      }
    }
    echo $guardar;
    echo "Se Guardo con Éxito";
  }else{
    echo "Error al guardar";
  }
}else{
  //// inclusión de formulario para Crear Categoria
  include_once("includes/mod_cen/formularios/f_nueva_categoria_informe.php");
}
?>
