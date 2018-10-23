<?php
$informeC = new informe();
$resultado=$informeC->buscarxCategoriaCoor('18');
?>
<div class="container-fluid">


  <h3 align="center">Informes Conectividad</h3>
    <div class='list-group'>
<?php
while ($filaResultado = mysqli_fetch_object($resultado))
 {

     switch ($filaResultado->prioridad) {
       case 'Normal':
         $class="alert alert-success";
         $parrafo="color:#646161;";
         break;
       case 'Media':
         $class="alert alert-warning";
         $parrafo="color:#646161;";
         break;
       case 'Alta':
         $class="alert alert-danger";
         $parrafo="color:#646161;";
         break;
       default:
         # code...
         break;
     }

      //echo "<div class='list-group'>";


      echo "<div class='list-group-item ".$class."'id='infoconec$filaResultado->informeId'>";
      echo "<h4 class='list-group-item-heading'> <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'>&nbsp</span><b>".ucwords($filaResultado->titulo)."</b></h4>";
      echo "<p class='list-group-item-text' style='".$parrafo."'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Id:  </b>".$filaResultado->informeId."  <b></p><p class='list-group-item-text' style='".$parrafo."' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFecha Subida:</b>".Maestro::formatoFecha($filaResultado->fechaCarga)."&nbsp<b> SubCategoria:</b> ".$filaResultado->subNombre." &nbsp<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Número:</b>".$filaResultado->numero."&nbsp<b>Escuela:</b>".$filaResultado->escuelaNombre." </p>";
      echo "</div>";

 }

?>
 </div>

</div>  <!-- cierra etiqueta container-fluid -->
