<?php
include_once("clases/persona.php");
include_once("clases/referente.php");

$personaId=$_POST["personaId"];
$apellido=$_POST["apellido"];
$nombre=$_POST["nombre"];
$dni=$_POST["dni"];
$cuil=$_POST["cuil"];
$telefonoC=$_POST["telefonoC"];
$telefonoM=$_POST["telefonoM"];
$direccion=$_POST["direccion"];
$email=$_POST["mail"];
$email2=$_POST["mail2"];
$facebook=$_POST["facebook"];
$twitter=$_POST["twitter"];
$localidadId=$_POST["localidadId"];
$cpostal=$_POST["cpostal"];

$referenteId=$_POST["referenteId"];
$tipo=$_POST["tipo"];
$rol=$_POST["rol"];
$etjcargo=$_POST["etjcargo"];
$fechaIngreso=$_POST["fechaIngreso"];
$titulo=$_POST["titulo"];

if(($_POST))
		{
			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
			$dni=$_POST["dni"];
			$cuil=$_POST["cuil"];
			$telefonoC=$_POST["telefonoC"];
			$telefonoM=$_POST["telefonoM"];
			$direccion=$_POST["direccion"];
			$email=$_POST["mail"];
			$email2=$_POST["mail2"];
			$facebook=$_POST["facebook"];
			$twitter=$_POST["twitter"];
			$localidadId=$_POST["localidadId"];
			$cpostal=$_POST["cpostal"];
			
			$persona=new Persona(NULL,$apellido,$nombre,$dni,$cuil,$telefonoC,$telefonoM,$direccion,$email,$email2,$facebook,$twitter,$localidadId,$cpostal);
			
		}
		else
		{
			$persona=new Persona(NULL);
			
		} 

echo "<form action='' method='POST'>";
echo "<table>";
echo "<tr>";
echo "<th><input type='text' name='apellido'></th>"."\n";
echo "<th><input type='text' name='nombre'></th>"."\n";
echo "<th><input type='text' name='dni'></th>"."\n";
//echo "<th><input type='text' name='email'></th>";
//echo "<th><input type='text' name='telefonoM'></th>";
//echo "<th><input type='text' name='telefonoC'></th>";
//echo "<th><input type='text' name='direccion'></th>";
//echo "<th><input type='text' name='facebook'></th>";	
echo "<th colspan='2'><input type='submit' value='Buscar'></th>"."\n";
echo "</tr>"."\n";
echo "<tr>"."\n";
echo "<th>Apellido</th>";
echo "<th>Nombre</th>";
echo "<th>DNI</th>";
echo "<th>Tipo</th>";
//echo "<th>Teléfono Movil</th>";
//echo "<th>Teléfono Colegio</th>";
//echo "<th>Dirección</th>";
//echo "<th>Facebook</th>";
echo "<th>-</th>";
echo "<th>-</th>";	
echo "<th>-</th>";
echo "</tr>"."\n";

$resultado = $persona->buscar();
					
while ($fila = mysqli_fetch_object($resultado))
	{
	$referente= new Referente(NULL,$fila->personaId);
	if($resultado2= $referente->buscar())
		{
		while ($fila2 = mysqli_fetch_object($resultado2))
			{
			echo "<tr>";
			echo "<td>".$fila->apellido."</td>";
			echo "<td>".$fila->nombre."</td>";
			echo "<td>".$fila->dni."</td>";
			echo "<td>".$fila2->tipo."</td>";
			echo "<td>"."<a href='index.php?men=referentes&id=2&personaId=".$fila2->personaId."&referenteId=".$fila2->referenteId."'>Ver más</a>"."</td>";		  
			echo "<td>"."<a href='index.php?men=referentes&id=3&personaId=".$fila2->personaId."&referenteId=".$fila2->referenteId."'>Editar</a>"."</td>";
			echo "<td>"."<a href='index.php?men=referentes&id=5&personaId=".$fila->personaId."'>Eliminar</a>"."</td>";
			echo "</tr>";
			echo "\n";
			}
		}
	}
	
echo "</table>";
echo "</form>";

?>
