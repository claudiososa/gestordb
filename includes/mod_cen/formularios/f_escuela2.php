<form action="index.php?men=escuelas&id=4" method="POST" >
		<input type="hidden" name="escuelaId" value="<?php echo $escuelaId ?>"/>
        <input type="hidden" name="referenteId" value="<?php echo $datos->getReferenteId() ?>"/>	
		<table>
			<tr>
				<th>NUMERO:</th>
				<td> <input type="text" name="numero" value="<?php echo $datos->getNumero()?>"/>
				</td>
			</tr>
			<tr>
				<th>CUE</th>
				<td> <input type="text" name="cue" value="<?php echo $datos->getCue()?>"/>
				</td>
			</tr>
			<tr>
				<th>NOMBRE</th>
				<td> <input type="text" name="nombre" value="<?php echo $datos->getNombre() ?>"/>
				</td>
			</tr>
			<tr>
				<th>DOMICILIO</th>
				<td> <input type="text" name="domicilio" value="<?php echo $datos->getDomicilio()?>"/>
				</td>
			</tr>
			<tr>
				<th>NIVEL</th>
				<td> <input type="text" name="nivel" value="<?php echo $datos->getNivel() ?>"/>
				</td>
			</tr>
			<tr>
				<th>TURNOS</th>
				<td> <input type="text" name="turnos" value="<?php echo $datos->getTurnos() ?>"/>
				</td>
			</tr>
			<tr>
				<th>LOCALIDAD</th>
				<td> <select name="localidadId">
				<?php while($fila = mysqli_fetch_object($resultado))
				{
				if ($fila->localidadId == $escuela->getLocalidadId()) {
					echo "<option value=".$fila->localidadId." selected>".$fila->nombre."</option>;"."\n";
				}
				else {
					echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
				}
				}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<th>PISO TECNOLOGICO</th>
			</tr>
			<tr>
				<th>Estado de piso</th>
				<td> <input type="text" name="estado" value="<?php echo $datospiso->getEstado() ?>"/>
				</td>
			</tr>
			<tr>
				<th>Cantidad de AP</th>
				<td> <input type="text" name="apCantidad" value="<?php echo $datospiso->getapCantidad() ?>"/>
				</td>
			</tr>
			<tr>
				<th>Cantidad de SWITCH</th>
				<td> <input type="text" name="switchCantidad" value="<?php echo $datospiso->getswitchCantidad() ?>"/>
				</td>
			</tr>
			<tr>
				<th></th>
				<td> <input type="submit" value="Editar" />
				</td>
			</tr>
		</table>