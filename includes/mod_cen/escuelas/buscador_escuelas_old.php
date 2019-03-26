<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="gmap/gmaps.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script>


<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rti.php");
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/director.php");
include_once("includes/mod_cen/clases/EscuelaReferentes.php");
include_once("includes/mod_cen/clases/Autoridades.php");
include_once("includes/mod_cen/clases/EscuelaTipoAutoridad.php");
include_once("includes/mod_cen/clases/CompartePredio.php");


/**
 * Inclusión de formulario para la busqueda de Escuelas
 */

   echo '<div class="form-group">';
     echo '<div class="" id="escPredio">';
     echo '</div>';
   echo '</div>';

?>
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
        <h5 class=" m-b-0 m-t-0 text-secondary">Búsqueda de Escuelas</h5>

      </div>

    </div>

    <div class="row">
      <div class="col-4">

            <?php
            include_once('includes/mod_cen/formularios/bst_f_buscar_escuela.php');

             ?>
      </div>

      <div class="col-8">
        <div class="card">
          <?php

          if(($_POST))
          	{
          				$cue=$_POST["cue"];
          				$numero=$_POST["numero"];
          				$nombre=$_POST["nombre"];
          				$localidadId=$_POST["localidadId"];

          				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);

          				$resultado = $escuela->buscar();
          				$resultado2= $escuela->buscar();
          				$cantidadEscuela=mysqli_num_rows($resultado2);
          				$primero=0;
          				$cantidad=0;
          				?>


          			<?php

          			echo "<h6>Cantidad de escuelas encontradas : <b>".$cantidadEscuela."</b></h6>";

          				$arreglo[]=array();
          				$arreglo["0"]="0";
          				$i=0;
                          // echo "<div class='row'>";
                           echo '<div class="accordion" id="accordion">';

          				while ($fila = mysqli_fetch_object($resultado2))
          				{
          					$repite=0;
          					$encontrado=0;
          					if($i==0)
          						$arreglo[$i]=$fila->referenteId;
          					else
          						foreach ($arreglo as $clave => $valor)
          						{
          							if($arreglo[$clave]==$fila->referenteId)
          								$repite++;
          						}
          						if($repite>0)
          							$encontrado=$repite;
          							$arreglo[count($arreglo)]=$fila->referenteId;
          					$i++;


          					/**
          					 * Verificar cantidad de rti de la institución
          					 * el dato se guarda en la variable cantidadRti
          					 */
          					$dato_rti=Rti::existeRtixinstitucion($fila->escuelaId);
          					$cantidadRti=mysqli_num_rows($dato_rti);

          					/**
          					 * Busqueda de informes de la institución actual
          					 * Cantidad encontradas en variable $cantInformes
          					 * Ultimos 3 informes almacenados en $ultimosInformes
          					 */
          						$informe = new Informe(null,$fila->escuelaId);
          						$buscar_informe = $informe->buscar();
          						$cantInformes = mysqli_num_rows($buscar_informe);
          						$ultimosInformes = $informe->buscar("3");

          		// Busqueda de informacion para predio[Inicio]

          						 $predio = new CompartePredio(null,$fila->escuelaId);
          					     $buscarPredio = $predio->buscarPredio();
          					     $cantidadPredio = $predio->buscarPredio('count');


          		// Busqueda de informacion para predio[Fin]

          							/**
          						 * Buscar referente de conectar igualdad de la de la escuela actual
          						 * guarda el dato en $datoEtt - incluye el nombre y apellido del referente
          						 */

          						//****** Modificacion de la busqueda de ETT en escuelaReferentes

          						$escuelasETT=new EscuelaReferentes(null,$fila->escuelaId,'19'); // buscamos las escuelas del ETT
          						$buscar_referenteETT=$escuelasETT->buscar2();// devuelve todos los datos de las escuelas del ETT
          						$datoBuscarETT=mysqli_fetch_object($buscar_referenteETT);


          							if ($datoBuscarETT->referenteId == NULL){  // Preguntamos si no existe ETT para la escuela (tambien puede ser que la escuela no tenga entrada en la tabla escuelaReferentes)

          							$referente=new Referente('0001');     // vamos a mostrar Sin, Asignar
          						  }else{

                                      $referente=new Referente($datoBuscarETT->referenteId);  // vamos a mostrar el ETT

          						  }


          						//$referente=new Referente($fila->referenteId);
          						$buscar_referente=$referente->buscar();
          						$datoEtt=mysqli_fetch_object($buscar_referente);

          						//***** Fin de modificacion busqueda de ETT

          						/**
          						 * Buscar referente de PMI de la de la escuela actual
          						 * guarda el dato en $datoEtt - incluye el nombre y apellido del referente
          						 */

          						if ($fila->referenteIdPmi==0){
          							$referente=new Referente("1");
          						}else{
          							$referente=new Referente($fila->referenteIdPmi);
          						}

          						$buscar_referente=$referente->buscar();
          						$datoAtt=mysqli_fetch_object($buscar_referente);

          						/**
          						 * Buscar dato de persona de referente ETJ de la escuela actual
          						 * guarda el dato en $datoEtj
          						 */
          						if ($datoBuscarETT->referenteId == NULL){  // preguntamos si no tiene ETT asignado

          						$escuelasETJ=new EscuelaReferentes(null,$fila->escuelaId,'20'); // buscamos la escuelas del ETJ
          						$buscar_referenteETJ=$escuelasETJ->buscar2();// devuelve todos los datos de la escuelas del ETJ
          						$datoBuscarETJ=mysqli_fetch_object($buscar_referenteETJ);

          								if ($datoBuscarETJ->referenteId == NULL ) {   // preguntamos si NO tiene ETJ asignado (tambien puede ser que la escuela no tenga entrada en la tabla escuelaReferentes)

          								$persona= new Referente('0001');     // vamos a mostrar Sin, Asignar
          								$buscar_referente=$persona->buscar();
          								$datoEtj=mysqli_fetch_object($buscar_referente);

          								}else{

          										$persona= new Referente($datoBuscarETJ->referenteId);  // vamos a mostrar el ETJ asignado
          										$buscar_referente=$persona->buscar();
          										$datoEtj=mysqli_fetch_object($buscar_referente);

          								     }


          						}else{  // buscamos datos del ETJ a cargo del ETT de la escuela

          								$persona= new Referente($datoEtt->etjcargo);
          								$buscar_referente=$persona->buscar();
          								$datoEtj=mysqli_fetch_object($buscar_referente);

          						}



          						/*
          							Inicio de buscador de autoridades (Director y supervisor)

          						*/

          						  switch ($fila->nivel) {
          						  	case 'Primaria Común':
          						  		 // Director de Primaria
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'3');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de Primaria


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'4');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}

          						  		break;

          						  	case 'Primaria Especial':

          						  		 // Director de Primaria Especial
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'28');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de Primaria Especial


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'18');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}




          						  		break;

          						  	case 'Secundaria Común':

          						  			 // Director de Secundaria Comun
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'20');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							   $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de Secundaria


          								  $autoridadSuper= new Autoridades(null,$fila->escuelaId,'15');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}





          						  		break;
          						  	case 'Secundaria Rural':

          						  		 // Director de Secundaria Rural
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'20');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de Secundaria Rural


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'15');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}



          						  		break;
          						  	case 'Secundaria Técnica':


          						  			// Director de Secundaria Rural
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'25');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de Secundaria Rural


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'14');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}




          						  		break;

          						  	case 'IEM':


          						  			 // Director de Secundaria Comun IEM
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'20');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de Secundaria IEM


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'15');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}




          						  		break;
          						  	case 'ISFD':

          						  		 // Rector de ISFD
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'22');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de ISFD


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'16');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}



          						  		break;

          						  	case 'BSPA':

          						  		 // Coordinador bspa
          						  		$autoridadDirector= new Autoridades(null,$fila->escuelaId,'29');
          						  		$existeDirector= $autoridadDirector->existe();
          						  		if ($existeDirector != 0) {

          						  		$autoridadDirector = new Autoridades($existeDirector);
          						  		$direDatos = $autoridadDirector->buscar();
          						  		$resultadoDirector=mysqli_fetch_object($direDatos);
          						  		$personaDire = new persona($resultadoDirector->personaId);
          						  		$buscarDirector = $personaDire->buscar();
          						  		$datoDirector=mysqli_fetch_object($buscarDirector);

          						  		}else{

          							  	 $personaDirector= new Persona('1');
          								 $buscarPersona = $personaDirector->buscar();
          								 $datoDirector =mysqli_fetch_object($buscarPersona);
          									}
          								// Supervisor de bspa


          								$autoridadSuper= new Autoridades(null,$fila->escuelaId,'19');
          						  		$existeSuper = $autoridadSuper->existe();

          						  		if ($existeSuper != 0) {

          						  		$autoridadSuper = new Autoridades($existeSuper);
          						  		$superDatos = $autoridadSuper->buscar();
          						  		$resultadoSuper=mysqli_fetch_object($superDatos);
          						  		$personaSuper = new persona($resultadoSuper->personaId);
          						  		$buscarSuper = $personaSuper->buscar();
          						  		$datoSupervisor=mysqli_fetch_object($buscarSuper);

          						  		}
          						  		else{

          							  	 $personaSuper= new Persona('1');
          								 $buscarSuper = $personaSuper->buscar();
          								 $datoSupervisor =mysqli_fetch_object($buscarSuper);
          								}



          						  		break;

          						  	default:
          						  		# code...
          						  		break;
          						  }



          						  /*
          						  Fin de Autoridades nuevo
                                  */
                                  ?>


                                    <?php

          						$locali=new Localidad($fila->localidadId,null);
          						$busca_loc= $locali->buscar();
          						$fila1=mysqli_fetch_object($busca_loc);

          					echo '<div class="card">';
          					// echo '<div class="panel panel-default">';
          					//echo '<div class="panel-heading">';
          					?>
          					<div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                      <?php
                                      echo  "<button class='btn btn-link' type='button'data-toggle='collapse' data-target='#collapseOne$fila->escuelaId' aria-expanded='false' aria-controls='collapseOne'>";

                                              echo $fila->numero." - ".$fila->cue." - ".substr($fila->nombre,0,70);
                                              if ($cantidadPredio >0) {
                                                  echo '<p align= "right"> Predio Compartido ['.$cantidadPredio.'] </p>';
                                              }else{
                                                  echo '<p align= "right"> Predio Sin Compartir ['.$cantidadPredio.'] </p>';
                                              }
                                          ?>
          	                        </button>
                                   </h5>
                    </div>


                          <?php
                              echo "<div id='collapseOne$fila->escuelaId' class='collapse' aria-labelledby='headingOne' data-parent='#accordion'>";
                          ?>
                              <div class="card-body">

                         				<div class="col">
                        					 <div class="alert alert-success" role="alert">Datos de la Institución</div>
                        					 <?php
                        					 echo "<div><b>Nº Colegio:</b> $fila->numero</div>";
                       					   echo "<div><b>CUE</b> $fila->cue</div>";
                        					 echo "<div><b>Nombre</b> $fila->nombre</div>";
                        					 echo"<div><b>Localidad</b> $fila1->nombre</div>";
                        					 echo"<div><b>Dirección</b> $fila->domicilio</div>";
                        					 echo"<div><b>Teléfono</b>$fila->telefono</div>";
                        					 echo"<div><b>Email</b>$fila->email</div>";

                        					 echo "<br></div>";



                        					 echo '<div class="col">';
                        					 echo '<div class="alert alert-success" role="alert">Informes Creados</div>';
                        					 echo"<div><b>Cantidad Total</b></div>";
                        					 echo "<div><a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver todos los informes &nbsp(".$cantInformes.")</a></div>";
                        					 echo"<div><b>Últimos Informes creados</b></div>";
                        					 echo "<div>";
                        					 echo "<ul class='list-group'>";

                        					 while($ultimos = mysqli_fetch_object($ultimosInformes))
                        					 {

                        						 $date = date_create($ultimos->fechaCarga);
                        						 $fecha=date_format($date, 'd-m-Y');
                        						 echo "<li class='list-group-item list-group-item-success'>
                        						 <div><a href='index.php?mod=slat&men=informe&id=3&informeId=".$ultimos->informeId."'>".substr($ultimos->titulo,0, 45)."...</a></div>
                        						 <div>Fecha Creación: ".$fecha."</div>
                        						 <div>Creado por: ".$ultimos->apellido." ".$ultimos->nombre."</div>
                        						 </li>";
                        						 //echo "<div><a href='index.php?mod=slat&men=informe&id=3&informeId=".$ultimos->informeId."'>".substr($ultimos->titulo,0, 30)."... -> ".$fecha."</a></div>";
                        					 }
                        					 echo "</ul>";
                        					 echo "</div>";
                        					 echo "<br>";
                        					 echo"<div><b><a class='btn btn-primary' href='index.php?mod=slat&men=informe&id=28&escuelaId=".$fila->escuelaId."'>Crear Nuevo Informe</a></b></div>";
                        					 echo "<br></div>";

          	// ====== Datos de Predio[Inicio] ======== //

          					 echo '<div class="col">';
          					 echo '<div class="alert alert-success" role="alert">Predio Compartido Con: </div>';

          					  echo '<table class ="table table-bordered">';
          					  echo '<tr>';
          					  echo '<th>N°</th>';
          					  echo '<th>CUE</th>';
          					  echo '<th>Nombre</th>';
          					  echo '</tr>';

          					 if ($cantidadPredio > 0)
          					     {

          					      while ($fila1 = mysqli_fetch_object($buscarPredio))
          					       {

          					     	if($fila1->escuelaId <> $fila->escuelaId)
          					     	 {
          					        echo '<tr>';
          					       // echo '<td><a class="btn btn-default" role="button" id="mpredio'.$fila1->escuelaId.'" data-toggle="modal" data-target="#myModalM'.$fila1->escuelaId.'" >'.$fila1->numero.'</a></td>';
          					          echo '<td><button type="button" class="btn btn-default" id="mpredio'.$fila1->escuelaId.'" name="button" data-toggle="modal" data-target="#myModalM'.$fila1->escuelaId.'">'.$fila1->numero.'</button></td>';
          					     	//echo '<td><a href="#">'.$fila1->numero.'</a></td>';
          					     	echo '<td>'.$fila1->cue.'</td>';
          					     	echo '<td>'.$fila1->nombre.'</td>';
          					     	echo '</tr>';
          					         }
          				           }


          					     }else{


          					     	echo '<tr>';
          					     	echo '<td> NO COMPARTE PREDIO  </td>';
          					     	echo '</tr>';

          					     }


          					 echo '</table>';
          					 echo '<br></div>';

          	// ====== Datos de Predio[FIN] ======== //


          					 echo '<div class="col">';
          					 echo '<div class="alert alert-success" role="alert">Referente ETT Aprender Conectados</div>';
          					 echo"<div><b>Apellido y Nombre:</b> $datoEtt->apellido"," $datoEtt->nombre</div>";
          					 echo"<div><b>Teléfono:</b> $datoEtt->telefonoM "-" $datoEtt->telefonoC</div>";
          					 echo"<div><b>Correo Electrónico:</b> $datoEtt->email</div>";
          					 echo "<br></div>";



          					 // $facilitador = new FacilEscuelas(null,$fila->escuelaId);
          						// $buscarFacil= $facilitador->buscar();
                     //
          						// if (mysqli_num_rows($buscarFacil)>0) {
          						// 	echo '<div class="col">';
          						// 	echo '<div class="alert alert-success" role="alert">Facilitador Escuela del Futuro</div>';
          						// 	while ($filaEscuela = mysqli_fetch_object($buscarFacil))
          						// 	{
          						// 		echo"<div><b>Apellido y Nombre</b></div>";
          						// 		echo "<div>".$filaEscuela->apellido.", ".$filaEscuela->nombre."</div>";
          						// 		echo"<div><b>Teléfono</b></div>";
          						// 		echo "<div>".$filaEscuela->telefonoM." / ".$filaEscuela->telefonoC."</div>";
          						// 		echo"<div><b>Correo Electrónico</b></div>";
          						// 		echo "<div>".$filaEscuela->email."</div>";
          						// 		echo "<br>";
          						// 	}
          						// 	echo "</div>";
          						// }


          					 echo '<div class="col">';
          					 echo '<div class="alert alert-success" role="alert">Referente ETJ Aprender Conectados</div>';
          					 echo"<div><b>Apellido y Nombre:</b> $datoEtj->apellido"," $datoEtj->nombre</div>";
          					 echo"<div><b>Teléfono:</b> $datoEtj->telefonoM "-" $datoEtj->telefonoC</div>";
          					 echo"<div><b>Correo Electrónico:</b> $datoEtj->email</div>";
          					 echo "<br></div>";

          					 echo '<div class="col">';
          					 echo '<div class="alert alert-success" role="alert">Referente ATT PMI (Plan Mejora Institucional)</div>';
          					 echo"<div><b>Apellido y Nombre:</b> $datoAtt->apellido", "$datoAtt->nombre</div>";
          					 echo"<div><b>Teléfono: $datoAtt->telefonoM "-" $datoAtt->telefonoC</b></div>";
          					 echo"<div><b>Correo Electrónico:</b> $datoAtt->email</div>";
          					 echo "<br></div>";

          					 echo '<div class="col">';
          					 echo '<div class="alert alert-success" role="alert">Datos de Directivo</div>';
          					 echo"<div><b>Apellido y Nombre:</b> $datoDirector->apellido"," $datoDirector->nombre</div>";
        					   echo"<div><b>Teléfono:</b> $datoDirector->telefonoM "-" $datoDirector->telefonoC</div>";
          					 echo"<div><b>Correo Electrónico:</b> $datoDirector->email</div>";
          					 echo "<br></div>";

          					 echo '<div class="col">';
          					 echo '<div class="alert alert-success" role="alert">Datos de Supervisor</div>';
          					 echo"<div><b>Apellido y Nombre:</b> $datoSupervisor->apellido"," $datoSupervisor->nombre</div>";
          					 echo"<div><b>Teléfono:</b> $datoSupervisor->telefonoM "-" $datoSupervisor->telefonoC</div>";
          					 echo"<div><b>Correo Electrónico:</b> $datoSupervisor->email</div>";
          					 echo "<br></div>";

          					 echo '<div class="col">';
          					echo '<div class="alert alert-success" role="alert">Datos de RTI</div>';

          					echo"<div><b>Cantidad de RTI</b></div>";
          					echo "<div><a href='index.php?mod=slat&men=escuelas&id=17&escuelaId=".$fila->escuelaId."'>".$cantidadRti."</a></div>";
          					echo "<br></div>";

          					?>

          					</div>

          					</div>
          					</div>

          				 <!-- </div> -->
          				<?php

          			}
          			  	echo "<div class='span11'>";
          	      	echo "<div id='map'></div>";
                        //echo "</div>";
                        echo "</div>";

          			//}
          		}else{
          			$escuela=new Escuela(NULL);
          		}
          ?>

        </div>

      </div>

      </div>

    </div>




  </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#example').DataTable( {
         "language": {
             "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         },
				"order": [[ 0, "asc" ]],
     } );
} );
</script>
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>
