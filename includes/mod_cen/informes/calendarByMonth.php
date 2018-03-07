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
<div class="container">

<div class="form-group">


<form class="" action="index.php?mod=slat&men=informe&id=9&ref=<?php echo $_GET['ref']?>" method="post">
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

</form>

</div>
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
<style>
	#calendar {
		font-family:Arial;
		font-size:12px;

	}
	#calendar caption {
		text-align:left;
		padding:5px 8px;
		background-color:#000000;
		color:#fff;
		font-weight:bold;

	}
	#calendar th {
		text-align:center;
		background-color:#FE642E;
		padding:2px 4px;
		color:#fff;
		width:40px;
		border: 1px solid #FE642E;

	}
	#calendar td {
		text-align:right;
		padding:7px 14px;
		background-color:#D8D8D8;
		border: 1px solid #FE642E;
	}
	#calendar .hoy {
		background-color:#81F781;
	}
</style>

<div class="container">




<?php


$cantidadVisitas=0;

//_________________________________________________//
// Recorrido de todos los referentes de Tipo ETT  //
//_________________________________________________//
while ($registro = mysqli_fetch_object($buscar_ref)) {
	# code...


	$escuelas= new Escuela(null,$registro->referenteId);
	$buscarEscuelas=$escuelas->buscar();
	$cantEscuelas=mysqli_num_rows($buscarEscuelas);




 $referente=$registro->referenteId;

/*if (isset($_GET["referenteId"])>0) {

	$referente=$_GET["referenteId"];
}*/


$informeMesReferente = new Informe();
$buscar_informe = $informeMesReferente->summary("mesAñoReferente",null,null,null,$defecto,"2017",null,$referente,null);

$lista = array();
$indice=0;
$cantidadEscuelasVisitas=0;
$escuelaInformeActual=0;

//_________________________________________________//
//  Recorrido de todos los informes del un mes y año determinado  //
//  para un determinado referente                  //
//_________________________________________________//

$cantidadEscuelasVisitadas=0;
$escuelaInformeActual=0;
while ($fila = mysqli_fetch_object($buscar_informe)) {
	$lista[$indice]=$fila->dia;
	$indice++;
	if($escuelaInformeActual <> $fila->escuelaId){
		 	$cantidadEscuelasVisitadas++;
	}
	$escuelaInformeActual=$fila->escuelaId;
}

//$array_informe= mysqli_fetch_all($buscar_informe,MYSQLI_ASSOC);


//var_dump($lista);
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

<div class="row">


<div class="col-md-6">

		<div class="panel panel-primary">
			<div class="panel-heading">
			 <h5>Visitas de <?php echo strtoupper($registro->apellido." ".$registro->nombre); ?></h5>
			</div>
			<div class="panel-body">


		<table id="calendar">
		<caption><?php echo $meses[$month]." ".$year?></caption>
		<tr>
			<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
			<th>Vie</th><th>Sab</th><th>Dom</th>
		</tr>
		<tr bgcolor="silver">
			<?php
			$last_cell=$diaSemana+$ultimoDiaMes;
			// hacemos un bucle hasta 42, que es el máximo de valores que puede
			// haber... 6 columnas de 7 dias
			for($i=1;$i<=42;$i++)
			{
				if($i==$diaSemana)
				{
					// determinamos en que dia empieza
					$day=1;
				}
				if($i<$diaSemana || $i>=$last_cell)
				{
					// celca vacia
					echo "<td>&nbsp;</td>";
				}else{
					$encontrado=0;

					foreach ($lista as $valor) {
						if($day==$valor){
							if($encontrado==0){
								echo "<td class='hoy'>$day</td>";
							}
							$encontrado=1;
							$cantidadVisitas++;
							//breaK;
						}
					}
					if($encontrado==0){
						echo "<td>$day</td>";
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
	</table>

</div>
</div>
</div>
	<div class='col-md-6'>

		<div class="panel panel-primary">
			<div class="panel-heading">
			 <h5>Detalle hasta el día <?php echo $diaActual." de ".$meses[$monthActual]." de ".$year?> </h5>
			</div>
			<div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item list-group-item-info">Escuelas a Cargo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="btn btn-primary">	<?php echo $cantEscuelas ?></li></a>
				  <li class="list-group-item list-group-item-info">Escuelas Visitadas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<a href="#" class="btn btn-success">	<?php echo $cantidadEscuelasVisitadas ?></li></a>
				  <li class="list-group-item list-group-item-info">Escuelas No Visitadas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<a href="#" class="btn btn-danger">	<?php echo $cantEscuelas-$cantidadEscuelasVisitadas ?></li></a>
				  <li class="list-group-item list-group-item-info">Cant. Visitadas realizadas	<a href="#" class="btn btn-primary">	<?php echo $cantidadVisitas ?></li></a>
				</ul>
			</div>
</div>
</div>
</div>


<?php
$cantidadVisitas=0;
} ?>

</div>
<?php }
//$defecto=0;
}
?>
