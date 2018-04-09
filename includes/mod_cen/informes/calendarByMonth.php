<link rel="stylesheet" href="includes/mod_cen/informes/css/stylesCalendar.css">
 <link rel="stylesheet" href="includes/mod_cen/informes/css/stylesVisitaMensual.css"/>
 <script type="text/javascript"src="includes/mod_cen/informes/js/calendar.js"></script>
<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
$defecto=0;
if(isset($_POST["enviarMes"])){
	$defecto=$_POST["seleMes"];
//	var_dump($_POST);
}else{
	$defecto=date("n");
}

?>

<!--*********SELECT DE AÑO********-->


 <div class="container">
<br><br>
<!-- <div class="form-group"> -->
  <form class="form-inline" action="index.php?mod=slat&men=informe&id=9&ref=<?php echo $_GET['ref']?>" method="post" align="center">
    <div class="form-group">
      <label class="labelMes" for="seleMes">Seleccione Mes:</label>
    	<select class="form-control seleMes" name="seleMes">
    		<option value="1" <?php if ($defecto==1){echo "selected";}   ?>>Enero</option>
    		<option value="2" <?php if ($defecto==2){echo "selected";}  ?>>Febrero</option>
    		<option value="3" <?php if ($defecto==3){echo "selected";}  ?>>Marzo</option>
    		<option value="4" <?php if ($defecto==4){echo "selected";}  ?>>Abril</option>
    		<option value="5" <?php if ($defecto==5){echo "selected";}  ?>>Mayo</option>
    		<option value="6" <?php if ($defecto==6){echo "selected";}  ?>>Junio</option>
    		<option value="7" <?php if ($defecto==7){echo "selected";}  ?>>Julio</option>
    		<option value="8" <?php if ($defecto==8){echo "selected";}  ?>>Agosto</option>
    		<option value="9" <?php if ($defecto==9){echo "selected";}  ?>>Septiembre</option>
    		<option value="10" <?php if ($defecto==10){echo "selected";}  ?>>Octubre</option>
    		<option value="11" <?php if ($defecto==11){echo "selected";}  ?>>Noviembre</option>
    		<option value="12" <?php if ($defecto==12){echo "selected";}  ?>>Diciembre</option>

    	</select>
      <button type="submit" class="btn btn-default btnBuscar" name="enviarMes">&nbsp<span class="glyphicon glyphicon-search"></span>&nbsp</button>

    </div>

  </form>
<br><br>

<!-- <form class="" action="index.php?mod=slat&men=informe&id=9&ref=<?php echo $_GET['ref']?>" method="post">
	<label class="" for="seleMes">Seleccione Mes</label>
	<select class="form-control" name="seleMes">
		<option value="1" <?php if ($defecto==1){echo "selected";}   ?>>Enero</option>
		<option value="2" <?php if ($defecto==2){echo "selected";}  ?>>Febrero</option>
		<option value="3" <?php if ($defecto==3){echo "selected";}  ?>>Marzo</option>
		<option value="4" <?php if ($defecto==4){echo "selected";}  ?>>Abril</option>
		<option value="5" <?php if ($defecto==5){echo "selected";}  ?>>Mayo</option>
		<option value="6" <?php if ($defecto==6){echo "selected";}  ?>>Junio</option>
		<option value="7" <?php if ($defecto==7){echo "selected";}  ?>>Julio</option>
		<option value="8" <?php if ($defecto==8){echo "selected";}  ?>>Agosto</option>
		<option value="9" <?php if ($defecto==9){echo "selected";}  ?>>Septiembre</option>
		<option value="10" <?php if ($defecto==10){echo "selected";}  ?>>Octubre</option>
		<option value="11" <?php if ($defecto==11){echo "selected";}  ?>>Noviembre</option>
		<option value="12" <?php if ($defecto==12){echo "selected";}  ?>>Diciembre</option>

	</select>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviarMes" value="Ver">
	</div>

</form> -->

</div>
<!-- ****FIN SELECT AÑO**** -->

