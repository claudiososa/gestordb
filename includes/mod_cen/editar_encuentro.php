<?php
include_once("includes/mod_cen/clases/encuentro.php");
include_once("includes/mod_cen/clases/ejes.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/ejes.php");

$refid=$_SESSION["referenteId"]; // variable identifica el referente logeado

$nroid=$_GET["nroid"]; //variable identifica el registro de Encuentro
//echo $nroid;
//busca y devuelve todos los ejes posibles lo almacena en $cons1.
$ejes=new Eje();
$cons1= $ejes->buscar();
//--------------------------------//

//busca y devuelve todas las escuelas donde el referente logeado esta a cargo
//y la escuela se de tipo primaría
$escuelas= new Escuela(null,$refid,null,null,null,null,'Primaria Común');
$cons2= $escuelas->buscar();
//------------------------------------//

//busca y devuelve el registro del encuentro que se esta editando
//luego carga en $dato el resultado como un array
$encuentros= new Encuentro($nroid,null);
$cons3=$encuentros->buscar();
$dato = mysqli_fetch_assoc($cons3);

//--------------------------------//

//Buscar y devuelve Sede el encuentro actual
//crear objeto escuela y asigna al atributo escuelaId el valor segun el campo
//enc_sede de la tabla encuentro, del registro actual
//luego busca y devuelve el resultado en la variable $b_sede - como tipo objeto
$sede= new Escuela();
$sede->escuelaId=$dato['enc_sede'];
$b_sede=$sede->buscar();
$dato_sede=mysqli_fetch_object($b_sede);

//asigna al objeto escuela en el atributo escuelaId el valor enc_noresc
//que corresponde a la escuela a capacitar en el encuentro actual
//se busca en escuela y el resultado se almacena en $dato_escu - en formato objeto
$sede->escuelaId=$dato['enc_nroesc'];
$b_numero=$sede->buscar();
$dato_escu=mysqli_fetch_object($b_numero);

if(isset($_GET["secu"])) {
	$editando="Editando Encuentro Secundaria";
	$tipo_escuela="null";
	$ejes=new Eje(null,null,"Secundaria");
	$result_cons1= $ejes->buscar();
}else {
	$editando="Editando Encuentro Primaria";
	$tipo_escuela="Primaria común";
	$ejes=new Eje(null,null,"Primaria");
	$result_cons1= $ejes->buscar();
}


if($dato['enc_nroenc']==1)
    $vardato="Primer Encuentro";
  else if ($dato['enc_nroenc']==2)
      $vardato="Segundo Encuentro";
	 else
	   $vardato="Tercer Encuentro"; 	
	   
   
if ( !empty($_POST['buscar']) ) {
	 $escuela= new Escuela(null,null,null,$_POST['num_sede']);
	 $b_escuela= $escuela->buscar();	 
	 $datob=mysqli_fetch_assoc($b_escuela);   
   }
 

