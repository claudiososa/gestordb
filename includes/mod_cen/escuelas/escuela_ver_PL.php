<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/director.php");

?>
<div class="container">
<?php
	 include('includes/mod_cen/formularios/buscadorPlanLectura.php');
 ?>
</div>

<div class="container">


		<?php

if(($_POST) || isset($_GET['retorno']))
	{

					if (isset($_GET['retorno'])) {

					$cue=NULL;
					$numero=$_GET['retorno'];
					$nombre=NULL;
					$localidadId=NULL;
					$nivel=0;
					//$_GET['retorno'];


						# code...
					}else{
					//var_dump($_POST);
				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];
				$nivel=$_POST["nivel"]; }

				
				if($nivel=="0"){
				$nivel=NULL;
				}

				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,$nivel,$localidadId,null);



				$resultado = $escuela->buscar();



					echo "<div class='panel panel-primary'>";
					echo "<div class ='panel-heading'>Búsqueda de Escuelas Plan de Lectura</div>";
					echo "<div class='panel-body'>";
					echo "<div class='table-responsive'>";
					echo	"<table class='table table-hover table-striped table-condensed'>";
				  echo "<tr class='info'>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th class='hidden-xs'>Nombre de Escuela</th>";
					echo"<th class='visible-xs'>Nombre</th>";
					echo "<th class='hidden-xs'>Informe</th>";
					echo "<th class='visible-xs'>Inf</th>";
					echo "<th class='hidden-xs'>Ver Informes</th>";
					echo "<th class='visible-xs'>Ver</th>";
					echo "<th class='hidden-xs'>Ver Profesores Lectura</th>";
					echo "<th class='visible-xs'>Prof</th>";
					echo "</th>";
			 	echo "</tr>";
				$arreglo[]=array();
				$arreglo["0"]="0";
				$i=0;

				while ($fila = mysqli_fetch_object($resultado))
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




					$crearreferente=new Referente($fila->referenteId);
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();

			  		$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();

						/**
						 * Buscar director de la institución
						 * se guarda el objeto con dato en $datoDirector
						 */
						 $director = new Director(null,$fila->escuelaId);
						 $buscar_director= $director->buscar();
						 $datoDirector =mysqli_fetch_object($buscar_director);

						 if($datoDirector==NULL){
								$personaDirector= new Persona("1");
								$buscarPersona = $personaDirector->buscar();
								$datoDirector =mysqli_fetch_object($buscarPersona);
						 }


						 
							if($fila->supervisor_id==NULL){
								$personaSupervisor= new Persona("1");
							}else{
								$personaSupervisor= new Persona($fila->supervisor_id);
							}

							$buscar_supervisor=$personaSupervisor->buscar();
							$datoSupervisor=mysqli_fetch_object($buscar_supervisor);


							

			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>".$fila->nombre."</a></td>";

			  		

			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);



						$informe = new Informe(null,$fila->escuelaId);

						$refLectura = array('ETTPL','CPPL');
						$buscar_informe = $informe->buscar(null,null,$refLectura);

						$cant = mysqli_num_rows($buscar_informe);

						// nuevo
							//$profesor2 = new ProfeEdFisicaxEscuela(null,null,$fila->escuelaId);
							//$buscarProfesor=$profesor2->buscarProfesores();
							//$cantidadProfeEF=mysqli_num_rows($buscarProfesor);


						if($cant==0){

							echo "<td><a class='btn btn-danger' href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
										 Crear</a>&nbsp&nbsp</td><td><a class='btn btn-danger' href='#'>0</a></td>";
	          
						
	            echo "<td><a class='btn btn-primary btnDatosInst' role='button' id='btnDatosInst".$fila->escuelaId."' data-toggle='modal' data-target='#myModalDatosEsc".$fila->escuelaId."'>Datos Escuela </a></td>&nbsp&nbsp&nbsp";

						}else{
						 	echo "<td><a class='btn btn-success' href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
										 Crear</a></td>";
							echo  "<td><a class='btn btn-success' href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."&tipo=lectura'>$cant</a></td>";
							
						    echo "<td><a class='btn btn-primary btnDatosInst' role='button' id='btnDatosInst".$fila->escuelaId."' data-toggle='modal' data-target='#myModalDatosEsc".$fila->escuelaId."'>Datos Escuela </a></td>&nbsp&nbsp&nbsp";
						}




			  	   	echo "</tr>";
		  	  		
							///modal
							echo '<div class="modal fade" id="myModalDatosEsc'.$fila->escuelaId.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDatosEsc'.$fila->escuelaId.'">';
							echo'<div class="modal-dialog" role="document">';
							echo '<div class="modal-content">';
							echo '<div class="modal-header">';
							echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
							echo '<h4 class="modal-title" id="myModalLabelDatosEsc'.$fila->escuelaId.'"><b>'.$fila->numero.'&nbsp-&nbsp'.$fila->cue.'&nbsp-&nbsp'.$fila->nombre.'</b></h4>';
							echo '</div>';
							echo '<div class="modal-body">';
							echo '<h4><b>Datos Institución</b></h4>';
							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Dirección:&nbsp</b>'.$fila->domicilio.'</div>';
							echo '</div>';
							echo '<div class="row">';
							echo '<div class="col-md-5"><b>Localidad:&nbsp</b>'.$fila1->nombre.'</div>';

							echo '</div>';
							echo '<div class="row">';

							echo '<div class="col-md-12"><b>Nivel:&nbsp</b>'.$fila->nivel.'</div>';
							echo '</div>';

							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Teléfono:&nbsp</b>'.$fila->telefono.'</div>';
						  echo '</div>';
							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Email:&nbsp</b>'.$fila->email.'</div>';
							echo '</div>';
							echo '<br>';
              echo '<hr>';
							echo '<h4><b>Datos Directivo</b></h4>';

							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Apellido y Nombre:&nbsp</b>'.$datoDirector->apellido.', '.$datoDirector->nombre.'</div>';
							echo '</div>';
							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Teléfono:&nbsp</b>'.$datoDirector->telefonoM.' / '.$datoDirector->telefonoC.'</div>';
							echo '</div>';
							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Correo Electrónico:&nbsp</b>'.$datoDirector->email.'</b></div>';
							echo '</div>';


							echo '<hr>';

							echo '<h4><b>Datos Supervisor</b></h4>';
							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Apellido y Nombre:&nbsp</b>'.$datoSupervisor->apellido.', '.$datoSupervisor->nombre.'</div>';
							echo '</div>';
							echo '<div class="row">';
							echo '<div class="col-md-12"><b>Teléfono:&nbsp</b>'.$datoSupervisor->telefonoM.' / '.$datoSupervisor->telefonoC.'</div>';

							echo '</div>';
							echo '<div class="row">';

							echo '<div class="col-md-12"><b>Correo Electrónico:&nbsp</b>'.$datoSupervisor->email.'</div>';
							echo '</div>';

							echo '</div>';
							echo '<div class="modal-footer">';
							echo '<button type="button" class="btn btn-primary"  data-dismiss="modal">Cerrar</button>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';

										

							echo "</div>";
							echo "</div>";


							echo "</div>";
							
	      	}

	      	echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
			//}
		}else{
			$escuela=new Escuela(NULL);
		}
		
?>
</div>



<script type="text/javascript" src="jquery/jquery113.jsp"></script>
			<script language="javascript">
			$(document).ready(function(){
				//alert("llego hasta aqui");
				$('[id^=sel_]').hide();
				$('[id^=g_]').hide();
				//alert(boton);
				 $('[id^=b_]').click(function () {
					 $('#ref_'+$(this).val()).hide()

					 $('#sel_'+$(this).val()).show();

					 $('#b_'+$(this).val()).hide()
					 $('#g_'+$(this).val()).show()

					 	});
				//});

				 $('[id^=g_]').click(function () {
					 $('#ref_'+$(this).val()).show()

					 $('#sel_'+$(this).val()).hide();

					 $('#b_'+$(this).val()).show()
					 $('#g_'+$(this).val()).hide()

					 	
         			});

			});
</script>
