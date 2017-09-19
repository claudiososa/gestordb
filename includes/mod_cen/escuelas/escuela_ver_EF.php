
<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
?>
<div class="container">


<table>
	<form action='' method='POST'>
	<tr><td>Número</td>
		 <td>Cue</td>
		 <td>Nombre</td>
		 <td>Departamento</td>
		 <td>
			Nivel
		 </td>
	</tr>
	<tr>
		<th><input type='text' name='numero' size="4"></th>
		<th><input type='text' name='cue'size="7"></th>
		<th><input type='text' name='nombre'></th>
		<th>
		<?php
		$departamento= new Departamentos();
				$total=$departamento->getTotal();
				echo "<select name='localidadId'>";
					echo	"<option value='NULL'>Todos</option>";
				for($val=2;$val<=$total;$val++) {
					$departamento= new Departamentos($val);
					$dato=$departamento->getDepartamento();
					echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
					}
				echo "</select>";?>
		</th>
		<th>
		 <select name="nivel">
		 					<option value="0" label="todos">Todos</option>
		 					<option value="Sin registrar" label="Sin registrar">Sin registrar</option>
								<option value="Primaria Común" label="Primaria Común">Primaria Común</option>
								<option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>
								<option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>
								<option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>
								<option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
								<option value="ISFD" label="ISFD">ISFD</option>
								<option value="IEM" label="IEM">IEM</option>
								<option value="Capacitación" label="Capacitación">Capacitación</option>

					</select>
			</th>
		<th colspan='3'><input type='submit' value='Buscar'></th></tr>
		</form>
</table>
</div>
<div class="container">


		<?php

if(($_POST))
	{
				//var_dump($_POST);
				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];
				$nivel=$_POST["nivel"];

				/*if($localidadId=="0"){
					$locadlidadId="NULL";
				}
				*/
				if($nivel=="0"){
				$nivel=NULL;
				}

				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,$nivel,$localidadId,null);



				$resultado = $escuela->buscar();
				echo "<table>";
				echo "<tr>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
			  	echo "<th>Localidad</th>";
			  	echo "<th>Referente a Cargo</th>";
			  	echo "<th></th>";
			  	echo "<th>Ver</th>";
				echo "</tr>";
				$arreglo[]=array();
				$arreglo["0"]="0";
				$i=0;

				while ($fila = mysqli_fetch_object($resultado))
				{
					$repite=0;
					$encontrado=0;
					if($i==0)
						$arreglo[$i]=$fila->referenteId;
					else
						foreach ($arreglo as $clave => $valor)
						{
							if($arreglo[$clave]==$fila->referenteId)
								$repite++;
						}
						if($repite>0)
							$encontrado=$repite;
							$arreglo[count($arreglo)]=$fila->referenteId;
					$i++;




					$crearreferente=new Referente($fila->referenteId);
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();

			  		$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();

			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>"."<a href='index.php?mod=slat&men=admin&id=7&escuelaId=".$fila->escuelaId."'>".$fila->nombre."</a></td>";

			  		//echo "<td>".substr($fila->nombre,0, 40)."</td>";

			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";
			  		echo "<td>";
			  		/*if($encontrado==0){

			  				echo "<div class='divSimple' id='sel_".$fila->referenteId."'>";
			  				$ett= new Referente(null,null,"ETT");
							$buscar_ett=$ett->buscar();

							echo "<select name='referentes' disabled>";
							//echo	"<option value=0>Todos</option>";
									while ($fila1 = mysqli_fetch_object($buscar_ett))
									{
										$persona = new Persona($fila1->personaId);
										$persona->getContacto();
										$nombre=$persona->getNombre();
										$apellido=$persona->getApellido();
										if($fila1->referenteId==$_SESSION["referenteId"])
											echo	"<option value='$fila1->referenteId' selected >$apellido".",&nbsp;".$nombre."</option>";
										else
											echo	"<option value='$fila1->referenteId' >$apellido".",&nbsp;".$nombre."</option>";

									}

							echo "</select></div>";
			  		}else{

			  			echo "<div class='divSimple' id='sel_".$fila->referenteId.$encontrado."'>";

			  			$ett= new Referente(null,null,"ETT");
			  			$buscar_ett=$ett->buscar();

			  			echo "<select name='referentes' disabled>";
			  			//echo	"<option value=0>Todos</option>";
			  			while ($fila1 = mysqli_fetch_object($buscar_ett))
			  			{
			  				$persona = new Persona($fila1->personaId);
			  				$persona->getContacto();
			  				$nombre=$persona->getNombre();
			  				$apellido=$persona->getApellido();
			  				if($fila1->referenteId==$_SESSION["referenteId"])
			  					echo	"<option value='$fila1->referenteId' selected >$apellido".",&nbsp;".$nombre."</option>";
			  					else
			  					echo	"<option value='$fila1->referenteId' >$apellido".",&nbsp;".$nombre."</option>";

			  			}

			  			echo "</select></div>";


			  		}

			  		//*/



			  				if($encontrado==0)
			  					echo "<div class='divSimple' id='ref_".$fila->referenteId."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$nombrePersona.", ".$apellidoPersona.
					  			"</a></div>";
					  		else
					  			echo "<div class='divSimple' id='ref_".$fila->referenteId.$encontrado."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$nombrePersona.", ".$apellidoPersona.
					  			"</a></div>";

					  		echo "<div class='divSimple1'>&nbsp;&nbsp;&nbsp;";
					  		/*
					  		if($encontrado==0)

					  			echo "<input type='image' src='img/iconos/modificar_p.png'  height='22' width='22' value='".$fila->referenteId."' id='b_".$fila->referenteId."'/>
					  	  		<input type='image' src='img/iconos/guardar.png'  height='22' width='22' value='".$fila->referenteId."' id='g_".$fila->referenteId."'/>
					  	  	</div>";
					  	  	else
					  	  		echo "<input type='image' src='img/iconos/modificar_p.png'  height='22' width='22' value='".$fila->referenteId.$encontrado."' id='b_".$fila->referenteId.$encontrado."'/>
					  	  		<input type='image' src='img/iconos/guardar.png'  height='22' width='22' value='".$fila->referenteId.$encontrado."' id='g_".$fila->referenteId.$encontrado."'/>
					  	  		</div>";
							*/



					echo "</td>";


			  		/*echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>"."<img src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></td>";
			  		*			  		<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".
			  				"<img  src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></div></td>";
			  		**/
			  		echo "<td>"."<a href='index.php?men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>Ver más</a>"."</td>";
			  		echo "</tr>";
		  	  		echo "\n";

	      	}
	      	echo "</table>";
			//}
		}else{
			$escuela=new Escuela(NULL);
		}
		//var venta= "<?php echo $_GET['registro']  ";