if ( !empty($_POST['editado']) )
 {
 	
	$escuela= new Escuela(null,null,null,$_GET['sede']);
	$b_escuela= $escuela->buscar();	 
	$dato=mysqli_fetch_assoc($b_escuela);   
   $sede_id=$dato['escuelaId'];		
   
   if (isset($_POST["escuela"])){
		$nroesc=$_POST["escuela"]; 		
	}else{
		$nroesc=$dato['escuelaId'];
		$subsede="";  
	  }
	
	 
   $tipcapac=$_POST["tipcapac"];
	$esta=$_POST["esta"];
	//$sede=$_GET["sede"];
	
	$fch=$_POST["fch"];
	$hsd=$_POST["hsd"];
	$hsh=$_POST["hsh"];
	$nroenc=$_POST["nroenc"];
	if ($nroenc=="Primer Encuentro")
   		$nroenc=1;
   		else if($nroenc=="Segundo Encuentro")
     		$nroenc=2;
	 		else if($nroenc=="Tercer Encuentro")
	  			$nroenc=3;   
	$catering=$_POST["catering"];
	$obs=$_POST["obs"];
	$cantdoc=$_POST["cantdoc"];
	$cantdire=$_POST["cantdire"];
	$cantsup=$_POST["cantsup"];
	$cantetj=$_POST["cantetj"];
	$cantrti=$_POST["cantrti"];
	$cantpmi=$_POST["cantpmi"];
	$canteqfor=$_POST["canteqfor"];
	
	$encuentro= new Encuentro($nroid,$refid,$tipcapac,$nroenc,$fch,$sede_id,$nroesc,$catering,$obs,$esta,$hsd,$hsh,$cantdoc,$cantrti,$cantsup,$cantpmi,$cantdire,$canteqfor,$cantetj);
	$editar=$encuentro->editar();
   if($editar==1) 
   	{
			$variablephp = "index.php?mod=slat&men=encuentros&id=2";
			?>
			<script type="text/javascript">
				var variablejs = "<?php echo $variablephp; ?>" ;
   			function redireccion(){window.location=variablejs;}
   			setTimeout ("redireccion()", 0); 
			</script>   	
   	<?php 
   	} 
}
?>  
  <table border="0">
  <tr>
    <td  colspan="6"><h1><?php echo $editando ?></h1></td>
  </tr>
	 <?php if(isset($_GET["secu"])) {
   	 echo '<form method="post" action="index.php?mod=slat&men=encuentros&id=4&secu=1&nroid='.$_GET["nroid"].'">';  		
	}else {
   	 echo '<form method="post" action="index.php?mod=slat&men=encuentros&id=4&nroid='.$_GET["nroid"].'">';  		
	}	?>  
  <tr> 
    <td >Nro de Escuela Sede:</td>
    <td ><input placeholder="4 digitos - sin puntos" pattern="[0-9]{4}" name="num_sede" value="<?php 
			if (!empty($_POST['buscar'])){
				echo $_POST['num_sede'];
				$sede=$_POST['num_sede'];
			}else{
				$sede=$dato_sede->numero; 				 			
    			echo $dato_sede->numero;
    		}?>"  /></td>
    <td>Nombre de Escuela Sede:</td>
    <td colspan="2"><input name="subsede1" size="100" value="<?php 
			if (!empty($_POST['buscar'])){
				echo $datob['nombre'];    
    		}else{
    			echo $dato_sede->nombre;
    		}?>" readonly /></td>
    </tr>		
	 <tr>    
    	<td colspan="6"><input name="buscar" type="submit" id="buscar" value="Buscar " />
      
      </form></td>
    </tr>
     <tr>
           <td height="15" colspan="6" bgcolor="#333333">&nbsp;</td>
         </tr>
  </table> 
       <form name="form1" method="post" action="index.php?mod=slat&men=encuentros&id=4&nroesc=<?php echo $dato_escu->numero?>&sede=<?php echo $sede ?>&nroid=<?php echo $nroid ?>">   
       <table width="890" border="0">
         <tr>
           
         </tr>
         <tr>
           <td>Tipos de Encuentros:</td>
           <td>
		       <?php 		          
                   echo "<select name='tipcapac'>";
			       	 while($fila=mysqli_fetch_array($result_cons1)){
			       	 	if($fila['eje_desc']==$dato['enc_tipcapac']) {
                         echo "<option selected>".$fila['eje_desc']."</option>";
                     }else {
                         echo "<option>".$fila['eje_desc']."</option>";   
                     }
                  }
                   echo "</select>";
			   
		       /*
		            echo "<option selected value='".$fila['eje_nroId']."'>".$fila['eje_desc']."</option>";
		       	
		       		$estructura= new Encuentro();
  						$datocampo= $estructura->estructura('enc_tipcapac');
					   echo '<select name="tipcapac">';
  						foreach ($datocampo AS $valor) 
							if($valor==$dato['enc_tipcapac']) {
							  echo "<option value='$valor' selected>$valor</option>";	
							}else {
								echo "<option value='$valor'>$valor</option>";
							}	  							
  						echo '</select>';*/
             ?>
           </td>
           <td>Estado del Encuentro</td>
           <td><select name="esta">
               <option value="Realizado" <?php if($dato['enc_esta']=='Realizado') echo 'selected'?> >Realizado</option>
               <option value="Ha realizar"<?php if($dato['enc_esta']=='Ha realizar') echo 'selected'?>>Ha realizar</option>
               <option value="Postergado"<?php if($dato['enc_esta']=='Postergado') echo 'selected'?>>Postergado</option>
           </select ></td>
         </tr>
          <?php if(!isset($_GET["secu"])) {
         		?>
         <tr>
           <td width="160">Escuela a Capacitar:</td>
           <td colspan="3">
             <?php  
               echo "<select name='escuela'>";
				   //echo"<option selected>".$dato['enc_nroesc']."</option>";
			       while($fila2=mysqli_fetch_array($cons2)){
								 if($dato['enc_nroesc']==$fila2['escuelaId']) {
								 	echo "<option selected value='".$fila2['escuelaId']."'>".$fila2['nombre']."</option>"; 
								 }else {
								 	echo "<option value='".$fila2['escuelaId']."'>".$fila2['nombre']."</option>";                         
                         }
                 }  
                   echo "</select>";
			   ?>
           </td>
         </tr>
          <?php } ?>
         <tr>
           <td bgcolor="#000000">&nbsp;</td>
           <td colspan="3" bgcolor="#000000">&nbsp;</td>
         </tr>
         <tr>
           
         </tr>
         <tr>
           <td>Fecha:</td>
           <td width="149"><label for="fecha"></label>
           <input type="date" name="fch" id="fecha" value="<?php echo $dato['enc_fch'];?>"></td>
           <td width="164">&nbsp;</td>
           <td width="308">&nbsp;</td>
         </tr>
         <tr>
           <td>Hora Inicio:</td>
           <td><input type="time" name="hsd" id="fecha2" value="<?php echo $dato['enc_hsd'];?>"/></td>
           <td>Hora Final:</td>
           <td><input type="time" name="hsh" id="fecha3" value="<?php echo $dato['enc_hsh'];?>"/></td>
         </tr>
         <tr>
           <td>Nro de encuentro:</td>
           <td><label for="nroenc"></label>
             <select name="nroenc" id="nroenc">
               
               <option value="Primer Encuentro" <?php if($vardato=='Primer Encuentro') echo 'selected'?>>Primer Encuentro</option>
               <option value="Segundo Encuentro" <?php if($vardato=='Segundo Encuentro') echo 'selected'?>>Segundo Encuentro</option>
               <option value="Tercer Encuentro" <?php if($vardato=='Tercer Encuentro') echo 'selected'?> >Tercer Encuentro</option>
           </select></td>
           <td><input type="hidden" name="nroesc" value="<?php if (!empty($_POST['buscar'])) echo $dato['enc_nroesc'];?>"/></td>
           <td><input type="hidden" name="subsede" size="100" value="<?php if (!empty($_POST['buscar']))echo $dato['enc_subsede'];?>" /></td>
         </tr>
         <tr>
           <td>Catering:</td>
           <td> <?php  
		       		$estructura= new Encuentro();
  						$datocampo= $estructura->estructura('enc_catering');
					   echo '<select name="catering">';
  						foreach ($datocampo AS $valor) 
							if($valor==$dato['enc_catering']) {
							  echo "<option value='$valor' selected>$valor</option>";	
							}else {
								echo "<option value='$valor'>$valor</option>";
							}	  							
  						echo '</select>';
             ?>
           </td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Observaciones:</td>
           <td colspan="3"><label for="Observaciones"></label>
           <textarea name="obs" id="Observaciones" cols="90" rows="5" ><?php echo $dato['enc_obs'];?></textarea></td>
         </tr>
         <tr>
           <td colspan="4">ASISTENTES</td>
         </tr>
         <tr>
           <td>Cant. Docentes:</td>
           <td><input name="cantdoc" type="number" min="0" max="1000" id="fecha4" value="<?php echo $dato['enc_cantdoc'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. Directivos:</td>
           <td><input name="cantdire" type="number" min="0" max="1000" id="fecha5" value="<?php echo $dato['enc_cantdire'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. Supervisores</td>
           <td><input name="cantsup" type="number" min="0" max="1000" id="fecha6" value="<?php echo $dato['enc_cantsup'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. ETJ:</td>
           <td><input name="cantetj" type="number" min="0" max="1000" id="fecha7" value="<?php echo $dato['enc_cantetj'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. RTI:</td>
           <td><input name="cantrti" type="number" min="0" max="1000" id="fecha8" value="<?php echo $dato['enc_cantrti'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. Plan de Mejora:</td>
           <td><input name="cantpmi" type="number" min="0" max="1000" id="fecha9" value="<?php echo $dato['enc_cantpmi'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td align="left">Cant. Equipo de Fortalecimineto:</td>
           <td><input name="canteqfor" type="number" min="0" max="1000" id="fecha10" value="<?php echo $dato['enc_canteqfor'];?>"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td align="left">&nbsp;</td>
           <td>&nbsp;</td>
           <td><input type="submit" name="editado" id="guardar" value="Aplicar Cambios"></td>
           <td>&nbsp;</td>
         </tr>
       </table>
       </form>
 