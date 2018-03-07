<?php

	include_once("includes/mod_cen/clases/Dispositivo.php");
	include_once("includes/mod_cen/clases/referente.php");
	include_once("includes/mod_cen/clases/persona.php");

   $dispositivo=new Dispositivo();
   $listado_disp=$dispositivo->buscar(null,null,"SMARTPHONE");
   $listado_disp2=$dispositivo->buscar(null,null,"SMARTPHONE"); 
   $cant=mysqli_num_rows($listado_disp2);   
	
    echo "cantidad de resultados: ". $cant;

	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='9'><h3>LISTADO DE ACCESO AL DBMS </h3></td></tr>";
	echo "<tr class='info'><td>AccesoID</td>";
	echo "<td>ReferenteId</td>";
	echo "<td>Fecha y Hora de Acceso</td>";
	echo "<td>Dispositivo Usado</td>";
	echo "<td>Perfil</td>";
	echo "</tr>";




      while ($fila = mysqli_fetch_object($listado_disp))
      {
      	

      echo "<tr>";
      echo "<td>".$fila->estadisAccesoId."</td>";
      echo "<td>".$fila->apellido.", ".$fila->nombre."</td>";
      echo "<td>".$fila->fechaHoraAcceso."</td>";
      echo "<td>".$fila->dispositivo."</td>";
      echo "<td>".$fila->tipo."</td>";
      echo "</tr>";
      echo "\n";


      }




	echo "</table>";
	echo "</div>";
	echo "</div>";

	
?>