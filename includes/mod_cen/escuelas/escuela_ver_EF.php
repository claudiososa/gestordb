
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

	<form class="form-horizontal" action='' method='POST'>
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2"><h3>Busqueda de Escuelas</h3></label>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Número</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
							<input type="text" size="4" class="form-control"  name="numero" placeholder="Ingrese número" autofocus>
					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">CUE</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
							<input type="text" size="4" class="form-control"  name="cue" placeholder="Ingrese CUE" autofocus>
					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Nombre</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
							<input type="text" size="4" class="form-control"  name="nombre" placeholder="Ingrese nombre" autofocus>
					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Departamento</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						 <?php
						 $departamento= new Departamentos();
								 $total=$departamento->getTotal();
								 echo "<select class='form-control' name='localidadId'>";
									 echo	"<option value='NULL'>Todos</option>";
								 for($val=2;$val<=$total;$val++) {
									 $departamento= new Departamentos($val);
									 $dato=$departamento->getDepartamento();
									 echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
									 }
								 echo "</select>";?>

					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Nivel</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
		       <select class='form-control' name="nivel">
						 <option value="0" label="Todos">Todos</option>
						 <option value="Sin registrar" label="Sin registrar">Sin registrar</option>
							 <option value="Primaria Común" label="Primaria Común">Primaria Común</option>
							 <option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>
							 <option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>
							 <option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>
							 <option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
							 <option value="ISFD" label="ISFD">ISFD</option>
							 <option value="IEM" label="IEM">IEM</option>
							 <option value="Capacitación" label="Capacitación">Capacitación</option>

				   </select>
			     </div>
		     </div>
	    </div>
    </div>

		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<input type='submit' class="btn btn-primary" value='Buscar'>
			</div>
		</div>

	</form>

</div>

<div class="container">


		<?php

if(($_POST))
	{
				//var_dump($_POST);
				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];
				$nivel=$_POST["nivel"];

				/*if($localidadId=="0"){
					$locadlidadId="NULL";
				}
				*/
				if($nivel=="0"){
				$nivel=NULL;
				}

				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,$nivel,$localidadId,null);



				$resultado = $escuela->buscar();



					echo "<div class='panel panel-primary'>";
					echo "<div class ='panel-heading'>Búsqueda de Escuelas</div>";
					echo "<div class='panel-body'>";
					echo "<div class='table-responsive'>";
					echo	"<table class='table table-hover table-striped table-condensed'>";
				  echo "<tr class='info'>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
					echo "<th>Nivel</th>";
			  	echo "<th>Localidad</th>";
					echo "<th>Informe</th>";
					echo "<th>Cant</th>";
					echo "<th>Ver Profesores</th>";
					echo "</th>";
			  //	echo "<th>Referente a Cargo</th>";
			  	//echo "<th></th>";
			  //	echo "<th>Ver</th>";
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
						 * se guarda el objeto con datso en $datoDirector
						 */
						 $director = new Director(null,$fila->escuelaId);
						 $buscar_director= $director->buscar();
						 $datoDirector =mysqli_fetch_object($buscar_director);

						 if($datoDirector==NULL){
								$personaDirector= new Persona("1");
								$buscarPersona = $personaDirector->buscar();
								$datoDirector =mysqli_fetch_object($buscarPersona);
						 }


						 /**
							* [$locali description]
							* @var Localidad
							*/
							//var_dump($fila->supervisor_id);
							if($fila->supervisor_id==NULL){
								$personaSupervisor= new Persona("1");
							}else{
								$personaSupervisor= new Persona($fila->supervisor_id);
							}

							$buscar_supervisor=$personaSupervisor->buscar();
							$datoSupervisor=mysqli_fetch_object($buscar_supervisor);




			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>"."<a href='index.php?mod=slat&men=admin&id=7&escuelaId=".$fila->escuelaId."'>".$fila->nombre."</a></td>";

			  		//echo "<td>".substr($fila->nombre,0, 40)."</td>";
            echo "<td>".$fila->nivel."</td>";
			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";


						$informe = new Informe(null,$fila->escuelaId);

						$buscar_informe = $informe->buscar();

						$cant = mysqli_num_rows($buscar_informe);

						if($cant==0){

							echo "<td><a class='btn btn-danger' href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
										 Crear</a>&nbsp&nbsp</td><td><a class='btn btn-danger' href='#'>0</a></td>";
	            echo "<td><a class='btn btn-primary botondesplegable' id=".$fila->escuelaId." role='button'>6</a></td>";
						}else{
						 	echo "<td><a class='btn btn-success' href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
										 Crear</a></td>";
							echo  "<td><a class='btn btn-success' href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>$cant</a></td>";
							echo "<td><a class='btn btn-primary botondesplegable' id=".$fila->escuelaId." role='button'>6</a></td>";
						}