<div class="container">


<div class="container-fluid " id="containerStyle">
	<br>


<!-- #Container Principal# -->
<div class="container-fluid fluidXs">
<?php

if($defecto>0){
if(isset($_GET["ref"])){
	switch ($_GET["ref"]) {
		case 'etj':
			$ref= new Referente(null,null,null,null,null,null,null,"Activo");
			$buscar_ref=$ref->buscarRef(null,$_SESSION['referenteId']);
			break;
		case 'coordinador':
				$ref= new Referente(null,null,null,null,null,null,null,"Activo");
				$buscar_ref=$ref->buscarRef("ETT");			# code...
				break;
		defalt:
			# code...
			break;
	}


?>
	<?php

	$cantidadVisitas=0;  // cantidad de visitas realizada por el ETT en el Mes

	//_________________________________________________//
	// Recorrido de todos los referentes de Tipo ETT  //
	//_________________________________________________//
	while ($registro = mysqli_fetch_object($buscar_ref)) {

		$escuelas= new Escuela(null,$registro->referenteId); // buscamos las escuelas del ETT
		$buscarEscuelas=$escuelas->buscar();  // devuelve todos los datos de las escuelas del ETT
		$cantEscuelas=mysqli_num_rows($buscarEscuelas); // Guardamos la Cantidad de Escuelas de cada ETT

	    $referente=$registro->referenteId;  // guardamos en la variable $referente el referenteId del ETT

	$informeMesReferente = new Informe();
	// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
	$buscar_informe = $informeMesReferente->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);
  $totalvisitascabecera=mysqli_num_rows($buscar_informe);

	$lista = array();
  $lista2= array(); //array para guardar num de escuelas calendario
	$indice=0;
	$cantidadEscuelasVisitas=0;
	$escuelaInformeActual=0;

	//_________________________________________________//
	//  Recorrido de todos los informes del un mes y año determinado  //
	//  para un determinado ETT                        //
	//_________________________________________________//

	$cantidadEscuelasVisitadas=0;  // contador e indice del array de escuelas de agrupamiento propio
	//$escuelaInformeActual=0;
	$listaEscVisitadas=array();    // Array para guardar el numero de las escuelas  visitadas
	$listaEscOtroAgrup=array();    // Array para guardar el numero de las escuelas visitadas de otro agrupamiento
	$cantidadEscuelasOtroAgrup=0;  // contador e indice del array de escuelas de otro agrupamiento
	$VisitaOficina=0;              // contador de cantidad de visitas a la oficina


	while ($fila = mysqli_fetch_object($buscar_informe)) {
		$lista[$indice]=$fila->dia;
    $escuelaDatos= new Escuela($fila->escuelaId);//busca datos de escuela asociada al informe
    $escuelaBuscar =$escuelaDatos->buscar();
    $escuelaResultado= mysqli_fetch_object($escuelaBuscar);
    $lista2[$indice]=$escuelaResultado->numero;

		$indice++;

	    if($escuelaInformeActual <> $fila->escuelaId){

	    		$escuelaEtt = new Escuela($fila->escuelaId); // buscamos a quien le pertenece la escuela
	    		$escuelaEttResultado= $escuelaEtt->buscar();
	    		$datoEscuela = mysqli_fetch_object($escuelaEttResultado); // obtenemos datos de la escuela con el escuelaId ingresado

	    		if ($datoEscuela->referenteId == $referente) {  // preguntamos si la escuela es de su agrupamiento

	    			$listaEscVisitadas[$cantidadEscuelasVisitadas]=$datoEscuela->numero; // almacenamos el numero de c/u de las escuelas de su agrupamiento visitadas por el Referente.
			 	    $cantidadEscuelasVisitadas++;
	    		}else{
	    			    if ($datoEscuela->numero != 2) // preguntamos si la escuela es distinta de 660000000 (Oficina de Conectar Igualdad)
	    			    	{

	    			    	$listaEscOtroAgrup[$cantidadEscuelasOtroAgrup]=$datoEscuela->numero; // almacenamos el numero de la escuela visitada por el ETT.
			 	    		$cantidadEscuelasOtroAgrup++;
	    			    }

	    		}

		}
		$escuelaInformeActual=$fila->escuelaId;
		if ($fila->escuelaId == 2)
	    			    	{
	    			    	$VisitaOficina++;
	    			    }
		}


	# definimos los valores iniciales para nuestro calendario
	$monthActual=date("n");
	$month=$defecto;
	$year=date("Y");
	$diaActual=date("j");
	//echo $diaActual;
	# Obtenemos el dia de la semana del primer dia
	# Devuelve 0 para domingo, 6 para sabado
	$diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
	# Obtenemos el ultimo dia del mes
	$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
	"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	?>
	<!-- #inicio container fluid# -->
<div class="container-fluid">
	<div class="panel panel-default">
    <div class="row">
    <div class="panel-heading headPanel">
      <h4 align="center" class="h4 col-md-10 col-xs-10 h4Head" ><?php echo strtoupper($registro->apellido." ".$registro->nombre); ?></h4>
      <div class="col-md-2 col-xs-2" align="right"><span class='badge spanHead'><?php echo "$totalvisitascabecera"; ?></span></div>
    </div>
      </div>
    <div class="panel-body divOculto">
      <!-- aqui se oculta -->

			<hr class="hrStyle">

			<h4>&nbsp&nbsp&nbsp<img class="img-responsive"src="img/iconos/calendar/fecha.png">&nbsp&nbspDetalle mes <?php echo " de  ".$meses[$month]." de ".$year?></h4>
			<br>

			<div class="row">
				<!-- calendario -->
			 <div class="col-md-6 ">
					<div class="col-md-10 calendar">

					<table id="calendar" class="table table-bordered">
						<thead>
							<td colspan="7" class='mes'><?php echo $meses[$month]." ".$year?></td>
						</thead>
						<thead class='mes'>



							<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
							<th>Vie</th><th>Sab</th><th>Dom</th>
							</thead>
<tbody>


					<tr bgcolor="silver" style="display:none">
						<?php
						$last_cell=$diaSemana+$ultimoDiaMes;
						// hacemos un bucle hasta 42, que es el máximo de valores que puede
						// haber... 6 columnas de 7 dias
						for($i=0;$i<=49;$i++)
						{
							if($i==$diaSemana)
							{
								// determinamos en que dia empieza
								$day=1;
							}
							if($i<$diaSemana || $i>=$last_cell)
							{
								// celdas vacias que estan fuera de los rangos de los dias del mes
								echo "<td>&nbsp;</td>";
							}else{			// dentro del else trabajamos buscando dias de visitas
								$encontrado=0;
								$visitasxDias=0;  //contamos las visitas x dias
                $cant=0;//contador para array de num esc.calendario
                $data=" ";//se almacenan los n° de escuelas del array $lista2

								foreach ($lista as $valor) {
									if($day==$valor){
										//if($encontrado==0){
											$visitasxDias++;
                      $data.=$lista2[$cant].'<br>';
											//echo "<td class='hoy'>$day $visitasxDias</td>";
										//}
										$encontrado=1;
										$cantidadVisitas++;

										//breaK;
									}
                  $cant++;
								}
								if($encontrado ==0){
									echo "<td>$day</td>";
								}
								else{
									if ($visitasxDias == 1) {

										echo "<td class='mas' style='background-image: url(img/iconos/calendar/rosa.png); background-repeat: no-repeat;
                    background-size: contain;background-size: 100% 100%;'><a tabindex='0' role='button' data-container='body' data-trigger='focus' data-toggle='popover' data-placement='top'  title='Esc. visitadas el $day de $meses[$month] ($visitasxDias)' data-content='$data' >$day</a></td>";

  }else {
    if ($visitasxDias == 2){

									echo "<td class='hoy' style='background-image: url(img/iconos/calendar/lavanda.png);background-repeat: no-repeat;
  background-size: contain;background-size: 100% 100%;'><a tabindex='0' role='button' data-container='body' data-toggle='popover' data-placement='top' data-trigger='focus' title='Esc. visitadas el $day de $meses[$month] ($visitasxDias)' data-content='$data' >$day</a></td>";
                }else {
                  echo "<td class='mas' style='background-image: url(img/iconos/calendar/star.png); background-repeat: no-repeat;background-size: contain;background-size: 100% 100%;'><a tabindex='0' role='button' data-container='body' data-trigger='focus' data-toggle='popover' data-placement='top' title='Esc. visitadas el $day de $meses[$month] ($visitasxDias)' data-content='$data'  >$day</a></td>";

                }
          }
								}
								$day++;
							}
							// cuando llega al final de la semana, iniciamos una columna nueva
							if($i%7==0)
							{
								echo "</tr><tr>\n";
							}
						}


					?>
					</tr>
					</tbody>
				</table>
        <table class='table table-bordered'>
          <tbody>
            <tr>
              <td><img class='img-responsive' src="img/iconos/calendar/3.png" alt="ColorRosa">1 Visita&nbsp<img class='img-responsive' src="img/iconos/calendar/2.png" alt="ColorRosa">2 visitas&nbsp<img class='img-responsive' src="img/iconos/calendar/st.png" alt="ColorRosa">3 o más Visitas</td>

              <!-- <td> 1 escuela</td> -->
            </tr>


        </tbody>
        </table>
</div>
				</div>


				<!-- Info detallada -->
				<div class="col-md-6">
					<!-- lista 1 -->
					<ul class="list-group">
						<?php

			 					echo "<li class='list-group-item'><span class='badge btnEsc bstyle1' id='btnEsc".$referente."' data-toggle='modal' data-target='#myModalEsc".$referente."'>$cantEscuelas</span><img class='img-responsive' src='img/iconos/calendar/vieja-escuela.png'>&nbsp&nbsp&nbsp&nbsp&nbspEscuelas a Cargo</li>";

			 					echo "<li class='list-group-item'><span class='badge btnDatosInst bstyle1' id='btnDatosInst".$referente."' data-toggle='modal' data-target='#myModalDatosEsc".$referente."'>$cantidadEscuelasVisitadas</span><img class='img-responsive' src='img/iconos/calendar/marcador-de-posicion.png'>&nbsp&nbsp&nbsp&nbsp&nbspEscuelas Visitadas</li>";


			 					$cantEscNoVisitas=$cantEscuelas-$cantidadEscuelasVisitadas;

 								echo "<li class='list-group-item'><span class='badge btnEscNoVisitas bstyle2' id='btnEscNoVisitas".$referente."' data-toggle='modal' data-target='#myModalEscNoVisitas".$referente."'>$cantEscNoVisitas</span><img class='img-responsive' src='img/iconos/calendar/marcador-de-posicion (1).png'>&nbsp&nbsp&nbsp&nbsp&nbspEscuelas No Visitadas</li>";




					//  lista 2


						echo "<br>";

			 					echo "<li class='list-group-item'><span class='badge btnDatosOtroAgrup bstyle1' id='btnDatosOtroAgrup".$referente."' data-toggle='modal' data-target='#myModalEscOtroAgrup".$referente."'>$cantidadEscuelasOtroAgrup</span><img class='img-responsive' src='img/iconos/calendar/marcadores-de-posicion.png'>&nbsp&nbsp&nbsp&nbsp&nbspEscuelas Visitadas Otro Agrup.</li>";

			 					echo "<li class='list-group-item'><span class='badge btnDatosOficina bstyle1' id='btnDatosOficina".$referente."' data-toggle='modal' data-target='#myModalOficina".$referente."'>$VisitaOficina</span><img class='img-responsive' src='img/iconos/calendar/lugar-de-trabajo.png'>&nbsp&nbsp&nbsp&nbsp&nbspVisita Oficina / Sede</li>";

								echo "<br>";

			 					echo "<li class='list-group-item'><span class='badge bstyle2'>$cantidadVisitas</span><img class='img-responsive' src='img/iconos/calendar/positivo-simbolo-verificado.png'>&nbsp&nbsp&nbsp&nbsp&nbspTotal de Visitas</li>";
						?>

					</ul>

				</div>



			</div><!-- ./row-->


    </div> <!-- ./panel-body -->

  </div><!--./panel-default -->


</div> <!-- # ./container-fluid# -->



<!-- ************************************************** -->
<!--                  Ventanas Modales                  -->
<!-- ************************************************** -->



<!-- Empieza el modal Escuelas escuelas a cargo -->

 <?php

echo '<div class="modal fade" id="myModalEsc'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEsc'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas a Cargo <?php echo ($registro->apellido." ".$registro->nombre); ?></h4>
</div>

 <div class="modal-body">

         <?php

          $escuelasAcargo= new Escuela(null,$registro->referenteId);
	      $buscarEscuelasAcargo=$escuelas->buscar();  // devuelve todos los datos de la escuelas a Cargo

				echo "<table class='table table-bordered'>";
				echo "<thead>";
				echo "<td>Cue</td>";
				echo "<td>N°</td>";
				echo "<td>Nombre</td>";
				echo "</thead>";

          while ($filaEsc = mysqli_fetch_object($buscarEscuelasAcargo))
					  		{
echo "<tbody>";
									echo "<td>$filaEsc->cue</td>";
									echo "<td>$filaEsc->numero</td>";
									echo "<td>$filaEsc->nombre</td>";
									echo "</tbody>";

								//
								// 	echo $filaEsc->cue." - ".$filaEsc->numero." - ".$filaEsc->nombre." <br> ";
             				}

										echo "</table>";
	    ?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas a cargo -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->


 <!-- Empieza el modal Escuelas Visitadas -->

 <?php

echo '<div class="modal fade" id="myModalDatosEsc'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelDatosEsc'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas a Cargo Visitadas por  <?php echo ($registro->apellido." ".$registro->nombre); ?></h4>
</div>

 <div class="modal-body">

         <?php
				 echo "<table class='table table-bordered'>";
				 echo "<thead>";
				 echo"<td>Fecha</td>";
				 echo "<td>N° Escuela</td>";
				 echo "</thead>";

          	  foreach ($listaEscVisitadas as $escNum) {   // Listamos las escuelas visitadas de su agrupamiento

						$datoEscuela= new Escuela(null,null,null,$escNum);
						$resultado= $datoEscuela->buscar();
                		$objEscuela = mysqli_fetch_object($resultado);

		 	     		 //echo $objEscuela->numero." - ".$objEscuela->nombre."<br>";
                		$informeMesETT = new Informe();
					// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
						$buscar_informeETT = $informeMesETT->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);



          	  			while ($lista = mysqli_fetch_object($buscar_informeETT))
					  		{
					  			if ($objEscuela->escuelaId == $lista->escuelaId)
					  			{
										$originalDate = $lista->fechaVisita;
										$newDate = date("d/m/Y", strtotime($originalDate));
										echo "<tbody>";
										echo "<td>$newDate</td>";
										echo "<td>$objEscuela->numero</td>";
										echo "</tbody>";

					  			}
							}

					}
echo "</table>";
		?>

       </div>

<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas Visitadas -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->

   <!-- Empieza el modal Escuelas escuelas no Visitadas -->

 <?php

echo '<div class="modal fade" id="myModalEscNoVisitas'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEscNoVisitas'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas a Cargo No Visitadas <?php echo ($registro->apellido." ".$registro->nombre); ?></h4>
</div>

 <div class="modal-body">

         <?php
				 echo "<table class='table table-bordered'>";
				 echo "<thead>";
				 echo "<td>N°</td>";
				 echo "<td>Nombre</td>";
				 echo "</thead>";

          $escuelasAcargo= new Escuela(null,$registro->referenteId);
	      $buscarEscuelasAcargo=$escuelas->buscar();  // devuelve todos los datos de la escuelas a Cargo

          while ($filaEsc = mysqli_fetch_object($buscarEscuelasAcargo))
					  		{

					  			$visitada=0;
								foreach ($listaEscVisitadas as $escNum)
								{

											if ($escNum == $filaEsc->numero) {

												$visitada=1;

											}


					            }
					            if ($visitada == 0) {
												echo "<tbody>";
												echo "<td>$filaEsc->numero</td>";
												echo "<td>$filaEsc->nombre</td>";
												echo "</tbody>";


					            }
                          }
													echo "</table>";

	    ?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas No Visitadas -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->

  <!-- Empieza el modal Escuelas Visitadas de otro agrupamiento -->

 <?php

echo '<div class="modal fade" id="myModalEscOtroAgrup'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelEscOtroAgrup'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Escuelas Visitadas Otro Agrupamiento</h4>
</div>

 <div class="modal-body">

         <?php
				 echo "<table class='table table-bordered'>";
				 echo "<thead>";
				 echo "<td>Fecha</td>";
				 echo "<td>Nombre</td>";
				 echo "</thead>";


          	  foreach ($listaEscOtroAgrup as $escNum) {   // Listamos las escuelas visitadas de su agrupamiento

						$datoEscuela= new Escuela(null,null,null,$escNum);
						$resultado= $datoEscuela->buscar();
                		$objEscuela = mysqli_fetch_object($resultado);

		 	     		 //echo $objEscuela->numero." - ".$objEscuela->nombre."<br>";
                		$informeMesETT = new Informe();
					// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
						$buscar_informeETT = $informeMesETT->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);


          	  			while ($lista = mysqli_fetch_object($buscar_informeETT))
					  		{
					  			if ($objEscuela->escuelaId == $lista->escuelaId)
					  			{
										$originalDate = $lista->fechaVisita;
										$newDate = date("d/m/Y", strtotime($originalDate));
										echo "<tbody>";
										echo "<td>$newDate</td>";
										echo "<td>$objEscuela->numero</td>";
										echo "</tbody>";

					  			}
							}

						}
						echo "</table>";
			?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Escuelas Visitadas de otro agrupamiento -->


  <!-- ************************************************** -->
  <!-- ************************************************** -->
  <!--      Empieza el modal Visitas a la Oficina         -->

 <?php

