<?php
if($_SESSION["typeUser"]<>'Admin' && $_SESSION["typeUser"]<>'Preceptor/a' &&  $_SESSION["typeUser"]<>'Director/a'){
	header("location:index.php?action=ingresar");
	exit();
}
?>
<section class="success" id="about">

	<div class="card-block">


<h5	 class="card-title" align="center">Agregar alumno a la base de datos:

</h5></div>
<div class="card-block" align="center"><a class="btn btn-outline"  href="index.php?action=createPerson" >Nuevo Alumno</a></div>



<br><br>



	<div class="card-block">
		<h5 class="card-title" align="center">Buscar y modificar datos de Alumno:</h5>

	</div>
<div class="card-block">


	<form class="form-inline" action="" method="post">
	  <label for="lastnameRegistro">Tipo de Usuario:&nbsp;</label>

    <?php
    if($_SESSION["typeUser"]=='Preceptor/a'){
      echo '<input type="text" name="typeuser" class="form-control mb-2 mr-sm-2 mb-sm-0" Value="Alumno" readonly>';
    }else{
      ?>
      <select class="form-control" name="typeuser">
          <option value="Alumno">Alumno</option>
          <option value="Docente">Docente</option>
          <option value="Tutor">Tutor</option>
          <option value="Director/a">Director/a</option>
          <option value="Preceptor/a">Preceptor/a</option>
          <option value="Admin">Administrador</option>
      </select>

    <?php
    }

    ?>
<br><br><br>
  <label class="sr-only" for="inlineFormInput">Apellido</label>
  <input type="text" name="lastname" value="" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Apellido">

  <label class="sr-only" for="">Nombre</label>
  <input type="text" name="firstname" value="" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Nombre">
  <label class="sr-only" for="">DNI</label>
  <input type="text" name="dni" value="" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="DNI">
<div class="card-block"align="center">
<button type="submit" class="btn btn-outline" name="searchPersonSubmit"value="Buscar">&nbsp;&nbsp;Buscar&nbsp;&nbsp;</button></div>
</form>

<br><br>
</section>
<?php
if($_POST){
  $resultado = new ControllerPerson();
  $dato=$resultado->searchPersonController('form');
  //var_dump($dato);
	echo '<div class="card">';
	echo '<div class="table-responsive">';
  echo '<table class="table table-condensed">';
  echo '<thead>
              <tr>
                <th>Id</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>CUIL</th>
                <th>Tipo</th>
                <th>Curso</th>
                <th>Tutor1</th>
                <th>Tutor2</th>';
  foreach ($dato as $key => $item) {
    echo '<tr>
      <td>'.$item["person_id"].'</td>
      <td>'.$item["lastname"].'</td>
      <td>'.$item["firstname"].'</td>
      <td>'.$item["dni"].'</td>
      <td>'.$item["cuil"].'</td>
      <td>'.$item["type"].'</td>';
      echo '<td>';
      if($item["type"]=='Alumno'){
        $inscription = new ControllerCourse();
        //var_dump($inscription);
        $verificar = $inscription->searchStudentInCourseController($item["person_id"]);
        if($verificar){
          echo $verificar[0]['name'].' '.$verificar[0]['turn'];
        }else{
          echo "Sin Asignar";
        }


          //var_dump($verificar);


      }
      echo '</td>';
      echo '<td>tutor1</td>
      <td>tutor2</td>
      <td><a href="index.php?action=editarPerson&id='.$item["person_id"].'"><button class="btn btn-primary">Editar</button></a></td>';
      //echo ' <td><a href="index.php?action=person&idBorrar='.$item["person_id"].'"><button>Borrar</button></a></td>';
    echo '</tr>';
  }
  echo '</table>';
	echo '</div>';
	echo '</div';
}
?>
</div>
</div>

<br><br>
