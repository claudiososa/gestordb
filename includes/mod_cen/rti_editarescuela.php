<?php

include_once("clases/persona.php");
include_once("clases/escuela.php");
include_once("clases/rti.php");
include_once("clases/cargo.php");

if ($_POST['personaA']){
	$persona = stripcslashes($_POST['personaA']);
	$rti = stripcslashes($_POST['rtiA']);
	$escuelaVieja = $_POST['escuelaA'];
	$numescuela = $_GET['numesc'];
	
	
	$aux=1;
    while($aux <= $numescuela){
			$nom = "cargo$aux";
			$$nom = stripcslashes($_POST['cargo'.$aux]);
			$aux = $aux +1;
			}
	
}

if ($_POST['personaId']){
			$personaId=$_POST["personaId"];
			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
			$dni=$_POST["dni"];
			$cuil=$_POST["cuil"];
			$telefonoC=$_POST["telefonoC"];
			$telefonoM=$_POST["telefonoM"];
			$direccion=$_POST["direccion"];
			$email=$_POST["email"];
			$email2=$_POST["email2"];
			$facebook=$_POST["facebook"];
			$twitter=$_POST["twitter"];
			$localidadId=$_POST["localidadId"];
			$cpostal=$_POST["cpostal"];
			
			$rtiId=$_POST["rtiId"];
			$titulo=$_POST["titulo"];
			$capacitacionTec=$_POST["capacitacionTec"];
			$capacitacionPed=$_POST["capacitacionPed"];
			
			$numescuela = $_POST['numescuela'];
			$escuelaVieja= $_GET['esc'];
			
			$aux = 1;

			while($aux <= $numescuela){
			$nombreC = "cargo$aux";
			$cargoId = $_POST['cargoId'.$aux];
			$escuelaId = $_POST['escuelaId'.$aux];
			$turno = $_POST['turno'.$aux];
			$cargo = new Cargo($cargoId, $rtiId, $escuelaId, $turno);
			$$nombreC=addslashes( serialize($cargo) );
			$aux = $aux +1;
			}
			
			$persona = new Persona($personaId,$apellido,$nombre,$dni,$cuil,$telefonoC,$telefonoM,$direccion,$email,$email2,$facebook,$twitter,$localidadId,$cpostal);
			$rti = new Rti($rtiId,$personaId,$titulo,$capacitacionTec,$capacitacionPed);
			
			$persona= addslashes( serialize($persona) );
			$rti= addslashes( serialize($rti) );
		}
		
if($_POST){
			
			$cue=$_POST["cue2"];
			$numero=$_POST["numero2"];
			$nombre=$_POST["nombre2"];
			
			$escuela=new Escuela(NULL,NULL,$cue,$numero,$nombre);
			
		}
		else
		{
			$escuela=new Escuela(NULL);
		}
?>		
		

<form action='index.php?men=rtis&id=6&numesc=<?php echo $numescuela ?>' method='POST'>
<table>
<tr>
<th><input type='text' name='numero2'></th>
<th><input type='text' name='nombre2'></th>
<th><input type='text' name='cue2'></th>

	
<th colspan='2'><input type='submit' value='Buscar'></th>
</tr>
<tr>
<th>Numero</th>
<th>Nombre</th>
<th>CUE</th>

<th>-</th>
<th>-</th>
</tr>
<?php
if ($resultado = $escuela->buscar()) {
	while ($fila = mysqli_fetch_object($resultado)) {
		  echo "<tr>"."\n";
		  echo "<td>".$fila->numero."</td>"."\n";
		  echo "<td>".$fila->nombre."</td>"."\n";
		  echo "<td>".$fila->cue."</td>"."\n";
	
		  echo "<td> <button type='submit' name='boton2' formaction='index.php?men=rtis&id=3&esc=".$fila->escuelaId."&numesc=".$numescuela."'>Editar</button> </td>"."\n";
		  echo "</tr>"."\n";
       
    }
    }
    
    $aux=1;
    while($aux <= $numescuela){
			$nombre = "cargo$aux";
			echo '<input type=\'hidden\' name=\'cargo'.$aux.'\' value=\''.$$nombre.'\' />'."\n";
			$aux = $aux +1;
			}
			
?>
<input type="hidden" name='personaA' value='<?php echo $persona ?>'/>
<input type="hidden" name='rtiA' value='<?php echo $rti ?>'/>
<input type="hidden" name='escuelaA' value='<?php echo $escuelaVieja ?>'/>		    		    
</table>
</form>

    

