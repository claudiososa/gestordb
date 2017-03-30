<?php
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/rti.php");
?>
<div class="container">
	<form class="form-horizontal" action='' method='POST'>
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2"><h3>Busqueda de R.T.I.</h3></label>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Apellido</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="apellido" placeholder="Ingrese apellido" autofocus>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nombre</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="nombre" placeholder="Ingrese nombre" autofocus>
					 </div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-2">D.N.I.</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="dni" placeholder="Ingrese n° dni sin puntos" autofocus>
					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">N° Escuela</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="num_escuela" placeholder="Ingrese n° de escuela" autofocus>
					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2"> CUE Escuela</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="cue_escuela" placeholder="Ingrese n° de cue" autofocus>
					 </div>
				</div>
			</div>
		</div>

		
      <div class="form-group">
		<label class="control-label col-md-2">Estado</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <select class="form-control" name="estado_rti">
		 			   <option value="" label="VACIO"> Seleccionar</option>
		 			   <option value="AFECTACION" label="AFECTACION">AFECTACION</option>
		 			   <option value="EN EJERCICIO" label="EN EJERCICIO">EJERCICIO</option>
					   <option value="LICENCIA" label="LICENCIA">LICENCIA</option>
					   <option value="RENUNCIA" label="RENUNCIA">RENUNCIA</option>

					</select>
				 </div>
			</div>
		</div>
	</div>



		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<input type='submit' class="btn btn-primary" value='Buscar'>
			</div>
		</div>
	</form>
</div>
<div class="table-responsive">
<div class="container">
<?php
if(($_POST))
		{

			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
			$localidadId=$_POST["localidadId"];
			$dni=$_POST["dni"];
			$num_escuela=$_POST["num_escuela"];
			$cue_escuela=$_POST["cue_escuela"];
			$estado_rti=$_POST["estado_rti"];


			if($apellido==""){
				$apellido=NULL;
			}
			if($nombre==""){
				$nombre=NULL;
			}
			if($dni==""){
				$dni=NULL;
			}
			if($num_escuela==""){
				$num_escuela=NULL;
			}
			if($cue_escuela==""){
				$cue_escuela=NULL;
			}
			if($estado_rti==""){
				$estado_rti=NULL;
			}


		
			echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
			echo "<thead>";
			echo "<tr><th>Apellido</th>";
			echo "<th>Nombre</th>";
			echo "<th>Dni</th>"; 
			echo "<th>Escuela</th>";
			echo "<th>  Cue</th>";
			echo "<th>Turno</th>";
			echo "<th>Estado</th>";
			echo "<th>Telefono</th>";
			echo "<th>E-mail</th>";
			echo "</tr>";
    		echo "</thead>";
			echo "<tbody>";


			$rti_buscado=new rti(NULL,NULL,NULL,NULL,NULL);
			
			$resultado_rti=$rti_buscado->buscarfull($apellido,$nombre,$dni,$num_escuela,$cue_escuela,$estado_rti);

			while ($fila = mysqli_fetch_object($resultado_rti))
			{
			echo "<tr>";
			echo "<td>".$fila->apellido."</td>";
			echo "<td>".$fila->nombre."</td>";
			echo "<td>".$fila->dni."</td>";
			echo "<td>".$fila->numero."</td>";
			echo "<td>".$fila->cue."</td>";
			echo "<td>".$fila->turno."</td>";
			echo "<td>".$fila->estado."</td>";
			echo "<td>".$fila->telefonoC." ".$fila->telefonoM."</td>";
			echo "<td>".$fila->email."</td>";
			


			//va al final
			echo "</tr>";
			echo "\n";
					
			}

		

		}
		else
		{
			$persona=new Persona(NULL);

		}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
?>
<script type="text/javascript">
$(document).ready(function()
		{
				$("#myTable").tablesorter();
		}
);
</script>
