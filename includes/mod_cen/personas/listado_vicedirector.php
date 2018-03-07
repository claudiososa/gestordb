<?php


	include_once("includes/mod_cen/clases/persona.php");
	//include_once("includes/mod_cen/clases/categoria.php");
	include_once("includes/mod_cen/clases/vicedirector.php");



	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='9'><h3>LISTADO DE VICE-DIRECTOR</h3></td></tr>";
	echo "<tr class='info'><td>Vice-ID</td>";
	echo "<td>Escuela-ID</td>";
	echo "<td>Persona-ID</td>";
	echo "<td>Turno</td>";
	echo "<td>Modificado</td>";
	echo "<td>User Modif</td>";
	echo "<td>Accion</td>";
	echo "<td>Accion</td>";
	echo "</tr>";



$vice= new ViceDirector();

      $resultado=$vice->buscar();
     
      
      while ($fila = $resultado->fetchobject()){
    

        

      echo "<tr>";
      echo "<td>".$fila->vicedirectorId."</td>";
      echo "<td>".$fila->escuelaId."</td>";
      echo "<td>".$fila->personaId."</td>";
      echo "<td>".$fila->turno."</td>";
      echo "<td>".$fila->fechaModif."</td>";



       $persona= new Persona($fila->userModif);
                    $buscar_persona=$persona->buscar();
                    $dato_persona=mysqli_fetch_object($buscar_persona);
                    $nomModif=$dato_persona->apellido." ".$dato_persona->nombre;


      echo "<td>".$nomModif."</td>";

      echo "<td>"."<a href='index.php?mod=slat&men=personas&id=10&vicedirectorId=$fila->vicedirectorId&escuelaId=$fila->escuelaId&personaId=$fila->personaId&turno=$fila->turno'>MODIFICAR</a>"."</td>";

      echo "<td>"."<a href='index.php?mod=slat&men=personas&id=11&vicedirectorId=$fila->vicedirectorId&escuelaId=$fila->escuelaId&personaId=$fila->personaId&turno=$fila->turno'>ELIMINAR</a>"."</td>";



      echo "</tr>";
      echo "\n";


      } 

    


	echo "</table>";
	echo "</div>";
	echo "</div>";
?>
