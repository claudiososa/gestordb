<?php
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/ProfeEdFisicaxEscuela.php");
?>
<div class="container">
	<form class="form-horizontal" action='' method='POST'>
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2"><h3>Busqueda de Referentes</h3></label>
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
			<label class="control-label col-md-2">Departamento</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
					 	<?php
							$departamento= new Departamentos();
							$total=$departamento->getTotal();
							echo "<select class='form-control' name='localidadId'>";
							echo	"<option value=0>Ninguno</option>";
							for($val=2;$val<=$total;$val++) {
								$departamento= new Departamentos($val);
								$dato=$departamento->getDepartamento();
								echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
								}
							echo "</select>";
						?>
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
//var_dump($_POST);
if($_POST)
		{
			$apellido=$_POST["apellido"];
			$nombre=$_POST["nombre"];
			$localidadId=$_POST["localidadId"];
			if($apellido==""){
				$apellido=NULL;
			}
			if($nombre==""){
				$nombre=NULL;
			}
			if($localidadId=="0"){
				$localidadId=NULL;
			}

			$persona = new Persona(NULL,$apellido,$nombre,null,null,null,null,null,null,null,null,null,$localidadId,null);
			$resultado = $persona->buscar();

			echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
			echo "<thead>";
			echo "<tr><th>Apellido</th>";
			echo "<th>Nombre</th>";
			echo "<th>Tipo</th>";
			echo "<th>Email</th>";
			echo "<th>Teléfono</th>";
			echo "<th>Esc N° </th>";
			echo "</tr>";
            echo "</thead>";
			echo "<tbody>";
			while ($fila = mysqli_fetch_object($resultado))
			{
				

				//var_dump($resultado);
				$referente= new Referente(NULL,$fila->personaId,NULL,NULL,NULL,NULL,NULL,"Activo");
				$buscarReferente = $referente->buscar();
				//var_dump($buscarReferente);

				//if ($buscarReferente != NULL){

				//$datoreferente=mysqli_fetch_object($buscarReferente);
				while ($fila2 = mysqli_fetch_object($buscarReferente))
					{

						// buscar referente o coordinador ed fisica o prof ed fisica 

					if($fila2->tipo == "ReferenteEducacionFisica" || $fila2->tipo == "CoordinadorEducacionFisica"){		

						echo "<tr>";
						echo "<td>".$fila->apellido."</td>";
						echo "<td>".$fila->nombre."</td>";
						echo "<td>".$fila2->tipo."</td>";
						echo "<td>".$fila->email."</td>";
						echo "<td>".$fila->telefonoC."</td>";

						/*if($_SESSION["tipo"]=="admin") {
								echo "<td>"."<a href='index.php?men=referentes&id=2&personaId=".$fila2->personaId."&referenteId=".$fila2->referenteId."'>Ver</a>"."</td>";
								echo "<td>"."<a href='index.php?men=referentes&id=3&referenteId=".$fila2->referenteId."'>Editar</a>"."</td>";
						}else {
								echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila2->personaId."&referenteId=".$fila2->referenteId."'>Ver más</a>"."</td>";
						} */
						echo "<td> -- </td>";
						echo "</tr>";
						echo "\n";
					  }
					}
			//	}else{

					$profeEF = new ProfeEdFisicaxEscuela(NULL,$fila->personaId);
					$buscarReferente = $profeEF->buscar();
					
					while ($fila2 = mysqli_fetch_object($buscarReferente))
					{

						// buscar prof ed fisica 

						echo "<tr>";
						echo "<td>".$fila2->apellido."</td>";
						echo "<td>".$fila2->nombre."</td>";
						echo "<td> Prof. Ed. Fisica</td>";
						echo "<td>".$fila2->email."</td>";
						echo "<td>".$fila2->telefonoC."</td>";

						/*
						if($_SESSION["tipo"]=="admin") {
								echo "<td>"."<a href='index.php?men=referentes&id=2&personaId=".$fila2->personaId."&referenteId=".$fila2->referenteId."'>Ver</a>"."</td>";
								echo "<td>"."<a href='index.php?men=referentes&id=3&referenteId=".$fila2->referenteId."'>Editar</a>"."</td>";
						}else {
								echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila2->personaId."&referenteId=".$fila2->referenteId."'>Ver más</a>"."</td>";
						}*/
						echo "<td>".$fila2->numero."</td>";
						echo "</tr>";
						echo "\n";
					  
					}




				//}
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