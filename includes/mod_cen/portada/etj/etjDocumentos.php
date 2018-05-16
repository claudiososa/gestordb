<?php
include_once("includes/mod_cen/clases/CategoriaDoc.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/Documento.php");
include_once("includes/mod_cen/clases/maestro.php");

$documentos = new Documento();
$resultadoBuscar = $documentos->buscarxTipoReferente('ETJ','5');
?>
<div class="container-fluid">
  <div class="alert alert-warning">
    Ultimos 5 archivos subidos
  </div>

<?php
while ($filaResultado = mysqli_fetch_object($resultadoBuscar))
{
    ?>

     <div class='alert alert-info'><?php echo "Archivo: <b>".$filaResultado->nombreArchivo."</b><br> Fecha Subida: <b>".
      Maestro::formatoFecha($filaResultado->fechaSubida)."</b><br> Descripcion: ".$filaResultado->descripcion;?><br><a href="documentacion/<?php echo $filaResultado->nombreArchivo;?>" download="<?php echo $filaResultado2->nombreArchivo;?>">
      <button type="button" class="btn btn-default btn-lg"><span class="pull-right glyphicon glyphicon glyphicon-download-alt"></span><font color="darkolivegreen">Descargar&nbsp;</font></button>
      </a></center>
    </div><br>
      <?php
}

?>

</div>  <!-- cierra etiqueta container-fluid -->
