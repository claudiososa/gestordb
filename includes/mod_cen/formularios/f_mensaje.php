<div class="container">
<form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
    <input type="hidden" id="destino" name="referentes" value="">
      <?php
      if ($_GET['id']==1) {
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
      }
       ?>
<hr>
<?php
if ($_GET['id']==3) {
  ?>
  <div class="form-group">
    <div class="col-md-12">
       <label class="control-label">De</label>
    </div>
    <div class="col-md-12">
      <p id='destinatario'><?php echo ucwords(strtolower($datoMensaje->apellido)).','.ucwords(strtolower($datoMensaje->nombre)) ?></p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
       <label class="control-label">Para</label>
    </div>
    <div class="col-md-12">
      <p>
        <?php

        $arrayDestino = explode(",",$datoValidado->destinatario);
        foreach ($arrayDestino as $key => $value) {
          if ($arrayDestino[$key]<>$datoValidado->referenteId)
          {//cuando el destinatario es distinto al usuario logueado
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
        }

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
      }elseif($_GET['id']==3){//Si esta en la ventana de Leer Mensaje
        ?>
        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Contenido</label>
          </div>
          <div class="col-md-12" id="myArea1">
            <?php
            $mensajes = new MensajesResp();
            $respuestas=$mensajes->verRespuestas($datoValidado->mensajeHiloId);

            $contenido = new ContenidoRespuestas();

            while ($fila = mysqli_fetch_object($respuestas)) {
                $contenido->contenidoId=$fila->contenidoId;
                $buscarContenido = $contenido->buscar();
                $datoContenido=mysqli_fetch_object($buscarContenido);
                echo '<br>'.$datoContenido->contenido.'<br>';
                if ($fila->respuestaReferenteId<>$_SESSION['referenteId']) {
              //    $nuevoHilo=new MensajeHilo($respuestas->mensajeRespId);
                  //$buscarHilo = $nuevoHilo->buscar();
                  //$datoHilo=mysqli_fetch_object($buscarHilo);

                  //$mensajesResp = new MensajesResp(null,null,$respuestas->contenidoId);
                  //$buscarResp = $mensajesResp->buscar();



                  //echo "<br><br><a class='btn btn-success' href='index.php?men=mensajes&id=4&r=".$fila->mensajeRespId."&mensajeId=".$_GET['mensajeId']."'>Responder</a><br><br>";
                }
                $mensajeRespId=$fila->mensajeRespId;
                if ($datoValidado->referenteId<>$_SESSION['referenteId']) {
                    echo "<br><br><a class='btn btn-success' href='index.php?men=mensajes&id=4&r=".$mensajeRespId."&mensajeId=".$_GET['mensajeId']."'>Responder</a><br><br>";
                }

            }
            if ($datoValidado->referenteId<>$_SESSION['referenteId']) {
                echo "<br><br><a class='btn btn-success' href='index.php?men=mensajes&id=4&r=".$mensajeRespId."&mensajeId=".$_GET['mensajeId']."'>Responder</a><br><br>";
            }

            //echo "<br><br><a class='btn btn-success' href='index.php?men=mensajes&id=4&r=".$mensajeRespId."&mensajeId=".$_GET['mensajeId']."'>Responder</a><br><br>";
            ?>
            </div>
        </div>

<script src="includes/mod_cen/formularios/js/nicEditor.js"></script>

  <?php
  if ($_GET['id']==3) {
    ?>
    <script type="text/javascript">
      toggleArea1();
    </script>
    <?php
  }
      }
       ?>


    </script>


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
          //echo "</div>";
        ?>
      </form>
</div>
