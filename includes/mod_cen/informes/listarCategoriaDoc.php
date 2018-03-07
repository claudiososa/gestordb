<?php
	
	include_once("includes/mod_cen/clases/CategoriaDoc.php");
	include_once("includes/mod_cen/clases/PermisoCategoriaDoc.php");
	
	
	
	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='9'><h3>LISTADO DE CATEGORIAS DOCUMENTOS</h3></td></tr>";
	echo "<tr class='info'><td>CategoriaID</td>";
	echo "<td>Nombre</td>";
	echo "<td>Descripcion</td>";
	echo "<td>Permisos</td>";
	echo "<td>Accion</td>";
	echo "</tr>";	
		
	


$categoria_doc=new CategoriaDoc(NULL,NULL,NULL);
      
      $resultado=$categoria_doc->buscar();
     

      while ($fila = mysqli_fetch_object($resultado))
      {

        	

      echo "<tr>";
      echo "<td>".$fila->categoriaDocId."</td>";
      echo "<td>".$fila->nombreCategoria."</td>";
      echo "<td>".$fila->descripcionCategoria."</td>";
     
      
      $permiso_cat_doc = new PermisoCategoriaDoc(NULL,$fila->categoriaDocId,NULL); 
      $referente_permiso = $permiso_cat_doc->buscar();
      $permisos_cat="";

      while($fila2 = mysqli_fetch_object($referente_permiso))
		{
			$permisos_cat.= " ".$fila2->tipoReferente;
		}
   
      echo "<td>". $permisos_cat."</td>";
        
      echo "<td>"."<a href='index.php?mod=slat&men=informe&id=19&categoriaDocId=$fila->categoriaDocId&nombreCategoria=$fila->nombreCategoria&descripcionCategoria=$fila->descripcionCategoria&tipoReferente=$permisos_cat'>MODIFICAR</a>"."</td>";
     

     
      echo "</tr>";
      echo "\n";
 
          
      }

    

    
	echo "</table>";
	echo "</div>";
	echo "</div>";
?>