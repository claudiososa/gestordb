<?php
include_once("clases/persona.php");
include_once("clases/rti.php");
?>
<form action='' method='POST'>
<table>
	<tr><td>Apellidos</td>
		 <td>Nombres</td>
		 <td>DNI </td>
	</tr>
	<tr>
		<th><input type='text' name='apellido'></th>
		<th><input type='text' name='nombre'></th>
		<th><input type='text' name='dni'></th>		
		<th colspan='3'><input type='submit' value='Buscar'></th>
</form>
<?php	

if(($_POST))
		{
			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
			$dni=$_POST["dni"];
			$persona=new Persona(NULL,$apellido,$nombre,$dni);
			$resultado = $persona->buscar();
					
while ($fila = mysqli_fetch_object($resultado))
	{
	$rti= new Rti(NULL,$fila->personaId);
	if($resultado2= $rti->buscar())
		{
		while ($fila2 = mysqli_fetch_object($resultado2))
			{
			echo "<tr>";
			echo "<td>".$fila->apellido."</td>";
			echo "<td>".$fila->nombre."</td>";
			echo "<td>".$fila->dni."</td>";
			echo "<td>"."<a href='index.php?men=rtis&id=2&personaId=".$fila2->personaId."rtiId=".$fila2->rtiId."'>Ver</a>"."</td>";		  
			echo "<td>"."<a href='index.php?men=rtis&id=3&personaId=".$fila2->personaId."&rtiId=".$fila2->rtiId."'>Editar</a>"."</td>";
			echo "</tr>";
			echo "\n";
			}
		}
	}
			
		}
		else
		{
			$persona=new Persona(NULL);
			
		} 

	
echo "</table>";

?>
