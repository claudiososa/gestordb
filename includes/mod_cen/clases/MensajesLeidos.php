<?php
include_once('conexion.php');
include_once("referente.php");
include_once("maestro.php");

class MensajesLeidos
{
	private $mensajesLeidosId;
	private $mensajeId;
 	private $referenteId;
 	private $fechaHora;

function __construct(	$mensajesLeidosId=NULL,
											$mensajeId=NULL,
                      $referenteId=NULL,
	                    $fechaHora=NULL
                      )
	{
		$this->mensajesLeidosId = $mensajesLeidosId;
		$this->mensajeId = $mensajeId;
 		$this->referenteId = $referenteId;
 		$this->fechaHora = $fechaHora;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO mensajesLeidos (mensajesLeidosid,mensajeId,referenteId,fechaHora)
		            VALUES (NULL,
												'". $this->mensajeId."',
                        '". $this->referenteId."',
                        '". $this->fechaHora."');
                        ";

		if ($conexion->query($sentencia)) {
			$mensajeId=$conexion->insert_id;
			return $mensajeId;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}


public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
    $sinParam=0;
		$sentencia="SELECT mensajesLeidos.mensajeId,mensajesLeidos.referenteId,mensajesLeidos.fechaHora,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
									FROM mensajesLeidos
									INNER JOIN referentes
									ON referentes.referenteId=mensajesLeidos.referenteId
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


		if($this->mensajeId!=NULL || $this->referenteId!=NULL || $this->destinatario!=NULL || $this->fechaHora!=NULL || $this->contenido!=NULL || $this->asunto!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->mensajeId!=NULL)
  		{
  			$sentencia.=" mensajesLeidos.mensajeId = $this->mensajeId && ";
  		}

  		if($this->referenteId!=NULL)
  		{
  			$sentencia.=" mensajesLeidos.referenteId = $this->referenteId && ";
  		}

  		if($this->fechaHora!=NULL)
  		{
  			$sentencia.=" mensajesLeidos.fechaHora='$this->fechaHora' && ";
  		}
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY mensajesLeidos.mensajesLeidosId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia.'<br><br>';
		return $conexion->query($sentencia);
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
