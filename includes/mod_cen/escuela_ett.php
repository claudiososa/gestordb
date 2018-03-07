<?php
 
include_once("clases/escuela.php");
include_once("clases/referente.php");
include_once("clases/localidades.php");
include_once('clases/director.php');//Agregada Arredes
include_once('clases/supervisor.php');//Agregada Arredes
include_once('clases/rti.php');//Agregada Arredes
$referenteId=$_SESSION['referenteId'];
$escuela= new Escuela(null,$referenteId);
$resultado = $escuela->Cargo();
	echo "<table>";
	echo "<tr><th colspan='4'><h1>Mis Escuelas</h1></th></tr>";
	echo "<tr ><th>CUE</th>";
	echo "<th>Nombre</th>";
	echo "<th>Nivel</th>";
	echo "<th>Localidad</th>";
	echo "<th>Informe</th>";
	echo "<th>Piso</th>";
	echo "<th>Autoridad</th>";
	echo "<th>Supervisor</th>";
	echo "<th>RTI</th>";
	echo "<th>Editar</th>";
	echo "</tr>";	
while ($fila = mysqli_fetch_object($resultado))
{
	echo "<tr>";
	echo "<td>"."<a href='index.php?men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>".$fila->cue."</a></td>";	
	echo "<td>"."<a href='index.php?men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>".$fila->nombre."</a></td>";	
	echo "<td>".$fila->nivel."</td>";
	$obj_local= new Localidad($fila->localidadId,null,null);
	$dato_local=$obj_local->buscar();
	$localidad=mysqli_fetch_object($dato_local);
	echo "<td>".$localidad->nombre."</td>";
	echo "<td>"."<a href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>Crear</a>"."</td>";
	if($fila->nivel=="Primaria Común") {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=7&escuelaId=".$fila->escuelaId."'>ADM</a>"."</td>";
	}else {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=8&escuelaId=".$fila->escuelaId."'>Piso</a>"."</td>";
	}
	
	echo "<td>";
	$director= director::existeAutoridad($fila->escuelaId);
	$director2 = mysqli_fetch_object($director);
	$dato_supervisor=supervisor::existeSupervisor($fila->escuelaId);
	$supervisor=mysqli_fetch_object($dato_supervisor);
	$dato_rti=Rti::existeRtixinstitucion($fila->escuelaId);
	$rti=mysqli_num_rows($dato_rti);
	if(isset($director2->directorId)>0)//Si existe director
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=13&personaId=".$director2->personaId."&directorId=".$director2->directorId."&escuelaId=".$fila->escuelaId."'>".$director2->tipoautoridad."</a>";	
	}
	else
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=13&escuelaId=".$fila->escuelaId."' style='color:#F00; font-weight:bold' >Sin Autoridad</a>";	
	}
	echo "</td>";
	echo "<td>";
	if($supervisor->supervisor_id>0)//Si existe supervisor para la escuela
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=15&personaId=".$supervisor->supervisor_id."&escuelaId=".$fila->escuelaId."'>".$supervisor->apellido.",".$supervisor->nombre."</a>";	
	}
	else
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=15&escuelaId=".$fila->escuelaId."' style='color:#F00; font-weight:bold' >Sin Supervisor</a>";	
	}
	echo "</td>";
	echo "<td>";
	if($rti>0)//Si existe rti para la escuela
	{
		echo "<a href='index.php?mod=slat&men=referentes&id=8&escuelaId=".$fila->escuelaId."'>".$rti."</a>";	
	}
	else
	{
		echo "<a href='index.php?mod=slat&men=referentes&id=8&escuelaId=".$fila->escuelaId."' style='color:#F00; font-weight:bold' >0</a>";	
	}
	echo "</td>";	
	echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=3&escuelaId=".$fila->escuelaId."'>Editar</a>"."</td>";
	echo "</tr>";
	echo "\n";
	
}	
echo "</table>";	
?>

