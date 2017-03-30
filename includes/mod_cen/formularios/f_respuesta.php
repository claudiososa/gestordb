<?php

  //var_dump($informe);

?>

 <form name="form" class="informef" action="index.php?mod=slat&men=informe&id=7" method="post">
 		<div class="form-group">
      <div class="col-md-12">
        <label class="control-label">Escuela</label>
      </div>
      <div class="col-md-12">
           <input type='text' name="escuelaId"  class="form-control" value="<?php echo $dato_escuela->numero?>" disabled>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label">Nombre de Escuela</label>
      </div>
      <div class="col-md-12">
        <input type='text' name="nombre_escuela"  class="form-control" value="<?php echo $dato_escuela->nombre?>" disabled>
      </div>
    </div>

   <div class="form-group">
       <div class="col-md-12">
         <label class="control-label">Fecha de visita (opcional)</label>
      </div>
      <div class="col-md-12">
        <input type='date'  name="fechaVisita"  class="form-control"
        value="<?php echo $respuesta->fechaVisita.'"'; if($informe->informeId<>"" && $informe->referenteId<>$_SESSION['referenteId']){echo 'disabled';}?>>
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
            <textarea  readonly  rows='20' name="contenido" class="form-control" ><?php echo $respuesta->contenido ?></textarea>
          </div>
        </div>


        <div class="form-group">

        <?php
        echo '<input type="hidden" name="informeId" value="'.$_GET["informeId"].'">';

          if(isset($_GET["respuestaId"]))
          {
            echo '<input type="hidden" name="edit_report" value="'.$_GET["informeId"].'">';
          }


              echo '<div class="col-md-12">';
              echo "<input class='btn btn-primary' type='submit' name='save_report' class='boton' value='Enviar'>";
              echo "<br>";
              echo '<span style="color:#000066">Revisar el informe antes de enviarlo</span>';
              echo "</div>";

              echo "</div>";

        

        ?>


      </form>
