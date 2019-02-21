<?php
$informeC = new informe();
$resultado=$informeC->buscarxCategoria2('27');

?>
<div class="container-fluid">
  <h5 class='alert alert-success' >Informes "Técnico"</h5>
    <ul class='list-group'>
        <?php
        while ($filaResultado = mysqli_fetch_object($resultado))
        {
            ?>

            <?php  

            $parrafo="color:#646161;";
            echo "<li class='list-group-item alert alert-danger'>";
            echo "<p><b><a class='text-info' id='infoconec$filaResultado->informeId' href='#'>".ucwords($filaResultado->titulo)."</a></b></p>";
            echo "<p style='".$parrafo."'><b>Id:  </b>".$filaResultado->informeId."  <b></p>";
            echo "<p style='".$parrafo."' >Fecha Subida:</b>".Maestro::formatoFecha($filaResultado->fechaCarga)."&nbsp<b> SubCategoria:</b> ".$filaResultado->subNombre." &nbsp<br><b>Número:</b>".$filaResultado->numero."&nbsp<b>Escuela:</b>".$filaResultado->escuelaNombre." </p>";
            echo "</li>";
        }
        ?>
    </ul>
</div>  <!-- cierra etiqueta container-fluid -->

<?php
$informeC = new informe();
$resultado=$informeC->buscarxCategoria2('29');

?>
<div class="container-fluid">
  <h5 class='alert alert-success'>Informes "Pedagógico"</h5>
    <ul class='list-group'>
        <?php
        while ($filaResultado = mysqli_fetch_object($resultado))
        {
            ?>

            <?php  

            $parrafo="color:#646161;";
            echo "<li class='list-group-item alert alert-danger' >";
            echo "<p><b><a class='text-info' id='infoconec$filaResultado->informeId' href='#'>".ucwords($filaResultado->titulo)."</a></b></p>";
            echo "<p style='".$parrafo."'><b>Id:  </b>".$filaResultado->informeId."  <b></p><p class='list-group-item-text' style='".$parrafo."' >Fecha Subida:</b>".Maestro::formatoFecha($filaResultado->fechaCarga)."&nbsp<b> SubCategoria:</b> ".$filaResultado->subNombre." &nbsp<br><b>Número:</b>".$filaResultado->numero."&nbsp<b>Escuela:</b>".$filaResultado->escuelaNombre." </p>";
            echo "</li>";
        }
        ?>
    </ul>
</div>  <!-- cierra etiqueta container-fluid -->


<?php
$informeC = new informe();
$resultado=$informeC->buscarxCategoria2('30');

?>
<div class="container-fluid">
  <h5 class='alert alert-success'>Informes "Historia Institucional"</h5>
    <ul class='list-group'>
        <?php
        while ($filaResultado = mysqli_fetch_object($resultado))
        {
            ?>

            <?php  

            $parrafo="color:#646161;";
            echo "<li class='list-group-item alert alert-danger'>";
            echo "<p><b><a class='text-info' id='infoconec$filaResultado->informeId' href='#'>".ucwords($filaResultado->titulo)."</a></b></p>";
            echo "<p style='".$parrafo."'><b>Id:  </b>".$filaResultado->informeId."  <b></p><p class='list-group-item-text' style='".$parrafo."' >Fecha Subida:</b>".Maestro::formatoFecha($filaResultado->fechaCarga)."&nbsp<b> SubCategoria:</b> ".$filaResultado->subNombre." &nbsp<br><b>Número:</b>".$filaResultado->numero."&nbsp<b>Escuela:</b>".$filaResultado->escuelaNombre." </p>";
            echo "</li>";
        }
        ?>
    </ul>
</div>  <!-- cierra etiqueta container-fluid -->
