<form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="index.php?mod=slat&men=informe&id=1&escuelaId=<?php echo $_GET["escuelaId"]?>" method="post">
    <input type="hidden" name="tipo" value="Acta de Visita">
    <div class="container">
      <label class="control-label" for=""><h3>Nuevo Mensaje</h3></label>
    </div>
    <div class="form-group">
      <div class="col-md-12">
         <label class="control-label">Para</label>
      </div>
      <div class="col-md-12">
        <input required type='text' name="destinatario" class="form-control" placeholder="Titulo corto para tu informe" value="">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
         <label class="control-label">Asunto</label>
      </div>
      <div class="col-md-12">
        <input required type='text' name="asunto" class="form-control" placeholder="Titulo corto para tu informe" value="">
      </div>
    </div>
       <?php

        //if($dato_escuela->referenteId==$_SESSION['referenteId'])
          //{

              echo '<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">';
      //<![CDATA[
              echo 'bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });';
              //echo 'nicEditors.findEditor("TextArea").attr("contentEditable","false");';

              echo "jQuery('.nicEdit-main').attr('contenteditable','false');";
        //]]>
              echo '</script>';
        //}
        ?>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Contenido</label>
          </div>
          <div class="col-md-12">
            <textarea  readonly  rows='20' name="contenido" class="form-control" ><?php echo $informe->contenido ?></textarea>
          </div>
        </div>
        <p>&nbsp;</p>
        <?php
        if($_GET['id']==3){
          ?>
          <div class="form-group">
            <div class="col-md-12">
              <label class="control-label">Archivos Adjuntos</label>
            </div>
            <div class="col-md-12">
              <?php
              while ($fila = mysqli_fetch_object($buscar_img)) {
                echo "<a href='img/informes/".$fila->nombre."'>".$fila->nombre."</a><br>";
              }
              ?>
            </div>
          </div>
          <?php
        }elseif($_GET['id']==1){
          ?>
          <div class="form-group">
            <div class="col-md-12">
              <label class="control-label">Adjuntar archivos (máximo 5 archivos, peso máximo por archivo 1024 kb)</label>
            </div>
            <div class="col-md-12">
              <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
            </div>
          </div>
          <?php
        }


        ?>
        <?php
          echo "</div>";
        ?>
      </form>
