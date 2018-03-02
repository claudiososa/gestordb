<link rel="stylesheet" href="includes/mod_cen/css/styleIconos.css">
<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
</script>

<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/detalleBuscarEscuela.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>

<?php
include_once 'includes/mod_cen/clases/EscuelaReferentes.php';
include_once 'includes/mod_cen/clases/escuela.php';
include_once 'includes/mod_cen/clases/Autoridades.php';
include_once 'includes/mod_cen/clases/informe.php';
include_once 'includes/mod_cen/clases/departamentos.php';

/**
 * Inclusión de formulario para la busqueda de Escuelas
 */
 echo '<div class="container wow flipInX">';
 echo'<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/busqueda (3).png"></div><h4><b>Búsqueda de Escuelas</b></h4>';

 echo '<hr>';
echo'</div>';
 echo'<br>';
  echo'<br>';
	 echo'<br>';

include_once("includes/mod_cen/formularios/f_buscar_escuela.php");

if(($_POST))
	{
				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];

				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);

				$resultado = $escuela->buscar();
				$resultado2= $escuela->buscar();
				$cantidadEscuela=mysqli_num_rows($resultado2);
				$primero=0;
				$cantidad=0;

			  echo "<div class='row' style='margin: 5px;padding: 3px;'>Cantidad de escuelas encontradas : <b>".$cantidadEscuela."</b></div>";

        ?>
        <table class="table table-bordered hidden-xs">
          <thead>
            <tr class='danger' >
              <th>CUE</th>
              <th>N°</th>
              <th>Nombre</th>
              <th>Mis informes</th>
              <th>Autoridades</th>

            </tr>
          </thead>

          <tbody>

        <?php

				while ($row = mysqli_fetch_object($resultado2))
				{
          $informe = new informe(null,$row->escuelaId);
          $buscarInforme= $informe->buscar();
          $cantidadInforme = mysqli_num_rows($buscarInforme);

          $autoridad = new Autoridades(null,$row->escuelaId);
          $buscarAutoridad = $autoridad->buscarAutoridad3('all');
          $cantidadAutoridades = mysqli_num_rows($buscarAutoridad);

          $escuela->escuelaId=$row->escuelaId;
          $buscarEscuela = $escuela->buscar();
          $infoEscuela = mysqli_fetch_object($buscarEscuela);

          //echo $infoEscuela->numero."<br>";
          echo '<tr id="fila'.$infoEscuela->escuelaId.'">';
          echo '<td>'.$infoEscuela->cue.'</td>';
          echo '<td>'.$infoEscuela->numero.'</td>';
          echo '<td>'.$infoEscuela->nombre.'</td>';
          echo '<td id="informes'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-danger" id="info'.$infoEscuela->escuelaId.'" name="button">'.$cantidadInforme.'</button></td>';
          echo '<td id="row'.$infoEscuela->escuelaId.'"><button type="button" class="btn btn-danger" id="autoridad'.$infoEscuela->escuelaId.'" name="button">'.$cantidadAutoridades.' </button><span id="verAutoridad'.$infoEscuela->escuelaId.'" class="pull-right clickable"><i  class="glyphicon glyphicon-chevron-down"></i></span></td>';
          echo '</tr>';

			  }


		}else{
			$escuela=new Escuela(NULL);
		}
?>

  </tbody>
</table>

<script type="text/javascript">
$(document).ready(function() {
	$('#example').DataTable( {
         "language": {
             "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         },
				"order": [[ 0, "asc" ]],
     } );
} );
</script>
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>
