<?php

class ControllerPerson{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){

		include "views/template.php";

	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){

			$enlaces = $_GET['action'];

		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}


	/**
	 * Buscar personas
	 */
	public function searchPersonController($typeSearch=NULL,$person_id=NULL){
		switch ($typeSearch) {
			case 'form':
				if(isset($_POST['searchPersonSubmit'])){
					$datosController = array (
																	'person_id'=>'',
																	'type'=>$_POST['typeuser'],
																	'firstname'=>$_POST['firstname'],
																	'lastname'=>$_POST['lastname'],
																	'dni'=>$_POST['dni']
																);
					$result = Person::searchPersonModel($datosController,'persons');
					return $result;
				}
				break;
				case 'inscription':
					if(isset($_POST['searchPersonSubmit'])){
						$datosController = array (
																		'person_id'=>'',
																		'type'=>$_POST['typeuser'],
																		'firstname'=>$_POST['firstname'],
																		'lastname'=>$_POST['lastname'],
																		'dni'=>$_POST['dni']
																	);
						$result = Person::searchPersonModel($datosController,'persons','inscription');
						return $result;
					}
					break;

			case 'person_id':
				$datosController = array (
															'person_id'=>$person_id,
															'type'=>'',
															'firstname'=>'',
															'lastname'=>'',
															'dni'=>''
														);
					$result = Person::searchPersonModel($datosController,'persons');
					return $result;
					break;

			default:
				# code...
				break;
		}

	}

	public function typePersonController($type=NULL){
		if(isset($type)){
			$datosController = array (
															'type'=>$_POST['typeuser'],
														);
			$result = Person::typePersonModel($datosController,'persons');
			return $result;
		}
	}
	//Registro usuarios

	public function registroPersonController(){
		if(isset($_POST["dniRegistro"])){

  		$datosController = array(
                      //"person"=>$_POST["personRegistro"],
                      "dni"=>$_POST["dniRegistro"],
                      "cuil"=>$_POST["cuilRegistro"],
                      "lastname"=>$_POST["lastnameRegistro"],
                      "firstname"=>$_POST["firstnameRegistro"],
                      "birthday"=>$_POST["birthdayRegistro"],
                      "sexo"=>$_POST["sexoRegistro"],
                      "phone"=>$_POST["phoneRegistro"],
                      "movil"=>$_POST["movilRegistro"],
  									  "email"=>$_POST["emailRegistro"],
  										"address"=>$_POST["addressRegistro"],
											"type"=>$_POST["typeRegistro"],
											"status"=>$_POST["statusRegistro"]

  									);
  		$respuesta = Person::registroPersonModel($datosController, "persons");

  		if ($respuesta =="success") {
  			return "success";
  		}else{
  			return "error";
  		}

		}
	}

	//Vista de usuarios
	//*******************************
  public function vistaPersonController($table,$type=NULL){
		$respuesta = Person::vistaPersonModel($table,$type);
		return $respuesta;
		//var_dump($respuesta[1][2]);
	}

	// Editar usuarios
	//*********************************************************
	public function editarPersonController(){
		$datos = $_GET["id"];
		$respuesta=Person::editarPersonModel($datos,"persons");
		include_once 'views/modules/person/forms/formNewPerson.php';
		/*echo '<input type="hidden" value="'.$respuesta["person_id"].'" name="person_IdEditar">
					<input type="text" value="'.$respuesta["dni"].'" placeholder="DNI" name="dniEditar" required>
          <input type="text" value="'.$respuesta["cuil"].'" placeholder="CUIL" name="cuilEditar" required>
          <input type="text" value="'.$respuesta["lastname"].'" placeholder="Apellidos" name="lastnameEditar" required>
          <input type="text" value="'.$respuesta["firstname"].'" placeholder="Nombres" name="firstnameEditar" required>
          <input type="text" value="'.$respuesta["birthday"].'" placeholder="Fecha de Nacimiento" name="birthdayEditar" required>
          <input type="text" value="'.$respuesta["sexo"].'" placeholder="Sexo" name="sexoEditar" required>
          <input type="text" value="'.$respuesta["phone"].'" placeholder="Telefono Fijo" name="phoneEditar" required>
          <input type="text" value="'.$respuesta["movil"].'" placeholder="Telefono Celular" name="movilEditar" required>
					<input type="email" value="'.$respuesta["email"].'" placeholder="Email" name="emailEditar" required>
          <input type="text" value="'.$respuesta["address"].'" placeholder="Dirección" name="addressEditar" required>

					<input type="submit" value="Actualizar">
		';*/
		//echo $respuesta[1];
		//return $respuesta;
		//var_dump($respuesta);
	}

	// Actualizar usuarios
	//*********************************************************
	public function actualizarPersonController(){
		if(isset($_POST["person_IdEditar"])){

			$datosController =  array(
                      "person_id"=>$_POST["person_IdEditar"],
											"dni"=>$_POST["dniRegistro"],
                      "cuil"=>$_POST["cuilRegistro"],
                      "lastname"=>$_POST["lastnameRegistro"],
                      "firstname"=>$_POST["firstnameRegistro"],
                      "birthday"=>$_POST["birthdayRegistro"],
                      "sexo"=>$_POST["sexoRegistro"],
                      "phone"=>$_POST["phoneRegistro"],
                      "movil"=>$_POST["movilRegistro"],
  									  "email"=>$_POST["emailRegistro"],
  										"address"=>$_POST["addressRegistro"],

                      /*"dni"=>$_POST["dniEditar"],
                      "cuil"=>$_POST["cuilEditar"],
                      "lastname"=>$_POST["lastnameEditar"],
                      "firstname"=>$_POST["firstnameEditar"],
                      "birthday"=>$_POST["birthdayEditar"],
                      "sexo"=>$_POST["sexoEditar"],
                      "phone"=>$_POST["phoneEditar"],
                      "movil"=>$_POST["movilEditar"],
  									  "email"=>$_POST["emailEditar"],
  										"address"=>$_POST["addressEditar"],*/
			);

		$respuesta = Person::actualizarPersonModel($datosController,"persons");
		if($respuesta == "success"){
			return 'success';
		}else {
			return "error";
		}
		//echo $respuesta;
	}
}


// Borar usuarios
//*********************************************************
public function borrarPersonController(){
	if(isset($_GET["idBorrar"])){
		$datos=$_GET["idBorrar"];
		$respuesta= Person::borrarPersonModel($datos,"persons");

		if($respuesta == "success"){
			header("location:index.php?action=person");
		}
	}
}


}

?>
