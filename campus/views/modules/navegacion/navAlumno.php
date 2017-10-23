<nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#">Campus Virtual</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<?php
				if(isset($_SESSION["typeUser"]))
				{
					echo '<li><a class="nav-link"  href="index.php?action=ok">Inicio</a></li>';
				}else{
				}
		 		?>
				<li><a class="nav-link"  href="index.php?action=salir">Cerrar Sesión</a></li>
				<li><a class="nav-link"  href='#'>
				<?php
				if(isset($_SESSION["typeUser"])){
					echo 'Tipo de usuario: '.$_SESSION["typeUser"];
				}
				 ?>
				 </a></li>
			</ul>
		</div>
	</div>
</nav>
