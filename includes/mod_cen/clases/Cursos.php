<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("maestro.php");

class Cursos
{
	private $cursoId;
 	private $curso;
 	private $division;
	private $turno;
	private $cantidadAlumnos;
	private $escuelaId;

function __construct($cursoId=NULL,
										 $curso=NULL,
										 $division=NULL,
										 $turno=NULL,
										 $cantidadAlumnos=NULL,
										 $escuelaId=NULL
										 )
	{
		$this->cursoId = $cursoId;
 		$this->curso = $curso;
 		$this->division = $division;
		$this->turno = $turno;
		$this->cantidadAlumnos = $cantidadAlumnos;
		$this->escuelaId = $escuelaId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO cursos (cursoId,curso,division,turno,cantidadAlumnos,escuelaId)
		            VALUES (NULL,
                        '". $this->curso."',
												'". $this->division."',
												'". $this->turno."',
												". $this->cantidadAlumnos.",
												". $this->escuelaId.");
                        ";


		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	public function borrar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM cursos WHERE cursoId=$this->cursoId";
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
		$sentencia = "UPDATE Cursos SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE cursoId=$this->cursoId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}
*/

public static function turno($valor)
{
	switch ($valor) {
		case 'M':
			$turno='Mañana';
			break;
		case 'I':
				$turno='Intermedio';
				break;
		case 'T':
			$turno='Tarde';
			break;
		case 'V':
			$turno='Vespertino';
			break;
		case 'N':
				$turno='Noche';
				break;
		default:
			# code...
			break;
	}
	return $turno;
}
public function buscar($tipo=null,$limit=null,$order=null)
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
								FROM cursos
								WHERE 1";

		if($this->cursoId!=NULL || $this->curso!=NULL ||
			$this->division!=NULL || $this->cantidadAlumnos!=NULL || $this->escuelaId!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->cursoId!=NULL)
  		{
  			$sentencia.=" cursos.cursoId = $this->cursoId && ";
  		}

  		if($this->curso!=NULL)
  		{
  			$sentencia.=" curso = '$this->curso' && ";
  		}

  		if($this->division!=NULL)
  		{
  			$sentencia.=" division='$this->division' && ";
  		}

			if($this->cantidadAlumnos!=NULL)
			{
				$sentencia.=" cantidadAlumnos = $this->cantidadAlumnos && ";
			}

			if($this->escuelaId!=NULL)
			{
				$sentencia.=" escuelaId = $this->escuelaId && ";
			}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else

		if (!isset($order)) {
			$sentencia.="  ORDER BY cursos.curso ASC";
		}else{
			$sentencia.="  ORDER BY cursos.curso ".$order;
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

if (isset($_POST['cursoId'])) {
	$estado= [];
	$curso= new Cursos($_POST['cursoId']);
	$borrar = $curso->borrar();

	$curso2= new Cursos();
	$curso2->escuelaId=$_POST['escuelaIdBorrar'];

	$total = $curso2->buscar('cantidad');

	$listaCursos = $curso2->buscar('total',null,'DESC');

	while ($fila = mysqli_fetch_object($listaCursos)) {
		$temporal=array('cursoId'=>$fila->cursoId,
										'curso'=>$fila->curso,
										'division'=>$fila->division,
										'turno'=>Cursos::turno($fila->turno));
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;

}

if (isset($_POST['escuelaIdAjaxId'])) {
	$estado= [];
	$curso= new Cursos();
	$curso->escuelaId=$_POST['escuelaIdAjaxId'];

	$total = $curso->buscar('cantidad');

	$listaCursos = $curso->buscar('total',null,'DESC');

	//while ($fila = mysqli_fetch_assoc($listaCursos)) {
	while ($fila = mysqli_fetch_object($listaCursos)) {
		//$data['data'][]=$fila;
		//$cur=$fila->curso;
		$temporal=array('cursoId'=>$fila->cursoId,
										'curso'=>$fila->curso,
										'division'=>$fila->division,
										'turno'=>Cursos::turno($fila->turno));
		array_push($estado,$temporal);
	}

	//$temporal=array('curso'=>'dato');
	//$temporal=array('curso'=>'dato');
	//array_push($estado,$temporal);
	//asort($estado);
	$json = json_encode($estado);
	Maestro::debbugPHP($json);
	echo $json;	# code...

}


if (isset($_POST['courseName'])) {

	//$tab=array(1=>'test',
	//	2=>'test2');


	//,divisionName: divisionName, turn:turn, quantityStudents:quantityStudents,escuelaId:escuelaId
	//$curso= new Cursos(NULL,$_POST['courseName'],$_POST['divisionName'],$_POST['turn'],$_POST['quantityStudents'],$_POST['escuelaId']);
	$curso= new Cursos(null,$_POST['courseName'],$_POST['divisionName'],$_POST['turn'],$_POST['quantityStudents'],$_POST['escuelaId']);
	$datoCurso = $curso->agregar();
	//$datoCurso=2;
		$estado= [];
	if ($datoCurso > 0) {
		$temporal=array('guardado'=>'ok',
											'id'=>$datoCurso);
		array_push($estado,$temporal);

	}else{
		$temporal=array('guardado'=>'error',
										'id'=>$datoCurso);
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;	# code...

	//Maestro::debbugPHP($datoCurso);
}


/**
 * BUSCAR TODOS LOS CURSOS DE UNA ESCUELA EN PARTICULAR
 *
 */

if (isset($_POST['buscarCursos'])) {
	$estado= [];
	$curso = new Cursos(null,null,null,null,null,$_POST['buscarCursos']);
	$datoCurso = $curso->buscar('total');
	if (mysqli_num_rows($datoCurso)>0) {
		while ($fila = mysqli_fetch_object($datoCurso)) {
			$temporal=array('cursoId'=>$fila->cursoId,
											'curso'=>$fila->curso,
											'division'=>$fila->division,
											'turno'=>Cursos::turno($fila->turno)
											);
			array_push($estado,$temporal);
		}
	}else{
		$temporal=array('cursoId'=>'no existen cursos para este Colegio');
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	Maestro::debbugPHP($json);
	echo $json;
}
