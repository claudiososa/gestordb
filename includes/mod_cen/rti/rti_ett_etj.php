<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rtixescuela.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/rti.php");
include_once("includes/mod_cen/clases/EscuelaReferentes.php");

$referenteId=$_GET['referenteId'];

$referente= new Referente($referenteId);
$b_referente = $referente->buscar();
$dato_referente = mysqli_fetch_object($b_referente);

$persona = new Persona($dato_referente->personaId);
$b_persona = $persona->buscar();

$dato_persona =  mysqli_fetch_object($b_persona);



//Crear objeto escuela y buscar las escuelas que tiene a cargo el Referente
if($_SESSION['tipo']=='DirectorNivelSecundario' || $_SESSION['tipo']=='Supervisor-Secundaria' || $_SESSION['tipo']=='Supervisor-General-Secundaria'){
	$escuela= new Escuela(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$referenteId);
	$escuela_acargo=$escuela->buscar();
   }else{

	       if ($_SESSION['tipo']=='ETJ' || $_SESSION['tipo']=='Coordinador' ) {
	  		$escuela=new EscuelaReferentes(null,null,'19',$referenteId); // buscamos las escuelas del ETT
	        //$resultado=$escuela->buscar2();// devuelve todos los datos de las escuelas del ETT
			$escuela_acargo=$escuela->buscar2();
	  

	      } else {

	  		$escuela= new Escuela(null,$referenteId);
	  		$escuela_acargo=$escuela->buscar();
	             }
	

	 }



echo '<div class="table-responsive">';
echo '<div class="container">';

echo "<table class='table table-hover table-striped table-condensed '>";
echo "<tr><th colspan='8'><h2>RTI a cargo de ".$dato_persona->apellido.", ".$dato_persona->nombre."</h2></th></tr>";
echo "<tr><th>Escuela</th>";
echo "<th>Turno</th>";
echo "<th>Apellido y Nombre</th>";
echo "<th>DNI</th>";
echo "<th>Correo Electrónico</th>";
echo "<th>Teléfono 1</th>";
echo "<th>Teléfono 2</th>";
echo "<th>Turno</th>";
echo "</tr>";
//recorrido por las escuelas acargo del referente
while($fila=mysqli_fetch_object($escuela_acargo)){
	//echo $fila->escuelaId.$fila->nombre."<br><br>";
	//echo "_______________________<br>";
	$rtix= new rtixescuela($fila->escuelaId);

	$buscar_rti=$rtix->buscar();
	//var_dump($rtix);
	while($filarti=mysqli_fetch_object($buscar_rti)){


		$rti=new Rti($filarti->rtiId);
		$buscar_dato=$rti->buscar();


		while($filadato=mysqli_fetch_object($buscar_dato)){
			$persona= new Persona($filadato->personaId);
			$buscar_persona=$persona->buscar();
			$dato=mysqli_fetch_object($buscar_persona);
			echo "<tr>";
			echo "<td>".$fila->numero."</td>";
			echo "<td>".$fila->nombre."</td>";
			echo "<td>".$dato->apellido.", ".$dato->nombre."</td>";
			echo "<td>".$dato->dni."</td>";
			echo "<td>".$dato->email."</td>";
			echo "<td>".$dato->telefonoM."</td>";
			echo "<td>".$dato->telefonoC."</td>";

			echo "<td>".$filarti->turno."</td>";

			//echo "<td>"."<a href='index.php?men=rtis&id=2&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Ver</a>"."</td>";
			//echo "<td>"."<a href='index.php?men=rtis&id=3&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Editar</a>"."</td>";
			echo "</tr>";
			echo "\n";



			//echo $filarti->escuelaId."-> ".$filarti->rtiId."<br>";
			//echo $dato->apellido."<br><br>";
		}

	}

}

echo "</table>";
echo '</div>';
echo '</div>';

?>