//boton para ver profesores ed fisica

			  	   	echo "</tr>";
		  	  		echo "\n";

							echo "<tr class='ocultartr' id='panel".$fila->escuelaId."'>";
							echo "<td colspan=9>";
							echo "<div class='panel panel-primary' id='ocultar'>";
							echo "<div class='panel-heading'>Profesores Escuela: ".$fila->nombre."</div>";
							echo "<div class='panel-body'>";


              echo "<br>";
              echo "<a class='btn btn-primary btnDatosInst' role='button' id='btnDatosInst".$fila->escuelaId."'>Datos Escuela</a>&nbsp&nbsp&nbsp";
							echo "<a class='btn btn-primary' role='button' href='index.php?mod=slat&men=edFisica&id=1&escuelaId=".$fila->escuelaId."'>Nuevo Profesor</a>&nbsp&nbsp&nbsp";
							echo "<a class='btn btn-success' role='button' href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>Crear Informe Escuela</a>&nbsp&nbsp&nbsp";
							echo "<a class='btn btn-success' role='button' href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver Informes Escuela</a>";
							echo "<br>";
							echo "<br>";
							echo "<br>";



//contenido boton datos escuela
							echo "<div class='panel panel-default datosInst' id='datosInst".$fila->escuelaId."'>";
							echo "<div class='panel-body'>";

	 					  echo "<div><h4><b>".$fila->numero."&nbsp-&nbsp".$fila->cue."&nbsp-&nbsp".$fila->nombre."</b></h4></div>";

							echo "<div class='row'>";
							echo "<div class='col-md-6'><br>";
	            echo "<div><b>Datos de la Institución</b></div>";
						  echo "<hr>";
	 					  echo"<div><b>Localidad:&nbsp</b>".$fila1->nombre."</div>";

	 					  echo"<div><b>Dirección:&nbsp</b>".$fila->domicilio."</div>";

	 					  echo"<div><b>Teléfono:&nbsp</b>".$fila->telefono."</div>";

	 					  echo"<div><b>Email:&nbsp</b>".$fila->email."</div>";
	 					  echo "<br></div>";




						 echo "<div class='col-md-6'><br>";
						 echo "<div><b>Datos Directivo</b></div>";
						 echo "<hr>";

						 echo"<div><b>Apellido y Nombre:&nbsp</b>".$datoDirector->apellido.", ".$datoDirector->nombre."</div>";
						 echo"<div><b>Teléfono:&nbsp</b>".$datoDirector->telefonoM." / ".$datoDirector->telefonoC."</div>";
						 echo"<div><b>Correo Electrónico:&nbsp</b>".$datoDirector->email."</div>";

						 echo "<br></div>";
						 echo "</div>";//cierre row


						 // Salto
						 echo "<div class='row'>";
						 echo "<div class='col-md-6'><br>";
						 echo "<div><b>Datos Supervisor</b></div>";
						 echo "<hr>";
						 echo"<div><b>Apellido y Nombre:&nbsp</b>".$datoSupervisor->apellido.", ".$datoSupervisor->nombre."</div>";
	           echo"<div><b>Teléfono:&nbsp</b>".$datoSupervisor->telefonoM." / ".$datoSupervisor->telefonoC."</div>";
						 echo"<div><b>Correo Electrónico:&nbsp</b>".$datoSupervisor->email."</div>";
						 echo "<br></div>";



