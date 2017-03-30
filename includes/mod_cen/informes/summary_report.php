<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/persona.php");

require_once("includes/mod_cen/clases/leido.php");
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/respuesta.php");

//cantidad de informes totales
$informes = new Informe();
$buscar_informe = $informes->summary("año",null,null,null,null,"2017");
$cantidadInforme=mysqli_num_rows($buscar_informe);

//informes de un mes especifico
/*$fechaa = new DateTime(date("2017-02-1"));
$fecha1 = $fechaa->format("Y-m-d H:i:s");

$fechab = new DateTime(date("2017-02-22"));
$fecha2 = $fechab->format("Y-m-d H:i:s");*/
$meses=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_informe_mes = $informes->summary("mesAño",null,null,null,$i+1,"2017");
	$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);
	//var_dump($cantidadInformeMes);
  if($cantidadInformeMes==0){
		array_push($meses,'0');
	}else{
		array_push($meses,$cantidadInformeMes);
	}

}

$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);

//$buscar_informe_mes = $informes->summary(null,null,null,"1",null);

//cantidad de informes totales



////////////////////////////////////////////////////////////////////////////////////////
$leidos = new Leido();
$buscar_leidos_unicas_año=$leidos->summary("añoUnicos","DISTINCT","informeId",null,null,null,"2017");
$cantidadLeidoTotal=mysqli_num_rows($buscar_leidos_unicas_año);

//$buscar_leidos = $leidos->summary(null,"leidoId");
$buscar_leidos_unicas = $leidos->summary("totalLeidosUnicos","DISTINCT","informeId");

$cantidadLeidoUnicas=mysqli_num_rows($buscar_leidos_unicas);

$mesesLeido=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_leido = $leidos->summary("mesAño","DISTINCT","informeId",null,null,$i+1,"2017");
	$cantidadLeidoMes=mysqli_num_rows($buscar_mes_leido);
	//var_dump($cantidadInformeMes);
  if($cantidadLeidoMes==0){
		array_push($mesesLeido,'0');
	}else{
		array_push($mesesLeido,$cantidadLeidoMes);
	}

}
////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////

/*$respuestas = new Respuesta();
$buscar_respuestas = $respuestas->summary();
$cantidadRespuesta=mysqli_num_rows($buscar_respuestas);*/

$respuestas = new Respuesta();

//$buscar_respuesta = $respuestas->summary("añoUnicos","DISTINCT","informeId",null,null);
$buscar_respuestas_unicas = $respuestas->summary("añoUnicos","DISTINCT","informeId",null,null,null,"2017");

$cantidadRespuestaUnicas=mysqli_num_rows($buscar_respuestas_unicas);

$mesesRespuesta=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_respuesta = $respuestas->summary("mesAño","DISTINCT","informeId",null,null,$i+1,"2017");
	$cantidadRespuestaMes=mysqli_num_rows($buscar_mes_respuesta);
	//var_dump($cantidadInformeMes);
  if($cantidadRespuestaMes==0){
		array_push($mesesRespuesta,'0');
	}else{
		array_push($mesesRespuesta,$cantidadRespuestaMes);
	}

}
////////////////////////////////////////////////////////////////////////////////////////


echo '<div class="container">';
if ($cantidadInforme>0 || $cantidadRespuesta>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Resumen de Informes Año 2017 - Totales</h4>
		</div>
	<div class="panel-body">
	<table id='myTable' class='table table-hover table-striped table-condensed '>
		<thead>
			<tr>
				<th>Detalle</th>
				<th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th>
				<th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
				<th>Cant. Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Informes Creados</td>
			  	<?php
					foreach ($meses as $valor) {
						# code...
						echo "<td>$valor</td>";
					}
					//var_dump($meses); ?>
					<td><?php echo $cantidadInforme; ?></td>

			</tr>
			<tr>
				<td>Leidos</td>
				<?php
				foreach ($mesesLeido as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadLeidoTotal?></td>
			</tr>

			<tr>
				<td>Respuestas</td>
				<?php
				foreach ($mesesRespuesta as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadRespuestaUnicas ?></td>
			</tr>

		</tbody>
		</table>
		</div>
		</div>
<?php
}else{
	echo "No existe Informes para esta Institución";
}

/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953

$informes = new Informe();
$buscar_informe = $informes->summary("añoPrioridad",null,null,null,null,"2017","Alta");
$cantidadInforme=mysqli_num_rows($buscar_informe);

$meses=array();
for ($i=0; $i < 12; $i++) {

	$buscar_informe_mes = $informes->summary("mesAñoPrioridad",null,null,null,$i+1,"2017","Alta");
	$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);
	//var_dump($cantidadInformeMes);
  if($cantidadInformeMes==0){
		array_push($meses,'0');
	}else{
		array_push($meses,$cantidadInformeMes);
	}

}

$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);

////////////////////////////////////////////////////////////////////////////////////////
$leidos = new Leido();
//$buscar_leidos = $leidos->summary(null,"leidoId");
$buscar_leidos_unicas = $leidos->summary("añoUnicosPrioridad","DISTINCT","informeId",null,null,null,"2017","Alta");

