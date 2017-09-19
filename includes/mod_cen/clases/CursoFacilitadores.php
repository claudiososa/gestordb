<?php
include_once('conexionv2.php');
include_once("referente.php");
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

public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$bd=Conexion2::getInstance();
    $sinParam=0;
		$sentencia="SELECT cursoFacilitadores.cursoFacilitadoresId,
											 referentes.cursoId,
											 cursoFacilitadores.asignaturaId,
											 referentes.profesorId,
											 referentes.tipo,
											 personas.nombre,
											 personas.apellido
									FROM cursoFacilitadores
									INNER JOIN referentes
									ON referentes.cursoId=cursoFacilitadores.cursoId
									INNER JOIN personas
									ON personas.personaId=referentes.personaId ";
									$sentencia.=" WHERE 1";


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


		if($this->cursoFacilitadoresId!=NULL || $this->cursoId!=NULL ||
			$this->asignaturaId!=NULL || $this->referenteId!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->cursoFacilitadoresId!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.cursoFacilitadoresId = $this->cursoFacilitadoresId && ";
  		}

  		if($this->cursoId!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.cursoId = '$this->cursoId' && ";
  		}

  		if($this->asignaturaId!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.asignaturaId=$this->asignaturaId && ";
  		}

			if($this->referenteId!=NULL)
			{
				$sentencia.=" cursoFacilitadores.referenteId = $this->referenteId && ";
			}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY cursoFacilitadores.cursoFacilitadoresId DESC";
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
