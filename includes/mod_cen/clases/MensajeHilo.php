<?php
include_once('conexionv2.php');
include_once("referente.php");

class MensajeHilo
{
	private $mensajeHiloId;
	private $mensajeId;
	private $referenteIdResp;
 	private $fechaHilo;

function __construct(	$mensajeHiloId=NULL,
											$mensajeId=NULL,
                      $referenteIdResp=NULL,
	                    $fechaHilo=NULL
                      )
	{
		$this->mensajeHiloId = $mensajeHiloId;
		$this->mensajeId = $mensajeId;
		$this->referenteIdResp = $referenteIdResp;
 		$this->fechaHilo = $fechaHilo;

	}

	/**
	 * [Metodo que devuelve un array con dos elementos el primero
	 * con el numero de hilo de tipo grupo
	 * el segundo elemento es el numero de hilo correspondiente a indivisual
	 * @param  [type] $mensajeId   [identifica el numero de mensaje a buscar]
	 * @param  [type] $referenteId [de quien se esta buscando el mensaje]
	 * @return [array]              $arrayHilos (2 elementos)/ si no encuentra nada devuelve en sus dos elementos 0
	 */
	public function buscarHilo($mensajeId=NULL,$referenteId=NULL){
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
									FROM mensajesHilo
									WHERE mensajeId=$mensajeId";
		if (isset($referenteId)) {
			$sentencia .=" AND referenteId=$referenteId ";
		}
		return $bd->ejecutar($sentencia);
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO mensajesHilo (mensajeHiloId,mensajeId,referenteIdResp,fechaHilo)
		            VALUES (NULL,
                        '". $this->mensajeId."',
                        '". $this->referenteIdResp."',
                        '". $this->fechaHilo."');
                        ";

			if ($bd->ejecutar($sentencia)) {
					$ultimoHiloId=$bd->lastID();
					return $ultimoHiloId;
			}else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
			}
	}


public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
								FROM mensajesHilo
  							 WHERE 1 ";


		if($this->mensajeHiloId!=NULL || $this->mensajeId!=NULL ||
			$this->fechaHilo!=NULL ||
			$this->referenteIdResp!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->mensajeId!=NULL)
  		{
  			$sentencia.=" mensajesHilo.mensajeId = $this->mensajeId && ";
  		}

  		if($this->mensajeHiloId!=NULL)
  		{
  			$sentencia.=" mensajesHilo.mensajeHiloId = $this->mensajeHiloId && ";
  		}


  		if($this->fechaHilo!=NULL)
  		{
  			$sentencia.=" mensajesHilo.fechaHilo='$this->fechaHilo' && ";
  		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY mensajesHilo.mensajeHiloId ASC";
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
