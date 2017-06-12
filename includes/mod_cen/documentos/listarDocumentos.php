<?php

	include_once("includes/mod_cen/clases/CategoriaDoc.php");
	include_once("includes/mod_cen/clases/Documento.php");
	include_once("includes/mod_cen/clases/PermisoDoc.php");




	echo '<div class="table-responsive">';
	echo '<div class="container">';
	echo "<table class='table table-hover table-striped table-condensed '>";
	echo "<tr><td colspan='9'><h3>LISTADO DE DOCUMENTOS</h3></td></tr>";
	echo "<tr class='info'><td>ID</td>";
	echo "<td>CategoriaDoc</td>";
	echo "<td>Nombre de Archivo</td>";
	echo "<td>Titulo</td>";
	echo "<td>Descripcion</td>";
	echo "<td>Destacado</td>";
	echo "<td>Permisos</td>";
	echo "<td>Accion</td>";
	echo "</tr>";

	    $doc=new Documento();

      $listado_doc=$doc->buscar();


      while ($fila = mysqli_fetch_object($listado_doc))
      {


      echo "<tr>";
      echo "<td>".$fila->documentoId."</td>";

      // buscamos el nombre de la categoria a la que pertenece el documento
    $categoria_doc = new CategoriaDoc($fila->categoriaDocId,null,null);
    $resultado = $categoria_doc->buscar();
    $filaResultado = mysqli_fetch_object($resultado);
		//var_dump($filaResultado);
      echo "<td>".$filaResultado->nombreCategoria."</td>";  // nombre de la categoria a la que pertenece
      echo "<td>".$fila->nombreArchivo."</td>";
      echo "<td>".$fila->titulo."</td>";
      echo "<td>".$fila->descripcion."</td>";

      	if ($fila->destacado == 1) {
      		echo "<td> SI</td>";
      		$destacado_nombre="SI";
      	}else{
				echo "<td> NO </td>";
         $destacado_nombre="NO";

      	}



      $permiso_doc = new PermisoDoc(NULL,$fila->documentoId,NULL);
      $listado_permiso = $permiso_doc->buscar();
      $permisos="";

      while($fila2 = mysqli_fetch_object($listado_permiso))
		{
			$permisos.= " ".$fila2->tipoReferente;
		}

      echo "<td>". $permisos."</td>";

      echo "<td>"."<a href='index.php?mod=slat&men=informe&id=21&documentoId=$fila->documentoId'>MODIFICAR</a>"."</td>";


      echo "</tr>";
      echo "\n";


      }




	echo "</table>";
	echo "</div>";
	echo "</div>";
?>
