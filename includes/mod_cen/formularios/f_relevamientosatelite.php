<form name="form" action="" method="POST" >
	<input type="hidden" name="escuelaId" value="<?php echo $escuelaId ?>"/>
	<?php
    if(isset($_GET['aulaSateliteId'])){
      echo '<input type="hidden" name="aulaSateliteId" value="'.$_GET['aulaSateliteId'].'"/>';
    }

   ?>
  <div class="form-group">
	    <div class="col-md-12">
       	<label class="control-label"><br>Número:</label>
	    </div>
      <div class="col-md-12">
         <input class="form-control" size="30"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}" value="<?php echo $datos->getNumero()?>" readonly>
      </div>
	</div>
  <div class="form-group">
		<div class="col-md-12">
			<label class="control-label"><br>CUE:</label>
		</div>
		<div class="col-md-12">
			<input class="form-control"size="30"  placeholder="solo números - 7 a 9 digitos" type="text" name="cue" pattern="[0-9]{7,9}" value="<?php echo $datos->getCue()?>" readonly>
		</div>
	</div>

<div class="form-group">
	<div class="col-md-12">
		<label class="control-label"><br>Nombre de Aula Satelite:</label>
	</div>
	<div class="col-md-12">
		<input class="form-control" size="30" type="text" id="nombre" name="nombre" value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->nombre ?>" readonly>
	</div>
</div>

<div class="form-group">
		<div class="col-md-12">
				<label class="control-label"><br>Domicilio de Aula Satelite:<label>
    </div>
    <div class="col-md-12">
      <input class="form-control"size="30" type="text" name="domicilio" value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->nombre ?>" readonly>
    </div>
