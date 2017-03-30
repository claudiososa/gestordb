<ul class="nav">
	<li><a href="index.php">Inicio</a></li>	
	<li><a href="index.php?mod=slat&men=escuelas&id=1">Escuelas</a></li>
	<li><a href="index.php?mod=slat&men=escuelas&id=12">ADM</a></li>
	<li><a href="">Encuentros</a>
        <ul>
           <li><a href="index.php?mod=slat&men=encuentros&id=3">Todos Encuentros</a></li>
         </ul>
   </li>	
	<li><?php echo "<a href='index.php?men=personas&id=2&personaId=".$_SESSION['personaId']."'>";?>Mi Perfil</a></li>	
	<li><a href="index.php?men=user&id=1">Cerrar Sesión</a></li>	
	<li><a href="">Hola,<?php echo $_SESSION["nombre"]?></a></li>	
</ul>
