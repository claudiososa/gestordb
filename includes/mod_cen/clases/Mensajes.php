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

	/**
	 * Metodo para devolver ultimo registro segun respuesta y destinatario
	 */
/*
	public function ultimoMensajeRespuesta($mensajeId,$referenteId){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia = "SELECT *
								 FROM mensajes
								 WHERE respuesta = $mensajeId AND destinatario = $referenteId
								 ORDER BY mensajeId ASC LIMIT 1";

								 $arrayDestino = explode(',',$fila->destinatario);
							   //var_dump($arrayDestino);
							   foreach ($arrayDestino as $key => $value) {
							     //echo $arrayDestino[$key].'<br>';
							     if ($arrayDestino[$key]==$_SESSION['referenteId']) {

							       $mensaje1 = new Mensajes();

							       $mensajeOriginal=$mensaje1->mensajeIdOriginal($fila->mensajeId,$fila->mensajeId);


							       $intervenciones = $mensaje1->buscarIntervenciones($mensajeOriginal[0]);
							       $intervenciones++;

							       $adjunto = new MensajesAdjunto(null,$fila->mensajeId);
							       $buscar_adjunto = $adjunto->buscar();
							       $cantAdjunto = mysqli_num_rows($buscar_adjunto);
							       echo '<div class="estilo1">';
							       echo '<div class="row">';
							       echo '<div class="col-md-4 col-xs-6">'.ucwords(strtolower($fila->apellido)).', '.ucwords(strtolower($fila->nombre)).'</div>';
							 echo '<div class="visible-xs">'.date("d-m-y H:i", strtotime($fila->fechaHora)).'</div>';
							       if ($cantAdjunto==0) {

							         echo '<div class="col-md-4 col-xs-12"><h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</a></h4></div>';
							       }else{
							         echo '<div class="col-md-4 col-xs-12"<h4><a href="index.php?men=mensajes&id=3&mensajeId='.$fila->mensajeId.'">'.$fila->asunto.'-('.$intervenciones.')</h4></a>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-paperclip"></span></div>';

							       }
							 echo '<div class="col-md-4 hidden-xs">'.date("d-m-Y H:i", strtotime($fila->fechaHora)).'</div>';

							       echo '</div>';
							       echo '</div>';
							       $cantidadMensajes++;

							     }
							   }


	}
	*/
	public function  mensajeIdOriginal($mensajeId,$mensajeIdRespuesta=NULL){
		$arrayIdMensaje = array();
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia = "SELECT respuesta
								 FROM mensajes
								 WHERE mensajeId = $mensajeId";
		$cantidadMensajes = mysqli_num_rows($conexion->query($sentencia));
		$valorRespuesta = mysqli_fetch_object($conexion->query($sentencia));
		if ($cantidadMensajes==1 AND $valorRespuesta==0) {
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

public function buscarIntervenciones($mensajeId){
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();
	$sentencia = "SELECT mensajeId FROM mensajes
								WHERE respuesta=$mensajeId";
	$cantidadMensajes = mysqli_num_rows($conexion->query($sentencia));
	return $cantidadMensajes;
}


public function buscarRespuesta($referenteId=NULL){
	$arrayCantidad=array();
	$arrayMensajeId=array();
	$cantidad=1;
	$nuevaConexion=new Conexion();
	$conexion=$nuevaConexion->getConexion();

	$sentencia = "SELECT * FROM mensajes WHERE respuesta=".$this->mensajeId;
	if (isset($referenteId)) {
		$sentencia .= " AND destinatario=$referenteId ORDER BY mensajeId DESC LIMIT 1";
	}
	//echo $sentencia;
	$buscarMensaje=$conexion->query($sentencia);

	if (isset($referenteId)) {
			$datoMensaje = mysqli_fetch_object($buscarMensaje);
			//var_dump($datoMensaje);
		array_push($arrayMensajeId,$datoMensaje->respuesta);
		$arrayRespuesta=array_merge($arrayCantidad,$arrayMensajeId);
	}else{
	array_push($arrayMensajeId,$this->mensajeId);
	if(mysqli_num_rows($buscarMensaje) > 0){

		while ($fila = mysqli_fetch_object($buscarMensaje)) {
			array_push($arrayMensajeId,$fila->mensajeId);
			$cantidad++;
		}

		/*$estado = 0;
		//$cantidad++;
		do {
			$cantidad++;
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();

			$sentencia = "SELECT * FROM mensajes WHERE respuesta=".$datoMensaje->respuesta;
			$buscarMensaje=$conexion->query($sentencia);

			$datoMensaje = mysqli_fetch_object($buscarMensaje);
			array_push($arrayMensajeId,$datoMensaje->mensajeId);
			if($datoMensaje->respuesta == 0){
				$estado = 2;
			}
		} while ($estado < 1); */
	}
	array_push($arrayCantidad,$cantidad);
	asort($arrayMensajeId);
	$arrayRespuesta=array_merge($arrayCantidad,$arrayMensajeId);
	}
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
			$this->contenido!=NULL || $this->asunto!=NULL || $this->respuesta==NULL)
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

			if($this->respuesta==0 AND $tipoConsulta=='originales')
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
