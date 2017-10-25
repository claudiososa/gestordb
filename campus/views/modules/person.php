<?php


if($_SESSION["typeUser"]<>'Admin'){
	header("location:index.php?action=ingresar");
	exit();
}

 ?>
<h1>Personas</h1>

	<table class="table table-condensed">
		<thead>
			<tr>
				<th>Id</th>
				<th>Apellido</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>CUIL</th>
        <th>Fecha Nac.</th>
        <th>Sexo</th>
        <th>Telefono Fijo</th>
        <th>Telefono Movil</th>
        <th>Email</th>
				<th>Dirección</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$ver = new ControllerPerson();
			//$lista = $ver->vistaPersonController('persons','Preceptor/a');
			$lista = $ver->vistaPersonController('persons');
			$ver->borrarPersonController();

			foreach ($lista as $key => $item) {
				# code...

			echo '<tr>
				<td>'.$item["person_id"].'</td>
	      <td>'.$item["lastname"].'</td>
	      <td>'.$item["firstname"].'</td>
	      <td>'.$item["dni"].'</td>
	      <td>'.$item["cuil"].'</td>
	      <td>'.$item["birthday"].'</td>
	      <td>'.$item["sexo"].'</td>
	      <td>'.$item["phone"].'</td>
				<td>'.$item["movil"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["address"].'</td>

				<td><a href="index.php?action=editarPerson&id='.$item["person_id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=person&idBorrar='.$item["person_id"].'"><button>Borrar</button></a></td>
			</tr>';
			}

			 ?>

		</tbody>
	</table>

	<?php
	if(isset($_GET["action"])){
		if($_GET["action"]=="cambio"){
			echo "Cambio Exitoso";
		}
	}
	 ?>
