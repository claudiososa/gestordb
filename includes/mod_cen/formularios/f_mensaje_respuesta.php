<div class="container">
<form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
    <input type="hidden" id="mensajeId" name="mensajeId" value="<?php echo $_GET['mensajeId']?>">
      <?php
      /*if ($_GET['id']==1) {
        ?>
        <div class="form-group">
          <div class="col-md-12">
            <label for="birds">Agregar destinatario: </label>
          </div>
          <div class="col-md-12">
            <input id="birds" value='' size="40" autofocus="">
          </div>
          </div>
        <?php
      }*/
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
        $arrayDestino = explode(",",$datoValidado->destinatario);
        //var_dump($arrayDestino);
        foreach ($arrayDestino as $key => $value) {
          //echo $arrayDestino[$key].'<br>';
          $referente = new Referente($arrayDestino[$key]);
          $buscarReferente = $referente->buscar();
          $datoReferente = mysqli_fetch_object($buscarReferente);

          $leido = new MensajesLeidos(null,$_GET['mensajeId'],$datoReferente->referenteId);
          $buscarLeido = $leido->buscar();
          if (mysqli_num_rows($buscarLeido)>0) {
            if ($datoMensaje->referenteId==$_SESSION['referenteId']) {
              echo '<b>'.ucwords(strtolower($datoReferente->apellido)).','.ucwords(strtolower($datoReferente->nombre)).'</b> <img src="img/iconos/leido.png" width="18" height="12" alt="leido"> - ';
            }else{
              echo ucwords(strtolower($datoReferente->apellido)).','.ucwords(strtolower($datoReferente->nombre)).' - ';
            }

          }else{
            if ($datoMensaje->referenteId==$_SESSION['referenteId']) {
              echo ucwords(strtolower($datoReferente->apellido)).','.ucwords(strtolower($datoReferente->nombre)).'<img src="img/iconos/noleido.png" width="18" height="12" alt="leido"> - ';
            }else{
              echo ucwords(strtolower($datoReferente->apellido)).','.ucwords(strtolower($datoReferente->nombre)).' - ';
            }
          }


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
       <label class="control-label">De</label>
    </div>
    <div class="col-md-12">
      <input type="hidden" name="remitente" value="<?php echo $_SESSION['referenteId'] ?>">
      <p id='destinatario'><?php echo ucwords(strtolower($_SESSION['apellido'])).', '.ucwords(strtolower($_SESSION['nombre'])) ?></p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
       <label class="control-label">Para</label>
    </div>
    <div class="col-md-12">
      <p id='destinatario'><?php
                            $remitente = new Referente($datoValidado->referenteId);
                            $buscarRemitente = $remitente->buscar();
                            $datoRemitente = mysqli_fetch_object($buscarRemitente);
                              //var_dump($datoValidado);
                            //echo '<br>'.$datoValidado->referenteId.'<br>';
                            if ($datoValidado->referenteId==(int)$_SESSION['referenteId']) {
                            //  echo 'llego aqui';
                              $remitente2 = new Referente($datoValidado->destinatario);
                              $buscarRemitente = $remitente2->buscar();
                              //$remitente->setReferenteId($datoValidado->destinatario);
                              //var_dump($remitente);
                              $buscarRemitente = $remitente2->buscar();
                              $datoRemitente = mysqli_fetch_object($buscarRemitente);
                              echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?>
                              <input type="hidden" name="destinatario" value="<?php echo $datoRemitente->referenteId ?>">
                              <?php
                            }else{
                              echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?></p>
                              <input type="hidden" name="destinatario" value="<?php echo $datoValidado->referenteId ?>">
                            <?php
                            }

?>
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
          //echo 'Re: '.$datoValidado->asunto;
          echo $datoValidado->asunto;
        }
        ?>"
        <?php
        if(isset($_GET['id']) AND $_GET['id']==3)
        {
          echo 'disabled';
        }
        ?>

        >
      </div>
    </div>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>


      <?php
      if ($_GET['id']==1) {
        ?>
        <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        jQuery('.nicEdit-main').attr('contenteditable','false');
        //]]>
        </script>


        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Contenido</label>
          </div>
          <div class="col-md-12">

            <textarea readonly  rows='20' name="contenido" class="form-control" >
              <?php
              if(isset($datoValidado->contenido) AND $datoValidado->contenido<>""){
                echo $datoValidado->contenido  ;
              }
              ?>
            </textarea>
          </div>
        </div>
        <?php
      }else{
        ?>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Mensaje</label>
          </div>
          <div class="col-md-12" id="myArea1">
            <?php
            if(isset($datoValidado->contenido) AND $datoValidado->contenido<>""){
              echo $datoValidado->contenido;
            }
            ?>
            </div>
        </div>
        <script src="includes/mod_cen/formularios/js/nicEditor.js"></script>
        <script type="text/javascript">
          toggleArea1();
        </script>
        <script type="text/javascript">
        //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        jQuery('.nicEdit-main').attr('contenteditable','false');
        //]]>
        </script>
        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Contenido</label>
          </div>
          <div class="col-md-12">

            <textarea  rows='20' name="contenido" class="form-control" >
              <?php
              //if(isset($datoValidado->contenido) AND $datoValidado->contenido<>""){
              //  echo $datoValidado->contenido  ;
              //}
              ?>
            </textarea>
          </div>
        </div>


  <?php
      }
       ?>


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
              while ($fila = mysqli_fetch_object($buscar_adjunto)) {
                echo "<a href='img/mensajes/".$fila->archivo."'>".$fila->archivo."</a><br>";
              }
              ?>
            </div>
          </div>
          <?php
        }elseif($_GET['id']==4){
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
          //echo "</div>";
        ?>
      </form>
</div>
