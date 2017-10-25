<?php
include_once('conexionv2.php');
include_once("maestro.php");

class HorarioFacilitadores
{
	private $horarioFacilitadoresId;
 	private $referenteId;
 	private $dia;
	private $horaIngreso;
 	private $horaSalida;
	private $cursoFacilitadoresId;
	private $escuelaId;

function __construct($horarioFacilitadoresId=NULL,
										 $referenteId=NULL,
										 $dia=NULL,
										 $horaIngreso=NULL,
										 $horaSalida=NULL,
										 $cursoFacilitadoresId=NULL,
										 $escuelaId=NULL
										 )
	{
		$this->horarioFacilitadoresId = $horarioFacilitadoresId;
 		$this->referenteId = $referenteId;
 		$this->dia =$dia;
		$this->horaIngreso = $horaIngreso;
 		$this->horaSalida = $horaSalida;
		$this->cursoFacilitadoresId = $cursoFacilitadoresId;
		$this->escuelaId = $escuelaId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO horarioFacilitadores (horarioFacilitadoresId,referenteId,dia,horaIngreso,horaSalida,cursoFacilitadoresId,escuelaId)
		            VALUES (NULL,
                        '". $this->referenteId."',
                        '".$this->dia."',
                        '". $this->horaIngreso."',
												'". $this->horaSalida."',
											  '". $this->cursoFacilitadoresId."',
												'". $this->escuelaId."');
                        ";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimohorarioFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }

	}

	/*public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE HorarioFacilitadores SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE horarioFacilitadoresId=$this->horarioFacilitadoresId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimohorarioFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}
*/

public function borrar($id)
{
	$bd=Conexion2::getInstance();
	$sentencia ='DELETE FROM horarioFacilitadores WHERE horarioFacilitadoresId='.$id;
	//return $sentencia;

	if($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
		 return $filaAfectada=$bd->lastID();
	}else{
			 return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
	}
}

public function buscarCursoId($id)
{
		$bd=Conexion2::getInstance();
		$sentencia ='SELECT * FROM horarioFacilitadores WHERE cursoFacilitadoresId='.$id;
		$fila = mysqli_fetch_object($bd->ejecutar($sentencia));
		$cantidad =  mysqli_num_rows($bd->ejecutar($sentencia));

		//if ($cantidad > 1) {
			$arrayDatoEncontrado=[
				'cantidad' =>$cantidad,
				'id' => $fila->cursoFacilitadoresId
			];
			return $arrayDatoEncontrado;
		//}else {
		//	return 0;
		//}
}


public function buscarId($id)
{
		$bd=Conexion2::getInstance();
		$sentencia ='SELECT * FROM horarioFacilitadores WHERE horarioFacilitadoresId='.$id;
		$dato = $bd->ejecutar($sentencia);
		if ($dato) {
			$fila = mysqli_fetch_object($dato);
			$datoEncontrado = mysqli_num_rows($dato);
			$arrayDatoEncontrado=[
				'cantidad' =>$datoEncontrado,
				'id' => $fila->cursoFacilitadoresId
			];

			return $arrayDatoEncontrado;
			//return $datoEncontrado->cursoFacilitadoresId;
		}else {
			return 0;
		}
}


public static function buscarCurso($cursoId)
{
	$bd=Conexion2::getInstance();
	$sinParam=0;
	$sentencia="SELECT *
								FROM horarioFacilitadores
								INNER JOIN cursoFacilitadores
								ON cursoFacilitadores.cursoFacilitadoresId=horarioFacilitadores.cursoFacilitadoresId
								INNER JOIN cursos
								ON cursos.cursoId=cursoFacilitadores.cursoId";

	$sentencia.=" WHERE cursoFacilitadores.cursoId=".$cursoId;
	$resultado = mysqli_num_rows($bd->ejecutar($sentencia));
	return $resultado;
}

public static function buscarProfesor($profesorId)
{
	$bd=Conexion2::getInstance();
	$sinParam=0;
	$sentencia="SELECT *
								FROM horarioFacilitadores
								INNER JOIN cursoFacilitadores
								ON cursoFacilitadores.cursoFacilitadoresId=horarioFacilitadores.cursoFacilitadoresId
								INNER JOIN cursos
								ON cursos.cursoId=cursoFacilitadores.cursoId";

	$sentencia.=" WHERE cursoFacilitadores.profesorId=".$profesorId;
	$resultado = mysqli_num_rows($bd->ejecutar($sentencia));
	return $resultado;
}

public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$bd=Conexion2::getInstance();
    $sinParam=0;
		$sentencia="SELECT horarioFacilitadores.cursoFacilitadoresId,horarioFacilitadores.horarioFacilitadoresId,
											horarioFacilitadores.dia,horarioFacilitadores.escuelaId,
											horarioFacilitadores.horaIngreso,horarioFacilitadores.horaSalida,
											cursos.curso,cursos.division,cursos.turno,cursos.cantidadAlumnos,
											CONCAT(personas.apellido,', ',personas.nombre) AS nombre,
											asignaturas.nombre AS 'asignatura'
									FROM horarioFacilitadores
									INNER JOIN cursoFacilitadores
									ON cursoFacilitadores.cursoFacilitadoresId=horarioFacilitadores.cursoFacilitadoresId
									INNER JOIN cursos
									ON cursos.cursoId=cursoFacilitadores.cursoId
									INNER JOIN asignaturas
									ON asignaturas.asignaturaId=cursoFacilitadores.asignaturaId
									INNER JOIN profesores
									ON profesores.profesorId=cursoFacilitadores.profesorId
									INNER JOIN personas
									ON personas.personaId=profesores.personaId";

