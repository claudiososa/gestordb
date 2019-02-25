
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
		<div class="page-wrapper">
		  <div class="container-fluid">
				<div class="row page-titles">
		      <div class="col-md-5 col-8 align-self-center">
		        <h5 class=" m-b-0 m-t-0">Modificar Perfil</h5>

		      </div>

		    </div>
				<div class="row">
					<div class="col-md-8 mx-auto">
						<div class="card">
							<div class="card-body">
								Datos Personales
								<hr>
								<div class="row">
									<div class="col-md-8">
										<h5><?php echo strtoupper ($persona->getApellido().' '.$persona->getNombre())?></h5>
										<h5><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbsp<?php echo $persona->getDni() ?> / <?php echo $persona->getCuil()?></h5>
										<h5><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="">&nbsp&nbsp&nbsp<?php echo $persona->getTelefonoM() ?></h5>

										<h5><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp<?php echo $persona->getEmail() ?></h5>
										<?php
										if ($persona->getTelefonoC() != "") {
											echo'<h5><img src="img/iconos/pruebaFotoPerfil/casa.png" alt="">&nbsp&nbsp&nbsp'.$persona->getTelefonoC().'</h5>';
										}

										if ($persona->getDireccion() != "") {
											echo'<h5><img src="img/iconos/pruebaFotoPerfil/casa (5).png" alt="">&nbsp&nbsp&nbsp'.$persona->getDireccion().'</h5>';
										}
										if ($persona->getFacebook() != "") {
											echo'<h5><img src="img/iconos/pruebaFotoPerfil/facebook (1).png" alt="">&nbsp&nbsp&nbsp'.$persona->getFacebook().'</h5>';
										}
										if ($persona->getTwitter() != "") {
											echo'<h5><img src="img/iconos/pruebaFotoPerfil/gorjeo.png" alt="">&nbsp&nbsp&nbsp'.$persona->getTwitter().'</h5>';
										}
										if ($persona->getUbicacion() != "") {
											echo'<h5><img src="img/iconos/pruebaFotoPerfil/ubicacion.png" alt="">&nbsp&nbsp&nbsp'.$persona->getUbicacion().'</h5>';
										}


										 ?>
										 <button type="button" name="button" data-toggle="modal" data-target="#myModal">Modificar</button>
									</div>
									<div class="col-md-4">
										<?php
									       $nomArchivoFoto="./img/perfil/";
									       if ($persona->getFotoPerfil() == "") {
										         $nomArchivoFoto.= "0000.jpg";
									       }else {
									           $nomArchivoFoto.= $persona->getFotoPerfil();
									           //$nomArchivoFoto.=".jpg";
									             }

									       echo  "<img src='$nomArchivoFoto'  alt='perfil'  class=' img-responsive rounded-circle' style='width:150px; height:150px;' > ";



								        ?>
									</div>

								</div>

							</div>

						</div>

					</div>

				</div>
			</div>
		</div>



     <?php include_once('includes/mod_cen/formularios/personaf.php'); ?>
<!--
		<div class="container">
		<form class="form-horizontal" action="index.php?men=personas&id=4" method="POST" >
			<input type="hidden" name="personaId" value="<?php //echo $personaId ?>"/>

			<div class="col-md-12">
        		<label class="control-label"><h3>Editar Perfil</h3></label>
      		</div>





		<?php //include_once('includes/mod_cen/formularios/personaf.php'); ?>
			<div class="form-group">
				<div class="col-md-12">
					<input type='submit' id="boton1" class="btn btn-primary" value='Aplicar Cambios'>
				</div>
			</div>
		</div> -->
