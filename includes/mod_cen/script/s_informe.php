<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");


//guardar en refid el id que identifica al referente loegado - ett o etj
$refid=$_SESSION["referenteId"];

//se crea un nuevo objeto escuela y se busca la escuela de acuerdo al GET escuelaId
$escuela=new Escuela($_GET["escuelaId"]);
$result_escuela=$escuela->buscar();
$dato_escuela=mysqli_fetch_object($result_escuela);
//objeto nuevo de tipo informe para guardar alli el nuevo registro
$informe = new Informe();

if($_POST){
	if(isset($_POST['editar'])) {
		
	}
	if(isset($_POST['nuevo_producto']) && !isset($_POST['editar'])){
		
		
	}
		
}else{
	echo "<h1>Informe Nuevo</h1>";
	
}

include_once('includes/mod_cen/formularios/f_informe.php');


/*
$escuelas= new Escuela(null,$refid,null,null,null,null,$tipo_escuela);
$referente= new Referente($_SESSION["referenteId"]);



if(isset($_GET["secu"])) {
	$tipo_escuela="null";
	$ejes=new Eje(null,null,"Secundaria");
	$result_cons1= $ejes->buscar();
	$nuevo="Nuevo Encuentro Secundaria";
}else {
	$nuevo="Nuevo Encuentro Primaria";
	$tipo_escuela="Primaria común";
	$ejes=new Eje(null,null,"Primaria");
	$result_cons1= $ejes->buscar();
}

$escuelas= new Escuela(null,$refid,null,null,null,null,$tipo_escuela);
$result_cons2= $escuelas->buscar();
//$result_cons4=mysqli_query("SELECT * FROM escuelas");

if (!empty($_POST['guardar']) ) {
   	
	if (isset($_POST["nroesc"])){
		$nroesc=$_POST["nroesc"];
		
		}
	  else {
		$nroesc=$_GET['sede'];
		$subsede="";  
	  }
   $tipcapac=$_POST["tipcapac"];
	$esta=$_POST["esta"];
	$sede=$_GET["sede"];	
	$fch=$_POST["fch"];
	$hsd=$_POST["hsd"];
	$hsh=$_POST["hsh"];
	$nroenc=$_POST["nroenc"];
	if ($nroenc=="Primer Encuentro")
   		$nroenc=1;
   		else if($nroenc=="Segundo Encuentro")
     		$nroenc=2;
	 		else
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
	$encuentro= new Encuentro(null,$refid,$tipcapac,$nroenc,$fch,$sede,$nroesc,$catering,$obs,$esta,$hsd,$hsh,$cantdoc,$cantrti,$cantsup,$cantpmi,$cantdire,$canteqfor,$cantetj);
	$agregar=$encuentro->agregar();
	echo $tipcapac;
	//echo $agregar;
	$variablephp = "index.php?mod=slat&men=encuentros&id=2";
	?>
	<script type="text/javascript">
	var variablejs = "<?php echo $variablephp; ?>" ;
   function redireccion(){window.location=variablejs;}
   setTimeout ("redireccion()", 6000); 
	</script>	
<?php
}


if ( !empty($_POST['buscar']) ) {
	 $escuela= new Escuela(null,null,null,$_POST['nroesc']);
	 //echo $_POST['nroesc1'];
	 $b_escuela= $escuela->buscar();	 
	 $dato=mysqli_fetch_assoc($b_escuela);   
    $sede=$dato['escuelaId'];
	 $subsede1=$dato['nombre'];}
  else
     {
	 $nroesc='';
	 $subsede='';	 
	 }
?>
  <table border="0">
  	<tr>
    	<td colspan="6"><h1><?php echo $nuevo?></h1></td>
   </tr>
   <?php if(isset($_GET["secu"])) {
   	 echo '<form id="form2" name="form2" method="post" action="index.php?mod=slat&men=encuentros&id=1&secu=1">';  
	}else {
   	 echo '<form id="form2" name="form2" method="post" action="index.php?mod=slat&men=encuentros&id=1">';  		
	}	?>
	 	
 	<tr> 
    	<td>Nro de Escuela Sede:</td>
    	<td><input  placeholder="4 digitos - sin puntos" pattern="[0-9]{4}" name="nroesc" id="fecha11" value="<?php if (!empty($_POST['buscar']))echo $_POST['nroesc'];?>" /></td>
    	<td>
	 	<?php 
    	if (!empty($_POST['buscar']))
     	{
    	 if(mysqli_num_rows($b_escuela)==0)
    	  {
		   echo "<b>Número ingresado no existe en la base de datos<b>";		
		  }    
     	}
    	?>    
    </td>
    <td>Nombre de Escuela Sede:</td>
        <td><input name="subsede1" value="<?php if (!empty($_POST['buscar']))echo $dato['nombre'];?>" size="100" readonly/></td>
	</tr>  
   <tr>  
   	<td colspan="6"><input name="buscar" type="submit" id="buscar" value="Buscar Escuela" />
       </form></td>
    </tr>
    <tr>
           <td height="15" colspan="6" bgcolor="#333333">&nbsp;</td>
         </tr>
  </table>

       <form name="form1" method="post" action="index.php?mod=slat&men=encuentros&id=1&sede=<?php echo $sede?>">   
       <table>
         <tr>
           
         </tr>
         <tr>
           <td>Tipos de Encuentros:</td>
           <td>
		       <?php  
                   echo "<select name='tipcapac'>";
			       	 while($fila=mysqli_fetch_array($result_cons1)){
                         echo "<option value='".$fila['eje_desc']."'>".$fila['eje_desc']."</option>";
                         }
                   echo "</select>";
			   ?>
           </td>
           <td>Estado del Encuentro:</td>
           <td><select name="esta">
                  <option selected="selected">Ha Realizar</option>
                  <option>Realizado</option>
                  <option>Postergado</option>
               </select ></td>
         </tr>
         <?php if(!isset($_GET["secu"])) {
         		?>
         <tr>
           <td width="216">Escuela a Capacitar:</td>
           <td colspan="3">
             <?php  
                   echo "<select name='nroesc'>";
			       while($fila2=mysqli_fetch_array($result_cons2)){
                         echo "<option value='".$fila2['escuelaId']."'>".$fila2['nombre']."</option>";
                         }
                   echo "</select>";
			   ?>
           </td>
         </tr>
         <?php } ?>
         <tr>
           <td height="15" colspan="4" bgcolor="#333333">&nbsp;</td>
         </tr>
         <tr>
           <td>Fecha:</td>
           <td width="177"><input type="date" name="fch" id="fecha" /></td>
           <td width="144">&nbsp;</td>
           <td width="325">&nbsp;</td>
         </tr>
         <tr>
           <td>Hora Inicio:</td>
           <td><input type="time" name="hsd" id="fecha2" /></td>
           <td>Hora Final:</td>
           <td><input type="time" name="hsh" id="fecha3" /></td>
         </tr>
         <tr>
           <td>Nro de encuentro:</td>
           <td><label for="nroenc"></label>
             <select name="nroenc" id="nroenc">
               <option selected="selected">Primer Encuentro</option>
               <option>Segundo Encuentro</option>
               <option>Tercer Encuentro</option>
           </select></td>
			</tr>
         <tr>
           <td>Catering:</td>
           <td><select name="catering" id="nroenc2">
                <option selected>Sin Catering</option>
                <option>Muy Bueno</option>
             	 <option>Bueno</option>
                <option>Malo</option> 
               </select></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Observaciones:</td>
           <td colspan="3"><label for="Observaciones"></label>
           <textarea name="obs" id="Observaciones" cols="90" rows="5"></textarea></td>
         </tr>
         <tr>
           <td colspan="4">ASISTENTES</td>
         </tr>
         <tr>
           <td>Cant. Docentes:</td>
           <td><input name="cantdoc" type="number" min="0" max="1000" id="fecha4" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. Directivos:</td>
           <td><input name="cantdire" type="number" min="0" max="1000"" id="fecha5" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. Supervisores</td>
           <td><input name="cantsup" type="number" min="0" max="1000" id="fecha6" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. ETJ:</td>
           <td><input name="cantetj" type="number" min="0" max="1000" id="fecha7" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. RTI:</td>
           <td><input name="cantrti" type="number" min="0" max="1000" id="fecha8" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td>Cant. Plan de Mejora:</td>
           <td><input name="cantpmi" type="number" min="0" max="1000" id="fecha9" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td align="left">Cant. Equipo de Fortalecimineto:</td>
           <td><input name="canteqfor" type="number" min="0" max="1000" id="fecha10" value="0"></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td align="left">&nbsp;</td>
           <td>&nbsp;</td>
           <td><input type="submit" name="guardar" id="guardar" value="Aplicar Cambios"></td>
           <td>&nbsp;</td>
         </tr>
       </table>
    </form>*/
