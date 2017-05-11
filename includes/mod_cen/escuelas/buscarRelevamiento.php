<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/RelevamientoElectrico.php");
include_once("includes/mod_cen/clases/AulaSatelite.php");
//include_once("includes/mod_cen/clases/persona.php");
//include_once("includes/mod_cen/clases/referente.php");
//include_once("includes/mod_cen/clases/rti.php");
//include_once("includes/mod_cen/clases/informe.php");
//include_once("includes/mod_cen/clases/director.php");

/**
 * Inclusión de formulario para la busqueda de Escuelas
 */
include_once("includes/mod_cen/formularios/f_buscar_escuela.php");

if($_POST || isset($_GET['escuelaId']))
	{

				if(isset($_GET['escuelaId'])){
					$escuela=new Escuela($_GET['escuelaId']);
				}else{
					$cue=$_POST["cue"];
					$numero=$_POST["numero"];
					$nombre=$_POST["nombre"];
					$localidadId=$_POST["localidadId"];
					$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);
				}
				//$resultado = $escuela->buscar();
				$resultado2= $escuela->buscar();
				$cantidadEscuela=mysqli_num_rows($resultado2);
				$primero=0;
				$cantidad=0;
				echo "<div class='row' style='margin: 5px;padding: 3px;'>Cantidad de escuelas encontradas: <b>".$cantidadEscuela."</b></div>";
        echo '<table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>CUE</th>
                    <th>Nº</th>
                    <th>Nombre Escuela</th>
                    <th>Localidad</th>
                    <th>Acción</th>
										<th>Aula Satelite</th>
                  </tr>
                </thead>
                <tbody>';
        while ($fila = mysqli_fetch_object($resultado2))
      	{
					$relevamiento = new RelevamientoElectrico($fila->escuelaId);
					$buscarRelevamiento = $relevamiento->buscar();
					$datoRelevamiento = mysqli_fetch_object($buscarRelevamiento);

					//var_dump($datoRelevamiento);
					/*
      		$crearreferente=new Referente($fila->referenteId);
      		$traerreferente= $crearreferente->getContacto();
      		$r_personaId=$traerreferente->getPersonaId();

      		$crearPersona=new Persona($r_personaId);
      		$traerPersona=$crearPersona->getContacto();
      		$nombrePersona= $traerPersona->getNombre();
      		$apellidoPersona= $traerPersona->getApellido();
      		$persona=$traerPersona->getPersonaId();*/
          echo '<tr>';
    			echo "<td>".$fila->escuelaId."</td>";
    			echo "<td>".$fila->cue."</td>";
          echo "<td>".$fila->numero."</td>";
    			echo "<td>".substr($fila->nombre,0, 40)."</td>";

		  		$locali=new Localidad($fila->localidadId,null);
		  		$busca_loc= $locali->buscar();
		  		$fila1=mysqli_fetch_object($busca_loc);
		  		echo "<td>".$fila1->nombre."</td>";
					if($datoRelevamiento<>NULL)
					{
						echo "<td>"."<a class='btn btn-success' href='index.php?mod=slat&men=escuelas&id=20&edit&escuelaId=".$fila->escuelaId."'>Modificar Relevamiento</a>"."</td>";
					}else{
						echo "<td>"."<a class='btn btn-primary' href='index.php?mod=slat&men=escuelas&id=20&escuelaId=".$fila->escuelaId."'>Registrar Relevamiento</a>"."</td>";
					}
					echo "<td><a class='btn btn-primary' href='index.php?mod=slat&men=escuelas&id=21&escuelaId=".$fila->escuelaId."'>Necesito Agregar Aula Satelite</a>"."</td>";
 	  		  echo "</tr>";
					$aulaSatelite = new AulaSatelite(null,$fila->escuelaId);
					$buscarAula = $aulaSatelite->buscar();
					if($buscarAula){
						echo "<tr>
									<td colspan='4'>Aulas Satelites</td>
									</tr>";
						echo "<tr>
									<td>Id</td>
									<td>Cue</td>
									<td>Nº Institución</td>
									<td>Nombre de Satelite</td>
									<td>Localidad</td>
									<td>Acción 1</td>
									<td>Acción 2</td></tr>";
						while ($fila1 = mysqli_fetch_object($buscarAula)) {
							  echo '<tr>';
								echo '<td>'.$fila1->aulaSateliteId.'</td>';
								echo '<td>'.$fila->cue.'</td>';
								echo '<td>'.$fila->numero.'</td>';
								echo '<td>'.$fila1->nombre.'</td>';
								$locali=new Localidad($fila1->localidadId,null);
								$busca_loc= $locali->buscar();
								$fila2=mysqli_fetch_object($busca_loc);
								echo "<td>".$fila2->nombre."</td>";
								echo "<td>"."<a class='btn btn-primary' href='index.php?mod=slat&men=escuelas&id=21&escuelaId=".$fila->escuelaId."&aulaSateliteId=".$fila1->aulaSateliteId."'>Modificar Datos de Aula</a>"."</td>";
								echo "<td>"."<a class='btn btn-primary' href='index.php?mod=slat&men=escuelas&id=22&escuelaId=".$fila->escuelaId."&aulaSateliteId=".$fila1->aulaSateliteId."'>Registrar Relevamiento</a>"."</td>";
								echo '</tr>';

						}
					}
  		  	echo "\n";
      	}
        echo '</table>';
			  	echo "<div class='span11'>";
	      	echo "<div id='map'></div>";
	      	echo "</div>";

			//}
		}else{
			$escuela=new Escuela(NULL);
		}
?>
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