									$sentencia.=" WHERE 1";
									//INNER JOIN referentes
									//ON referentes.referenteId=horarioFacilitadores.referenteId
									//INNER JOIN personas
									//ON personas.personaId=referentes.personaId

		if($tiporeferente<>NULL){
      	$sinParam=1;
				$sentencia.= " AND ( referentes.tipo='".$tiporeferente."'";
		}

		if ($listaRefer <> NULL){
				$sinParam=1;
				$sentencia.="  AND ( ";
				foreach ($listaRefer as $value) {
					$sentencia.=" referentes.tipo='".$value."' || ";
				}
				$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		if ($sinParam==1) {
			$sentencia.=' ) ';
		}


		if($this->horarioFacilitadoresId!=NULL || $this->referenteId!=NULL || $this->escuelaId!=NULL ||
			$this->horaIngreso!=NULL || $this->horaSalida!=NULL || $this->cursoFacilitadoresId!=NULL ||
			$this->dia!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->horarioFacilitadoresId!=NULL)
  		{
  			$sentencia.=" horarioFacilitadores.horarioFacilitadoresId = $this->horarioFacilitadoresId && ";
  		}

  		if($this->referenteId!=NULL)
  		{
  			$sentencia.=" horarioFacilitadores.referenteId = $this->referenteId && ";
  		}

  		if($this->dia!=NULL)
  		{
  			$sentencia.=" horarioFacilitadores.dia LIKE '%$this->dia%' && ";
  		}

  		if($this->horaIngreso!=NULL)
  		{
  			$sentencia.=" horarioFacilitadores.horaIngreso=$this->horaIngreso && ";
  		}

  		if($this->horaSalida!=NULL)
  		{
  			$sentencia.=" horarioFacilitadores.horaSalida='$this->horaSalida' && ";
  		}

			if($this->cursoFacilitadoresId!=NULL)
			{
				$sentencia.=" horarioFacilitadores.cursoFacilitadoresId = $this->cursoFacilitadoresId && ";
			}

			if($this->escuelaId!=NULL)
			{
				$sentencia.=" horarioFacilitadores.escuelaId = $this->escuelaId && ";
			}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY horarioFacilitadores.horarioFacilitadoresId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia.'<br><br>';
		return $bd->ejecutar($sentencia);
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
