<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("MensajeHilo.php");

include_once("maestro.php");

class MensajesResp
{
	private $mensajeRespId;
	private $mensajeHilo;
 	private $contenidoId;
	private $respuestaReferenteId;
 	private $fechaHora;

function __construct(	$mensajeRespId=NULL,
											$mensajeHilo=NULL,
                      $contenidoId=NULL,
                      $respuestaReferenteId=NULL,
	                    $fechaHora=NULL
                      )
	{
		$this->mensajeRespId = $mensajeRespId;
		$this->mensajeHilo = $mensajeHilo;
 		$this->contenidoId =$contenidoId;
		$this->respuestaReferenteId = $respuestaReferenteId;
 		$this->fechaHora = $fechaHora;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();

		$sentencia="INSERT INTO mensajesResp (mensajeRespId,mensajeHilo,contenidoId,respuestaReferenteId,fechaHora)
		            VALUES (NULL,
												'". $this->mensajeHilo."',
                        '". $this->contenidoId."',
                        '". $this->respuestaReferenteId."',
                        '". $this->fechaHora."');
                        ";
												//echo $sentencia;
		if ($bd->ejecutar($sentencia)) {
			$respuestaId=$bd->lastID();
			return $respuestaId;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function buscarHilo($mensajeId,$referenteId,$tipo){
		$bd=Conexion2::getInstance();
		$sentencia="SELECT * FROM mensajesHilo
								WHERE mensajeId=$mensajeId
								AND referenteId=$referenteId
								AND mensajeTipo=$mensajeTipo";
	}

	public function buscarIntervenciones($mensajeHilo){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia = "SELECT mensajeHilo FROM mensajesResp
									WHERE mensajeHilo = $mensajeHilo";
		$cantidadMensajes = mysqli_num_rows($conexion->query($sentencia));
		return $cantidadMensajes;
	}


public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
    $sinParam=0;
		$sentencia="SELECT mensajesResp.mensajeRespId,mensajesResp.respuestaReferenteId,mensajesResp.contenidoId
									,mensajesResp.fechaHora,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
									FROM mensajesResp
									INNER JOIN referentes
									ON referentes.referenteId=mensajesResp.respuestaReferenteId
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


		if($this->mensajeHilo!=NULL ||  $this->respuestaReferenteId!=NULL || $this->fechaHora!=NULL || $this->contenidoId!=NULL || $this->asunto!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->mensajeHilo!=NULL)
  		{
  			$sentencia.=" mensajesResp.mensajeHilo = $this->mensajeHilo && ";
  		}

			if($this->mensajeRespId!=NULL)
  		{
  			$sentencia.=" mensajesResp.mensajeRespId = $this->mensajeRespId && ";
  		}

  		if($this->respuestaReferenteId!=NULL)
  		{
  			$sentencia.=" mensajesResp.respuestaReferenteId = $this->respuestaReferenteId && ";
  		}

      if($this->contenidoId!=NULL)
      {
        $sentencia.=" mensajesResp.contenidoId =$this->contenidoId && ";
      }

  		if($this->respuestaReferenteId!=NULL)
  		{
  			$sentencia.=" mensajesResp.respuestaReferenteId=$this->respuestaReferenteId && ";
  		}

  		if($this->fechaHora!=NULL)
  		{
  			$sentencia.=" mensajesResp.fechaHora='$this->fechaHora' && ";
  		}
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY mensajesResp.mensajeHilo DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia.'<br><br>';
		if ($tipoConsulta=='cantidad') {
			$cantidad = mysqli_num_rows($conexion->query($sentencia));
			return $cantidad;
		}else{
			return $conexion->query($sentencia);
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