echo '<div class="modal fade" id="myModalOficina'.$referente.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabelOficina'.$referente.'">';

 ?>

<div class="modal-dialog" role="document">
      <!-- Modal content-->
 <div class="modal-content">

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Visitas a Oficina / Sede </h4>
</div>

 <div class="modal-body">

         <?php
				 echo "<table class='table table-condensed'>";
				//  echo "<thead>";
				//  echo "<td></td>";
               		$informeMesETT = new Informe();
					// Buscamos los informes creados por el ETT en el mes que indiquemos en el año actual
						$buscar_informeETT = $informeMesETT->summary("mesAñoReferente",null,null,null,$defecto,"2018",null,$referente,null);


          	  			while ($lista = mysqli_fetch_object($buscar_informeETT))
					  		{
					  			if ($lista->escuelaId == 2)
					  			{
										echo "<tbody>";
										echo "<td>$lista->fechaVisita</td>";
										echo "<td>Oficina Conectar Igualdad / Sede</td>";
										echo "</tbody>";


					  			}
							}
							echo "</table>";
			?>

       </div>


<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>

    </div>

  </div> <!-- cierra Modal Visitas a Oficina -->

  <!-- ************************************************** -->
  <!--           Fin de Ventanas Modales                  -->
  <!-- ************************************************** -->


<?php

$cantidadVisitas=0;
}
?>

<!-- </div> -->
<?php }
//$defecto=0;
}
?>


</div><!-- #Fin Container Principal# -->
</div>
</div>
