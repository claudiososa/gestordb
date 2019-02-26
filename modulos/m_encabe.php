	<?php
		if (!empty($_GET['ide']))
		{
		$id=$_GET['ide'];
		switch ($ide) {
			case 1:
				include("includes/mod_encabe/cambiante.php");
				break;

		}
		}
			else {

					include("includes/mod_encabe/principal.php");


			}
	?>
