<form action="index.php?mod=slat&men=admin&id=3" method="POST" >
		<table>
			<tr>
				<th>Referente</th>
				<td>
				<select name="referenteId" >
				<?php
				while($fila = mysqli_fetch_object($b_referente)) {
					$c_persona= new Persona($fila->personaId);
					$b_persona=$c_persona->buscar();
					$d_persona=mysqli_fetch_object($b_persona);
					if($fila->referenteId>1) {					
						echo "<option value=".$fila->referenteId.">".$fila->tipo." -".$d_persona->apellido." ,".$d_persona->nombre."</option>";
					}						
				}		
				?>
				</select></td>
			</tr>
			<tr>
				<th></th>
				<td> <input type="submit" value="Login" />
				</td>
			</tr>
		</table>