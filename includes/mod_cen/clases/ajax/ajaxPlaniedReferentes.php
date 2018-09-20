<?php
  //include_once('../informe.php');
 //include_once('../img.php');

   include_once('../EscuelaReferentes.php');
   include_once('../referente.php');
   include_once("../persona.php");
   include_once("../escuela.php");
   include_once("../rtixescuela.php");
   include_once("../rti.php");
   include_once('../maestro.php');

   include_once('../Autoridades.php');
   include_once('../EscuelaTipoAutoridad.php');
   include_once('../TipoAutoridades.php');

  //include_once('../respuesta.php');
  //include_once('../leido.php');

 if (isset($_POST['escuela']))
  {
   //$cartel="llego bien";
  	//Maestro::debbugPHP($_POST['escuela']);
    //Maestro::debbugPHP($cartel);

  	$arrayPrincipal=array();  // guarda los referentes etj,ett y rti

    //*********** Cargamos Datos del ETT *****************//

    $escuelaPlanied= new EscuelaReferentes(null,$_POST['escuela']);
    $ett=$escuelaPlanied->buscarReferente('19');

    if ($ett->personaId != NULL) { // entra si la escuela tiene ETT

if ($ett->fotoPerfil == NULL) {
  $ett->fotoPerfil = '0000.jpg';
}
      $temporal=array(
      'personaId'=>$ett->personaId,
      'apellido'=>$ett->apellido,
      'nombre'=>$ett->nombre,
      'dni'=>$ett->dni,
      'cuil'=>$ett->cuil,
      'telefonoM'=>$ett->telefonoM,
      'telefonoC'=>$ett->telefonoC,
      'email'=>$ett->email,
      'direccion'=>$ett->direccion,
      'twitter'=>$ett->twitter,
      'fotoPerfil'=>$ett->fotoPerfil
      );
      $ettRefId=$ett->referenteId;
      array_push($arrayPrincipal,$temporal); // insertamos datos del ett al array principal


      		//******** Cargamos Datos del ETJ ********//

      		$ettReferente= new Referente($ettRefId);

      		$etjAcargo = $ettReferente->buscar();  // buscamos el etj a cargo

      		$datosEtjAcargo=mysqli_fetch_object($etjAcargo);
      		//Maestro::debbugPHP($datosEtjAcargo);

      		$etjReferente= new Referente($datosEtjAcargo->etjcargo);

      		$etjBuscar=$etjReferente->buscar();


      		$etjPersonaId= mysqli_fetch_object($etjBuscar);
      		//Maestro::debbugPHP($etjPersonaId);
      		$etjPersona= new Persona($etjPersonaId->personaId);
      		$etjDatos=$etjPersona->buscar();             // buscamos los Datos del ETJ
      		$etj=mysqli_fetch_object($etjDatos);

      		//**** cargamos datos del Etj ****//


          if ($etj->fotoPerfil == NULL) {
            $etj->fotoPerfil = '0000.jpg';
          }
      	  $temporal=array(
        'personaId'=>$etj->personaId,
	      'apellido'=>$etj->apellido,
	      'nombre'=>$etj->nombre,
	      'dni'=>$etj->dni,
	      'cuil'=>$etj->cuil,
	      'telefonoM'=>$etj->telefonoM,
	      'telefonoC'=>$etj->telefonoC,
	      'email'=>$etj->email,
	      'direccion'=>$etj->direccion,
	      'twitter'=>$etj->twitter,
	      'fotoPerfil'=>$etj->fotoPerfil

	      );
	    array_push($arrayPrincipal,$temporal);




    }else{   // entra aqui x que no tiene ETT

      $temporal=array(
      'personaId'=>'',
      'apellido'=>'',
      'nombre'=>'',
      'dni'=>'',
      'cuil'=>'',
      'telefonoM'=>'',
      'telefonoC'=>'',
      'email'=>'',
      'direccion'=>'',
      'twitter'=>'',
      'fotoPerfil'=>'0000.jpg'

      );

      array_push($arrayPrincipal,$temporal); // insertamos datos vacios del ett al array principal

      // Buscamos si el ETJ tiene a esta escuela a cargo

      $escuelaPlanied= new EscuelaReferentes(null,$_POST['escuela']);
      $etj=$escuelaPlanied->buscarReferente('20'); // Busco etj de la escuela


       if ($etj->personaId != NULL) {


       if ($etj->fotoPerfil == NULL) {
         $etj->fotoPerfil = '0000.jpg';
       }
	    $temporal=array(
	      'personaId'=>$etj->personaId,
	      'apellido'=>$etj->apellido,
	      'nombre'=>$etj->nombre,
	      'dni'=>$etj->dni,
	      'cuil'=>$etj->cuil,
	      'telefonoM'=>$etj->telefonoM,
	      'telefonoC'=>$etj->telefonoC,
	      'email'=>$etj->email,
	      'direccion'=>$etj->direccion,
	      'twitter'=>$etj->twitter,
	      'fotoPerfil'=>$etj->fotoPerfil

	      );
	    array_push($arrayPrincipal,$temporal);

       }else{

	      $temporal=array(
	      'personaId'=>'',
	      'apellido'=>'',
	      'nombre'=>'',
	      'dni'=>'',
	      'cuil'=>'',
	      'telefonoM'=>'',
	      'telefonoC'=>'',
	      'email'=>'',
	      'direccion'=>'',
	      'twitter'=>'',
	      'fotoPerfil'=>'0000.jpg'

	      );

	    array_push($arrayPrincipal,$temporal);
    }



 }






// datos de rti


    $escuela= new Escuela($_POST['escuela']);
    $fila=$escuela->buscarUnico();
    $rtix= new rtixescuela($fila->escuelaId);
    $buscar_rti=$rtix->buscar();
    while($filarti=mysqli_fetch_object($buscar_rti)){

        $rti=new Rti($filarti->rtiId);
        $buscar_dato=$rti->buscar();
        //$cantidadRti='2';
        while($filadato=mysqli_fetch_object($buscar_dato)){
          $persona= new Persona($filadato->personaId);
          $buscar_persona=$persona->buscar();
          $dato=mysqli_fetch_object($buscar_persona);

          $temporal=array(
          	'personaId'=>$dato->personaId,
            'apellido'=>$dato->apellido,
            'nombre'=>$dato->nombre,
            'dni'=>$dato->dni,
            'cuil'=>$dato->cuil,
            'telefonoM' =>$dato->telefonoM,
            'telefonoC' =>$dato->telefonoC,
            'email'=>$dato->email,
            'direccion'=>$dato->direccion,
            'twitter'=>$dato->twitter,
            'fotoPerfil' =>$dato->fotoPerfil
      		);
      		array_push($arrayPrincipal,$temporal);
        }
      }

  //Datos director






// fin de datos rti

    //Maestro::debbugPHP($list);
     Maestro::debbugPHP($arrayPrincipal);
    //$json = json_encode($list);
    $json = json_encode($arrayPrincipal);

    echo $json;
  }




  ?>
