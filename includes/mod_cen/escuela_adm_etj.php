<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/adm.php");
?>
<table>
	<?php 
			$c_adm= new Adm();			
			$b_adm= $c_adm->buscar();
			//echo "hola";
			//echo $c_adm->migrahuayra;		
			
			$dato_adm=mysqli_num_rows($b_adm);
			
			//$c_adm->
			 ?>
	<tr>
		<td>Cantidad de Escuelas con ADM</td>
		<td><?php echo $dato_adm; ?></td>
		<td>ADM Migración Completa</td><td><?php
			$c_adm->migrahuayra="Migrado Completo";
			$b_adm= $c_adm->buscar();
			$dato_adm=mysqli_num_rows($b_adm);			
			$c_adm->migrahuayra="";		
			echo $dato_adm;		 
		 ?></td><td>ADM sin migrar</td><td>
		<?php
			$c_adm->migrahuayra="Sin migrar";
			$b_adm= $c_adm->buscar();
			$dato_adm=mysqli_num_rows($b_adm);			
			$c_adm->migrahuayra="";		
			echo $dato_adm;			
?>					 
		 </td>
		<td>ADM Migración Incompleta</td><td>
		<?php
			$c_adm->migrahuayra="Migración Incomopleta";
			$b_adm= $c_adm->buscar();
			$dato_adm=mysqli_num_rows($b_adm);			
			$c_adm->migrahuayra="";		
			echo $dato_adm;			
?>					 
		 </td>		
	</tr>
	<tr><td colspan="8"><br></td></tr>
</table>
<table>
	<form action='' method='POST'>
	<tr><th>Número</th>
		 <th>Cue</th>
		 <th>Nombre</th>
		 <th>Departamento</th>
		 <th>Migración</th>		 
	</tr>
	<tr>
		<td><input type='text' name='numero' size="4"></td>
		<td><input type='text' name='cue'size="7"></td>
		<td><input type='text' name='nombre'></td>
		<td>
		<?php
		$departamento= new Departamentos();
				$total=$departamento->getTotal();
				echo "<select name='localidadId'>";
					echo	"<option value=0>Todos</option>";			
				for($val=2;$val<=$total;$val++) {
					$departamento= new Departamentos($val);
					$dato=$departamento->getDepartamento();
					echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
					}	
				echo "</select>";?>
		</td>
		<td>
				<select name="migraHuayra" >
							<option label="Todos" value="todos" >Todos</option>
							<option label="Sin migrar" value="Sin migrar" >Sin migrar</option>
							<option label="Migrado Completo" value="Migrado Completo" >Migrado Completo</option>
							<option label="Migrado Incompleto" value="Migrado Incompleto" >Migrado Incompleto</option>
							<option label="No requiere" value="No requiere" >No requiere</option>
				<select>				
		</td>
		<td colspan='3'><input type='submit' value='Buscar'></td></tr>
		</form>
</table>
		<?php 
	
if(($_POST))
	{							
				
				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];		
						
				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);
			
				$resultado = $escuela->buscar();						
				echo "<table>";
				echo "<tr>";
				echo "<th colspan=6> Busqueda > Estado de Migración > ".$_POST['migraHuayra']."</th>";
				echo "</tr>";
				echo "<tr>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
			  	echo "<th>Localidad</th>";
			  	echo "<th>Referente a Cargo</th>";
			  	echo "<th>Estado</th>";
			  	echo "<th>Ver</th>";
				echo "</tr>";
				while ($fila = mysqli_fetch_object($resultado)) 
				{
					
					$crearreferente=new Referente($fila->referenteId);			  		
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();
			  		
			  		$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();
					if($_POST['migraHuayra']=='todos') {
						$migrahuayra=null;
					}else{	
						$migrahuayra=$_POST['migraHuayra'];
					}		  		
			  		
			  		//echo $fila->escuelaId;
			  		$crearadm= new Adm(null,$fila->escuelaId,null,null,null,null,null,null,null,null,null,null,null,null,null,$migrahuayra,null);
			  		$buscaradm= $crearadm->buscar();
			  		while($dato=mysqli_fetch_object($buscaradm)) {
			  			echo "<td>".$fila->numero."</td>";
			  			echo "<td>".$fila->cue."</td>";
			  			echo "<td>".substr($fila->nombre,0, 40)."</td>";
			  			$locali=new Localidad($fila->localidadId,null);
			  			$busca_loc= $locali->buscar();
			  			$fila1=mysqli_fetch_object($busca_loc);
			  			echo "<td>".$fila1->nombre."</td>";
			  			echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$nombrePersona.", ".$apellidoPersona."</td>";
			  			echo "<td>".$dato->migrahuayra."</td>";
			  			echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=10&escuelaId=".$fila->escuelaId."'>Ver más</a>"."</td>";		  
			  			echo "</tr>";
		  	  			echo "\n";
		  	  		}
	      	}
	      	echo "</table>";
			//}
		}else{
			$escuela=new Escuela(NULL);
		}

?>