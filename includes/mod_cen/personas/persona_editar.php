
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
			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<div class="panel panel-default">

						<div class="panel-body">
							<!-- contenido de mi perfil -->
							<h3 align="center">Datos Personales</h3>
							<hr>
							<!-- aqui empieza columnas-8 para datos 4 para foto -->
							<div class="row">
								<!-- columnas de info personal -->
								<div class="col-md-8">

										<h3><?php echo strtoupper ($persona->getApellido().' '.$persona->getNombre())?></h3>
										<h4><img src="img/iconos/pruebaFotoPerfil/carnet-de-identidad (2).png" alt="">&nbsp&nbsp&nbsp<?php echo $persona->getDni() ?> / <?php echo $persona->getCuil()?></h4>
										<h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="">&nbsp&nbsp&nbsp<?php echo $persona->getTelefonoM() ?></h4>

										<h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp<?php echo $persona->getEmail() ?></h4>
										<?php
										if ($persona->getTelefonoC() != "") {
											echo'<h4><img src="img/iconos/pruebaFotoPerfil/casa.png" alt="">&nbsp&nbsp&nbsp'.$persona->getTelefonoC().'</h4>';
										}
										// if ($persona->getEmail2() != "") {
										// 	echo'<h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">&nbsp&nbsp&nbsp'.$persona->getEmail2().'</h4>';
										// }
										if ($persona->getDireccion() != "") {
											echo'<h4><img src="img/iconos/pruebaFotoPerfil/casa (5).png" alt="">&nbsp&nbsp&nbsp'.$persona->getDireccion().'</h4>';
										}
										if ($persona->getFacebook() != "") {
											echo'<h4><img src="img/iconos/pruebaFotoPerfil/facebook (1).png" alt="">&nbsp&nbsp&nbsp'.$persona->getFacebook().'</h4>';
										}
										if ($persona->getTwitter() != "") {
											echo'<h4><img src="img/iconos/pruebaFotoPerfil/gorjeo.png" alt="">&nbsp&nbsp&nbsp'.$persona->getTwitter().'</h4>';
										}
										if ($persona->getUbicacion() != "") {
											echo'<h4><img src="img/iconos/pruebaFotoPerfil/ubicacion.png" alt="">&nbsp&nbsp&nbsp'.$persona->getUbicacion().'</h4>';
										}


										 ?>
								<button type="button" name="button" data-toggle="modal" data-target="#myModal">Modificar</button>


								</div>
								<!-- columnas de foto -->
								<br>



								<div class="col-md-4">

								<!-- carga de foto de perfil -->
								<?php
							       $nomArchivoFoto="./img/perfil/";
							       if ($persona->getFotoPerfil() == "") {
								         $nomArchivoFoto.= "0000.jpg";
							       }else {
							           $nomArchivoFoto.= $persona->getFotoPerfil();
							           //$nomArchivoFoto.=".jpg";
							             }

							       echo  "<img src='$nomArchivoFoto'  alt='perfil'  class=' img-responsive img-circle' style='width:60%; height:auto;' > "; 

							//$fotperfil=$persona->getFotoPerfil();

						    //echo "<input type='hidden' name='fotoPerfil' value='$fotperfil' >";

						        ?>

									<!--  original <img src="tests/0483.jpg" alt="..." class=" img-responsive img-circle" style="max-width:60%;"> -->

								</div>

							</div><!-- cierre row -->


						</div><!-- cierre panel-body -->

					</div><!-- cierre panel-default -->


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
