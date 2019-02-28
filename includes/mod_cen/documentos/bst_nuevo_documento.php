<script src="includes/mod_cen/js/permisos.js"></script>
<script src="includes/mod_cen/js/s_ajax_documento.js"></script>
<?php

include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/persona.php");
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
  $nuevo_doc = new Documento(null,$_POST["categoria_doc"],NULL,$_POST["tituloDoc"],$_POST["descripcion"],$_POST["destacado"],$fecha,$fecha,$_SESSION["referenteId"],$_SESSION["tipo"]);
  $guardar = $nuevo_doc->agregar();

  foreach ($_FILES['input-img'] as $key) {
    $cantidadElmentos=count($_FILES['input-img']['name']);

    for ($i=0; $i < $cantidadElmentos ; $i++) {
      # code...
      $img1 = $_FILES['input-img']['tmp_name'][$i];
      $img1 = $_FILES['input-img']['name'][$i];

      $dir_subida = './documentacion/';
      //echo $_FILES['input-img']['type'][$i];

      switch ($_FILES['input-img']['type'][$i]) {
        case 'application/pdf':
          $nombreArchivo=$_POST["tituloDoc"].'.pdf';
          break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            $nombreArchivo=$_POST["tituloDoc"].'.xlsx';
            break;
        case 'application/vnd.ms-excel':
                $nombreArchivo=$_POST["tituloDoc"].'.xls';
                break;
       case 'application/msword':
                $nombreArchivo=$_POST["tituloDoc"].'.doc';
                break;
       case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
               $nombreArchivo=$_POST["tituloDoc"].'.docx';
               break;
       case 'image/jpeg':
                $nombreArchivo=$_POST["tituloDoc"].'.jpg';
                break;
       case 'image/png':
               $nombreArchivo=$_POST["tituloDoc"].'.png';
               break;
       case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
               $nombreArchivo=$_POST["tituloDoc"].'.pptx';
               break;
      case 'video/mpeg':
               $nombreArchivo=$_POST["tituloDoc"].'.mp4';
               break;


        default:
          # code...
          break;
      }

      $fichero_subido = $dir_subida . $nombreArchivo;

      if (move_uploaded_file($_FILES['input-img']['tmp_name'][$i], $fichero_subido)) {
        /*if($_FILES['input-img']['type'][$i]=='image/jpeg'){
          $nuevoArchivo = $dir_subida.$nombreArchivoMediano;
          copy($fichero_subido,$nuevoArchivo);
        }*/
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
          // se busca el mail del referente

              $dato_referente =  new Referente($_SESSION["referenteId"]);
              $buscar_dato = $dato_referente->Persona($_SESSION["referenteId"]);
              $origen =  mysqli_fetch_object($buscar_dato);

              $remitente=$origen->email;



          // fin de busqueda mail de referente


          //echo "Se creo permiso".$value;

          $enviado=$doc_guardado->enviarMail($value,$remitente,$_POST["tituloDoc"]);
          //echo "\n".$destino."\n";

        }

      }
    }

    echo $guardar." ".$enviado;
    echo "Se Guardo con Éxito";
  }

      $variablephp = "index.php?mod=slat&men=informe&id=20";

?>

              <script type="text/javascript">
                var variablejs = "<?php echo $variablephp; ?>" ;
                function redireccion(){window.location=variablejs;}
                setTimeout ("redireccion()",1000);
                    </script>

<?php





}else{
  //// inclusión de formulario para Cargar nuevo Documento con sus permisos asociados



  $categ = new CategoriaDoc(NULL,NULL,NULL);
  if($_SESSION['tipo']=='admin')
  {
    $buscarcategoria = $categ->buscar();
  }else{
    $buscarcategoria = $categ->buscar(null,'si');
  }


  $tipoReferente = new Referente();
  $buscarTipoReferente = $tipoReferente->tipoReferente();



  include_once("includes/mod_cen/formularios/bst_f_documento.php"); // formulario de carga de archivo!!


}



?>
