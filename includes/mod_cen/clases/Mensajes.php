<?php
include_once('conexionv2.php');
include_once("referente.php");
//include_once("MensajeHilo.php");
include_once("maestro.php");

class Mensajes
{
	private $mensajeId;
 	private $referenteId;
 	private $asunto;
	private $destinatario;
 	private $fechaHora;

function __construct($mensajeId=NULL,
										 $referenteId=NULL,
										 $asunto=NULL,
										 $destinatario=NULL,
										 $fechaHora=NULL
										 )
	{
		$this->mensajeId = $mensajeId;
 		$this->referenteId = $referenteId;
 		$this->asunto =$asunto;
		$this->destinatario = $destinatario;
 		$this->fechaHora = $fechaHora;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO mensajes (mensajeId,referenteId,asunto,destinatario,fechaHora)
		            VALUES (NULL,
                        '". $this->referenteId."',
                        '".$this->asunto."',
                        '". $this->destinatario."',
												'". $this->fechaHora."');
                        ";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoMensajeId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	/*public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE mensajes SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE mensajeId=$this->mensajeId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoMensajeId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}
*/

public function buscarHilo()
	{
		$referenteActual=$_SESSION ['referenteId'];
		$bd=Conexion2::getInstance();
		$stmt ="SELECT * FROM mensajes
					INNER JOIN mensajesHilo
					ON mensajesHilo.mensajeId=mensajes.mensajeId
					AND mensajesHilo.referenteIdResp=$referenteActual
					INNER JOIN referentes
					ON referentes.referenteId=mensajes.referenteId
					INNER JOIN personas
					ON personas.personaId=referentes.personaId
					WHERE 1";
					$stmt.="  ORDER BY mensajes.mensajeId DESC";
					echo $stmt.'<br><br>';
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
		$sentencia="SELECT mensajes.mensajeId,referentes.referenteId,mensajes.asunto
									,mensajes.destinatario,mensajes.fechaHora,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
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
			$this->asunto!=NULL)
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


		$sentencia.="  ORDER BY mensajes.mensajeId DESC";
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
