<?php
		include_once('clases/adm.php');
		include_once('clases/escuela.php');
		include_once('clases/localidades.php');
		
		if(isset($_GET['escuelaId'])) {$escuelaId=$_GET['escuelaId'];}
				
		$escuela= new Escuela($escuelaId);
		$datos = $escuela->getContacto();
		
		$adm= new Adm(null,$escuelaId);      
		$adm_buscar= $adm->buscar();
		$existe=mysqli_num_rows($adm_buscar);
		if($existe==1) {
			$datoadm=mysqli_fetch_object($adm_buscar);?>
		<table class="informe">
		<tr>		
			<th>Número</th>
			<td><?php echo $datos->getNumero();?></td>
		</tr>	
		<tr>		
			<th>CUE</th>
			<td><?php echo $datos->getCue();?></td>
		</tr>	
		<tr>		
			<th>Nombre</th>
			<td><?php echo $datos->getNombre();?></td>
		</tr>
		<tr>		
			<th>¿Tiene ADM?</th>
			<td><?php echo $datoadm->estado;?></td>
		</tr>	
		<tr>		
			<th>Servidor</th>
			<td><?php echo $datoadm->servidor;?></td>
		</tr>
		<tr>		
			<th>Router</th>
			<td><?php echo $datoadm->router;?></td>
		</tr>
		<tr>		
			<th>Pizarra Digital</th>
			<td><?php echo $datoadm->pizarradigital;?></td>
		</tr>
		<tr>		
			<th>Proyector</th>
			<td><?php echo $datoadm->proyector;?></td>
		</tr>
		<tr>		
			<th>Impresora</th>
			<td><?php echo $datoadm->impresora;?></td>
		</tr>
		<tr>		
			<th>UPS</th>
			<td><?php echo $datoadm->ups;?></td>
		</tr>
		<tr>		
			<th>Camara Digital</th>
			<td><?php echo $datoadm->camarafoto;?></td>
		</tr>
		<tr>		
			<th>Pendrive</th>
			<td><?php echo $datoadm->pendrive;?></td>
		</tr>
		<tr>		
			<th>Cantidad de Netbooks</th>
			<td><?php echo $datoadm->cantidadnetbook;?></td>
		</tr>
		<tr>		
			<th>Marca de Netbook</th>
			<td><?php echo $datoadm->netmarca;?></td>
		</tr>
		<tr>		
			<th>Cantidad de Netbook Funcionando</th>
			<td><?php echo $datoadm->netfunciona;?></td>
		</tr>
		<tr>		
			<th>Cantidad de Netbook con falla</th>
			<td><?php echo $datoadm->netfalla;?></td>
		</tr>
		<tr>		
			<th>Estado de Migración a Huayra</th>
			<td><?php echo $datoadm->migrahuayra;?></td>
		</tr>
		<tr>		
			<th>Observaciones</th>
			<td><?php echo $datoadm->observaciones;?></td>
		</tr>
				
		</table>		
		<?php }else {
			echo "No esta registrado ADM para esta escuela"; 
		}	 	
			
?>
		
