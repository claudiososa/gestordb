<?php
 
  include_once('../persona.php');
  include_once('../ProfeEdFisicaxEscuela.php');




/**
 * AL PRESIONAR BUSCAR PROFESOR
 */

if (isset($_POST['dni'])) 
{


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
	//Maestro::debbugPHP($_POST);
		$estado= [];
	//if ($_POST['botonSaveTeacher']=='saveTeacher') {
		include_once('persona.php');
		if ($_POST['statusTeacher']=='create') {
			
			
			$persona= new Persona(null,$_POST['surnameTeacher'],
																$_POST['nameTeacher'],
																$_POST['dniTeacher'],
																$_POST['dniTeacher'],
																$_POST['phoneTeacher'],
																$_POST['phoneTeacher'],
																null,
																$_POST['emailTeacher'],
																$_POST['emailTeacher'],
																null,
																null,
																'0001',
																'4400',
																null
															);

			$datoPersona = $persona->agregar();

			$profesorEdFisica = new ProfeEdFisicaxEscuela(null,$datoPersona,$_POST['escuelaId']); 
			$datoProfeEF=$profesorEdFisica->agregar();
			
			//$profesor = new Profesores(null,$datoPersona,$_POST['escuelaId']);
			//$datoProfesor = $profesor->agregar();

			$profesor2 = new ProfeEdFisicaxEscuela(null,null,$_POST['escuelaId']); 

			$buscarProfesor=$profesor2->buscar();

			while ($fila = mysqli_fetch_object($buscarProfesor))
			 {
						$temporal=array('profesorId'=>$fila->id_Ed_FisicaxEscuela,
														'nombre'=>$fila->personaId,
														'apellido'=>$fila->escuelaId);
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
					$profesorEdFisica = new ProfeEdFisicaxEscuela(null,$_POST['personaId'],$_POST['escuelaId']); 
					$datoProfeEF=$profesorEdFisica->agregar();

					
					//$profesor = new Profesores(null,$_POST['personaId'],$_POST['escuelaId']);
					//$datoProfesor = $profesor->agregar();

					//$profesor2 = new Profesores(null,null,$_POST['escuelaId']);
					$profesor2 = new ProfeEdFisicaxEscuela(null,null,$_POST['escuelaId']); 

					$buscarProfesor=$profesor2->buscar();

					while ($fila = mysqli_fetch_object($buscarProfesor)) {
						$temporal=array('profesorId'=>$fila->id_Ed_FisicaxEscuela,
														'nombre'=>$fila->personaId,
														'apellido'=>$fila->escuelaId);
						array_push($estado,$temporal);
					}

		}

		$json = json_encode($estado);
		//Maestro::debbugPHP($json);
		echo $json;
}


?>