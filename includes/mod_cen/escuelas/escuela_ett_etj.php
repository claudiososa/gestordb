<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/rtixescuela.php");
include_once("includes/mod_cen/clases/rti.php");


$referenteId=$_GET['referenteId'];
$referente= new Referente($referenteId);
$consulta= $referente->DatoPersona();
$datoref=mysqli_fetch_object($consulta);



$escuela= new Escuela(null,$referenteId);
$resultado = $escuela->Cargo();

	echo '<div class="table-responsive">';
	echo '<div class="container">';

	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo "<h4>Escuelas a Cargo de: ".$datoref->nombre.", ".$datoref->apellido."</h4>" ?>
		</div>
		<div class="panel-body">
			<?php
	//$fila=mysqli_fetch_object($resultado);
	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	//echo "<tr><th colspan='7'><h2>Escuelas a Cargo de: ".$datoref->nombre.", ".$datoref->apellido."</h2></th></tr>";
	echo "<thead>";
	echo "<tr ><th>CUE</th>";
	echo "<th>Nombre</th>";
	echo "<th>Nivel</th>";
	echo "<th>Localidad</th>";
	echo "<th>Piso</th>";
	echo "<th>RTI</th>";
	echo "<th>Informes</th>";

	//echo "<th>Editar</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
while ($fila = mysqli_fetch_object($resultado))
{

	$dato_rti=Rti::existeRtixinstitucion($fila->escuelaId);
	$rti=mysqli_num_rows($dato_rti);

	echo "<tr>";
	echo "<td>".$fila->cue."</td>";
	echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>".$fila->nombre."</a></td>";
	//echo "<td>".$fila->nombre."</td>";
	echo "<td>".$fila->nivel."</td>";
	$obj_local= new Localidad($fila->localidadId,null,null);
	$dato_local=$obj_local->buscar();
	$localidad=mysqli_fetch_object($dato_local);
	echo "<td>".$localidad->nombre."</td>";
	if($fila->nivel=="Primaria Común") {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=11&escuelaId=".$fila->escuelaId."'>ADM</a>"."</td>";
	}else {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=8&escuelaId=".$fila->escuelaId."'>Piso</a>"."</td>";
	}

	echo "<td>";
		if($rti>0)//Si existe rti para la escuela
		{
			echo "<a href='index.php?mod=slat&men=escuelas&id=17&escuelaId=".$fila->escuelaId."'>".$rti."</a>";
		}
		else
		{
			echo "0";
		}
		echo "</td>";

		$informe = new Informe(null,$fila->escuelaId);

		$buscar_informe = $informe->buscar();

		$cant = mysqli_num_rows($buscar_informe);

		//if($_SESSION["tipo"]=="ETT"){
			while ($fila1 = mysqli_fetch_object($buscar_informe)){
				$referente= new Referente($fila1->referenteId);
				$buscar_referente = $referente->buscar();
				$dato_referente = mysqli_fetch_object($buscar_referente);

				if($dato_referente->tipo=="Supervisor"){
					$cant=$cant-1;
				}
			}

		echo "<td><a href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
			 Crear</a>&nbsp&nbsp<a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";
			 //echo "<td><a href='index.php?mod=slat&men=informe&id=4&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";

		//}
	//echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>Ver</a>"."</td>";
	//echo "<td>"."<a href='index.php?men=escuelas&id=3&escuelaId=".$fila->escuelaId."'>Editar</a>"."</td>";
	echo "</tr>";
	echo "\n";
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
?>
<script type="text/javascript">
$(document).ready(function()
		{
				//$("#myTable").tablesorter();
				$("#myTable").tablesorter( {sortList: [[0,1]]} );
				//$("#myTable1").tablesorter();
				$("#myTable1").tablesorter( {sortList: [[0,1]]} );
		}
);
</script>
