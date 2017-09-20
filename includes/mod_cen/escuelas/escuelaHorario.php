<script src="includes/mod_cen/escuelas/js/escuelaHorario.js" type="text/javascript"></script>
<?php

include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/Cursos.php");
include_once("includes/mod_cen/clases/referente.php");

$escuela = new Escuela($_GET['escuelaId']);
$datoEscuela = $escuela->buscarUnico();

$curso = new Cursos();
$curso->escuelaId=$_GET['escuelaId'];

$cantidadCursos= $curso->buscar('cantidad');
$cursosActuales= $curso->buscar('total');


	echo '<div class="table-responsive">';
	//echo '<div class="container">';

	?>
	<div class="col-md-8">


	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo "<h4>Horario para Escuela : ".$datoEscuela->nombre.", ".$datoEscuela->cue."</h4>" ?>
		</div>
		<div class="panel-body">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo "<h4>Lunes</h4>" ?>
				</div>
				<div class="panel-body">
sdfasdf
				</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<?php echo "<h4>Martes</h4>" ?>
					</div>
					<div class="panel-body">
asdfdas
					</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<?php echo "<h4>Miercoles</h4>" ?>
						</div>
						<div class="panel-body">
adsfdasf
						</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<?php echo "<h4>Jueves</h4>" ?>
							</div>
							<div class="panel-body">
asdfasf
							</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<?php echo "<h4>Viernes</h4>" ?>
								</div>
								<div class="panel-body">
sdfdasf
								</div>
								</div>

			<?php

	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Accion</th>";
	echo "<th> Escuela  N°  </th>";
	echo "<th>Cargo</th>";
	echo "<th>Apellido y Nombre</th>";
	echo "<th>Dni</th>";
	echo "<th>Cuil</th>";
	echo "<th>Telefono</th>";
	echo "<th>e-mail</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
while ($fila = mysqli_fetch_object($resultado))
{

	// busca director

    $director= director::existeAutoridad($fila->escuelaId);
	$director2 = mysqli_fetch_object($director);


	echo "<tr>";


	if(isset($director2->directorId)>0)//Si existe director
	{
		$dire=new Persona($director2->personaId);
		$buscarDire=$dire->buscar();
		$resultadoDire=mysqli_fetch_object($buscarDire);

		// en el siguiente boton enviamos la variable  "dirUpdate" el proposito es indicar que los cambios se estan realizando desde el menu de un etj o coordinador y que cuando el script termine liste nuevamente el menu de mis ett y no mis escuelas

		echo "<td><a class='btn btn-primary' role='button' href='index.php?mod=slat&men=escuelas&id=13&personaId=".$director2->personaId."&directorId=".$director2->directorId."&escuelaId=".$fila->escuelaId."&dirUpdate=1'>"."Editar"."</a></td>";
		echo "<td>".$fila->numero."</td>";
		echo "<td>".$director2->tipoautoridad."</td>";
		echo "<td>".$resultadoDire->apellido.", ".$resultadoDire->nombre."</td>";
		echo "<td>".$resultadoDire->dni."</td>";
		echo "<td>".$resultadoDire->cuil."</td>";
		echo "<td>".$resultadoDire->telefonoC." ".$resultadoDire->telefonoM."</td>";
		echo "<td>".$resultadoDire->email." ".$resultadoDire->email2."</td>";


		}
	else
	{
		// en el siguiente boton enviamos la variable  "dirUpdate" el proposito es indicar que los cambios se estan realizando desde el menu de un etj o coordinador y que cuando el script termine liste nuevamente el menu de mis ett y no mis escuelas
		echo "<td><a class='btn btn-danger' role='button' href='index.php?mod=slat&men=escuelas&id=13&escuelaId=".$fila->escuelaId."&dirUpdate=1' font-weight:bold' >Cargar</a></td>";
		echo "<td>".$fila->numero."</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";


	}

	echo "</tr>";
	echo "\n";
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<div class='col-md-4'>";
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo "<h4>Cursos</h4>" ?>
	</div>
	<div class="panel-body">
		<div class=class="col-md-12" id="courses">

			<?php echo 'Total de curso:'.$cantidadCursos;
				while ($fila = mysqli_fetch_object($cursosActuales)) {
					echo '<p>'.$fila->curso.' '.$fila->division.
					' Turno <b>'.Cursos::turno($fila->turno).'</b><img id="curso'.$fila->cursoId.'" src="img/iconos/delete.png" alt="borrar"></p>';
				}
			?>

		</div>
		<hr />
		<button id="newCourse" class="btn btn-success" type="button" name="button">Nuevo Curso</button>
		<div id="formNewCourse" class="col-md-12">
			<hr />
			<form class="" action="" method="post">
				<div class="form-group">
					<label  for="courseName">Curso</label>
					<select class="form-control" name="courseName" id="courseName">
							<option value="0">Seleccione</option>
							<option value="1">1°</option>
							<option value="2">2°</option>
							<option value="3">3°</option>
							<option value="4">4°</option>
							<option value="5">5°</option>
							<option value="6">6°</option>
							<option value="7">7°</option>
					</select>
				</div>

				<div class="form-group">
					<label  for="divisionName">Division</label>
					<select class="form-control" name="divisionName" id="divisionName">
							<option value="0">Seleccione</option>
							<option value="1ra">1ra</option>
							<option value="2da">2da</option>
							<option value="3ra">3ra</option>
							<option value="4ta">4ta</option>
							<option value="5ta">5ta</option>
							<option value="6ta">6ta</option>
							<option value="7ma">7ma</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
							<option value="F">F</option>
							<option value="G">G</option>
					</select>
				</div>

				<div class="form-group">
					<label  for="turn">Turno</label>
					<select class="form-control" name="turn" id="turn">
						  <option value="0">Seleccione</option>
							<option value="M">Mañana</option>
							<option value="I">Intermedio</option>
							<option value="T">Tarde</option>
							<option value="V">Vespertino</option>
							<option value="N">Noche</option>
					</select>
				</div>

				<div class="form-group">
					<label  for="quantityStudents">Cantidad Alumnos</label>
					<br>
					<input type="number" name="quantityStudents" min="1" max="50" value="1" id="quantityStudents">
				</div>
				<input type="hidden" name="escuelaId" id="escuelaId" value="<?php echo $_GET['escuelaId'] ?>">
			 <button type="button" id="saveCourse" class="btn btn-warning" name="button">Guardar Curso</button>
			</form>
		</div>
<?php
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
//echo "</div>";
?>
<script type="text/javascript">
$(document).ready(function()
		{
				//$("#myTable").tablesorter();
				$("#myTable").tablesorter( {sortList: [[0,1]]} );
				//$("#myTable1").tablesorter();
				$("#myTable1").tablesorter( {sortList: [[0,1]]} );
		}
);
</script>
<script type="text/javascript">
$("table").tableExport( {

  formats: ['xls',],
	ignoreCols: 0,
	bootstrap: true,
	});





</script>
