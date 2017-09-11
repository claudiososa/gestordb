<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("maestro.php");

class CursoFacilitadores
{
	private $cursoFacilitadoresId;
 	private $curso;
 	private $division;
	private $turno;
 	private $asignaturaId;
	private $personaId;
	private $referenteId;
	private $escuelaId;

function __construct($cursoFacilitadoresId=NULL,
										 $curso=NULL,
										 $division=NULL,
										 $turno=NULL,
										 $asignaturaId=NULL,
										 $personaId=NULL,
										 $referenteId=NULL,
										 $escuelaId=NULL
										 )
	{
		$this->cursoFacilitadoresId = $cursoFacilitadoresId;
 		$this->curso = $curso;
 		$this->division =$division;
		$this->turno = $turno;
 		$this->asignaturaId = $asignaturaId;
		$this->personaId = $personaId;
		$this->referenteId = $referenteId;
		$this->escuelaId = $escuelaId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO cursoFacilitadores (cursoFacilitadoresId,curso,division,turno,asignaturaId,personaId,referenteId,escuelaId)
		            VALUES (NULL,
                        '". $this->curso."',
                        '".$this->division."',
                        '". $this->turno."',
												'". $this->asignaturaId."',
												'". $this->personaId."',
												'". $this->referenteId."',
											  '". $this->escuelaId."');
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
											 referentes.curso,
											 cursoFacilitadores.division,
											 cursoFacilitadores.turno,
											 cursoFacilitadores.asignaturaId,
											 referentes.personaId,
											 referentes.tipo,
											 personas.nombre,
											 personas.apellido
									FROM cursoFacilitadores
									INNER JOIN referentes
									ON referentes.curso=cursoFacilitadores.curso
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


		if($this->cursoFacilitadoresId!=NULL || $this->curso!=NULL ||
			$this->turno!=NULL || $this->asignaturaId!=NULL || $this->escuelaId!=NULL || $this->referenteId!=NULL ||
			$this->division!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->cursoFacilitadoresId!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.cursoFacilitadoresId = $this->cursoFacilitadoresId && ";
  		}

  		if($this->curso!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.curso = '$this->curso' && ";
  		}

  		if($this->division!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.division = '$this->division' && ";
  		}

  		if($this->turno!=NULL)
  		{
  			$sentencia.=" cursoFacilitadores.turno='$this->turno' && ";
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