?>
</div>
<script type="text/javascript" src="jquery/jquery113.jsp"></script>
			<script language="javascript">
			$(document).ready(function(){
				//alert("llego hasta aqui");
				$('[id^=sel_]').hide();
				$('[id^=g_]').hide();
				//alert(boton);
				 $('[id^=b_]').click(function () {
					 $('#ref_'+$(this).val()).hide()

					 $('#sel_'+$(this).val()).show();

					 $('#b_'+$(this).val()).hide()
					 $('#g_'+$(this).val()).show()

					 	//var valor =$(this).val();
						//alert(valor);
				//		var detalle = $(this).val();
				//		$.post("includes/mod_cen/clases/c_productos.php", { detalle: detalle, venta: venta }, function(data){
				//			var resultado = JSON.parse(data);
				//			var dato = resultado['estado'];
				//			var total = resultado['total'];
				//			$('#'+dato).remove();
				//			$('#total').text("Total:    "+total);
         			});
				//});

				 $('[id^=g_]').click(function () {
					 $('#ref_'+$(this).val()).show()

					 $('#sel_'+$(this).val()).hide();

					 $('#b_'+$(this).val()).show()
					 $('#g_'+$(this).val()).hide()

					 	//var valor =$(this).val();
						//alert(valor);
				//		var detalle = $(this).val();
				//		$.post("includes/mod_cen/clases/c_productos.php", { detalle: detalle, venta: venta }, function(data){
				//			var resultado = JSON.parse(data);
				//			var dato = resultado['estado'];
				//			var total = resultado['total'];
				//			$('#'+dato).remove();
				//			$('#total').text("Total:    "+total);
         			});

			});
</script>

<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {
                               // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xlsx'],
		bootstrap: true             // (String[]), filetype(s) for the export, (default: ['xls', 'csv', 'txt'])

	});





</script>