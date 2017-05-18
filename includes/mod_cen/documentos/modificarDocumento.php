
<script src="includes/mod_cen/js/permisos.js"></script>
<?php

include_once("includes/mod_cen/documentos/listarDocumentos.php");
include_once("includes/mod_cen/clases/PermisoCategoriaDoc.php");
include_once("includes/mod_cen/clases/CategoriaDoc.php");
include_once("includes/mod_cen/clases/Documento.php");


if(isset($_POST["modif_doc"]) ){

   
	$fecha=date("Y-m-d H:i:s");
 
 $modif_doc = new Documento($_GET["documentoId"],$_POST["categoria_doc"],$_POST["archivo"],$_POST["tituloDoc"],$_POST["descripcion"],$_POST["destacado"],$_GET["fechaSubida"],$fecha);
  $guardar = $modif_doc->editar();

  
   if ($guardar >0){   

     
        // para actualizar los permisos del documento vamos a borrar las entradas que tiene el documentoId en la tabla  permiso_doc e ingresar nuevas entradas


        $permiso_doc_viejo = new PermisoDoc(null,$_GET["documentoId"],null);
        $borrar = $permiso_doc_viejo->eliminarPermisos();

        if ($borrar >0){

        if (is_array($_POST["tipo"])) {
         foreach ($_POST["tipo"] as $value) {
        $permiso_doc = new PermisoDoc(null,$_GET["documentoId"],$value);
        $crearPermiso = $permiso_doc->agregar();
        if($crearPermiso==1){
          echo "Se actualizo permiso ".$value;
        }
        
      }
    }


      }
  
    
    echo "Actualizacion Exitosa"; 
   // sleep(5);
  }else{
    echo "Error al actualizar";
  }



      $variablephp = "index.php?mod=slat&men=informe&id=20";

?>

              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php



    }else{

    	 
        $categ = new CategoriaDoc(NULL,NULL,NULL);
        $buscarcategoria = $categ->buscar();



$tipoPermiso = new PermisoCategoriaDoc(NULL,$_GET["categoriaDocId"],Null);
$buscarTipoPermiso = $tipoPermiso->buscar();


  
  include_once("includes/mod_cen/formularios/f_Modif_documento.php");


}



?>


