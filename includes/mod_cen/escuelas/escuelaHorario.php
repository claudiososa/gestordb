<script src="includes/mod_cen/escuelas/js/escuelaHorario.js" type="text/javascript"></script>
<script src="includes/mod_cen/escuelas/js/escuelaHorarioDia.js" type="text/javascript"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<?php

include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/Cursos.php");
include_once("includes/mod_cen/clases/Profesores.php");
include_once("includes/mod_cen/clases/referente.php");

$escuela = new Escuela($_GET['escuelaId']);
$datoEscuela = $escuela->buscarUnico();

//Definicion de variables con cantidad y lista de cursos actuales para la escuela

$curso = new Cursos();
$curso->escuelaId=$_GET['escuelaId'];

$cantidadCursos= $curso->buscar('cantidad');
$cursosActuales= $curso->buscar('total');
$cursosActuales2= $curso->buscar('total');

//Definicion de variables con cantidad y lista de Profesores actuales para la escuela

$profesor = new Profesores();
$profesor->escuelaId=$_GET['escuelaId'];

$cantidadProfesores= $profesor->buscar('cantidad');
$profesoresActuales= $profesor->buscar('total');
$profesoresActuales2= $profesor->buscar('total');

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
				<div class="panel-body" id='formHorarioLunes'>
					<button class="agregarHora btn btn-success" type="agregarHora" name="button" id="horaLunes">Agregar Hora</button>
				</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<?php echo "<h4>Martes</h4>" ?>
					</div>
					<div class="panel-body">
						<button class="btn btn-success" type="agregarHora" name="button" id="horaMartes">Agregar Hora</button>
						<div class="formHorarioNuevaHora" id='formHorarioMartes'>
							<?php //include_once('includes/mod_cen/formularios/f_HorarioNuevaHora.php');?>
						</div>
					</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<?php echo "<h4>Miercoles</h4>" ?>
						</div>
						<div class="panel-body">
							<button class="btn btn-success" type="agregarHora" name="button" id="horaMiercoles">Agregar Hora</button>
							<div class="formHorarioNuevaHora" id='formHorarioMiercoles'>
								<?php //include_once('includes/mod_cen/formularios/f_HorarioNuevaHora.php');?>
							</div>
						</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<?php echo "<h4>Jueves</h4>" ?>
							</div>
							<div class="panel-body">
								<button class="btn btn-success" type="agregarHora" name="button" id="horaJueves">Agregar Hora</button>
								<div class="formHorarioNuevaHora" id='formHorarioJueves'>
									<?php //include_once('includes/mod_cen/formularios/f_HorarioNuevaHora.php');?>
								</div>
							</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<?php echo "<h4>Viernes</h4>" ?>
								</div>
								<div class="panel-body">
									<button class="btn btn-success" type="agregarHora" name="button" id="horaViernes">Agregar Hora</button>
									<div class="formHorarioNuevaHora" id='formHorarioViernes'>
										<?php //include_once('includes/mod_cen/formularios/f_HorarioNuevaHora.php');?>
									</div>
								</div>
								</div>


					</div>
     </div>
    </div>
  <div class='col-md-4'>


<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo "<h4>Cursos</h4>" ?>
	</div>
	<div class="panel-body">
		<div class=class="col-md-12" id="courses">

			<?php echo 'Total de curso:'.$cantidadCursos;
				while ($fila = mysqli_fetch_object($cursosActuales)) {
					echo '<p>'.$fila->curso.' '.$fila->division.
					' Turno <b>'.Cursos::turno($fila->turno).'</b><img class="curso" id="curso'.$fila->cursoId.'" src="img/iconos/delete.png" alt="borrar"></p>';
				}
			?>

		</div>
		<hr />
		<button id="newCourse" class="btn btn-success" type="button" name="button">Nuevo Curso</button>
		<div id="formNewCourse" class="col-md-12">
			<hr />
			<?php include('includes/mod_cen/formularios/f_HorarioNuevoCurso.php') ?>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo "<h4>Profesores</h4>" ?>
	</div>
	<div class="panel-body">
		<div class=class="col-md-12" id="teachers">
			<?php echo 'Total de Profesores:'.$cantidadProfesores;
				while ($fila = mysqli_fetch_object($profesoresActuales)) {
					echo '<p>'.$fila->nombre.' '.$fila->apellido.'<img class="profesor" id="profesor'.$fila->profesorId.'" src="img/iconos/delete.png" alt="borrar"></p>';
				}
			?>

		</div>
		<hr />
		<button id="newTeacher" class="btn btn-success" type="button" name="button">Nuevo Profesor</button>
					<?php include('includes/mod_cen/formularios/f_HorarioNuevoProfesor.php') ?>

	</div>
</div>
</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
