<?php
	session_start();	
	session_unset();
	session_destroy();
	echo '<script type="text/javascript">';
	echo 'function redireccion(){';
	echo 'window.location="index.php"};';
	echo 'setTimeout ("redireccion()", 0); //el tiempo expresado en milisegundos';
	echo '</script>';
?>