/*
						 echo "<div class='col-md-6'><br>";
						 echo "<div><b>Datos Directivo</b></div>";
						 echo "<hr>";

						 echo"<div><b>Apellido y Nombre:&nbsp</b>".$datoDirector->apellido.", ".$datoDirector->nombre."</div>";
						 echo"<div><b>Teléfono:&nbsp</b>".$datoDirector->telefonoM." / ".$datoDirector->telefonoC."</div>";
						 echo"<div><b>Correo Electrónico:&nbsp</b>".$datoDirector->email."</div>";

						 echo "<br></div>";*/
  					  echo "</div>";//cierre row

							echo "</div>";

							echo "</div>";	//final boton datos escuelas

							//subpanel de profesores

							echo "<div class='panel panel-primary' id ='subpanelprofesores'>";
							echo "<div class='panel-heading panelprof'><span class='panel-title clickable'><h5>Profesor Juan Perez<span class='pull-right clickable'><i class='glyphicon glyphicon-chevron-down'></i></span></h5></span></div>";
							echo "<div class='panel-body bodyprof'>";

              echo "<h4><b>Datos personales profesor juan:</b></h4>";
              echo "<p>holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>";
              echo "<hr>";
              echo "<h4><b>Cursos a cargo prof juan:</b></h4>";
              echo "<p>3°1°   2°4°</p>";
              echo "<hr>";
              echo "<h4><b>Carga horaria total:</b></h4>";
              echo "<p>20 horas semanales</p>";
							echo "<button class='btn btn-primary btnNuevoCurso' id='btnNuevoCurso".$fila->escuelaId."'>Asignar Nuevo Curso</button>";
							echo "<div class='col-md-12 formNewCourse'  id='formNewCourse".$fila->escuelaId."'>";
							 include('includes/mod_cen/formularios/f_HorarioNuevoCursoProf.php');
							 echo"</div>";

               echo"</div>";//panel-body subpanel profesores


							echo"</div>";// panel-primary subpanel profesores
							echo "</div>";
							echo "</div>";


							echo "</div>";
							echo "</div>";
							echo "</td>";
							echo "</tr>";
	      	}

	      	echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
			//}
		}else{
			$escuela=new Escuela(NULL);
		}
		//var venta= "<?php echo $_GET['registro']  ";
?>
</div>
<script type="text/javascript" src="includes/mod_cen/edFisica/js/botonesEF.js"></script>

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

					 	//var valor =$(this).val();
						//alert(valor);
				//		var detalle = $(this).val();
				//		$.post("includes/mod_cen/clases/c_productos.php", { detalle: detalle, venta: venta }, function(data){
				//			var resultado = JSON.parse(data);
				//			var dato = resultado['estado'];
				//			var total = resultado['total'];
				//			$('#'+dato).remove();
				//			$('#total').text("Total:    "+total);
         			});
				//});

				 $('[id^=g_]').click(function () {
					 $('#ref_'+$(this).val()).show()

					 $('#sel_'+$(this).val()).hide();

					 $('#b_'+$(this).val()).show()
					 $('#g_'+$(this).val()).hide()

					 	//var valor =$(this).val();
						//alert(valor);
				//		var detalle = $(this).val();
				//		$.post("includes/mod_cen/clases/c_productos.php", { detalle: detalle, venta: venta }, function(data){
				//			var resultado = JSON.parse(data);
				//			var dato = resultado['estado'];
				//			var total = resultado['total'];
				//			$('#'+dato).remove();
				//			$('#total').text("Total:    "+total);
         			});

			});
</script>
<!--
<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {
                               // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xlsx'],
		bootstrap: true             // (String[]), filetype(s) for the export, (default: ['xls', 'csv', 'txt'])

	});


-->
