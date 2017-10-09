<?php
include_once('conexionv2.php');
include_once("maestro.php");

class CursoFacilitadores
{
	private $cursoFacilitadoresId;
 	private $cursoId;
 	private $asignaturaId;
	private $profesorId;
	private $referenteId;

function __construct($cursoFacilitadoresId=NULL,
										 $cursoId=NULL,
										 $asignaturaId=NULL,
										 $profesorId=NULL,
										 $referenteId=NULL
										 )
	{
		$this->cursoFacilitadoresId = $cursoFacilitadoresId;
 		$this->cursoId = $cursoId;
 		$this->asignaturaId = $asignaturaId;
		$this->profesorId = $profesorId;
		$this->referenteId = $referenteId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO cursoFacilitadores (cursoFacilitadoresId,cursoId,asignaturaId,profesorId,referenteId)
		            VALUES (NULL,
                        '". $this->cursoId."',
												'". $this->asignaturaId."',
												'". $this->profesorId."',
												'". $this->referenteId."');
                        ";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	/*public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE CursoFacilitadores SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE CursoFacilitadoresId=$this->CursoFacilitadoresId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

*/

public function borrar($id)
{
	$bd=Conexion2::getInstance();
	$sentencia ='DELETE FROM cursoFacilitadores WHERE cursoFacilitadoresId='.$id;
	//return $sentencia;

	if($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
		 return $filaAfectada=$bd->lastID();
	}else{
			 return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
	}
}

public function buscarId($id)
{
		$bd=Conexion2::getInstance();
		$sentencia ='SELECT * FROM cursoFacilitadores WHERE cursoFacilitadoresId='.$id;
		$fila = mysqli_fetch_object($bd->ejecutar($sentencia));
		$cantidad =  mysqli_num_rows($bd->ejecutar($sentencia));

		if ($dato > 1) {
			$arrayDatoEncontrado=[
				'cantidad' =>$cantidad,
				'id' => $fila->cursoFacilitadoresId
			];
			return $arrayDatoEncontrado;
		}else {
			return 0;
		}
}



public function buscar($tipo=null,$cursoId=null,$asignaturaId=null,$profesorId=null,$referenteId=null)
	{
		$bd=Conexion2::getInstance();

		$sentencia="SELECT cursoFacilitadores.cursoFacilitadoresId,
											 cursoFacilitadores.cursoId,
											 cursoFacilitadores.asignaturaId,
											 cursoFacilitadores.profesorId,
											 personas.nombre,
											 personas.apellido
									FROM cursoFacilitadores
									INNER JOIN referentes
									ON referentes.referenteId=cursoFacilitadores.referenteId
									INNER JOIN personas
									ON personas.personaId=referentes.personaId ";
									$sentencia.=" WHERE cursoId=".$cursoId." AND asignaturaId=".$asignaturaId." AND profesorId=".$profesorId." AND cursoFacilitadores.referenteId=".$referenteId;


		//echo $sentencia.'<br><br>';
		if ($tipo=="cantidad") {
			$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));
			return $cantidad;
		}elseif ($tipo=="id") {
			$id = mysqli_fetch_object($bd->ejecutar($sentencia));
			return $id->cursoFacilitadoresId;
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
