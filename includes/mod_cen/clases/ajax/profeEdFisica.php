<?php


  include_once('../persona.php');
  include_once('../conexion.php');
  include_once('../ProfeEdFisicaxEscuela.php');
  include_once('../conexionv2.php');
  include_once('../maestro.php');
  include_once('../ProfeEdFisicaxCurso.php');




/**
 * AL PRESIONAR BUSCAR PROFESOR
 */


if (isset($_POST['dni']))
{  // include_once('../persona.php');
	//include_once("includes/mod_cen/clases/persona.php");


	$persona = new Persona(null,null,null,$_POST['dni']);
	$datoPersona = $persona->buscar();
	$cantidadPersona=mysqli_num_rows($datoPersona);


	$estado= [];

	if ($cantidadPersona > 0)
 	{   // encuentra a una persona


 		$dato = mysqli_fetch_object($datoPersona);

 		$profesorEdFisica = new ProfeEdFisicaxEscuela(null,$dato->personaId,$_POST['escuelaId']); // new
 		$datoProfesorEdFisica = $profesorEdFisica->buscar();// busca para saber si el profesor ya esta cargado en la escuela
 		$cantidadProfeEF=mysqli_num_rows($datoProfesorEdFisica); // new

 			if ($cantidadProfeEF > 0)
 			{

 				$temporal=array('dni'=>'existe');
 				array_push($estado,$temporal);
 		    }else {

 		    		$temporal=array('personaId'=>$dato->personaId,
 											'dni'=>$dato->dni,
 						 					'nombre'=>$dato->nombre,
 											'apellido'=>$dato->apellido,
 											'telefono'=>$dato->telefonoM,
 											'email'=>$dato->email,
 											'cuil'=>$dato->cuil
 											);
 			    	array_push($estado,$temporal);
                 }

 	}else{
 	      $temporal=array('dni'=>'error');
 	      array_push($estado,$temporal);
 	     }

 	$json = json_encode($estado);
 	echo $json;

 }




 /**
 * Al presionar el boton guardar profesor
 */
if (isset($_POST['botonSaveTeacher'])) {

	//include_once("includes/mod_cen/clases/persona.php");
	//Maestro::debbugPHP($_POST);
		$estado= [];
	//if ($_POST['botonSaveTeacher']=='saveTeacher') {
		//include_once('persona.php');
		if ($_POST['statusTeacher']=='create') {


			//$profesorEdFisica = new ProfeEdFisicaxEscuela(null,'555',$_POST['escuelaId']);
			//$datoProfeEF=$profesorEdFisica->agregar();




			$persona= new Persona(null,$_POST['surnameTeacher'],
																$_POST['nameTeacher'],
																$_POST['dniTeacher'],
																$_POST['dniTeacher'],
																$_POST['phoneTeacher'],
																$_POST['phoneTeacher'],
																'nada',
																$_POST['emailTeacher'],
																$_POST['emailTeacher'],
																'nada',
																'nada',
																'0001',
																'4400',
																'nada'
															);
			$datoPersona = $persona->agregar();


		//$persona1= new Persona(NULL, 'santos', 'valeria', '33970638', '33970638 ', '38711111', '38711111', 'san luis', 'correo1@gmail.com', 'correo1@gmail.com', 'valeria', 'valeria', '0001', '4400', '');
			//Maestro::debbugPHP($persona1);

		//	$datoPersona = $persona1->agregar();
			//Maestro::debbugPHP($datoPersona);

			$profesorEdFisica = new ProfeEdFisicaxEscuela(null,$datoPersona,$_POST['escuelaId'],$_POST['titulo']);


			$datoProfeEF=$profesorEdFisica->agregar();

			//$profesor = new Profesores(null,$datoPersona,$_POST['escuelaId']);
			//$datoProfesor = $profesor->agregar();

			$profesor2 = new ProfeEdFisicaxEscuela(null,null,$_POST['escuelaId']);

					$buscarProfesor=$profesor2->buscarProfesores();

					while ($fila = mysqli_fetch_object($buscarProfesor)) {
						$temporal=array('profesorId'=>$fila->numero,
														'nombre'=>$fila->nombre,
														'apellido'=>$fila->apellido);
						array_push($estado,$temporal);
					}

		}else{

		//$profePrueba = new ProfeEdFisicaxEscuela(null,'777',$_POST['escuelaId']);
		//$proEF=$profePrueba->agregar();
		/*	$persona= new Persona($_POST['personaId'],
																$_POST['surnameTeacher'],
																$_POST['nameTeacher'],
																$_POST['dniTeacher'],
																$_POST['cuilTeacher'],
																null,
																$_POST['phoneTeacher'],
																null,
																$_POST['emailTeacher'],
																null,
																null,
																null,
																'0001',
																'4400',
																null
															);
					$datoPersona = $persona->update();*/

					// include_once('../ProfeEdFisicaxEscuela.php');

					//$profePrueba = new ProfeEdFisicaxEscuela(null,'999',$_POST['escuelaId']);
		            //$proEF=$profePrueba->agregar();
					$profesorEdFisica = new ProfeEdFisicaxEscuela(null,$_POST['personaId'],$_POST['escuelaId'],$_POST['titulo']);
					$datoProfeEF=$profesorEdFisica->agregar();


					//$profesor = new Profesores(null,$_POST['personaId'],$_POST['escuelaId']);
					//$datoProfesor = $profesor->agregar();

					//$profesor2 = new Profesores(null,null,$_POST['escuelaId']);
					$profesor2 = new ProfeEdFisicaxEscuela(null,null,$_POST['escuelaId']);

					$buscarProfesor=$profesor2->buscarProfesores();

					while ($fila = mysqli_fetch_object($buscarProfesor)) {
						$temporal=array('profesorId'=>$fila->numero,
														'nombre'=>$fila->nombre,
														'apellido'=>$fila->apellido);
						array_push($estado,$temporal);
					}

		}

		$json = json_encode($estado);
		//Maestro::debbugPHP($json);
		echo $json;
}



//****** AGREGAR UN NUEVO CURSO ****/////

if (isset($_POST['courseName'])) {

	//$tab=array(1=>'test',
	//	2=>'test2');


	//,divisionName: divisionName, turn:turn, quantityStudents:quantityStudents,escuelaId:escuelaId
	//$curso= new Cursos(NULL,$_POST['courseName'],$_POST['divisionName'],$_POST['turn'],$_POST['quantityStudents'],$_POST['escuelaId']);
	//$curso= new Cursos(null,$_POST['courseName'],$_POST['divisionName'],$_POST['turn'],$_POST['quantityStudents'],$_POST['escuelaId']);
	$nuevoCurso= new ProfeEdFisicaxCurso(null,$_POST['id_Ed_FisicaxEscuela'],$_POST['turn'],$_POST['nivel'],$_POST['cantidadHoras'],$_POST['tipoCargo'],$_POST['courseName'],$_POST['divisionName']);

	//$existe = $nuevoCurso->existeCurso(); // metodo para saber que no esta cargando el mismo curso
	//$cantidad=mysqli_num_rows($existe);

	$estado= [];
	$datoCurso = $nuevoCurso->agregar();
	//$datoCurso=2;

	if ($datoCurso > 0) {
		$temporal=array('guardado'=>'ok',
											'id'=>$datoCurso);
		array_push($estado,$temporal);

	}else{
		$temporal=array('guardado'=>'error',
										'id'=>$datoCurso);
		array_push($estado,$temporal);
	   }
		$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;	# code...
  }
	//Maestro::debbugPHP($datoCurso);
  // FIN DE AGREGAR NUEVO CURSO

?>
