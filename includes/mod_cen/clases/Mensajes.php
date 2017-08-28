<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("MensajeHilo.php");
include_once("maestro.php");

class Mensajes
{
	private $mensajeId;
 	private $referenteId;
 	private $asunto;
 	private $contenido;
	private $destinatario;
 	private $fechaHora;
	private $fechaUltimaResp;

function __construct($mensajeId=NULL,$referenteId=NULL,$asunto=NULL,
											$contenido=NULL,$destinatario=NULL,$fechaHora=NULL,$fechaUltimaResp=NULL)
	{
		$this->mensajeId = $mensajeId;
 		$this->referenteId = $referenteId;
 		$this->asunto =$asunto;
 		$this->contenido =$contenido;
		$this->destinatario = $destinatario;
 		$this->fechaHora = $fechaHora;
		$this->fechaUltimaResp = $fechaUltimaResp;
	}
	public function  mensajeIdOriginal($mensajeId,$mensajeIdRespuesta=NULL){
		$arrayIdMensaje = array();
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia = "SELECT respuesta
								 FROM mensajes
								 WHERE mensajeId = $mensajeId";
		$cantidadMensajes = mysqli_num_rows($conexion->query($sentencia));
		$valorRespuesta = mysqli_fetch_object($conexion->query($sentencia));

		if ($cantidadMensajes==1 AND $valorRespuesta->respuesta==0) {
			array_push($arrayIdMensaje,$mensajeId);
			array_push($arrayIdMensaje,$mensajeIdRespuesta);
		}else{
			$valorRespuesta = mysqli_fetch_object($conexion->query($sentencia));
			$sentenciaFinal = "SELECT mensajeId
											FROM mensajes
											WHERE mensajeId=".$valorRespuesta->respuesta."
											AND respuesta=0";
		$mensajeObjeto = mysqli_fetch_object($conexion->query($sentenciaFinal));
		$mensaje=$mensajeObjeto->mensajeId;
		array_push($arrayIdMensaje,$mensaje);
		array_push($arrayIdMensaje,$mensajeIdRespuesta);
		}


		return $arrayIdMensaje;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO mensajes (mensajeId,referenteId,asunto,contenido,destinatario,fechaHora,fechaUltimaResp)
		            VALUES (NULL,
                        '". $this->referenteId."',
                        '".$this->asunto."',
                        '". $this->contenido."',
                        '". $this->destinatario."',
												'". $this->fechaHora."',
                        '". $this->fechaUltimaResp."');
                        ";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoMensajeId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE mensajes SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE mensajeId=$this->mensajeId";
		echo $sentencia;
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoMensajeId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

public function buscarIntervenciones($mensajeId){
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();
	$sentencia = "SELECT mensajeId FROM mensajes
								WHERE respuesta=$mensajeId";
	$cantidadMensajes = mysqli_num_rows($conexion->query($sentencia));
	return $cantidadMensajes;
}

public function buscarRespuesta2()
	{
		$bd=Conexion2::getInstance();
		$stmt ="SELECT * FROM mensajes
					INNER JOIN referentes
					ON referentes.referenteId=mensajes.referenteId
					INNER JOIN personas
					ON personas.personaId=referentes.personaId
					WHERE 1";
					$stmt.="  ORDER BY mensajes.fechaUltimaResp DESC";
					//echo $stm.'<br><br>';
					return $bd->ejecutar($stmt);
	}

public function propio($mensajeId){
		$bd=Conexion2::getInstance();
		$stmt ="SELECT *
						FROM mensajes
						WHERE mensajeId=$mensajeId";
						//echo $stmt;
	  $dato=mysqli_fetch_object($bd->ejecutar($stmt));
		//var_dump($dato);

		if ($dato->referenteId==(int)$_SESSION['referenteId']) {
			return 'si';
		}
		return 'no';
}

public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$bd=Conexion2::getInstance();
    $sinParam=0;
		$sentencia="SELECT mensajes.mensajeId,referentes.referenteId,mensajes.asunto,mensajes.contenido
									,mensajes.destinatario,mensajes.fechaHora,mensajes.fechaUltimaResp,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
									FROM mensajes
									INNER JOIN referentes
									ON referentes.referenteId=mensajes.referenteId
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


		if($this->mensajeId!=NULL || $this->referenteId!=NULL ||
			$this->destinatario!=NULL || $this->fechaHora!=NULL ||
			$this->contenido!=NULL || $this->asunto!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->mensajeId!=NULL)
  		{
  			$sentencia.=" mensajes.mensajeId = $this->mensajeId && ";
  		}

  		if($this->referenteId!=NULL)
  		{
  			$sentencia.=" mensajes.referenteId = $this->referenteId && ";
  		}

  		if($this->asunto!=NULL)
  		{
  			$sentencia.=" mensajes.asunto LIKE '%$this->asunto%' && ";
  		}

      if($this->contenido!=NULL)
      {
        $sentencia.=" mensajes.contenido LIKE '%$this->contenido%' && ";
      }

  		if($this->destinatario!=NULL)
  		{
  			$sentencia.=" mensajes.destinatario=$this->destinatario && ";
  		}

  		if($this->fechaHora!=NULL)
  		{
  			$sentencia.=" mensajes.fechaHora='$this->fechaHora' && ";
  		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY mensajes.fechaUltimaResp DESC";
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
