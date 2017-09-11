<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("maestro.php");

class HorarioFacilitadores
{
	private $horarioFacilitadoresId;
 	private $referenteId;
 	private $dia;
	private $horaIngreso;
 	private $horaSalida;
	private $cursoFacilitadoresId;

function __construct($horarioFacilitadoresId=NULL,
										 $referenteId=NULL,
										 $dia=NULL,
										 $horaIngreso=NULL,
										 $horaSalida=NULL,
										 $cursoFacilitadoresId=NULL
										 )
	{
		$this->horarioFacilitadoresId = $horarioFacilitadoresId;
 		$this->referenteId = $referenteId;
 		$this->dia =$dia;
		$this->horaIngreso = $horaIngreso;
 		$this->horaSalida = $horaSalida;
		$this->cursoFacilitadoresId = $cursoFacilitadoresId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO HorarioFacilitadores (horarioFacilitadoresId,referenteId,dia,horaIngreso,horaSalida,cursoFacilitadoresId)
		            VALUES (NULL,
                        '". $this->referenteId."',
                        '".$this->dia."',
                        '". $this->horaIngreso."',
												'". $this->horaSalida."',
											  '". $this->cursoFacilitadoresId."');
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

public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$bd=Conexion2::getInstance();
    $sinParam=0;
		$sentencia="SELECT HorarioFacilitadores.cursoFacilitadoresId,HorarioFacilitadores.horarioFacilitadoresId,referentes.referenteId,HorarioFacilitadores.dia
									,HorarioFacilitadores.horaIngreso,HorarioFacilitadores.horaSalida,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
									FROM HorarioFacilitadores
									INNER JOIN referentes
									ON referentes.referenteId=HorarioFacilitadores.referenteId
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


		if($this->horarioFacilitadoresId!=NULL || $this->referenteId!=NULL ||
			$this->horaIngreso!=NULL || $this->horaSalida!=NULL || $this->cursoFacilitadoresId!=NULL ||
			$this->dia!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->horarioFacilitadoresId!=NULL)
  		{
  			$sentencia.=" HorarioFacilitadores.horarioFacilitadoresId = $this->horarioFacilitadoresId && ";
  		}

  		if($this->referenteId!=NULL)
  		{
  			$sentencia.=" HorarioFacilitadores.referenteId = $this->referenteId && ";
  		}

  		if($this->dia!=NULL)
  		{
  			$sentencia.=" HorarioFacilitadores.dia LIKE '%$this->dia%' && ";
  		}

  		if($this->horaIngreso!=NULL)
  		{
  			$sentencia.=" HorarioFacilitadores.horaIngreso=$this->horaIngreso && ";
  		}

  		if($this->horaSalida!=NULL)
  		{
  			$sentencia.=" HorarioFacilitadores.horaSalida='$this->horaSalida' && ";
  		}

			if($this->cursoFacilitadoresId!=NULL)
			{
				$sentencia.=" HorarioFacilitadores.cursoFacilitadoresId = $this->cursoFacilitadoresId && ";
			}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY HorarioFacilitadores.horarioFacilitadoresId DESC";
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
