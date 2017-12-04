<?php
	
	//include_once("includes/mod_cen/clases/TipoAutoridades.php");
	include_once("includes/mod_cen/clases/Autoridades.php");

		
	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='12'><h3>LISTADO DE AUTORIDADES</h3></td></tr>";
	echo "<tr class='info'><td>AutoridadID</td>";
	echo "<td>EscuelaId</td>";
	echo "<td>Tipo de Autoridad</td>";
	echo "<td>PersonaId</td>";
	echo "<td>T. Mañana</td>";
	echo "<td>T. Intermedio</td>";
	echo "<td>T. Tarde</td>";
	echo "<td>T. Vespertino</td>";
	echo "<td>T. Noche</td>";
	echo "<td>J. Extendida</td>";
	echo "<td>Accion</td>";
	echo "<td>Accion</td>";
	echo "</tr>";	
		
	

$objautoridad = new Autoridades();
      
      $resultado=$objautoridad->buscar();
     

      while ($fila = mysqli_fetch_object($resultado))
      {

        	

      echo "<tr>";
      echo "<td>".$fila->autoridadesId."</td>";
      echo "<td>".$fila->escuelaId."</td>";
      echo "<td>".$fila->tipoAutoridadId."</td>";
      echo "<td>".$fila->personaId."</td>";
      echo "<td>".$fila->mañana."</td>";
      echo "<td>".$fila->intermedio."</td>";
      echo "<td>".$fila->tarde."</td>";
      echo "<td>".$fila->vespertino."</td>";
      echo "<td>".$fila->noche."</td>";
      echo "<td>".$fila->extendida."</td>";
     
      echo "<td> Modificar </td>";  
      echo "<td> Eliminar </td>";      
      //echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=28&tipoId=$fila->tipoId&cargoAutoridad=$fila->cargoAutoridad&login=$fila->login'>MODIFICAR</a>"."</td>";
      //echo "<td>"."<a href='index.php?mod=slat&men=informe&id=15&subTipoId=$fila->subTipoId&tipoId=$fila->tipoId&nombre=$fila->nombre&descripcion=$fila->descripcion&estado=$fila->estado'>ELIMINAR</a>"."</td>";
      
     
      
      echo "</tr>";
      echo "\n";
 
          
      }

    

    
	echo "</table>";
	echo "</div>";
	echo "</div>";
?>