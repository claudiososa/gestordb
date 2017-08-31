<div class="container">
<form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="" method="post">
    <input type="hidden" id="mensajeId" name="mensajeId" value="<?php echo $_GET['mensajeId']?>">
    <input type="hidden" id="tipo" name="tipo" value="<?php echo $_GET['tipo']?>">
    <hr>
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

                            $hilo = new MensajeHilo();
                            //$arrayHilo=$hilo->buscarHilo($_GET['mensajeId'],$_SESSION['referenteId']);
                            $mensaje = new Mensajes($_GET['mensajeId']);
                            $buscarMensaje = $mensaje->buscar();
                            $datoMensa= mysqli_fetch_object($buscarMensaje);
                            $arrayDestino = explode(',',$datoMensa->destinatario);
                            if (!isset($_GET['todos'])) {

                                if (count($arrayDestino)<3) {
                                ?><input type="hidden" name="destinatario" value="<?php echo $datoMensa->destinatario ?>">

                                <?php


                                    foreach ($arrayDestino as $key => $value) {
                                        if ($arrayDestino[$key]<>$_SESSION['referenteId'])
                                        {
                                            $referente = new Referente($arrayDestino[$key]);
                                            $buscarRef = $referente->buscar();
                                            $datoRef = mysqli_fetch_object($buscarRef);
                                            echo ucwords(strtolower($datoRef->apellido)).', '.ucwords(strtolower($datoRef->nombre));
                                        }
                                    }
                                }else{
                                    ?><input type="hidden" name="destinatario" value="<?php echo $datoMensa->referenteId ?>">
                                      <?php
                                      $referente = new Referente($datoMensa->referenteId);
                                      $buscarRef = $referente->buscar();
                                      $datoRef = mysqli_fetch_object($buscarRef);
                                      echo ucwords(strtolower($datoRef->apellido)).', '.ucwords(strtolower($datoRef->nombre));

                                }
                          }elseif(isset($_GET['todos']))
                          {
                              echo 'responder a todos<br><br>';

                              foreach ($arrayDestino as $key => $value) {
                                  if ($arrayDestino[$key]<>$_SESSION['referenteId'])
                                  {
                                      $referente = new Referente($arrayDestino[$key]);
                                      $buscarRef = $referente->buscar();
                                      $datoRef = mysqli_fetch_object($buscarRef);
                                      echo ucwords(strtolower($datoRef->apellido)).', '.ucwords(strtolower($datoRef->nombre).' ');

                                  }
                              }
                              
                              ?><input type="hidden" name="destinatario" value="<?php echo $datoMensa->destinatario ?>">
                                <?php

                          }

?>
    </div>
  </div>
  <?php

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

            $mensajes = new MensajesResp();
            $respuestas=$mensajes->verRespuestas($datoValidado->mensajeHiloId);

            $contenido = new ContenidoRespuestas();

            while ($fila = mysqli_fetch_object($respuestas)) {
                $contenido->contenidoId=$fila->contenidoId;
                $buscarContenido = $contenido->buscar();
                $datoContenido=mysqli_fetch_object($buscarContenido);
                echo $datoContenido->contenido.'<br>';
                $mensajeRespId=$fila->mensajeRespId;
            }

            echo "<a class='btn btn-success' href='index.php?men=mensajes&id=4&r=".$mensajeRespId."&mensajeId=".$_GET['mensajeId']."'>Responder</a>";

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
