<?php
include_once("clases/persona.php");
include_once("clases/referente.php");

if(($_POST))
		{
			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
							
			$persona=new Persona(NULL,$apellido,$nombre);
			
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
echo "<th colspan='2'><input type='submit' value='Buscar'></th>"."\n";
echo "</tr>"."\n";
echo "<tr>"."\n";
echo "<th>Apellido</th>";
echo "<th>Nombre</th>";
echo "<th>Tipo</th>";
echo "<th>-</th>";
echo "<th>-</th>";	
echo "<th>-</th>";
echo "</tr>"."\n";
echo "</form>";
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
			echo "<td>".$fila2->tipo."</td>";
			echo "<td>";			
			echo "<form action='?men=escuelas&id=2&referenteId=".$fila2->referenteId."&escuelaId=".$_GET['escuelaId']."' method='post'>";
			echo '<button type="submit"> Seleccionar</button>';			
			echo "</td>";
			echo "</form>";			
			echo "\n";
			}
		}
	}
	
echo "</table>";
echo "</form>";

?>
