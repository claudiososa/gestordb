
<script src="includes/mod_cen/js/permisos.js"></script>
<?php

include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/PermisoCategoriaDoc.php");
include_once("includes/mod_cen/clases/CategoriaDoc.php");
include_once("includes/mod_cen/clases/PermisoDoc.php");
include_once("includes/mod_cen/clases/Documento.php");



$tipoReferente = new Referente();
$buscarTipoReferente = $tipoReferente->tipoReferente();


//// Verifica si se envia por post guardar_categoria_doc y si el nombre tiene algun dato cargado
if(isset($_POST["guardar_doc"]) AND $_POST["tituloDoc"]<>""){
 // var_dump($_POST["tipo"]);
  echo "<br><br>";


  $fecha=date("Y-m-d H:i:s");
  $nuevo_doc = new Documento(null,$_POST["categoria_doc"],$_POST["archivo"],$_POST["tituloDoc"],$_POST["descripcion"],$_POST["destacado"],$fecha,$fecha);
  $guardar = $nuevo_doc->agregar();
  if ($guardar>0){
    if (is_array($_POST["tipo"])) {
      foreach ($_POST["tipo"] as $value) {
        $permiso_doc = new PermisoDoc(null,$guardar,$value);
        $crearPermiso = $permiso_doc->agregar();
        if($crearPermiso==1){
          echo "Se creo permiso".$value," ".$guardar;
        }
        
      }
    }
    echo $guardar;
    echo "Se Guardo con Éxito";
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
  //// inclusión de formulario para Cargar nuevo Documento con sus permisos asociados

  
  
  $categ = new CategoriaDoc(NULL,NULL,NULL);
  $buscarcategoria = $categ->buscar();

  $tipoReferente = new Referente();
  $buscarTipoReferente = $tipoReferente->tipoReferente();



  include_once("includes/mod_cen/formularios/f_documento.php"); // formulario de carga de archivo!!


}



?>
