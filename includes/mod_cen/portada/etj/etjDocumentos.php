<!--<script type="text/javascript" src="includes/mod_cen/documentos/panel.js"></script>
<link href="includes/mod_cen/documentos/estilos.css" rel="stylesheet" type="text/css">-->

<?php
include_once("includes/mod_cen/clases/CategoriaDoc.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/Documento.php");

 // obtiene el listado de categorias a la cual tiene permiso el referente Logueado
// $categoria_doc = new CategoriaDoc();
// $carg_origen=$_SESSION["tipo"];
// $resultado = $categoria_doc->buscarCatPermiso($carg_origen);

 $documentos = new Documento();
 $resultadoBuscar = $documentos->buscarxTipoReferente('ETJ','5');
?>
<div class="container-fluid">
<!-- aqui debera estar el while principal para escribir las categorias  -->

<?php
while ($filaResultado = mysqli_fetch_object($resultadoBuscar))
{
  //  $idcateg=$filaResultado->categoriaDocId;
  //  $doc_categ = new Documento();
  //  $resultadoBuscar = $doc_categ->buscarDocPermiso($carg_origen,$idcateg,'5');
  //  while ($filaResultado2 = mysqli_fetch_object($resultadoBuscar) )
  //  {
    ?>
     <div class=alert-info><?php echo $filaResultado2->descripcion;?><br><a href="documentacion/<?php echo $filaResultado2->nombreArchivo;?>" download="<?php echo $filaResultado2->nombreArchivo;?>">
      <button type="button" class="btn btn-default btn-lg"><span class="pull-right glyphicon glyphicon glyphicon-download-alt"></span><font color="darkolivegreen">Descargar&nbsp;</font></button>
      </a></center>
    </div><br>
      <?php
}

?>

</div>  <!-- cierra etiqueta container-fluid -->
