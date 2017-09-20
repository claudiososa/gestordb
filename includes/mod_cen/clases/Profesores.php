<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("maestro.php");

class Profesores
{
	private $profesorId;
 	private $personaId;
 	private $escuelaId;

function __construct($profesorId=NULL,
										 $personaId=NULL,
										 $escuelaId=NULL
										 )
	{
		$this->profesorId = $profesorId;
 		$this->personaId = $personaId;
 		$this->escuelaId = $escuelaId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO profesores (profesorId,personaId,escuelaId)
		            VALUES (NULL,
                        ". $this->personaId.",
												". $this->escuelaId.");";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoProfesor=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	public function borrar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM profesores WHERE profesorId=$this->profesorId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
			 	$ultimoRegistro=$bd->lastID();
				return $ultimoRegistro;
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	/*public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE Cursos SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE profesorId=$this->profesorId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}
*/
public function buscar($tipo=null,$limit=null,$order=null)
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
								FROM profesores
								INNER JOIN personas
								ON profesores.personaId=personas.personaId
								WHERE 1";

		if($this->profesorId!=NULL || $this->personaId!=NULL ||
			$this->escuelaId!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->profesorId!=NULL)
  		{
  			$sentencia.=" personaIds.profesorId = $this->profesorId && ";
  		}

  		if($this->personaId!=NULL)
  		{
  			$sentencia.=" personaId = '$this->personaId' && ";
  		}

  		if($this->escuelaId!=NULL)
  		{
  			$sentencia.=" escuelaId='$this->escuelaId' && ";
  		}

			$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else

		if (!isset($order)) {
			$sentencia.="  ORDER BY profesores.personaId ASC";
		}else{
			$sentencia.="  ORDER BY profesores.personaId ".$order;
		}

		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia.'<br><br>';
		if (isset($tipo)) {
			switch ($tipo) {
				case 'unico':
					$unico = mysqli_fetch_object($bd->ejecutar($sentencia));
					return $unico;
					break;
				case 'total':
							return $bd->ejecutar($sentencia);
						break;
				case 'cantidad':
								$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));
								return $cantidad;
								break;
				default:
					# code...
					break;
			}
		}else{
			return $bd->ejecutar($sentencia);
		}

	}



	public function __get($var)
	{
		return $this->$var;

	}


	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}

}
/*
if (isset($_POST['profesorId'])) {
	$estado= [];
	$personaId= new Cursos($_POST['profesorId']);
	$borrar = $personaId->borrar();

	$personaId2= new Cursos();
	$personaId2->escuelaId=$_POST['escuelaIdBorrar'];

	$total = $personaId2->buscar('cantidad');

	$listaCursos = $personaId2->buscar('total',null,'DESC');

	while ($fila = mysqli_fetch_object($listaCursos)) {
		$temporal=array('profesorId'=>$fila->profesorId,
										'personaId'=>$fila->personaId,
										'escuelaId'=>$fila->escuelaId,
										'turno'=>Cursos::turno($fila->turno));
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;

}

if (isset($_POST['escuelaIdAjaxId'])) {
	$estado= [];
	$personaId= new Cursos();
	$personaId->escuelaId=$_POST['escuelaIdAjaxId'];

	$total = $personaId->buscar('cantidad');

	$listaCursos = $personaId->buscar('total',null,'DESC');

	//while ($fila = mysqli_fetch_assoc($listaCursos)) {
	while ($fila = mysqli_fetch_object($listaCursos)) {
		//$data['data'][]=$fila;
		//$cur=$fila->personaId;
		$temporal=array('profesorId'=>$fila->profesorId,
										'personaId'=>$fila->personaId,
										'escuelaId'=>$fila->escuelaId,
										'turno'=>Cursos::turno($fila->turno));
		array_push($estado,$temporal);
	}

	//$temporal=array('personaId'=>'dato');
	//$temporal=array('personaId'=>'dato');
	//array_push($estado,$temporal);
	//asort($estado);
	$json = json_encode($estado);
	Maestro::debbugPHP($json);
	echo $json;	# code...

}
*/

if (isset($_POST['dni'])) {
	include_once('persona.php');
	$persona= new Persona(null,null,null,$_POST['dni']);
	$datoPersona = $persona->buscar();
	$cantidadPersona=mysqli_num_rows($datoPersona);

	//$datoCurso=2;
		$estado= [];
	if ($cantidadPersona > 0) {
		$dato = mysqli_fetch_object($datoPersona);
		$temporal=array('dni'=>$dato->dni,
										'nombre'=>$dato->nombre,
										'apellido'=>$dato->apellido,
										'telefono'=>$dato->telefonoM,
										'email'=>$dato->email
										);
		array_push($estado,$temporal);
	}else{
		$temporal=array('dni'=>'error');
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;
}
