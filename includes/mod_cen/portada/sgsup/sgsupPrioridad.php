<?php
$informeC = new informe();
$resultado=$informeC->buscarxPrioridad('Alta',$_SESSION['referenteId']);

?>
<div class="container-fluid">
  <!-- <div class="alert alert-warning">
    Informes de Prioridad Alta
  </div> -->
  <h3 align="center">Informes Prioridad Alta</h3>
    <div class='list-group'>
<?php
while ($filaResultado = mysqli_fetch_object($buscar_alta))
 {
     ?>

    <?php
      //echo "<div class='list-group'>";

$parrafo="color:#646161;";
      echo "<div class='list-group-item alert alert-danger' id='infoconec$filaResultado->informeId'>";
      echo "<h4 class='list-group-item-heading'> <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'>&nbsp</span><b>".ucwords($filaResultado->titulo)."</b></h4>";
      echo "<p class='list-group-item-text' style='".$parrafo."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Id:  </b>".$filaResultado->informeId."  <b></p><p class='list-group-item-text' style='".$parrafo."' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFecha Subida:</b>".Maestro::formatoFecha($filaResultado->fechaCarga)."&nbsp<b> SubCategoria:</b> ".$filaResultado->subNombre." &nbsp<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Número:</b>".$filaResultado->numero."&nbsp<b>Escuela:</b>".$filaResultado->escuelaNombre." </p>";
      echo "</div>";



      // echo "</div>";
      // echo "<p class='alert alert-info'>Id: <b>".$filaResultado->informeId."   </b><a id='infoconec$filaResultado->informeId' href='#'> Titulo: <b>".$filaResultado->titulo."</b></a><br>
      //   Fecha Subida: <b>".Maestro::formatoFecha($filaResultado->fechaCarga)."</b>
      //   <br>SubCategoria:".$filaResultado->subNombre."
      //   <br>Número:".$filaResultado->numero."
      //   <br>Escuela:".$filaResultado->escuelaNombre."
      //   ";


 }

?>
 </div>
</div>  <!-- cierra etiqueta container-fluid -->
