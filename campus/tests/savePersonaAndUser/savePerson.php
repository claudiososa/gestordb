<?php
include_once 'person.php';
$datosController = array(
                      //"person"=>$_POST["personRegistro"],
                      "dni"=>rand(20202020, 20209999),
                      "cuil"=>rand(20202020, 20209999),
                      "lastname"=>'sosa1',
                      "firstname"=>'ariel1',
                      "birthday"=>'02-02-2017',
                      "sexo"=>'m',
                      "phone"=>'454545',
                      "movil"=>'999999',
  									  "email"=>'cas@gmail.com',
  										"address"=>'paraiso'

  									);
  		$respuesta = Person::registroPersonModel($datosController, "persons");


  		if ($respuesta =="success") {
  			echo 'guardado0';
  		}else{
  			echo 'NOO see guardado0';
  		}

      ?>
