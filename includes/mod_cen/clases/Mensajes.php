<?php
include_once('conexion.php');
include_once("referente.php");
include_once("maestro.php");

class Mensajes
{
	private $mensajeId;
 	private $referenteId;
 	private $asunto;
 	private $contenido;
	private $destinatario;
 	private $fechaHora;

function __construct($mensajeId=NULL,
                      $referenteId=NULL,
                      $asunto=NULL,
                      $contenido=NULL,
                      $destinatario=NULL,
	                    $fechaHora=NULL
                      )
	{
		$this->mensajeId = $mensajeId;
 		$this->referenteId = $referenteId;
 		$this->asunto =$asunto;
 		$this->contenido =$contenido;
		$this->destinatario = $destinatario;
 		$this->fechaHora = $fechaHora;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO mensajes (mensajeId,referenteId,asunto,contenido,destinatario,fechaHora)
		            VALUES (NULL,
                        '". $this->referenteId."',
                        '".$this->asunto."',
                        '". $this->contenido."',
                        '". $this->destinatario."',
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
		$sentencia="SELECT mensajes.mensajeId,mensajes.referenteId,mensajes.asunto,mensajes.contenido
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


		if($this->mensajeId!=NULL || $this->referenteId!=NULL || $this->destinatario!=NULL || $this->fechaHora!=NULL || $this->contenido!=NULL || $this->asunto!=NULL)
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


		$sentencia.="  ORDER BY mensajes.mensajeId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		echo $sentencia.'<br><br>';
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
