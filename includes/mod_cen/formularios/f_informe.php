<script src="includes/mod_cen/js/s_ajax_informe.js"></script>


<?php
  if($informe->informeId==""){
  }
  //var_dump($informe);
?>
<form name="form" enctype="multipart/form-data" class="informef" id="formInforme" action="index.php?mod=slat&men=informe&id=1&escuelaId=<?php echo $_GET["escuelaId"]?>" method="post">
 		<div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Escuela</label>
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
    <?php
    if($_GET["men"]=="informe" &&  $_GET["id"]==3){
      ?>
    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label">Localidad, Departamento</label>
      </div>
      <div class="col-md-12">
        <input type='text' name="localidad"  class="form-control" value="<?php echo $dato_localidad->Localidad?>" disabled>
      </div>
    </div>
    <?php } ?>

    <div class="form-group">
       <div class="col-md-12">
         <label class="control-label">Prioridad</label>
       </div>
       <div class="col-md-12">
   <?php
       $prioridad=Informe::camposet('prioridad','informes');
       ?>
       <select  class="form-control" name="prioridad" <?php
        if($informe->informeId<>"" && $informe->referenteId<>$_SESSION['referenteId'] )
         {            //if($dato_escuela->referenteId<>$_SESSION['referenteId'] && isset($nuevo))
           echo 'disabled';}?> >
         <?php
           foreach ($prioridad AS $valor)

             if($valor==$informe->prioridad) {
               echo "<option selected value='$valor'>$valor</option>";
             }else {
               echo "<option value='$valor'>$valor</option>";
             }

         echo '</select>';
       ?>
      </div>
   </div>

     <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Categoría</label>
        </div>
        <div class="col-md-12">
        <select  class="form-control" id="tipo" name="nuevotipo">
              <option value='0'>Seleccione</option>
              <?php
                $selected="";
                while($fila=mysqli_fetch_object($buscarPermisos)){
                  if($fila->tipoId==$informe->nuevotipo){
                    $selected="selected ";
                  }
                  echo "<option ".$selected."value=".$fila->tipoId.">".$fila->nombre."</option>";
                  $selected="";
                }
              ?>
        </select>
        </div>
    </div>

    <input type="hidden" name="tipo" value="Acta de Visita">

    <div class="form-group">
       <div class="col-md-12">
         <label class="control-label">Sub Categoría</label>
       </div>

       <div class="col-md-12" id="divsubtipo">
       <select  class="form-control" id="subtipo" name="subtipo">
           <?php
                if(isset($ver)){
                  echo "<option value='0'>Seleccione</option>";
                    $selected="";
                  while($fila=mysqli_fetch_object($buscarSubTipo)){
                    if($fila->subTipoId==$informe->subtipo){
                      $selected="selected ";
                    }
                    echo "<option ".$selected."value='".$fila->subTipoId."'>".$fila->nombre."</option>";
                    $selected="";
                  }
                } else{
                      echo "<option selected value='0'>Seleccione</option>";
                }
            ?>

       </select>
       </div>
   </div>

     <div class="form-group">
       <div class="col-md-12">
         <label class="control-label">Fecha de visita (opcional)</label>
      </div>
      <div class="col-md-12">
        <input type='date'  name="fechaVisita" id="fechaVisita"  class="form-control"
        value="<?php echo $informe->fechaVisita.'"'; if($informe->informeId<>"" && $informe->referenteId<>$_SESSION['referenteId']){echo 'disabled';}?>>
      </div>
    </div>

    <div class="form-group">
       <div class="col-md-12">
         <label class="control-label">Título</label>
       </div>
       <div class="col-md-12">
          <input required type='text' name="titulo" class="form-control" placeholder="Titulo corto para tu informe" value="<?php echo $informe->titulo.'"';
         if($informe->informeId<>"" && $informe->referenteId<>$_SESSION['referenteId'])
          {
            echo 'disabled';
          }
          ?>
          >
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
        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Adjuntar archivos (máximo 5 archivos, peso máximo por archivo 1024 kb)</label>
          </div>
          <div class="col-md-12">
            <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
          </div>
        </div>
        <p>&nbsp;</p>

        <div class="form-group">

        <?php
          if(isset($_GET["informeId"]))
          {

            $informeId=$_GET["informeId"];
            $escuelaId=$informe->escuelaId;
            echo '<input type="hidden" name="escuelaId" value="'.$escuelaId.'">';
            echo '<input type="hidden" name="edit_report" value="'.$informeId.'">';
            echo '<input type="hidden" name="f_carga" value="'.$informe->fechaCarga.'">';
          }

          if(isset($_GET["escuelaId"])){
             $escuelaId=$_GET["escuelaId"];
              echo '<input type="hidden" name="escuelaId" value="'.$escuelaId.'">';
          }



          if($informe->informeId=="" || $informe->referenteId==$_SESSION['referenteId'])

          //if($dato_escuela->referenteId==$_SESSION['referenteId'] || $_SESSION['tipo']=="ETJ" || $_SESSION['tipo']=="Supervisor")
          {
            $fecha_actual= new DateTime(date("Y-m-d H:i:s"));
            $fecha_informe = new DateTime(date($informe->fechaCarga));
            $fecha = $fecha_actual->diff($fecha_informe);
            //if($fecha->s >0 $fecha->i < 10   && $fecha->d < 1 && $fecha->h <1){
            if($fecha->s < 1 && $fecha->i < 10 && $fecha->d < 1 && $fecha->h <1){
                echo '<div class="col-md-12">';
                echo "<input class='btn btn-primary' type='submit' name='save_report' class='boton' value='Enviar'>";
                echo "<br>";
                echo "<p>&nbsp;</p>";
                echo '<span style="color:#000066">Revisar el informe antes de enviarlo</span>';
                echo "</div>";
              }
            }
              echo "</div>";
        ?>
      </form>
