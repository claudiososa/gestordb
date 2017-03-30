<?php 
	include_once('clases/localidades.php');
	include_once('clases/maestro.php');
	include_once('clases/escuela.php');
	include_once('clases/rti.php');
	$datoestado= Maestro::estructura('estado','rtixescuela');//Cargo los estados posibles de un RTI x institución
	$objlocalidad= new Localidad(null,null,null);//Cargo Localidades
	$datoturno= Maestro::estructura('turno','rtixescuela');//Cargo los turnos posibles de un RTI x institución
	$dato_localidad=$objlocalidad->buscar();
	$row_localidad= mysqli_fetch_object($dato_localidad);
	$enejercicio=0;//seteo la información resúmen
	$afectacion=0;
	$licencia=0;
	$renuncia=0;
	$total=0;
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();
	$objescuela= new Escuela($_GET['escuelaId']);
	$dato_escuela=$objescuela->buscar();
	$escuela=mysqli_fetch_object($dato_escuela);
	$dato_rti=Rti::existeRtixinstitucion($_GET['escuelaId']);//Tómo datos de la escuela
	//Encabezado de página
	echo "<p> <strong>RTI Escuela Número ".$escuela->numero." - ".$escuela->nombre."<hr /><br></strong></p> <p><input type='button' name='cmdnuevorti' class='editarrti' id='0' 	value='Nuevo' /></p>";
	//Tabla con RTI
	echo "<table>";
	echo "<tr><th colspan='4'><h1>Referentes TIC Institucional</h1></th></tr>";
	echo "<tr ><th>Apellido</th>";
	echo "<th>Nombre</th>";
	echo "<th>Turno</th>";
	echo "<th>Teléfono</th>";
	echo "<th>Email</th>";
	echo "<th>Estado</th>";
	echo "<th>Acción</th>";
	echo "</tr>";	
	while ($fila = mysqli_fetch_object($dato_rti))
	{
		$total=$total+1;
		echo "<tr  class='editarrtidc'>";
		echo "<td>".$fila->apellido."</td>";	
		echo "<td>".$fila->nombre."</td>";	
		echo "<td>".$fila->turno."</td>";
		echo "<td>".$fila->telefonoC."</td>";
		echo "<td>".$fila->email."</td>";
		echo "<td>".$fila->estado."</td>";
		echo "<td><input type='button' name='cmddetalle".$fila->rtiId."' class='editarrti' id='".$fila->rtiId."' 	value='Editar' /></td>";
		switch($fila->estado)
		{
			case 'EN EJERCICIO':
				$enejercicio=$enejercicio+1;
				break;
			case 'AFECTACION':
				$afectacion=$afectacion+1;
				break;
			case 'LICENCIA':
				$licencia=$licencia+1;
				break;
			case 'RENUNCIA':
				$renuncia=$renuncia+1;
				break;
		}
			
	}
	echo "</table>";	
	//Tabla con Resumen
	echo "<table width='500' style='background-color:#CCC; font-weight:bold' >";
	echo "<tr  class='editarrtidc'>";
	echo "<td>TOTAL: ".$total."&nbsp;&nbsp;&nbsp;    =&nbsp;&nbsp;EJERCICIO: ".$enejercicio."&nbsp;&nbsp;+&nbsp;&nbsp;AFECTACION: ".$afectacion."&nbsp;&nbsp;+&nbsp;&nbsp;LICENCIA: ".$licencia."&nbsp;&nbsp;    +&nbsp;&nbsp;RENUNCIA: ".$renuncia." </td>";	
	echo "</tr>";
	echo "</table>";	
?>
<script type="text/javascript" src="jquery/jquery113.jsp"></script>
<script type="text/javascript" src="jquery/jquery-ui/jquery-ui.min.js"></script> 
<script type="text/javascript" src="includes/mod_cen/Script/gestionarrti.js"></script> 
<link href="includes/mod_cen/css/rti_escuela.css" rel="stylesheet" type="text/css" />
<div id="dialog-form">
<form action="includes/mod_cen/registrarRti.php" method="post" id="form1">
<table width="500">
  <tr>
    <td>Estado</td>
    <td colspan="3">
      <?php 
	  	echo '<select name="cbestado" id="cbestado" style="width:100%">';
			foreach ($datoestado AS $valor) 
	  		echo "<option value='$valor'>$valor</option>";
	  		echo '</select>';?>
    </td>
    </tr>
  <tr>
    <td>Nro. de Documento</td>
    <td><input name="txtdni" type="text" id="txtdni" autofocus />
      <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
      <input name="txtidesacuela" type="hidden" id="txtidesacuela" value="<?php echo $_GET['escuelaId'] ?>"/>
      <input name="idrti" type="hidden" id="idrti" value="<?php if(isset($_GET['id'])){ echo round($_GET['id'],0);}?>" /></td>
    <td>Turno</td>
    <td><label for="cbturno"></label>
      <?php echo '<select name="cbturno" id="cbturno" style="width:100%">';
foreach ($datoturno AS $valor) 
	echo "<option value='$valor'>$valor</option>";
	echo '</select>';?></td>
    </tr>
  <tr>
    <td>Apellido</td>
    <td><input type="text" name="txtapellido" id="txtapellido" class="hades" /></td>
    <td>Nombre</td>
    <td><input type="text" name="txtnombre" id="txtnombre" class="hades" /></td>
  </tr>
  <tr>
    <td>Domicilio</td>
    <td>
      <input type="text" name="txtdomicilio" id="txtdomicilio" class="hades" /></td>
    <td>Cuil</td>
    <td><input type="text" name="txtcuit" id="txtcuit" class="hades" /></td>
  </tr>
  <tr>
    <td>Localidad</td>
    <td>
        <select name="cblocalidad" id="cblocalidad" style="width:100%">
            <?php
do {  
?>
            <option value="<?php echo $row_localidad->localidadId?>"><?php echo $row_localidad->nombre?></option>
            <?php
} while ($row_localidad= mysqli_fetch_object($dato_localidad));
  
?>
          </select></td>
    <td>Código Postal</td>
    <td>
    <input type="text" name="txtcp" id="txtcp" class="hades" /></td>
  </tr>
  <tr>
    <td>Teléfono 1</td>
    <td>
    <input type="text" name="txttelefono1" id="txttelefono1" class="hades" /></td>
    <td>Teléfono 2</td>
    <td>
    <input type="text" name="txttelefono2" id="txttelefono2" class="hades" /></td>
  </tr>
  <tr>
    <td>Email 1</td>
    <td>
    <input type="text" name="txtemail1" id="txtemail1" class="hades" /></td>
    <td>Email 2</td>
    <td>
    <input type="text" name="txtemail2" id="txtemail2" class="hades" /></td>
  </tr>
  <tr>
    <td>Facebook</td>
    <td>
    <input type="text" name="txtfacebook" id="txtfacebook" class="hades"/></td>
    <td>Twitter</td>
    <td>
    <input type="text" name="txttwitter" id="txttwitter" class="hades" /></td>
  </tr>
  
</table>
</form>
</div>