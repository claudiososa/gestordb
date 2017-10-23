<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
					echo '<li class="nav-item active" id="1a"><a class="nav-link" href="index.php?action=ok">Inicio<span class="sr-only">(current)</span></a></li>';
				}else{
				 echo '<li><a href="index.php?action=ingresar">Ingreso</a></li>';
				}
				?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?action=createCourse">Cursos</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="index.php?action=usuarios">Usuarios</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="index.php?action=createPerson">Crear Personas</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="index.php?action=person">Listar Personas</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="index.php?action=searchPerson">Buscar Persona</a>
				</li>


				<li class="nav-item"><a class="nav-link"href="index.php?action=salir">Cerrar Sesión</a></li>
				<li class="nav-item"><a class="nav-link"href='#'>

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
