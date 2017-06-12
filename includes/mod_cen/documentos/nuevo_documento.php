<script src="includes/mod_cen/js/permisos.js"></script>
<script src="includes/mod_cen/js/s_ajax_informe.js"></script>
<?php

include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/PermisoCategoriaDoc.php");
include_once("includes/mod_cen/clases/CategoriaDoc.php");
include_once("includes/mod_cen/clases/PermisoDoc.php");
include_once("includes/mod_cen/clases/Documento.php");
include_once("includes/mod_cen/clases/img.php");



$tipoReferente = new Referente();
$buscarTipoReferente = $tipoReferente->tipoReferente();


//// Verifica si se envia por post guardar_categoria_doc y si el nombre tiene algun dato cargado
if(isset($_POST["guardar_doc"]) AND $_POST["tituloDoc"]<>""){
 // var_dump($_POST["tipo"]);
  echo "<br><br>";


  $fecha=date("Y-m-d H:i:s");
  $nuevo_doc = new Documento(null,$_POST["categoria_doc"],$nombreArchivo,$_POST["tituloDoc"],$_POST["descripcion"],$_POST["destacado"],$fecha,$fecha);
  $guardar = $nuevo_doc->agregar();

  foreach ($_FILES['input-img'] as $key) {
    $cantidadElmentos=count($_FILES['input-img']['name']);

    for ($i=0; $i < $cantidadElmentos ; $i++) {
      # code...
      $img1 = $_FILES['input-img']['tmp_name'][$i];
      $img1 = $_FILES['input-img']['name'][$i];

      $dir_subida = './documentacion/';

      if($_FILES['input-img']['type'][$i]=='image/jpeg'){
        $nombreArchivo='doc_'.$guardar.'_'.$i.'.jpg';
        $nombreArchivoMediano='doc_'.$guardar.'_'.$i.'m.jpg';
        $tipoArchivo='image/jpeg';
      } elseif($_FILES['input-img']['type'][$i]=='application/pdf') {
        $nombreArchivo='doc_'.$guardar.'_'.$i.'.pdf';
        $tipoArchivo='application/pdf';
      }
      //$fichero_subido = $dir_subida . basename($_FILES['input-img']['name'][0]);
      $fichero_subido = $dir_subida . $nombreArchivo;
//      echo $fichero_subido;


//echo '<pre>';
      if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
        if($_FILES['input-img']['type'][$i]=='image/jpeg'){
          $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
          copy($fichero_subido,$nuevoArchivo);
        }
        //$imagen = new Img(null,$guardar_informe,$nombreArchivo,$tipoArchivo);
        //$agregarImg = $imagen->agregar();
    //    echo "El fichero es válido y se subió con éxito.\n";
      }	 else {
// echo "¡Posible ataque de subida de ficheros!\n";
      }

    }
    break;
  }

  $doc_guardado = new Documento($guardar,null,$nombreArchivo);
  $editar = $doc_guardado->editar('nombreArchivo');

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
