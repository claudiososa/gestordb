<?php
$informeC = new informe();

$resultado=$informeC->buscarxCategoria('18');

?>
<div class="container-fluid">
  <div class="alert alert-warning">
    Informes Categoria PNCE
  </div>

<?php
while ($filaResultado = mysqli_fetch_object($resultado))
 {
     ?>

      <div class='alert alert-info'><?php echo "Titulo: <b>".$filaResultado->titulo."</b><br> Fecha Subida:".$filaResultado->fechaCarga;?><br>

     </div><br>
       <?php
 }

?>

</div>  <!-- cierra etiqueta container-fluid -->
