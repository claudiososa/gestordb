<?php
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/persona.php");

$informe = new Informe(null,$_GET["escuelaId"]);
$escuela = new Escuela($_GET["escuelaId"]);
$buscar_escuela = $escuela->buscar();
$dato_escuela = mysqli_fetch_object($buscar_escuela);


$buscar_informe = $informe->buscar();

$cantidad=mysqli_num_rows($buscar_informe);
if ($cantidad>0){

	echo "<h1>Informes para ".$dato_escuela->nombre."</h1><br>";
	?>
	<table>
		<tr>
			<th>Id</th>
			<th>Fecha creación</th>
			<th>Tipo</th>
			<th>Título</th>			
			<th>Fecha de Visita</th>			
			<th>Creado por...</th>			
			<th>Última modificación</th>
		</tr>
	<?php
	while ($fila=mysqli_fetch_object($buscar_informe))
	{	
		$referente= new Referente($fila->referenteId);
		$buscar_referente = $referente->buscar();
		$dato_referente= mysqli_fetch_object($buscar_referente);

		$persona= new Persona($dato_referente->personaId);
		$buscar_persona=$persona->buscar();
		$dato_persona=mysqli_fetch_object($buscar_persona);

		//if($dato_referente->tipo<>"Supervisor"){

	?>

		<tr>
			<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
			<td><?php echo $fila->fechaCarga;?></td>
			<td><?php echo $fila->tipo;?></td>									
			<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
			<td><?php echo $fila->fechaVisita;?></td>
			<td><?php echo $dato_persona->apellido.", ".$dato_persona->nombre;?></td>
			<td><?php echo $fila->fechaModificado;?></td>
			
			
		</tr>	

		<?php
		//}
	}
	echo "</table>";

}else{
	echo "No existe Informes para esta Institución";
}