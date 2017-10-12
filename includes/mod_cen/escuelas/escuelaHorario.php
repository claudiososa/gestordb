<script type="text/javascript">
  var referenteId = " <?php echo trim($_SESSION['referenteId']) ?>";
	var escuelaId = " <?php echo trim($_GET['escuelaId']) ?>";
</script>
<script src="includes/mod_cen/escuelas/js/escuelaHorario.js" type="text/javascript"></script>
<script src="includes/mod_cen/escuelas/js/escuelaHorarioDia.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/bootstrap-clockpicker.min.css">
<link rel="stylesheet" type="text/css" href="includes/mod_cen/escuelas/assets/css/github.min.css">

<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/Cursos.php");
include_once("includes/mod_cen/clases/Profesores.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/HorarioFacilitadores.php");

$escuela = new Escuela($_GET['escuelaId']);
$datoEscuela = $escuela->buscarUnico();

//Buscar horario cargados para escuela actuales
$horario = new HorarioFacilitadores(null,$_SESSION['referenteId'],null,null,null,null,$_GET['escuelaId']);


//var_dump($buscarHorario);

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


	<div class="panel panel-primary" id="dias">
		<div class="panel-heading">
			<?php echo "<strong>Horario para Escuela : ".$datoEscuela->nombre.", ".$datoEscuela->cue."</strong>" ?>
		</div>
		<div class="panel-body">
			<div class="panel panel-primary">
				<div class="panel-heading">Lunes</div>
				<div class="panel-body">
					<div class="formHorarioNuevaHora" id='divHorarioLUNES'>
						<button class="agregarHora btn btn-success" type="agregarHora" name="button" id="horaLunes">Agregar Hora</button>
						<table class="table">
							<thead>
								<tr>
									<th>Dia</th>
									<th>Hora Inicio</th>
									<th>Hora Final</th>
									<th>Asignatura</th>
									<th>Curso</th>
									<th>Turno</th>
									<th>Profesor</th>
                  <th>Accion</th>
								</tr>
							</thead>
							<tbody id='LUNES'>


						<?php
							$horario->dia='LUNES';
							$buscarHorario = $horario->buscar();

								while ($fila = mysqli_fetch_object($buscarHorario)) {
									echo "<tr id='hora".$fila->horarioFacilitadoresId."'>";
									echo "<td>".$fila->dia."</td>";
									echo "<td>".$fila->horaIngreso."</td>";
									echo "<td>".$fila->horaSalida."</td>";
									echo "<td>".$fila->asignatura."</td>";
									echo "<td>".$fila->curso."° ".$fila->division."</td>";
									echo "<td>".Cursos::turno($fila->turno)."</td>";
									echo "<td>".$fila->nombre."</td>";
                  echo "<td><a href='#'><img class='dia' id='horaId".$fila->horarioFacilitadoresId."' src='img/iconos/delete.jpg' alt='borrar item'></a></td>";
									echo '</tr>';
								}
						 ?>

					 </tbody>
				 </table>
					</div>
				</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">Martes</div>
					<div class="panel-body">
						<div class="formHorarioNuevaHora" id='divHorarioMARTES'>
							<button class="agregarHora btn btn-success" type="agregarHora" name="button" id="horaMartes">Agregar Hora</button>

							<table class="table">
								<thead>
									<tr>
										<th>Dia</th>
										<th>Hora Inicio</th>
										<th>Hora Final</th>
										<th>Asignatura</th>
										<th>Curso</th>
										<th>Turno</th>
										<th>Profesor</th>
									</tr>
								</thead>
								<tbody id='MARTES'>
							<?php
								$horario->dia='MARTES';
								$buscarHorario = $horario->buscar();

									while ($fila = mysqli_fetch_object($buscarHorario)) {
										echo "<tr>";
										echo "<td>".$fila->dia."</td>";
										echo "<td>".$fila->horaIngreso."</td>";
										echo "<td>".$fila->horaSalida."</td>";
										echo "<td>".$fila->asignatura."</td>";
										echo "<td>".$fila->curso."° ".$fila->division."</td>";
										echo "<td>".Cursos::turno($fila->turno)."</td>";
										echo "<td>".$fila->nombre."</td>";
                    echo "<td><a href='#'><img class='horaId' id='horaId".$fila->horarioFacilitadoresId."' src='img/iconos/delete.jpg' alt='borrar item'></a></td>";
										echo '</tr>';
									}
							 ?>
						 </tbody>
					 </table>

						</div>
					</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">Miércoles</div>
						<div class="panel-body">
							<div class="formHorarioNuevaHora" id='divHorarioMIERCOLES'>
								<button class="agregarHora btn btn-success" type="agregarHora" name="button" id="horaMiercoles">Agregar Hora</button>
								<table class="table">
									<thead>
										<tr>
											<th>Dia</th>
											<th>Hora Inicio</th>
											<th>Hora Final</th>
											<th>Asignatura</th>
											<th>Curso</th>
											<th>Turno</th>
											<th>Profesor</th>
										</tr>
									</thead>
									<tbody id='MIERCOLES'>
								<?php
									$horario->dia='MIERCOLES';
									$buscarHorario = $horario->buscar();

										while ($fila = mysqli_fetch_object($buscarHorario)) {
											echo "<tr>";
											echo "<td>".$fila->dia."</td>";
											echo "<td>".$fila->horaIngreso."</td>";
											echo "<td>".$fila->horaSalida."</td>";
											echo "<td>".$fila->asignatura."</td>";
											echo "<td>".$fila->curso."° ".$fila->division."</td>";
											echo "<td>".Cursos::turno($fila->turno)."</td>";
											echo "<td>".$fila->nombre."</td>";
                      echo "<td><a href='#'><img class='horaId' id='horaId".$fila->horarioFacilitadoresId."' src='img/iconos/delete.jpg' alt='borrar item'></a></td>";
											echo '</tr>';
										}
								 ?>
							 </tbody>
						 </table>
							</div>
						</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading">Jueves</div>
							<div class="panel-body">
								<div class="formHorarioNuevaHora" id='divHorarioJUEVES'>
									<button class="agregarHora btn btn-success" type="agregarHora" name="button" id="horaJueves">Agregar Hora</button>
									<table class="table">
										<thead>
											<tr>
												<th>Dia</th>
												<th>Hora Inicio</th>
												<th>Hora Final</th>
												<th>Asignatura</th>
												<th>Curso</th>
												<th>Turno</th>
												<th>Profesor</th>
											</tr>
										</thead>
										<tbody id='JUEVES'>
									<?php
										$horario->dia='JUEVES';
										$buscarHorario = $horario->buscar();

											while ($fila = mysqli_fetch_object($buscarHorario)) {
												echo "<tr>";
												echo "<td>".$fila->dia."</td>";
												echo "<td>".$fila->horaIngreso."</td>";
												echo "<td>".$fila->horaSalida."</td>";
												echo "<td>".$fila->asignatura."</td>";
												echo "<td>".$fila->curso."° ".$fila->division."</td>";
												echo "<td>".Cursos::turno($fila->turno)."</td>";
												echo "<td>".$fila->nombre."</td>";
                        echo "<td><a href='#'><img class='horaId' id='horaId".$fila->horarioFacilitadoresId."' src='img/iconos/delete.jpg' alt='borrar item'></a></td>";
												echo '</tr>';
											}
									 ?>
								 </tbody>
							 </table>
								</div>
							</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">Viernes</div>
								<div class="panel-body">
									<div class="formHorarioNuevaHora" id='divHorarioVIERNES'>
										<button class="agregarHora btn btn-success" type="agregarHora" name="button" id="horaViernes">Agregar Hora</button>
										<table class="table">
											<thead>
												<tr>
													<th>Dia</th>
													<th>Hora Inicio</th>
													<th>Hora Final</th>
													<th>Asignatura</th>
													<th>Curso</th>
													<th>Turno</th>
													<th>Profesor</th>
												</tr>
											</thead>
											<tbody id='VIERNES'>
										<?php
											$horario->dia='VIERNES';
											$buscarHorario = $horario->buscar();

												while ($fila = mysqli_fetch_object($buscarHorario)) {
													echo "<tr>";
													echo "<td>".$fila->dia."</td>";
													echo "<td>".$fila->horaIngreso."</td>";
													echo "<td>".$fila->horaSalida."</td>";
													echo "<td>".$fila->asignatura."</td>";
													echo "<td>".$fila->curso."° ".$fila->division."</td>";
													echo "<td>".Cursos::turno($fila->turno)."</td>";
													echo "<td>".$fila->nombre."</td>";
                          echo "<td><a href='#'><img class='horaId' id='horaId".$fila->horarioFacilitadoresId."' src='img/iconos/delete.jpg' alt='borrar item'></a></td>";
													echo '</tr>';
												}
										 ?>
									 </tbody>
								 </table>
									</div>
								</div>
								</div>


					</div>
     </div>
    </div>
  <div class='col-md-4'>


<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo "Cursos" ?>
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
		<?php echo "Profesores" ?>
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

<script src="js/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript">
	$('.clockpicker').clockpicker()
</script>


<script src="js/highlight.min.js"></script>
<script type="text/javascript">
hljs.configure({tabReplace: '    '});
hljs.initHighlightingOnLoad();
</script>
