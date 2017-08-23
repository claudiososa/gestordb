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
	private $respuesta;

function __construct($mensajeId=NULL,
                      $referenteId=NULL,
                      $asunto=NULL,
                      $contenido=NULL,
                      $destinatario=NULL,
	                    $fechaHora=NULL,
											$respuesta=NULL
                      )
	{
		$this->mensajeId = $mensajeId;
 		$this->referenteId = $referenteId;
 		$this->asunto =$asunto;
 		$this->contenido =$contenido;
		$this->destinatario = $destinatario;
 		$this->fechaHora = $fechaHora;
		$this->respuesta = $respuesta;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO mensajes (mensajeId,referenteId,asunto,contenido,destinatario,fechaHora,respuesta)
		            VALUES (NULL,
                        '". $this->referenteId."',
                        '".$this->asunto."',
                        '". $this->contenido."',
                        '". $this->destinatario."',
                        '". $this->fechaHora."',
												'". $this->respuesta."');
                        ";

		if ($conexion->query($sentencia)) {
			$mensajeId=$conexion->insert_id;
			return $mensajeId;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

public function buscarRespuesta(){
	$arrayCantidad=array();
	$arrayMensajeId=array();
	$cantidad=1;
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();

	$sentencia = "SELECT * FROM mensajes WHERE mensajeId=".$this->mensajeId;
	//echo $sentencia;
	$buscarMensaje=$conexion->query($sentencia);
	$datoMensaje = mysqli_fetch_object($buscarMensaje);
	//var_dump($datoMensaje);
	array_push($arrayMensajeId,$this->mensajeId);
	if($datoMensaje->respuesta <> 0){
		$estado = 0;
		//$cantidad++;
		do {
			$cantidad++;
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();

			$sentencia = "SELECT * FROM mensajes WHERE mensajeId=".$datoMensaje->respuesta;
			$buscarMensaje=$conexion->query($sentencia);

			$datoMensaje = mysqli_fetch_object($buscarMensaje);
			array_push($arrayMensajeId,$datoMensaje->mensajeId);
			if($datoMensaje->respuesta == 0){
				$estado = 2;
			}
		} while ($estado < 1);
	}
	array_push($arrayCantidad,$cantidad);
	asort($arrayMensajeId);
	$arrayRespuesta=array_merge($arrayCantidad,$arrayMensajeId);
	return $arrayRespuesta;//$cantidad;
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


		if($this->mensajeId!=NULL || $this->referenteId!=NULL ||
			$this->destinatario!=NULL || $this->fechaHora!=NULL ||
			$this->contenido!=NULL || $this->asunto!=NULL || $this->respuesta!=NULL)
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

			if($this->respuesta!=NULL)
  		{
  			$sentencia.=" mensajes.respuesta=$this->respuesta && ";
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

if(isset($_POST["term"])){

	$objReferentes=new Referente(null,null,null,null,null,null,null,'Activo');
	//$objReferentes->estado='Activo';

	$buscarReferentes=$objReferentes->buscar();
	//$lista=array();
	$indiceFila=0;
	$indiceColumna=0;
	$resultado= [];
	if(mysqli_num_rows($buscarReferentes)>0) {
		while($fila = mysqli_fetch_object($buscarReferentes))
		{
			$resultado[]=$fila->nombre;
			//$resultado.=$fila->referenteId;
		//	array_push($resultado[$fila->referenteId],$fila->nombre);
			//array_push($data['pussy'], 'wagon');
			//$resultado.="<option value='".$fila->referenteId."'>".$fila->nombre."</option>";
		}
		echo json_encode($resultado);

	}

	echo $resultado;
}
