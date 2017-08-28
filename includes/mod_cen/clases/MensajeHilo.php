<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("maestro.php");

class MensajeHilo
{
	private $mensajeHiloId;
	private $mensajeId;
 	private $mensajeTipo;
	private $referenteIdResp;
 	private $fechaHilo;

function __construct(	$mensajeHiloId=NULL,
											$mensajeId=NULL,
                      $mensajeTipo=NULL,
                      $referenteIdResp=NULL,
	                    $fechaHilo=NULL
                      )
	{
		$this->mensajeHiloId = $mensajeHiloId;
		$this->mensajeId = $mensajeId;
 		$this->mensajeTipo = $mensajeTipo;
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
	public function buscarHilo($mensajeId=NULL,$referenteId){
		$arrayHilos = array('0','0');
		if (isset($mensajeId)) {
			$hilo = new mensajeHilo(null,$mensajeId);
			$bd=Conexion2::getInstance();
			$sentencia="SELECT *
										FROM mensajesHilo
										WHERE mensajeId=$mensajeId";
			$buscarHilo=$bd->ejecutar($sentencia);
		}else{
			$hilo = new mensajeHilo();
			$buscarHilo = $hilo->buscar();
		}

		while ($fila = mysqli_fetch_object($buscarHilo)) {
		      $arrayDestino = explode(',',$fila->referenteIdResp);
		      foreach ($arrayDestino as $key => $value) {
		          if ($arrayDestino[$key]==$referenteId) {
								if ($fila->mensajeTipo=='1') {
										$arrayHilos[0]=$fila->mensajeHiloId;
								}elseif ($fila->mensajeTipo=='2') {
									$arrayHilos[1]=$fila->mensajeHiloId;
								}
		        }
		    }
			}
		return $arrayHilos;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO mensajesHilo (mensajeHiloId,mensajeId,mensajeTipo,referenteIdResp,fechaHilo)
		            VALUES (NULL,
                        '". $this->mensajeId."',
                        '".$this->mensajeTipo."',
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

	public function buscarSoloHilos($mensajeId)
		{
			$bd=Conexion2::getInstance();
			$sentencia="SELECT *
										FROM mensajesHilo
										WHERE mensajeId=$mensajeId";
		  return $bd->ejecutar($sentencia);
	  }

public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
									FROM mensajesHilo";
									if (!isset($tipoConsulta)) {
										$sentencia .= " INNER JOIN mensajesResp
										ON mensajesResp.mensajeHilo=mensajesHilo.mensajeHiloId ";
									}

									$sentencia .= " WHERE 1 ";


		if($this->mensajeHiloId!=NULL || $this->mensajeId!=NULL ||
			$this->mensajeTipo!=NULL || $this->fechaHilo!=NULL ||
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
		if (!isset($tipoConsulta))
		{
			return $bd->ejecutar($sentencia);
		}else{
			$objHilo=mysqli_fetch_object($bd->ejecutar($sentencia));
			return $objHilo;
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
