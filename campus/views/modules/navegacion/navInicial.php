
<nav class="navbar ">
	<ul class="nav navbar-nav">

		<li><a href='#'>
		<?php


		if(isset($_SESSION["typeUser"])){
			echo 'Tipo de usuario: '.$_SESSION["typeUser"];

		}
		 ?>
		 </a></li>
	</ul>
</nav>
