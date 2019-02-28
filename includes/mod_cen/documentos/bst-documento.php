<!--<script type="text/javascript" src="includes/mod_cen/documentos/panel.js"></script>
<link href="includes/mod_cen/documentos/estilos.css" rel="stylesheet" type="text/css">-->

<?php
include_once("includes/mod_cen/clases/CategoriaDoc.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/Documento.php");

 // obtiene el listado de categorias a la cual tiene permiso el referente Logueado
    $categoria_doc = new CategoriaDoc();
    $carg_origen=$_SESSION["tipo"];
    $resultado = $categoria_doc->buscarCatPermiso($carg_origen);
?>

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
        <h5 class=" m-b-0 m-t-0">Ver Documentos</h5>

      </div>

    </div>

    <div class="card">

      <div class="card-body">


          <div class="row">
            <div class="col-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">              
                <?php
                  $num=1;
                  $sub_num=1;
                   while ($filaResultado = mysqli_fetch_object($resultado)){
                     $idcateg=$filaResultado->categoriaDocId;
                     ?>                   
                     <a class="nav-link"
                     id="v-pills-home-tab<?php echo $filaResultado->categoriaDocId; ?>"
                     data-toggle="pill"
                     href="#collapseprincipal<?php echo $filaResultado->categoriaDocId; ?>" role="tab"
                     aria-controls="v-pills-home<?php echo $filaResultado->categoriaDocId; ?>" aria-selected="false"><?php echo $filaResultado->nombreCategoria;?>
                     </a>
                      <?php
                    } ?>
              </div>
            </div>
            <div class="col-9">
              <div class="tab-content" id="v-pills-tabContent">
               <!--  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div> -->
                <?php
                 // buscamos los documentos segun permiso y que sean de la categoria segun como este logeado
                 $resultadoNuevo = $categoria_doc->buscarCatPermiso($carg_origen);
                while ($fila = mysqli_fetch_object($resultadoNuevo)){
                  $documentos = new Documento(null,$fila->categoriaDocId);

                  $resultadoBuscar = $documentos->buscar();
                ?>                  
                  <div class="tab-pane fade" id="collapseprincipal<?php echo $fila->categoriaDocId; ?>" role="tabpanel" aria-labelledby="v-pills-home-tab<?php echo $fila->categoriaDocId; ?>">


                    <?php
                      while ($filaResultado2 = mysqli_fetch_object($resultadoBuscar)) {
                        // code...

                        echo $filaResultado2->titulo;?>

                        <a href="documentacion/<?php echo $filaResultado2->nombreArchivo;?>" download="<?php echo $filaResultado2->nombreArchivo;?>"><button type="button" class="btn btn-default btn-lg">  <span class="pull-right glyphicon glyphicon glyphicon-download-alt"></span>
                          </button></a><br><?php echo $filaResultado2->descripcion;?>
                      <?php
                      }
                      ?>

                  </div>
              <?php } ?>

              </div>
            </div>
          </div>


      </div>

    </div>



  </div>

</div>
