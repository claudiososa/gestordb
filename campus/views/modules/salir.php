<?php
session_start();
session_destroy();

header("location:index.php?action=ingresar");
 ?>
<h1>¡Haz salido de la aplicación!</h1>
