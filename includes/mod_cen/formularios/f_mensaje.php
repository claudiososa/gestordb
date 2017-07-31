<div class="container">
<form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">

    <input type="hidden" id="destino" name="referentes" value="">

      <label class="control-label" for=""><h3>Nuevo Mensaje</h3></label>
      <?php
      if ($_GET['id']==1) {
        ?>
        <div class="form-group">
          <div class="col-md-12">
            <label for="birds">Agregar destinatario: </label>
          </div>
          <div class="col-md-12">
            <input id="birds" value='' size="40">
          </div>
          </div>
        <?php
      }
       ?>


<hr>
<!--<div class="ui-widget" style="margin-top:2em; font-family:Arial">
  Result:
  <div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
</div>-->
<?php
if ($_GET['id']==3) {
  ?>
  <div class="form-group">
    <div class="col-md-12">
       <label class="control-label">Para</label>
    </div>
    <div class="col-md-12">
      <p>
        <?php
        //var_dump($datoValidado->destinatario);
        $arrayDestino = split(',',$datoValidado->destinatario);
        //var_dump($arrayDestino);
        foreach ($arrayDestino as $key => $value) {
          //echo $arrayDestino[$key].'<br>';
          $referente = new Referente($arrayDestino[$key]);
          $buscarReferente = $referente->buscar();
          $datoReferente = mysqli_fetch_object($buscarReferente);
          echo ucwords(strtolower($datoReferente->apellido)).','.ucwords(strtolower($datoReferente->nombre)).' - ';          
        }
        $datoValidado->destinatario
        ?>
      </p>
    </div>
  </div>

  <?php
}else{
  ?>
  <div class="form-group">
    <div class="col-md-12">
       <label class="control-label">Para</label>
    </div>
    <div class="col-md-12">
      <p id='destinatario'></p>
    </div>
  </div>
  <?php
}
 ?>



    <div class="form-group">
      <div class="col-md-12">
         <label class="control-label">Asunto</label>
      </div>
      <div class="col-md-12">
        <input required type='text' id='asunto' name="asunto" class="form-control" placeholder="Titulo corto para tu informe" value="<?php
        if(isset($datoValidado->asunto) AND $datoValidado->asunto<>""){
          echo $datoValidado->asunto  ;
        }
        ?>">
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
            <textarea  readonly  rows='20' name="contenido" class="form-control" >
              <?php
              if(isset($datoValidado->contenido) AND $datoValidado->contenido<>""){
                echo $datoValidado->contenido  ;
              }
              ?>
            </textarea>
          </div>
        </div>
        <p>&nbsp;</p>
        <?php
        if($_GET['id']==13){
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
          echo '<div class="col-md-12">';
          echo "<input class='btn btn-primary' type='submit' name='save_report' class='boton' value='Enviar Mensaje'>";
          echo "<br>";
          echo "<p>&nbsp;</p>";
          echo "<p>&nbsp;</p>";
          echo "<p>&nbsp;</p>";
          echo "</div>";
        }


        ?>
        <?php
          echo "</div>";
        ?>
      </form>
</div>