</div>
<div class="form-group">
		<div class="col-md-12">
			<label class="control-label"><br>Teléfono:<label>
		</div>
		<div class="col-md-12">
      <input class="form-control" placeholder="Nº Teléfono, solo números" title="Ingresar solo números" type="text" id="tel_escuela" name="telefono" pattern="[0-9]{1,18}"
      value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->telefono ?>" readonly>
		</div>
	</div>

	<div class="form-group">
		 <div class="col-md-12">
			 <label class="control-label"><br>Localidad</label>
		 </div>
		 <div class="col-md-12">
			 <select name="localidadId" class="form-control" disabled="">
 				<?php while($fila = mysqli_fetch_object($resultado))
 							{
   							if ($fila->localidadId == $datosAulaSatelite->localidadId) {
   									echo "<option value=".$fila->localidadId." selected>".$fila->nombre."</option>;"."\n";
   							}else {
   									echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
   							}
 							}
 								?>
 				</select>
			</div>
		</div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Cue de otras instituciones que funcionan en el mismo edificio:<label>
      </div>
      <div class="col-md-12">
          <input class="form-control"size="30" type="text" name="otroCue" value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->otroCue ?>" >
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>La institución ¿Tiene regimen de internado o albergue?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('internado','aulaSatelite');
         //var_dump($datosAulaSatelite);
         ?>

         <select  class="form-control" name="internado">
           <?php
            echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){

                 if($valor==$datosAulaSatelite->internado){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Cantidad Total de Personal (Directivos,Docentes, Auxiliares y otros Cargos:<label>
      </div>
      <div class="col-md-12">
          <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="totalCargos" name="totalCargos"  value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->totalCargos ?>" >
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Matricula de Alumnos:<label>
      </div>
      <div class="col-md-12">
          <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="matricula" name="matricula"  value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->matricula ?>" >
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>La institución ¿Tiene energía eléctrica?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('energia','aulaSatelite');
     ?>
         <select  class="form-control" name="energia">
           <?php
            echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){

                 if($valor==$datosAulaSatelite->energia){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>En caso de respuesta afirmativa a la pregunta anterior indicar -> Tipo de Instalacion de Energia eléctrica<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('tipoInstalacion','aulaSatelite');
     ?>
         <select  class="form-control" name="tipoInstalacion">
           <?php
              echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                 if($valor==$datosAulaSatelite->tipoInstalacion){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Cómo funciona?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('comoFunciona','aulaSatelite');
     ?>
         <select  class="form-control" name="comoFunciona">
           <?php
            echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                  if($valor==$datosAulaSatelite->comoFunciona){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Cantidad de Aulas:<label>
      </div>
      <div class="col-md-12">
          <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="cantidadAulas" name="cantidadAulas"  value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->cantidadAulas ?>" >
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Cantidad de Computadoras Instaladas:<label>
      </div>
      <div class="col-md-12">
          <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="cantidadPcInstaladas" name="cantidadPcInstaladas"  value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->cantidadPcInstaladas ?>" >
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Tiene heladera?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('heladera','aulaSatelite');
     ?>
         <select  class="form-control" name="heladera">
           <?php
             echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                 if($valor==$datosAulaSatelite->heladera){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Indicar si tiene otros equipos eléctricos instalados:<label>
          </div>
      <div class="col-md-12">
        <?php //$turnos=str_split($datos->getTurnos()); ?>


        <?php
        if($datosAulaSatelite<>NULL && $datosAulaSatelite->otros<>"")
        {
          $otros=str_split($datosAulaSatelite->otros);
        }else{
          $otros=str_split('nnnnn');
          //$otros=array("","","","","");
        }
        //var_dump($otros);
        ?>

        <label class="checkbox-inline">
          <input type="checkbox" name="televisor" value="televisor"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otros[0]=='s') echo 'checked';
          }
          ?>
          >Televisor
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="cañon" value="cañon"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otros[1]=='s') echo 'checked';
          }
          ?> >Cañon
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="reproductor" value="reproductor CD/DVD"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otros[2]=='s') echo 'checked';
          }
            ?> >Reproductor CD/DVD
        </label><br>
        <label class="checkbox-inline">
          <input type="checkbox" name="impresora" value="impresora"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otros[3]=='s') echo 'checked';
          }
          ?> >Impresora
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="otro" value="otro"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otros[4]=='s') echo 'checked';
          }
            ?>
             >Otro
        </label>

        <input hidden type="text" name="otrosactual" value="<?php
        if($datosAulaSatelite<>NULL)
        {
          echo $datosAulaSatelite->otros;
        }else{
          echo 'nnnnn';
          //$otros=array("","","","","");
        }
         //echo $datosAulaSatelite->otros
         ?>" readonly>
          </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Tiene suficiente Energía?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('suficienteEnergia','aulaSatelite');
     ?>
         <select  class="form-control" name="suficienteEnergia">
           <?php
             echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                 if($valor==$datosAulaSatelite->suficienteEnergia){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Tiene Calefón?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('calefon','aulaSatelite');
     ?>
         <select  class="form-control" name="calefon">
           <?php
             echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
              if($datosAulaSatelite<>NULL){
                if($valor==$datosAulaSatelite->calefon){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Necesita Calefón Solar?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('necesitaCalefonSolar','aulaSatelite');
     ?>
         <select  class="form-control" name="necesitaCalefonSolar">
           <?php
             echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                  if($valor==$datosAulaSatelite->necesitaCalefonSolar){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Necesita bombeo de agua para el Calefón Solar?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('necesitaBombeoAgua','aulaSatelite');
     ?>
         <select  class="form-control" name="necesitaBombeoAgua">
           <?php
             echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                 if($valor==$datosAulaSatelite->necesitaBombeoAgua){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>¿Tiene conectividad a Internet?<label>
      </div>
      <div class="col-md-12">
     <?php
         $internado=Maestro::estructura('conectividad','aulaSatelite');
     ?>
         <select  class="form-control" name="conectividad">
           <?php
             echo "<option value='0'>Seleccione...</option>";
             foreach ($internado AS $valor)
               if($datosAulaSatelite<>NULL){
                  if($valor==$datosAulaSatelite->conectividad){
                   echo "<option selected value='$valor'>$valor</option>";
                 }else{
                   echo "<option value='$valor'>$valor</option>";
                 }
               }else{
                 echo "<option value='$valor'>$valor</option>";
               }

           echo '</select>';
         ?>
     </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Indicar que proveedor de conectividad (puede indicar más de uno):<label>
          </div>
      <div class="col-md-12">
        <?php //$turnos=str_split($datos->getTurnos()); ?>


        <?php
        if($datosAulaSatelite<>NULL  && $datosAulaSatelite->otrosC<>"")
        {
          $otrosC=str_split($datosAulaSatelite->tipoConectividad);
        }else{
          $otrosC=str_split('nnnnnn');
          //$otros=array("","","","","");
        }
        //var_dump($otros);
        ?>

        <label class="checkbox-inline">
          <input type="checkbox" name="Claro" value="Claro"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otrosC[0]=='s') echo 'checked';
          }
          ?>
          >Claro
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="Arnet" value="Arnet"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otrosC[1]=='s') echo 'checked';
          }
          ?> >Arnet
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="Fibertel" value="Fibertel"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otrosC[2]=='s') echo 'checked';
          }
            ?>
             >Fibertel (CableVision)
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="EmpresaLocal" value="Empresa Local de Conectividad"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otrosC[3]=='s') echo 'checked';
          }
            ?> >Empresa Local de Conectividad
        </label><br>
        <label class="checkbox-inline">
          <input type="checkbox" name="Satelital" value="Satelital"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otrosC[4]=='s') echo 'checked';
          }
          ?> >Satelital
        </label>

        <label class="checkbox-inline">
          <input type="checkbox" name="otro" value="otro"
          <?php
          if($datosAulaSatelite<>NULL){
            if($otrosC[5]=='s') echo 'checked';
          }
            ?>
             >Otro
        </label>

        <input hidden type="text" name="otrosconectividad" value="<?php
        if($datosAulaSatelite<>NULL)
        {
          echo $datosAulaSatelite->tipoConectividad;
        }else{
          echo 'nnnnnn';
          //$otros=array("","","","","");
        }
         //echo $datosAulaSatelite->otros
         ?>" readonly>
          </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label class="control-label"><br>Comentario:<label>
      </div>
      <div class="col-md-12">
          <input class="form-control" placeholder="ingrese comentario" title="Ingrese comentario" type="textarea" rows="10" cols="40" id="comentario" name="comentario"  value="<?php if($datosAulaSatelite) echo $datosAulaSatelite->comentario ?>" >
      </div>
    </div>

    <div align="center">
  		<div class="form-group" "input-group">
        <button type="submit" class="btn btn-success btn-lg" id="botonF_escuela">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aplicar cambios
        </button>
      </div>
    </div>
</form>
