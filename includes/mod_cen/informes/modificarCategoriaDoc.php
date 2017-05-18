<?php


include_once("includes/mod_cen/informes/listarCategoriaDoc.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/PermisoCategoriaDoc.php");
include_once("includes/mod_cen/clases/CategoriaDoc.php");


if(isset($_POST["modif_categoria_doc"]) ){


 // 1 - actualizar nombre de categoria y descripcion de categoria doc
 // 2 - borrar las entradas con categoriaDocId en la tabla permiso_categoria_doc
//  3 - crear las nuevas entradas en la tabla permiso_categoria_doc con el id de categoriaDoc
  

    $categoria_doc = new CategoriaDoc($_GET["categoriaDocId"],$_POST["nombre"],$_POST["descripcion"]);
    $guardar = $categoria_doc->editar();


   if ($guardar>0){
        // para actualizar los permisos de la categoria vamos a borrar las entradas anteriores e ingresar nuevas entradas en la tabla permisocategoriadoc

        $permiso_cate_doc_viejo = new PermisoCategoriaDoc(null,$_GET["categoriaDocId"],null);
        $borrar = $permiso_cate_doc_viejo->eliminarPermisos();

        if ($borrar >0){

       if (is_array($_POST["tipo"])) {
        foreach ($_POST["tipo"] as $value) {
        $permiso_cate_doc = new PermisoCategoriaDoc(null,$_GET["categoriaDocId"],$value);
        $crearPermiso = $permiso_cate_doc->agregar();
        if($crearPermiso==1){
          echo "Se creo permiso".$value," ".$_GET["categoriaDocId"];
        }
        
      }
    }


        }


    
    
    echo "Se Actualizo con Éxito";
  }else{
    echo "Error al actualizar";
  }



      $variablephp = "index.php?mod=slat&men=informe&id=18";

?>

              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",0);
                    </script>

<?php



    }else{

    	 $tipoReferente = new Referente();
        $buscarTipoReferente = $tipoReferente->tipoReferente();
  
  include_once("includes/mod_cen/formularios/f_modif_categoria_doc.php");


}



?>