<?php
include_once("clases/escuela.php");
include_once("clases/referente.php");
include_once("clases/cargo.php");
$referenteId=$_SESSION['referenteId'];
$escuela= new Escuela(null,$referenteId);
$resultado = $escuela->Cargo();
	echo "<table>";
	echo "<tr><th colspan='6'><h1>Mis RTI</h1></th></tr>";
	echo "<tr><th>Escuela</th>"; 
	echo "<th>Turno</th>";
	echo "<th>Apellido y Nombre</th>";	
	echo "<th>Teléfono</th>";		
	echo "<th>ver</th>";
	echo "<th>Editar</th>";
	echo "</tr>";	
while ($fila = mysqli_fetch_object($resultado))
{
	//echo $fila->escuelaId;
	$cargo=new Cargo(null,null,$fila->escuelaId);
	$result=$cargo->Cargo();
	while($dato=mysqli_fetch_object($result)) {;
		$escu= new Escuela($dato->escuelaId);
		$infoescu=$escu->getContacto();
		echo "<tr>";
		echo "<td>".$infoescu->getNumero()."</td>";
		echo "<td>".$dato->turno."</td>";
		echo "<td>".$dato->apellido.", ".$dato->nombre."</td>";
		echo "<td>".$dato->telefonoM."</td>";
		echo "<td>"."<a href='index.php?men=rtis&id=2&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Ver</a>"."</td>";		  
		echo "<td>"."<a href='index.php?men=rtis&id=3&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Editar</a>"."</td>";
		echo "</tr>";
		echo "\n";	
	}
	
}	
echo "</table>";	
?>

