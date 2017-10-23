<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){
		include "views/template.php";
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){
		//var_dump($_GET['action']);
		if(isset( $_GET['action'])){

			$enlaces = $_GET['action'];

		}else{
			$enlaces = "index";
		}
		//
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		include $respuesta;
	}

	//Registro usuarios

	public function registroUsuarioController($user_id,$user_name,$type){
		//if(isset($_POST["dniRegistro"])){

		$encriptar = md5($user_name);
		//$encriptar = crypt($_POST["passwordRegistro"]);
		$datosController = array(
										"user_id"=>$user_id,
										"usuario"=>$user_name,
									  "password"=>$encriptar,
										//"email"=>$_POST["emailRegistro"],
										"type"=>$_POST["typeRegistro"],
										"status"=>'Inactivo'
									);
		$respuesta = Datos::registroUsuarioModel($datosController, "users");

		if ($respuesta =="success") {
			header("location:index.php?action=ok");
		}else{
			header("location:index.php");
		}

	//	}
	}

	//ingreso de Automatico
	//******************************************************

	public static function ingresoAuto(){
		$datosController =['usuario'=>$_SESSION['username'],
		];
		$respuesta = Datos::ingresoUsuarioModel($datosController,'users');

		//var_dump($_SESSION['refereteId']);
		//if ($respuesta['type']<>'') {

			$tipoUsuario= $respuesta["type"];
			$_SESSION["validar"]=true;
			$_SESSION["typeUser"]=$respuesta["type"];
			$_SESSION["user_id"]=$respuesta["user_id"];

		//header("location:index.php?action=ok");
		//}

	}
	//ingreso de usuarios
  //******************************************************
	public function ingresoUsuarioController(){
		if(isset($_POST["usuarioIngreso"])){

		$encriptar = md5($_POST["passwordIngreso"]);

		$datosController = array("usuario"=>$_POST["usuarioIngreso"]
										//"password"=>$encriptar
									);

		$respuesta = Datos::ingresoUsuarioModel($datosController, "users");

		$intentos = $respuesta["attempts"];
		$maximoIntentos = 2;

		if($intentos < $maximoIntentos){

			if($respuesta["user_name"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){
				session_start();

				$tipoUsuario= $respuesta["type"];
				$_SESSION["validar"]=true;
				$_SESSION["typeUser"]=$respuesta["type"];
				$_SESSION["user_id"]=$respuesta["user_id"];

				$intentos=0;

				$datosController= array ("usuarioId"=>$respuesta ["user_id"],
																	"intentos" => $intentos);

				$respuesta = Datos::intentosUsuarioModel($datosController,"users");

				header("location:index.php?action=ok");
			}else{
				$intentos++;

				$datosController= array ("usuarioId"=>$respuesta ["user_id"],
																	"intentos" => $intentos);

				$respuesta = Datos::intentosUsuarioModel($datosController,"users");

				header("location:index.php?action=fallo");
			}
		}else{
			$intentos=0;

			$datosController= array ("usuarioId"=>$respuesta ["user_id"],
																"intentos" => $intentos);

			$respuesta = Datos::intentosUsuarioModel($datosController,"users");

			header("location:index.php?action=fallo3intentos");
		}
		}

	}


	//Vista de usuarios
	//*******************************
  public function vistaUsuariosController(){
		$respuesta = Datos::vistaUsuarioModel("users");
		foreach ($respuesta as $key => $item) {
			# code...

		echo '<tr>
			<td>'.$item["user_name"].'</td>
			<td>'.$item["password"].'</td>
			<td>'.$item["type"].'</td>
			<td>'.$item["status"].'</td>
			<td><a href="index.php?action=editar&id='.$item["user_id"].'"><button>Editar</button></a></td>
			<td><a href="index.php?action=usuarios&idBorrar='.$item["user_id"].'"><button>Borrar</button></a></td>
		</tr>';
		}
		//var_dump($respuesta[1][2]);
	}

	// Editar usuarios
	//*********************************************************
	public function editarUsuarioController(){
		$datos = $_GET["id"];
		$respuesta=Datos::editarUsuarioModel($datos,"users");

		echo '<input type="hidden" value="'.$respuesta["user_id"].'" name="idEditar">
					<input type="text" value="'.$respuesta["user_name"].'" placeholder="Usuario" name="usuarioEditar" required>
					<input type="password" value="'.$respuesta["password"].'" placeholder="Contraseña" name="passwordEditar" required>
					<input type="input" value="'.$respuesta["type"].'"  name="typeEditar" required>
					<input type="input" value="'.$respuesta["status"].'" name="statusEditar" required>
					<input type="submit" value="Actualizar">
		';
		//echo $respuesta[1];
		//return $respuesta;
		//var_dump($respuesta);
	}

	// Actualizar usuarios
	//*********************************************************
	public function actualizarUsuarioController(){
		if(isset($_POST["usuarioEditar"])){

			$encriptar = md5($_POST["passwordEditar"]);

			$datosController =  array("id"=>$_POST["idEditar"],
											"usuario"=>$_POST["usuarioEditar"],
											"password"=>$encriptar,
											"type"=>$_POST["typeEditar"],
											"status"=>$_POST["statusEditar"]
			);

		$respuesta = Datos::actualizarUsuarioModel($datosController,"users");
		if($respuesta == "success"){
			header("location:index.php?action=cambio");
		}else {
			echo "Error";
		}
		//echo $respuesta;
	}
}


// Borar usuarios
//*********************************************************
public function borrarUsuarioController(){
	if(isset($_GET["idBorrar"])){
		$datos=$_GET["idBorrar"];
		$respuesta= Datos::borrarUsuarioModel($datos,"users");

		if($respuesta == "success"){
			header("location:index.php?action=usuarios");
		}
	}
}

// Migrar usuarios
//*********************************************************
public function migrationUsersController(){
	$respuesta = Person::vistaPersonModel("persons");
	foreach ($respuesta as $key => $item) {
		$encriptar = md5($item["dni"]);
		$datosController = array(
										"user_id"=>$item["person_id"],
										"usuario"=>$item["dni"],
										"password"=>$encriptar,
										//"email"=>$_POST["emailRegistro"],
										"type"=>'Alumno',
										"status"=>'Inactivo'
									);
		$guardarUser = Datos::registroUsuarioModel($datosController, "users");


	}

}


}

?>
