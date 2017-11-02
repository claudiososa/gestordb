<script src="includes/mod_cen/escuelas/js/escuelaEF.js" type="text/javascript"></script>

<?php
//<script src="includes/mod_cen/escuelas/js/escuelaHorarioDia.js" type="text/javascript"></script>
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/Cursos.php");
include_once("includes/mod_cen/clases/ProfeEdFisicaxEscuela.php");
//include_once("includes/mod_cen/clases/ProfesoresEF.php");
include_once("includes/mod_cen/clases/ajax/profeEdFisica.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/ProfeEdFisicaxCurso.php");



//echo $_GET['escuelaId'];
$escuela = new Escuela($_GET['escuelaId']);
$datoEscuela = $escuela->buscarUnico();

//Definicion de variables con cantidad y lista de cursos actuales para la escuela

$curso = new ProfeEdFisicaxCurso();
//$curso->escuelaId=$_GET['escuelaId'];

$Cursos= $curso->buscarCursos('141','1639');
$cantidadCurso=mysqli_num_rows($Cursos);
//$cantidadCurso=2;
//$cursosActuales= $curso->buscar('total');

//Definicion de variables con cantidad y lista de Profesores actuales para la escuela

//$profesor = new Profesores();
//$profesor->escuelaId=$_GET['escuelaId'];
$profesor2 = new ProfeEdFisicaxEscuela(null,null,$_GET['escuelaId']);
$buscarProfesor=$profesor2->buscarProfesores();
$cantidadProfeEF=mysqli_num_rows($buscarProfesor);


//$cantidadProfesores= $profesor->buscar('cantidad');
//$profesoresActuales= $profesor->buscar('total');


	echo '<div class="table-responsive">';
	//echo '<div class="container">';

	?>
	
  <div class='col-md-8'>

<!-- DESDE AQUI -->

<!-- HASTA AQUI -->
<div class="panel panel-primary">
	<div class="panel-heading">
		<?php echo "<h4>Profesores</h4>" ?>
	</div>
	<div class="panel-body">
		<div class=class="col-md-12" id="teachers">
			<?php  echo 'Total de Profesores:'.$cantidadProfeEF;
				while ($fila = mysqli_fetch_object($buscarProfesor)) {
					echo '<p>'.$fila->apellido.' '.$fila->nombre.'  [ '.$fila->id_Ed_FisicaxEscuela .'] <img class="profesor" id="profesor'.$fila->profesorId.'" src="img/iconos/delete.png" alt="borrar"></p>';
				$numeroEsc=$fila->numero;
				}
			?>

		</div>
		<hr />
		<button id="newTeacher" class="btn btn-success" type="button" name="button">Nuevo Profesor</button>

			<?php include('includes/mod_cen/formularios/f_HorarioNuevoProfesorEF.php') ?>
		<?php echo "<a class='btn btn-primary' role='button' href='index.php?mod=slat&men=escuelas&id=25&retorno=".$numeroEsc."'>Volver</a>&nbsp&nbsp&nbsp"; ?>  
							
																	
	</div>
</div>


</div>
</div>


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