$cantidadLeidosUnicos=mysqli_num_rows($buscar_leidos_unicas);

$mesesLeido=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_leido = $leidos->summary("mesAñoPrioridad","DISTINCT","informeId",null,null,$i+1,"2017","Alta");
	$cantidadLeidoMes=mysqli_num_rows($buscar_mes_leido);
	//var_dump($cantidadInformeMes);
  if($cantidadLeidoMes==0){
		array_push($mesesLeido,'0');
	}else{
		array_push($mesesLeido,$cantidadLeidoMes);
	}

}
////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////

$respuestas = new Respuesta();

//$buscar_respuesta = $respuestas->summary(null,"respuestaId");
$buscar_respuestas_unicas = $respuestas->summary("añoUnicosPrioridad","DISTINCT","informeId",null,null,null,"2017","Alta");

$cantidadRespuestaUnicas=mysqli_num_rows($buscar_respuestas_unicas);

$mesesRespuesta=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_respuesta = $respuestas->summary("mesAñoPrioridad","DISTINCT","informeId",null,null,$i+1,"2017","Alta");
	$cantidadRespuestaMes=mysqli_num_rows($buscar_mes_respuesta);
	//var_dump($cantidadInformeMes);
  if($cantidadRespuestaMes==0){
		array_push($mesesRespuesta,'0');
	}else{
		array_push($mesesRespuesta,$cantidadRespuestaMes);
	}

}

/////////////////////////////////////////
if ($cantidadInforme>0 || $cantidadRespuesta>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Resumen de Informes Año 2017 - por Prioridad Alta</h4>
		</div>
	<div class="panel-body">
	<table id='myTable' class='table table-hover table-striped table-condensed '>
		<thead>
			<tr>
				<th>Detalle</th>
				<th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th>
				<th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
				<th>Cant. Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Informes Creados</td>
			  	<?php
					foreach ($meses as $valor) {
						# code...
						echo "<td>$valor</td>";
					}
					//var_dump($meses); ?>
					<td><?php echo $cantidadInforme; ?></td>

			</tr>
			<tr>
				<td>Leidos</td>
				<?php
				foreach ($mesesLeido as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadLeidosUnicos ?></td>
			</tr>

			<tr>
				<td>Respuestas</td>
				<?php
				foreach ($mesesRespuesta as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadRespuestaUnicas ?></td>
			</tr>

		</tbody>
		</table>
		</div>
		</div>
<?php
}else{
	echo "No existe Informes para esta Institución";
}

/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953

$informes = new Informe();
$buscar_informe = $informes->summary("añoPrioridad",null,null,null,null,"2017","Media");
$cantidadInforme=mysqli_num_rows($buscar_informe);

$meses=array();
for ($i=0; $i < 12; $i++) {

	$buscar_informe_mes = $informes->summary("mesAñoPrioridad",null,null,null,$i+1,"2017","Media");
	$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);
	//var_dump($cantidadInformeMes);
  if($cantidadInformeMes==0){
		array_push($meses,'0');
	}else{
		array_push($meses,$cantidadInformeMes);
	}

}

$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);

////////////////////////////////////////////////////////////////////////////////////////
$leidos = new Leido();
//$buscar_leidos = $leidos->summary(null,"leidoId");
$buscar_leidos_unicas = $leidos->summary("añoUnicosPrioridad","DISTINCT","informeId",null,null,null,"2017","Media");

$cantidadLeidosUnicos=mysqli_num_rows($buscar_leidos_unicas);

$mesesLeido=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_leido = $leidos->summary("mesAñoPrioridad","DISTINCT","informeId",null,null,$i+1,"2017","Media");
	$cantidadLeidoMes=mysqli_num_rows($buscar_mes_leido);
	//var_dump($cantidadInformeMes);
  if($cantidadLeidoMes==0){
		array_push($mesesLeido,'0');
	}else{
		array_push($mesesLeido,$cantidadLeidoMes);
	}

}
////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////

$respuestas = new Respuesta();

//$buscar_respuesta = $respuestas->summary(null,"respuestaId");
$buscar_respuestas_unicas = $respuestas->summary("añoUnicosPrioridad","DISTINCT","informeId",null,null,null,"2017","Media");

$cantidadRespuestaUnicas=mysqli_num_rows($buscar_respuestas_unicas);

$mesesRespuesta=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_respuesta = $respuestas->summary("mesAñoPrioridad","DISTINCT","informeId",null,null,$i+1,"2017","Media");
	$cantidadRespuestaMes=mysqli_num_rows($buscar_mes_respuesta);
	//var_dump($cantidadInformeMes);
  if($cantidadRespuestaMes==0){
		array_push($mesesRespuesta,'0');
	}else{
		array_push($mesesRespuesta,$cantidadRespuestaMes);
	}

}

