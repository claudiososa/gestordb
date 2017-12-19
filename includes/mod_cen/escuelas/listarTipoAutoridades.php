<?php
	
	include_once("includes/mod_cen/clases/TipoAutoridades.php");
		
	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='9'><h3>LISTADO DE TIPOS DE AUTORIDADES</h3></td></tr>";
	echo "<tr class='info'><td>TipoID</td>";
	echo "<td>Autoridad </td>";
	echo "<td>Nombre de Autoridad</td>";
	echo "<td>Estado de Login</td>";
	echo "<td>Accion</td>";
	echo "<td>Accion</td>";
	echo "</tr>";	
		
	

$tipoAutoridad = new TipoAutoridades();
      
      $resultado=$tipoAutoridad->buscar();
     

      while ($fila = mysqli_fetch_object($resultado))
      {

        	

      echo "<tr>";
      echo "<td>".$fila->tipoId."</td>";
       echo "<td>".$fila->tipoReferente."</td>";
      echo "<td>".$fila->cargoAutoridad."</td>";
     
      if ($fila->login==1) {
      	echo "<td> PERMITIDO</td>";

      } else {
      	
      	echo "<td> [- DENEGADO -]</td>";
      }
      
      echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=28&tipoId=$fila->tipoId&tipoReferente=$fila->tipoReferente&cargoAutoridad=$fila->cargoAutoridad&login=$fila->login'>MODIFICAR</a>"."</td>";
      //echo "<td>"."<a href='index.php?mod=slat&men=informe&id=15&subTipoId=$fila->subTipoId&tipoId=$fila->tipoId&nombre=$fila->nombre&descripcion=$fila->descripcion&estado=$fila->estado'>ELIMINAR</a>"."</td>";
      
     
      
      echo "</tr>";
      echo "\n";
 
          
      }

    

    
	echo "</table>";
	echo "</div>";
	echo "</div>";
?>