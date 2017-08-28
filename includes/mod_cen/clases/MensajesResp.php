<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("MensajeHilo.php");

include_once("maestro.php");

class MensajesResp
{
	private $mensajeRespId;
	private $mensajeHilo;
 	private $asunto;
 	private $contenido;
	private $respuestaReferenteId;
 	private $fechaHora;

function __construct(	$mensajeRespId=NULL,
											$mensajeHilo=NULL,
                      $asunto=NULL,
                      $contenido=NULL,
                      $respuestaReferenteId=NULL,
	                    $fechaHora=NULL
                      )
	{
		$this->mensajeRespId = $mensajeRespId;
		$this->mensajeHilo = $mensajeHilo;
 		$this->asunto =$asunto;
 		$this->contenido =$contenido;
		$this->respuestaReferenteId = $respuestaReferenteId;
 		$this->fechaHora = $fechaHora;
	}

	public function buscarHilo($mensajeId,$referenteId,$tipo){
		$bd=Conexion2::getInstance();
		$sentencia="SELECT * FROM mensajesHilo
								WHERE mensajeId=$mensajeId
								AND referenteId=$referenteId
								AND mensajeTipo=$mensajeTipo";
	}

	public function respuestasParaMensaje($mensajeId,$tipo=NULL){
		$bd=Conexion2::getInstance();
		if ($tipo!='arrayRespuestas') {
			# code...

		$stmt = "SELECT * FROM mensajesHilo
							INNER JOIN mensajesResp
							ON mensajesHilo.mensajeHiloId=mensajesResp.mensajeHilo
							WHERE mensajeId=$mensajeId ORDER BY fechaHora ASC";

		if ($tipo=='cantidad') {
			//echo $stmt;
			$total = mysqli_num_rows($bd->ejecutar($stmt));
			return $total;
		}elseif ($tipo=='resultados') {
			return $bd->ejecutar($stmt);
		}
	}else{
		$arrayHilos = array();
		$elemento=0;
		$hilo = new MensajeHilo(null,$mensajeId);
		$buscarHilo = $hilo->buscarSoloHilos($mensajeId);
		while ($fila = mysqli_fetch_object($buscarHilo)) {
			$arrayDestino = explode(',',$fila->referenteIdResp);
			//var_dump($arrayDestino);
			foreach ($arrayDestino as $key => $value)
			{

					if ($arrayDestino[$key]==$_SESSION['referenteId'])
					{
							array_push($arrayHilos,$fila->mensajeHiloId);
					}
			}
		}
	}
	if (count($arrayHilos)>0) {
		$bd=Conexion2::getInstance();
		switch (count($arrayHilos)) {
			case '1':
					$stmt ="SELECT * FROM mensajesResp WHERE mensajeHilo=$arrayHilos[0] ORDER BY fechaHora ASC";
				break;
			case '2':
					$stmt ="SELECT * FROM mensajesResp WHERE mensajeHilo=$arrayHilos[0] OR mensajeHilo=$arrayHilos[1] ORDER BY fechaHora ASC";
					# code...
					break;
			default:
				# code...
				break;
		}
		return $bd->ejecutar($stmt);
	}else{
		return 'sinRespuestas';
	}

	}



	public function agregar()
	{
		$bd=Conexion2::getInstance();

		$sentencia="INSERT INTO mensajesResp (mensajeRespId,mensajeHilo,asunto,contenido,respuestaReferenteId,fechaHora)
		            VALUES (NULL,
												'". $this->mensajeHilo."',
                        '".$this->asunto."',
                        '". $this->contenido."',
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

	public function buscarIntervenciones($mensajeHilo){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia = "SELECT mensajeHilo FROM mensajesResp
									WHERE mensajeHilo = $mensajeHilo";
		$cantidadMensajes = mysqli_num_rows($conexion->query($sentencia));
		return $cantidadMensajes;
	}

	public function buscarRespuestas($arrayBuscarHilo){
		$bd=Conexion2::getInstance();
		$recorrido=0;
		if ($arrayBuscarHilo[0]=='0' && $arrayBuscarHilo[1]=='0') {
			$sentencia = "SELECT * FROM mensajesResp
										WHERE mensajesResp.mensajeHilo=-1 ";
		}else{

		$sentencia = "SELECT * FROM mensajesResp
									WHERE ";
		if ($arrayBuscarHilo[0]<>'0') {
				$sentencia .=" mensajesResp.mensajeHilo=$arrayBuscarHilo[0]  OR";
				$recorrido++;
		}

		if ($arrayBuscarHilo[1]<>'0') {
				$sentencia .=" mensajesResp.mensajeHilo=$arrayBuscarHilo[1] ";
				$recorrido++;
				$recorrido++;
		}
									 //mensajesResp.mensajeHilo=";

		}
		if ($recorrido==1) {
			$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}
		//echo $sentencia;
		return $bd->ejecutar($sentencia);
	}

	public function buscarRespMensajeActual($mensajeId,$referenteId){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia = "SELECT * FROM mensajesResp
									WHERE respuestaReferenteId = $referenteId OR respuestaReferenteId = $this->respuestaReferenteId";

		return $conexion->query($sentencia);
	}


public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
    $sinParam=0;
		$sentencia="SELECT mensajesResp.mensajeRespId,mensajesResp.respuestaReferenteId,mensajesResp.asunto,mensajesResp.contenido
									,mensajesResp.respuestaReferenteId,mensajesResp.fechaHora,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
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


		if($this->mensajeHilo!=NULL ||  $this->respuestaReferenteId!=NULL || $this->fechaHora!=NULL || $this->contenido!=NULL || $this->asunto!=NULL)
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

  		if($this->asunto!=NULL)
  		{
  			$sentencia.=" mensajesResp.asunto LIKE '%$this->asunto%' && ";
  		}

      if($this->contenido!=NULL)
      {
        $sentencia.=" mensajesResp.contenido LIKE '%$this->contenido%' && ";
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
