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

                            $arrayHilo=$hilo->buscarHilo($_GET['mensajeId'],$_SESSION['referenteId']);

                            if (!isset($_GET['todos'])) {
                              $objMensaje = new Mensajes($_GET['mensajeId']);
                              $buscarMensaje = $objMensaje->buscar();
                              $datoMensaje = mysqli_fetch_object($buscarMensaje);
                              //var_dump($arrayHilo);
                              if ($arrayHilo[1]<>0) {//si existe hilo de tipo individual
                                //echo "si existe hilo de tipo individual";
                                  $hilo->mensajeHiloId=$arrayHilo[1];
                                  $buscarHilo =$hilo->buscar(null,null,null,'tipoConsulta');
                                  $arrayDestino = explode(',',$buscarHilo->referenteIdResp);
                                  foreach ($arrayDestino as $key => $value) {
                                    //echo $arrayDestino[$key].'<br>';
                                    if ($arrayDestino[$key]<>$_SESSION['referenteId']) {
                                      $remitente = new Referente($arrayDestino[$key]);
                                      $buscarRemitente = $remitente->buscar();
                                      $datoRemitente = mysqli_fetch_object($buscarRemitente);
                                      echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?>
                                      <input type="hidden" name="destinatario" value="<?php echo $datoRemitente->referenteId ?>">
                                      <?php
                                    }

                                  //var_dump($buscarHilo);
                              }
                              if (isset($_GET['solo'])) {
                                $objMensaje = new Mensajes($_GET['mensajeId']);
                                $buscarMensaje = $objMensaje->buscar();
                                $datoMensaje = mysqli_fetch_object($buscarMensaje);
                                ?>
                                <input type="hidden" name="destinatario" value="<?php echo $datoMensaje->referenteId ?>">
                                <?php
                              }
                            }else{

                              $objMensaje = new Mensajes($_GET['mensajeId']);
                              $buscarMensaje = $objMensaje->buscar();
                              $datoMensaje = mysqli_fetch_object($buscarMensaje);
                              $arrayDestino = explode(',',$datoMensaje->destinatario);
                              foreach ($arrayDestino as $key => $value) {
                                //echo $arrayDestino[$key].'<br>';
                                if ($arrayDestino[$key]==$datoMensaje->referenteId) {
                                  $remitente = new Referente($arrayDestino[$key]);
                                  $buscarRemitente = $remitente->buscar();
                                  $datoRemitente = mysqli_fetch_object($buscarRemitente);
                                  echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?>

                                  <?php
                                }
                                $objMensaje = new Mensajes($_GET['mensajeId']);
                                $buscarMensaje = $objMensaje->buscar();
                                $datoMensaje = mysqli_fetch_object($buscarMensaje);
                                ?>
                                <input type="hidden" name="destinatario" value="<?php echo $datoMensaje->referenteId ?>">
                                <?php
                            }
                            if (isset($_GET['solo'])) {
                              $objMensaje = new Mensajes($_GET['mensajeId']);
                              $buscarMensaje = $objMensaje->buscar();
                              $datoMensaje = mysqli_fetch_object($buscarMensaje);
                              ?>
                              <input type="hidden" name="destinatario" value="<?php echo $datoMensaje->referenteId ?>">
                              <?php
                            }
                            }

                          }else{
                              var_dump($arrayHilo);
                            if ($arrayHilo[0]<>0) {//si existe hilo de tipo grupo
                              //echo "si existe hilo de tipo individual";


                                $hilo->mensajeHiloId=$arrayHilo[0];
                                $buscarHilo =$hilo->buscar(null,null,null,'tipoConsulta');
                                $arrayDestino = explode(',',$buscarHilo->referenteIdResp);
                                foreach ($arrayDestino as $key => $value) {
                                  //echo $arrayDestino[$key].'<br>';
                                  if ($arrayDestino[$key]<>$_SESSION['referenteId']) {
                                    $remitente = new Referente($arrayDestino[$key]);
                                    $buscarRemitente = $remitente->buscar();
                                    $datoRemitente = mysqli_fetch_object($buscarRemitente);
                                    echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?>

                                    <?php
                                  }
                                  ?>
                                  <input type="hidden" name="destinatario" value="<?php echo $buscarHilo->referenteIdResp ?>">
                              <?php
                                //var_dump($buscarHilo);
                            }
                          }else{

                            $objMensaje = new Mensajes($_GET['mensajeId']);
                            $buscarMensaje = $objMensaje->buscar();
                            $datoMensaje = mysqli_fetch_object($buscarMensaje);
                            $arrayDestino = explode(',',$datoMensaje->destinatario);
                            foreach ($arrayDestino as $key => $value) {
                              //echo $arrayDestino[$key].'<br>';
                              if ($arrayDestino[$key]<>$_SESSION['referenteId']) {
                                $remitente = new Referente($arrayDestino[$key]);
                                $buscarRemitente = $remitente->buscar();
                                $datoRemitente = mysqli_fetch_object($buscarRemitente);
                                echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?>

                                <?php
                              }
                              ?>
                              <input type="hidden" name="destinatario" value="<?php echo $datoMensaje->destinatario ?>">
                          <?php
                          }
                          }
                          }



                          /*  $remitente = new Referente($datoValidado->referenteId);
                            $buscarRemitente = $remitente->buscar();
                            $datoRemitente = mysqli_fetch_object($buscarRemitente);*/
                            //var_dump($datoValidado);
                            //echo '<br>'.$datoValidado->referenteId.'<br>';
                          /*  if ($datoValidado->referenteId==(int)$_SESSION['referenteId']) {
                            //  echo 'llego aqui';
                              $remitente2 = new Referente($datoValidado->destinatario);
                              $buscarRemitente = $remitente2->buscar();
                              //$remitente->setReferenteId($datoValidado->destinatario);
                              //var_dump($remitente);
                              $buscarRemitente = $remitente2->buscar();
                              $datoRemitente = mysqli_fetch_object($buscarRemitente);
                              echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?>
                              <input type="hidden" name="destinatario" value="<?php echo $datoRemitente->destinatario ?>">
                              <?php
                            }else{
                              echo ucwords(strtolower($datoRemitente->apellido)).', '.ucwords(strtolower($datoRemitente->nombre)) ?></p>
                              <input type="hidden" name="destinatario" value="<?php echo $datoValidado->referenteId ?>">
                            <?php
                          }*/
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
            if(isset($datoValidado->contenido) AND $datoValidado->contenido<>""){
              echo $datoValidado->contenido.'<br>';
            }

            $hilo = new MensajeHilo();
            $arrayBuscarHilo=$hilo->buscarHilo($_GET['mensajeId'],$_SESSION['referenteId']);
            //var_dump($arrayBuscarHilo);
            $mensajeResp = new MensajesResp();
            $encontrarRespuestas=$mensajeResp->buscarRespuestas($arrayBuscarHilo);


            //$buscarResp=$mensajeResp->buscarRespMensajeActual($mensajeId,$_SESSION['referenteId']);
            while ($fila = mysqli_fetch_object($encontrarRespuestas)) {
              echo $fila->contenido.'<br>';
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
