<?php
	include_once("clases/persona.php");
	include_once("clases/referente.php");
	
	$referenteId=$_SESSION['referenteId'];
	
	$referente= new Referente($referenteId);
	$resultado = $referente->Cargo();
	
	//$fila=mysqli_fetch_object($resultado);
	echo "<table>";
	echo "<tr><td colspan='5'><h1>Mis ETT</h1></td></tr>";
	echo "<tr><td>Apellidos</td>";
	echo "<td>Nombres</td>";
	echo "<td>A cargo</td>";
	echo "<td></td>";
	echo "<td></td>";
	echo "</tr>";	
		
	while ($fila = mysqli_fetch_object($resultado))
	{
		echo "<tr>";
		echo "<td>".$fila->apellido."</td>";
		echo "<td>".$fila->nombre."</td>";
		echo "<td>".$fila->tipo."</td>";
		echo "<td>"."<a href='index.php?men=user&id=5&referenteId=".$fila->referenteId."'>Escuelas</a>"."</td>";		  
		echo "<td>"."<a href='index.php?men=referentes&id=2&personaId=".$fila->personaId."&referenteId=".$fila->referenteId."'>Ver</a>"."</td>";		  
		//echo "<td>"."<a href='index.php?men=referentes&id=3&referenteId=".$fila->referenteId."'>Editar</a>"."</td>";
		echo "</tr>";
		echo "\n";
	}	
	echo "</table>";
?>