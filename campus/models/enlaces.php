<?php

class Paginas{

	public function enlacesPaginasModel($enlaces){


		if($enlaces == "ingresar" || $enlaces == "usuarios"
			|| $enlaces == "editar" || $enlaces == "salir" || $enlaces == "person" || $enlaces == "alumno" ){

			$module =  "views/modules/portada/".$enlaces.".php";

		}elseif($enlaces == "searchPerson" || $enlaces == "createPerson" || $enlaces == "editarPerson" || $enlaces == "searchPersonDirector"){
			$module =  "views/modules/person/".$enlaces.".php";
		}elseif($enlaces == "createCourse" || $enlaces == "inscription" || $enlaces == "mycourses"
		|| $enlaces == "attendance" || $enlaces == "attendanceDate" || $enlaces == "coursesDirector" || $enlaces == "statisDirector"
		 || $enlaces == "viewStudentsCourse"){
			$module =  "views/modules/course/".$enlaces.".php";
		}elseif($enlaces == "migration_users" || $enlaces == "migration_students"){
			$module =  "views/modules/migration/".$enlaces.".php";
		}elseif($enlaces == "index"){
			$module =  "views/modules/inicio.php";
		}else if($enlaces == "ok"){
			$module =  "views/modules/inicio.php";
		}else if($enlaces == "fallo"){
			$module =  "views/modules/ingresar.php";
		}else if($enlaces == "fallo3intentos"){
			$module =  "views/modules/ingresar.php";
		}else if($enlaces == "cambio"){
			$module =  "views/modules/usuarios.php";
		}else if($enlaces == "cambioperson"){
			$module =  "views/modules/person.php";
		}else{
			$module =  "views/modules/registro.php";
		}

		return $module;

	}

}

?>
