<?php
include_once("includes/mod_cen/clases/encuentro.php");
include_once("includes/mod_cen/clases/ejes.php");

$refid=$_SESSION["referenteId"];
//echo $refid;

$encuentros= new Encuentro(null,$refid);

$result_cons1=$encuentros->buscar();

?>
<div id="tabla">
<table border="0">
      <h1>Lista de Encuentros</h1>
        <tr>
				<td>Nº Escuela</td>            
            <td>Tipo de Encuentro</td>
            <td>Número de Encuentro</td>
            <td>Sede o Escuela </td>
            <td>Fecha</td>
            <td>Horario</td>
            <td>Estado</td>
            <td>Asistentes</td>
            <td>Editar</td>
        </tr> 
        
        <?php while ($fila=mysqli_fetch_array($result_cons1)) 
			{
			$escuela=new Escuela($fila['enc_sede']);
			//echo $fila['enc_sede']."<br>";
			$enc_sede=$escuela->buscar();	
			$dato_sede=mysqli_fetch_object($enc_sede);
			
			$escuela1= new Escuela($fila['enc_nroesc']);
			$enc_nroid=$escuela1->buscar();
			$dato_nroid=mysqli_fetch_object($enc_nroid);
			
			$crear_eje= new Eje(null,$fila['enc_tipcapac']);
			$buscar_eje=$crear_eje->buscar();
			$nivel_eje=mysqli_fetch_object($buscar_eje);

			echo "<tr><td>".$dato_nroid->numero."</td>";          
         echo "<td>".$fila["enc_tipcapac"]."</td>";
		  	
		  	if($fila["enc_nroenc"]==1){
		     echo "<td>Primer encuentro</td>";}
			  else if ($fila["enc_nroenc"]==2)
			       echo "<td>Segundo encuentro</td>"; 
			    else
				   echo "<td>Tercer encuentro</td>";
		  echo "<td>".$dato_sede->nombre."</td>";
		  echo "<td>".$fila["enc_fch"]."</td>";
		  echo "<td>".$fila["enc_hsd"]."----".$fila["enc_hsh"]."</td>";
		  echo "<td>".$fila["enc_esta"]."</td>";
		  $total=$fila['enc_cantdire']+$fila['enc_cantdoc']+$fila['enc_cantrti']+$fila['enc_cantsup']+$fila['enc_cantpmi']+$fila['enc_canteqfor']+$fila['enc_cantetj'];
		  echo "<td>".$total."</td>";
		  //echo "<td>".$fila["ref_nroid"]."</td>";
		  if($nivel_eje->eje_pert=="Primaria") {
				echo "<td>"."<a href='index.php?mod=slat&men=encuentros&id=4&nroid=".$fila["enc_nroid"]."'>Editar</a>"."</td>";
        }elseif($nivel_eje->eje_pert=="Secundaria") {
        	   echo "<td>"."<a href='index.php?mod=slat&men=encuentros&id=4&secu=1&nroid=".$fila["enc_nroid"]."'>Editar</a>"."</td>";
        }
        echo "</tr>";
		  }
		  echo "</table>";
		  echo "</div>";  
		
  ?>


