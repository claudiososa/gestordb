<a href='?men=escuelas&id=3&escuelaId=<?php echo $_GET['escuelaId'];?>'>Actualizar datos</a><br>
<?php
		if(isset($_SESSION["tipo"]))
		{
			if($_SESSION["tipo"]=="admin") 
			{		
			 	?><a href='?men=referentes&id=7&escuelaId=<?php echo $_GET['escuelaId'];?>'>Asignar Referente</a>
				<?php
			}		
		}