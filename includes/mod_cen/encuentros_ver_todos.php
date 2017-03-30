<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/encuentro.php");
?>
<table>
	<h1>Ver Encuentros</h1>				 
	<tr><td colspan="8"><br></td></tr>
</table>
<table>
	<form action='' method='POST'>
	<tr><th>Número</th>
		 <th>Cue</th>
		 <th>Nombre</th>
		 <th>Departamento</th>
		 <th>Tipo</th>
		 <th>Estado</th>	
		 <th>Nº Encuentro</th>	 
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
		<?php 
		//$estructura= new Encuentro();
  		$datotipo= Encuentro::estructura('enc_tipcapac');
		echo '<select name="enc_tipcapac">';
		echo '<option value="todos">Todos</option>';
		
  		foreach ($datotipo AS $valor) 
				echo "<option value='$valor'>$valor</option>";				  							
  		echo '</select>';
  		?>					
		</td>
		<td>
		<?php 
		$estructura= new Encuentro();
  		$datocampo= $estructura->estructura('enc_esta');
		echo '<select name="enc_esta">';
		echo '<option value="todos">Todos</option>';
  		foreach ($datocampo AS $valor) 
				echo "<option value='$valor'>$valor</option>";				  							
  		echo '</select>';
  		?>					
		</td>
		<td>
		    <select name="enc_nroenc">
		         <option value="0">Todos</option>
               <option value="1">Primer Encuentro</option>
               <option value="2">Segundo Encuentro</option>
               <option value="3">Tercer Encuentro</option>
           </select>
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
				$enc_tipcapac=$_POST['enc_tipcapac'];	
				$enc_nroenc=$_POST['enc_nroenc'];
				
				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);
			
				$resultado = $escuela->buscar();						
				echo "<table>";
				echo "<tr>";
				echo "<th colspan=6><h1>Busqueda > Estado > ".$_POST['enc_esta']." > ".$_POST['enc_tipcapac']."</h1></th>";
				echo "</tr>";
				echo "<tr>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
			  	echo "<th>Localidad</th>";
			  	echo "<th>Referente a Cargo</th>";
			  	echo "<th>Tipo</th>";
			  	echo "<th>Estado</th>";
			  	echo "<th>Fecha</th>";
			  	echo "<th>Ver</th>";
				echo "</tr>";
				while ($fila = mysqli_fetch_object($resultado)) 
				{
					
					/*$crearreferente=new Referente($fila->referenteId);			  		
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();*/
			  		
			  		/*$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();*/
			  		if($_POST['enc_esta']=='todos') {
			  			$enc_esta=null;
			  			//echo "todos ------";		
			  		}else {
						$enc_esta=$_POST['enc_esta'];			  		
			  		}	
			  		if($enc_nroenc=='0') {
			  			$enc_nroenc=null;		
			  		}
			  		if($_POST['enc_tipcapac']=='todos') {
			  			$enc_tipcapac=null;		
			  		}
			  			
			  		//  		$crear_encuentro= new Encuentro(null,null,$enc_tipcapac,$enc_nroenc,null,null,$fila->escuelaId,null,null,null);
			  		
			  		$crear_encuentro= new Encuentro(null,null,$enc_tipcapac,$enc_nroenc,null,null,$fila->escuelaId,null,null,$enc_esta);
			  		//echo $fila->escuelaId;

			  		$buscar_encuentro= $crear_encuentro->buscar();
			  		while($dato=mysqli_fetch_object($buscar_encuentro)) {
						
						$crearreferente=new Referente($dato->ref_nroid);			  		
			  			$traerreferente= $crearreferente->getContacto();
			  			$r_personaId=$traerreferente->getPersonaId();			  			
			  			
			  			$crearPersona=new Persona($r_personaId);
			  			$traerPersona=$crearPersona->getContacto();
			  			$nombrePersona= $traerPersona->getNombre();
			  			$apellidoPersona= $traerPersona->getApellido();
			  			$persona=$traerPersona->getPersonaId();
			  			echo "<td>".$fila->numero."</td>";
			  			echo "<td>".$fila->cue."</td>";
			  			echo "<td>".substr($fila->nombre,0, 40)."</td>";
			  			$locali=new Localidad($fila->localidadId,null);
			  			$busca_loc= $locali->buscar();
			  			$fila1=mysqli_fetch_object($busca_loc);
			  			echo "<td>".$fila1->nombre."</td>";
			  			echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$dato->ref_nroid."'>".$nombrePersona.", ".$apellidoPersona."</td>";
			  			echo "<td>".$dato->enc_tipcapac."</td>";
			  			echo "<td>".$dato->enc_esta."</td>";
			  			echo "<td>".$dato->enc_fch."</td>";
			  			echo "<td>"."<a href='index.php?mod=slat&men=encuentros&id=6&nroid=".$dato->enc_nroid."'>Ver más</a></td>";		  
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