/////////////////////////////////////////
if ($cantidadInforme>0 || $cantidadRespuesta>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Resumen de Informes Año 2017 - por Prioridad Media</h4>
		</div>
	<div class="panel-body">
	<table id='myTable' class='table table-hover table-striped table-condensed '>
		<thead>
			<tr>
				<th>Detalle</th>
				<th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th>
				<th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
				<th>Cant. Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Informes Creados</td>
			  	<?php
					foreach ($meses as $valor) {
						# code...
						echo "<td>$valor</td>";
					}
					//var_dump($meses); ?>
					<td><?php echo $cantidadInforme; ?></td>

			</tr>
			<tr>
				<td>Leidos</td>
				<?php
				foreach ($mesesLeido as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadLeidosUnicos ?></td>
			</tr>

			<tr>
				<td>Respuestas</td>
				<?php
				foreach ($mesesRespuesta as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadRespuestaUnicas ?></td>
			</tr>

		</tbody>
		</table>
		</div>
		</div>
<?php
}else{
	echo "No existe Informes para esta Institución";
}

/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953
/////////////////////////////////////////////////////autopackage.273256953

$informes = new Informe();
$buscar_informe = $informes->summary("añoPrioridad",null,null,null,null,"2017","Normal");
$cantidadInforme=mysqli_num_rows($buscar_informe);

$meses=array();
for ($i=0; $i < 12; $i++) {

	$buscar_informe_mes = $informes->summary("mesAñoPrioridad",null,null,null,$i+1,"2017","Normal");
	$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);
	//var_dump($cantidadInformeMes);
  if($cantidadInformeMes==0){
		array_push($meses,'0');
	}else{
		array_push($meses,$cantidadInformeMes);
	}

}

$cantidadInformeMes=mysqli_num_rows($buscar_informe_mes);

////////////////////////////////////////////////////////////////////////////////////////
$leidos = new Leido();
//$buscar_leidos = $leidos->summary(null,"leidoId");
$buscar_leidos_unicas = $leidos->summary("añoUnicosPrioridad","DISTINCT","informeId",null,null,null,"2017","Normal");

$cantidadLeidosUnicos=mysqli_num_rows($buscar_leidos_unicas);

$mesesLeido=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_leido = $leidos->summary("mesAñoPrioridad","DISTINCT","informeId",null,null,$i+1,"2017","Normal");
	$cantidadLeidoMes=mysqli_num_rows($buscar_mes_leido);
	//var_dump($cantidadInformeMes);
  if($cantidadLeidoMes==0){
		array_push($mesesLeido,'0');
	}else{
		array_push($mesesLeido,$cantidadLeidoMes);
	}

}
////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////

$respuestas = new Respuesta();

//$buscar_respuesta = $respuestas->summary(null,"respuestaId");
$buscar_respuestas_unicas = $respuestas->summary("añoUnicosPrioridad","DISTINCT","informeId",null,null,null,"2017","Normal");

$cantidadRespuestaUnicas=mysqli_num_rows($buscar_respuestas_unicas);

$mesesRespuesta=array();
for ($i=0; $i < 12; $i++) {
	# code...

	$buscar_mes_respuesta = $respuestas->summary("mesAñoPrioridad","DISTINCT","informeId",null,null,$i+1,"2017","Normal");
	$cantidadRespuestaMes=mysqli_num_rows($buscar_mes_respuesta);
	//var_dump($cantidadInformeMes);
  if($cantidadRespuestaMes==0){
		array_push($mesesRespuesta,'0');
	}else{
		array_push($mesesRespuesta,$cantidadRespuestaMes);
	}

}

/////////////////////////////////////////
if ($cantidadInforme>0 || $cantidadRespuesta>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Resumen de Informes Año 2017 - por Prioridad Normal</h4>
		</div>
	<div class="panel-body">
	<table id='myTable' class='table table-hover table-striped table-condensed '>
		<thead>
			<tr>
				<th>Detalle</th>
				<th>Enero</th><th>Febrero</th><th>Marzo</th><th>Abril</th><th>Mayo</th><th>Junio</th><th>Julio</th>
				<th>Agosto</th><th>Septiembre</th><th>Octubre</th><th>Noviembre</th><th>Diciembre</th>
				<th>Cant. Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Informes Creados</td>
			  	<?php
					foreach ($meses as $valor) {
						# code...
						echo "<td>$valor</td>";
					}
					//var_dump($meses); ?>
					<td><?php echo $cantidadInforme; ?></td>

			</tr>
			<tr>
				<td>Leidos</td>
				<?php
				foreach ($mesesLeido as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadLeidosUnicos ?></td>
			</tr>

			<tr>
				<td>Respuestas</td>
				<?php
				foreach ($mesesRespuesta as $valor) {
					# code...
					echo "<td>$valor</td>";
				}
				?>
				<td><?php echo $cantidadRespuestaUnicas ?></td>
			</tr>

		</tbody>
		</table>
		</div>
		</div>
<?php
}else{
	echo "No existe Informes para esta Institución";
}
?>

</div>

<script type="text/javascript">
$(document).ready(function()
		{
			//$("#myTable").tablesorter();
			$("#myTable").tablesorter( {sortList: [[1,1]]} );
			//$("#myTable1").tablesorter();
			//$("#myTable1").tablesorter( {sortList: [[0,1]]} );
			//$("#informe_ett").tablesorter( {sortList: [[1,1]]} );
		}
);
</script>
