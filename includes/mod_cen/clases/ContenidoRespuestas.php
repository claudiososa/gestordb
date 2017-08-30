<?php
include_once('conexionv2.php');

class ContenidoRespuestas
{
	private $contenidoId;
	private $contenido;

function __construct(	$contenidoId=NULL,
											$contenido=NULL
                      )
	{
		$this->contenidoId = $contenidoId;
		$this->contenido = $contenido;

	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO contenidoRespuestas (contenidoId,contenido)
		            VALUES (NULL,
                        '". $this->contenido."');
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
								FROM contenidoRespuestas
  							 WHERE 1 ";


		if($this->contenidoId!=NULL || $this->contenido!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->contenido!=NULL)
  		{
  			$sentencia.=" contenidoRespuestas.contenido = $this->contenido && ";
  		}

  		if($this->contenidoId!=NULL)
  		{
  			$sentencia.=" contenidoRespuestas.contenidoId = $this->contenidoId && ";
  		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY contenidoRespuestas.contenidoId ASC";
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
