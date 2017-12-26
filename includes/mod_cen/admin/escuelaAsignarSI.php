<?php
include_once("includes/mod_cen/clases/maestro.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/EscuelaReferentes.php");

include_once("includes/mod_cen/formularios/f_asignar_escuela.php");

if(($_POST))
	{
		  	$escuela=new Escuela(NULL,null,$_POST["cue"],$_POST["numero"],$_POST["nombre"],null,null,null,null);
				$resultado = $escuela->buscar();
				echo '<div class="table-responsive">';
				echo "<table class='table table-hover table-striped table-condensed'>";
				echo "<tr>";
			  	echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
			  	echo "<th>Localidad</th>";
			  	echo "<th>Referente PMI a Cargo</th>";
				echo "</tr>";
				//crear objeto vacio de tipo autoridades.
				$objEscuelaReferentes = new EscuelaReferentes();

				//Recorre todas las escuelas encontradas de acuerdo a lo ingresado en el buscador
				while ($fila = mysqli_fetch_object($resultado))
				{
					$objEscuelaReferentes->escuelaId = $fila->escuelaId;
					$buscarReferente = $objEscuelaReferentes->buscarReferente('6');
					//var_dump($buscarReferente);
					if ($buscarReferente <>'0') {
						$encontrado = $buscarReferente->referenteId;
						//var_dump($encontrado);
					}
						echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
						echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>".substr($fila->nombre,0, 40)."</td>";

			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1 = mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";
			  		echo "<td>";
			  		if($encontrado=='0'){//SI LA ESCUELA ENCONTRADA NO TIENE REFERENTE ACARGO
			  				//echo "<div class='divSimple' id='sel_".$fila->escuelaId."'>";
			  			$supervisor= new Referente();
							$buscar_supervisor=$supervisor->buscarRef2("SI");

							echo "<select disabled id='seleref_".$fila->escuelaId."' name='referentes' >";
							echo	"<option value='0001'>Sin Asignar</option>";
							while ($fila1 = mysqli_fetch_object($buscar_supervisor))
									{
											echo	"<option value='".$fila1->referenteId."' >$fila1->apellido".",&nbsp;".$fila1->nombre."</option>";
									}
									echo "</select></div>";
			  		}else{
			  			echo "<div class='divSimple' id='sel_".$fila->escuelaId.$encontrado."'>";

			  			$supervisor = new Referente();
							$buscar_supervisor = $supervisor->buscarRef2('SI');

			  			echo "<select  disabled id='seleref_".$fila->escuelaId.$encontrado."' name='referentes' >";
			  			//echo	"<option value=0>Todos</option>";
			  			echo	"<option value='0001'>Sin Asignar</option>";
			  			while ($fila1 = mysqli_fetch_object($buscar_supervisor))
			  			{
								//echo $fila1->referenteId;
								if ($fila1->referenteId==$encontrado) {
									echo	"<option selected value='".$fila1->referenteId."'>$fila1->apellido".",&nbsp;".$fila1->nombre."</option>";
								}else{
									echo	"<option value='".$fila1->referenteId."'>$fila1->apellido".",&nbsp;".$fila1->nombre."</option>";
								}

							}

			  			echo "</select></div>";


			  		}

		  				if($encontrado==0)
							{
								echo "<div class='divSimple'  value='esc_".$fila->escuelaId."'  id='ref_".$fila->escuelaId."'>Sin asignar</div>";
							}else{
								echo "<div class='divSimple' value='esc_".$fila->escuelaId."' id='ref_".$fila->escuelaId.$encontrado."'>".
								"<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$objReferente->personaId."&referenteId=".$fila->referenteId."'>".
								$buscarReferente->apellido.", ".$buscarReferente->nombre.
								"</a></div>";
								//echo "<div class='divSimple1'>&nbsp;&nbsp;&nbsp;";
							}

					  		if($encontrado==0)

					  			echo "<input type='image' src='img/iconos/modificar_p.png'  height='22' width='22' value='".$fila->escuelaId."' id='b_".$fila->escuelaId."'/>
					  	  		<input type='image' src='img/iconos/guardar.png'  height='22' width='22' value='".$fila->escuelaId."' id='g_".$fila->escuelaId."'/>
					  	  	</div>";
					  	  	else
					  	  		echo "<input type='image' src='img/iconos/modificar_p.png'  height='22' width='22' value='".$fila->escuelaId.$encontrado."' id='b_".$fila->escuelaId.$encontrado."'/>
					  	  		<input type='image' src='img/iconos/guardar.png'  height='22' width='22' value='".$fila->escuelaId.$encontrado."' id='g_".$fila->escuelaId.$encontrado."'/>
					  	  		</div>";




					echo "</td>";
			  		/*echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>"."<img src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></td>";
			  		*			  		<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".
			  				"<img  src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></div></td>";
			  		**/


			  		echo "</tr>";
		  	  		echo "\n";

	      	}
	      	echo "</table>";
					echo "</div>";
			//}
		}else{
			$escuela=new Escuela(NULL);
		}
		//var venta= "<?php echo $_GET['registro']  ";
?>
<script type="text/javascript" src="jquery/jquery113.jsp"></script>
			<script language="javascript">
			$(document).ready(function(){
				//alert("llego hasta aqui");
				$('[id^=sel_]').hide();
				$('[id^=g_]').hide();
				//alert(boton);
				 $('[id^=b_]').click(function () {

					 var seleref = $('#seleref_'+$(this).val()).attr("id");
					 $('#'+seleref).attr('disabled', false);

					 $('#ref_'+$(this).val()).hide()

					 $('#sel_'+$(this).val()).show();

					 $('#b_'+$(this).val()).hide()
					 $('#g_'+$(this).val()).show()

         			});


				 $('[id^=g_]').click(function () {
					 var seleref = $('#seleref_'+$(this).val()).attr("id");

					 var refe = $('#ref_'+$(this).val()).attr("id");
					 var sele = $('#sel_'+$(this).val()).attr("id");

					 $('#b_'+$(this).val()).show()
					 $('#g_'+$(this).val()).hide()

					 var valor =$('#ref_'+$(this).val()).attr('id');

					 var referente_id =$("#"+seleref).val();

					 var escuela = $('#ref_'+$(this).val()).attr("value");
					 var seleref = $('#seleref_'+$(this).val()).attr("id");
					 var escuela_id=escuela.substring(4,8);

					 //var snp = 'snp'
					 var tipo = '6'

					 $.post("includes/mod_cen/clases/escuela.php", {tipo:tipo,referente_id: referente_id, escuela_id: escuela_id }, function(data){
					 var resultado = JSON.parse(data);
					 var dato = resultado['estado'];

					 $('#'+valor).html(dato);
					 $('#'+sele).hide();
					 $('#'+refe).show();

						});
         			});

			});
</script>