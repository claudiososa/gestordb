<?php

include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/PermisoCategoriaDoc.php");
include_once("includes/mod_cen/clases/CategoriaDoc.php");



$tipoReferente = new Referente();
$buscarTipoReferente = $tipoReferente->tipoReferente();


//// Verifica si se envia por post guardar_categoria_doc y si el nombre tiene algun dato cargado
if(isset($_POST["guardar_categoria_doc"]) AND $_POST["nombre"]<>""){
  var_dump($_POST["tipo"]);
  echo "<br><br>";
  //$fecha=date("Y-m-d H:i:s");
  $categoria_doc = new CategoriaDoc(null,$_POST["nombre"],$_POST["descripcion"]);
  $guardar = $categoria_doc->agregar();
  if ($guardar>0){
    if (is_array($_POST["tipo"])) {
      foreach ($_POST["tipo"] as $value) {
        $permiso_cate_doc = new PermisoCategoriaDoc(null,$guardar,$value);
        $crearPermiso = $permiso_cate_doc->agregar();
        if($crearPermiso==1){
          echo "Se creo permiso".$value," ".$guardar;
        }
        
      }
    }
    echo $guardar;
    echo "Se Guardo con Éxito";
  }else{
    echo "Error al guardar";
  }
}else{
  //// inclusión de formulario para Crear CategoriaDoc

  include_once("includes/mod_cen/formularios/f_nueva_categoria_doc.php");


  // pruebas 
  /*

 $permisos = new PermisoCategoriaDoc(NULL,NULL,$_SESSION["tipo"]);
  $buscarPermisos = $permisos->buscar();
  include_once("includes/mod_cen/formularios/f_documento.php"); 
  
   ver el buscar del metodo permisos!!!

  */
}



?>
