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



<div class="container-fluid">

     <div class="row">
     <!-- aqui debera estar el while principal para escribir las categorias  -->


<?php
$num=1;
$sub_num=1;
 while ($filaResultado = mysqli_fetch_object($resultado))
      {

   $idcateg=$filaResultado->categoriaDocId;


?>

<div class="col-md-4">
     <div class="panel panel-info">

              <div class="panel-heading"><a data-toggle="collapse" href="#collapseprincipal<?php echo $num; ?>"><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span>
                     <span class="panel-title clickable"><h3 class="panel-title"><b><?php echo $filaResultado->nombreCategoria;?></b></h3></span></a>
              </div>
<!--contenido de categoria documentos administrativos-->
   <div id="collapseprincipal<?php echo $num; ?>" class="panel-collapse collapse">

        <div class="panel-body">

          <?php
   // buscamos los documentos segun permiso y que sean de la categoria segun como este logeado

       $doc_categ = new Documento();
       $resultadoBuscar = $doc_categ->buscarDocPermiso($carg_origen,$idcateg);


       while ($filaResultado2 = mysqli_fetch_object($resultadoBuscar) )
              {

           ?>


          <div class="panel-group">
               <div class="panel panel-success">
                    <div class="panel-heading"><a data-toggle="collapse" href="#collapse<?php echo $sub_num; ?>"><h3 class="panel-title"><font color="darkolivegreen"><b><?php echo $filaResultado2->titulo;?></b></font></h3></a>
                    </div>
                    <div id="collapse<?php echo $sub_num; ?>" class="panel-collapse collapse">
                      <div class="panel-body"><center><a href="documentacion/<?php echo $filaResultado2->nombreArchivo;?>" download="<?php echo $filaResultado2->nombreArchivo;?>"><button type="button" class="btn btn-default btn-lg"><span class="pull-right glyphicon glyphicon glyphicon-download-alt"></span><font color="darkolivegreen">Descargar&nbsp;</font></button></a></center><br><?php echo $filaResultado2->descripcion;?>
                      </div>
                    </div>
               </div>
          </div>

          <?php

$sub_num=$sub_num+1;
}

?>


 </div>

</div>
</div>
</div>

<?php

$num=$num+1;
}

?>

</div>  <!-- cierra  etiqueta row-->

</div>  <!-- cierra etiqueta container-fluid -->
