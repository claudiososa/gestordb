

<?php
		include_once('includes/mod_cen/clases/persona.php');
		include_once('includes/mod_cen/clases/localidades.php');
		$personaId=$_GET['personaId'];
		$persona= new Persona($personaId);
		$persona = $persona->getContacto();

		$nuevalocalidad = new Localidad($persona->getLocalidadId());
		$localidad = $nuevalocalidad->getLocalidad();

		$location=new Localidad();
		$resultado=$location->buscar();
		?>
		<div class="container">
		<form class="form-horizontal" action="index.php?men=personas&id=4" method="POST" >
			<input type="hidden" name="personaId" value="<?php echo $personaId ?>"/>

			<div class="col-md-12">
        		<label class="control-label"><h3>Editar Perfil</h3></label>
      		</div>





		<?php include_once('includes/mod_cen/formularios/personaf.php'); ?>
			<div class="form-group">
				<div class="col-md-12">
					<input type='submit' id="boton1" class="btn btn-primary" value='Aplicar Cambios'>
				</div>
			</div>
		</div>
