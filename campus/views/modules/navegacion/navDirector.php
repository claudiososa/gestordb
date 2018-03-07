
	<nav class="navbar fixed-top navbar-toggleable-md navbar-light" id="mainNav">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
				Menu <i class="fa fa-bars"></i>
		</button>
		<div class="container">

<a class="navbar-brand" href="index.php?action=ok">5159</a>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <a class="nav-link" href="index.php?action=coursesDirector">Cursos</a>
      </li>

			<li class="nav-item">
        <a class="nav-link" href="index.php?action=searchPersonDirector">Buscar Persona</a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="index.php?action=statisDirector">Estadisticas</a>
      </li>
			<li class="nav-item">
        <a class="nav-link" href="index.php?action=salir">Cerrar Sesión</a>
      </li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<?php

					if(isset($_SESSION["typeUser"])){
						echo 'Tipo de usuario: '.$_SESSION["typeUser"];

					}
					 ?>
					 </a>
			</li>
    </ul>



</div>
</div>
</nav>
