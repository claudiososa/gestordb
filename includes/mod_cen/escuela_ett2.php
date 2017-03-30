<?php
include_once("clases/escuela.php");
include_once("clases/referente.php");
include_once("clases/localidades.php");


$referenteId=$_SESSION['referenteId'];
$escuela= new Escuela(null,$referenteId);
$resultado = $escuela->Cargo();
//$fila=mysqli_fetch_object($resultado);
	echo "<table>";
	echo "<tr><th colspan='4'><h1>Mis Escuelas</h1></th></tr>";
	echo "<tr ><th>CUE</th>";
	echo "<th>Nombre</th>";
	echo "<th>Nivel</th>";
	echo "<th>Localidad</th>";
	echo "<th>Piso</th>";
	echo "<th>ver</th>";
	echo "<th>Editar</th>";
	echo "</tr>";	
while ($fila = mysqli_fetch_object($resultado))
{
	echo "<tr>";
	echo "<td>".$fila->cue."</td>";
	echo "<td>".$fila->nombre."</td>";
	echo "<td>".$fila->nivel."</td>";
	$obj_local= new Localidad($fila->localidadId,null,null);
	$dato_local=$obj_local->buscar();
	$localidad=mysqli_fetch_object($dato_local);
	echo "<td>".$localidad->nombre."</td>";
	if($fila->nivel=="Primaria Común") {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=7&escuelaId=".$fila->escuelaId."'>ADM</a>"."</td>";		  
	}else {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=8&escuelaId=".$fila->escuelaId."'>Piso</a>"."</td>";		  		
	}
	echo "<td>"."<a href='index.php?men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>Ver</a>"."</td>";		  
	echo "<td>"."<a href='index.php?men=escuelas&id=3&escuelaId=".$fila->escuelaId."'>Editar</a>"."</td>";
	echo "</tr>";
	echo "\n";
	
}	
echo "</table>";	
?>

