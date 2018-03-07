<script type="text/javascript" src="includes/mod_cen/informes/js/buscarInformeAutoridad.js"></script>
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/clases/TipoReferentes.php");
include_once("includes/mod_cen/clases/maestro.php");

/*
$categorias = new TipoInforme();
$buscarCat = $categorias->buscarCat();
//$informe = new Informe();

$subcategorias = new SubTipoInforme();
$buscarSubCat = $subcategorias->buscar();


$tipoReferente = new TipoReferentes();
$buscarReferente = $tipoReferente->buscar();
*/

if (isset($_POST['valor'])) {
  # code...

  $tipoReferentes = new TipoReferentes();
  $buscar_ref = $tipoReferentes->buscar();
  $item = array();
  $arrayPrincipal=array();

  //$valueLinea = '7';
while ($fila = mysqli_fetch_object($buscar_ref)) {
  //  $item=array();
  //  $item=[];

  if ($fila->linea == $_POST['valor']) {




    echo $fila->cargoAutoridad;
    $item=[];
array_push($arrayPrincipal,$item);

  }

}
//array_push($arrayPrincipal,$item);
$json = json_encode($arrayPrincipal);
Maestro::debbugPHP($json);

}

include_once("includes/mod_cen/formularios/f_busquedaInforme.php");
?>
