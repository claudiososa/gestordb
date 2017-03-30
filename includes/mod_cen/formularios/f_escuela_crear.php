<form action="index.php?men=admin&id=1" method="POST" >
		<table>
			<tr>
				<th>Número:</th>
				<td> <input size="40"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}">
				</td>
			</tr>
			<tr>
				<th>CUE</th>
				<td> <input size="40" placeholder="solo números - 7 a 9 digitos"  type="text" name="cue" pattern="[0-9]{7,9}">
				</td>
			</tr>
			<tr>
				<th>Nombre</th>
				<td> <input size="40" type="text" name="nombre" >
				</td>
			</tr>				
			<tr>
				<th>Domicilio</th>
				<td> <input size="40" type="text" name="domicilio" />
				</td>
			</tr>
			<tr>
				<th>Teléfono</th>
					 <td> <input placeholder="Nº Teléfono, solo números" size="40" title="Ingresar solo números" type="text" name="telefono" pattern="[0-9]{1,18}" />
				</td>
			</tr>
			<tr>
				<th>Nivel</th>
			    <td> 
					<select name="nivel">
					         <option value="" label="Sin registrar">Sin registrar</option>	
								<option value="Primaria Común" label="Primaria Común">Primaria Común</option>	
								<option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>	
								<option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>	
								<option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>	
								<option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
								<option value="ISFD" label="ISFD">ISFD</option>
								<option value="IEM" label="IEM">IEM</option>
								<option value="Capacitación" label="Capacitación">Capacitación</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Turnos</th>
				<td> <input type="text" name="turnos">
				</td>
			</tr>
			<tr>
				<th>Localidad</th>
				<td> <select name="localidadId">
				<?php 
				while($fila = mysqli_fetch_object($resultado))
				{
					echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
				}
				?>
				</select>
				</td>
			</tr>	
			<tr>
				<th></th>
				<td> <input type="submit" value="Aplicar cambios" />
				</td>
			</tr>
		</table>