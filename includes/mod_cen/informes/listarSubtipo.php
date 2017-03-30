<?php
	
	include_once("includes/mod_cen/clases/SubTipoInforme.php");
	include_once("includes/mod_cen/clases/persona.php");
	include_once("includes/mod_cen/clases/categoria.php");
	
	
	
	
	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='9'><h3>LISTADO DE SUB-CATEGORIAS</h3></td></tr>";
	echo "<tr class='info'><td>CategoriaID</td>";
	echo "<td>SubCategoriaID</td>";
	echo "<td>SubCategoria</td>";
	echo "<td>Descripcion</td>";
	echo "<td>Estado</td>";
	echo "<td>Modificado</td>";
	echo "<td>User Modif</td>";
	echo "<td>Accion</td>";
	echo "<td>Accion</td>";
	echo "</tr>";	
		
	
// aqui

$subtipo=new SubTipoInforme(NULL,NULL,NULL,NULL,NULL,NULL,NULL);
      
      $resultado=$subtipo->buscar();
     

      while ($fila = mysqli_fetch_object($resultado))
      {

        	

      echo "<tr>";
      echo "<td>".$fila->tipoId."</td>";
      echo "<td>".$fila->subTipoId."</td>";
      
      echo "<td>".$fila->nombre."</td>";
      echo "<td>".$fila->descripcion."</td>";
      echo "<td>".$fila->estado."</td>";
      echo "<td>".$fila->fechaModif."</td>";

//desde aqui

       
       $persona= new Persona($fila->userModif);
                    $buscar_persona=$persona->buscar();
                    $dato_persona=mysqli_fetch_object($buscar_persona);
                    $nomModif=$dato_persona->apellido." ".$dato_persona->nombre;

//hasta aqui
      echo "<td>".$nomModif."</td>";
     // echo "<td>".$fila->userModif."</td>";
      echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=13&subTipoId=$fila->subTipoId&tipoId=$fila->tipoId&nombre=$fila->nombre&descripcion=$fila->descripcion&estado=$fila->estado'>MODIFICAR</a>"."</td>";
      echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=14&subTipoId=$fila->subTipoId&tipoId=$fila->tipoId&nombre=$fila->nombre&descripcion=$fila->descripcion&estado=$fila->estado'>ELIMINAR</a>"."</td>";
      
     
      
      echo "</tr>";
      echo "\n";
 
          
      }

    

    
	echo "</table>";
	echo "</div>";
	echo "</div>";
?>