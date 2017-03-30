<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rtixescuela.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/rti.php");

$referenteId=$_SESSION['referenteId'];

//Crear objeto escuela y buscar las escuelas que tiene a cargo el Referente
$escuela= new Escuela(null,$referenteId);
$escuela_acargo=$escuela->buscar();

echo "<table>";
echo "<tr><th colspan='6'><h1>Mis RTI</h1></th></tr>";
echo "<tr><th>Escuela</th>";
echo "<th>Turno</th>";
echo "<th>Apellido y Nombre</th>";
echo "<th>Correo Electrónico</th>";
echo "<th>Teléfono 1</th>";
echo "<th>Teléfono 2</th>";
echo "<th>Turno</th>";
echo "<th>Editar</th>";
echo "</tr>";
//recorrido por las escuelas acargo del referente
while($fila=mysqli_fetch_object($escuela_acargo)){
	//echo $fila->escuelaId.$fila->nombre."<br><br>";
	//echo "_______________________<br>";
	$rtix= new rtixescuela($fila->escuelaId);
	
	$buscar_rti=$rtix->buscar();
	//var_dump($rtix);
	while($filarti=mysqli_fetch_object($buscar_rti)){
		
		
		$rti=new Rti($filarti->rtiId);
		$buscar_dato=$rti->buscar();
		
		
		while($filadato=mysqli_fetch_object($buscar_dato)){
			$persona= new Persona($filadato->personaId);
			$buscar_persona=$persona->buscar();
			$dato=mysqli_fetch_object($buscar_persona);
			echo "<tr>";
			echo "<td>".$fila->numero."</td>";
			echo "<td>".$fila->nombre."</td>";
			echo "<td>".$dato->apellido.", ".$dato->nombre."</td>";
			echo "<td>".$dato->email."</td>";				
			echo "<td>".$dato->telefonoM."</td>";
			echo "<td>".$dato->telefonoC."</td>";
				
			echo "<td>".$filarti->turno."</td>";
				
			//echo "<td>"."<a href='index.php?men=rtis&id=2&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Ver</a>"."</td>";
			//echo "<td>"."<a href='index.php?men=rtis&id=3&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Editar</a>"."</td>";
			echo "</tr>";
			echo "\n";
			
			
		
			//echo $filarti->escuelaId."-> ".$filarti->rtiId."<br>";
			//echo $dato->apellido."<br><br>";
		}
		
	}
	
}

echo "</table>";	
?>

