<?php
include_once('conexion.php');
include_once("referente.php");
include_once("maestro.php");

class MensajesResp
{
	private $mensajeRespId;
	private $mensajeId;
 	private $referenteId;
 	private $asunto;
 	private $contenido;
	private $destinatario;
 	private $fechaHora;

function __construct(	$mensajeRespId=NULL,
											$mensajeId=NULL,
                      $referenteId=NULL,
                      $asunto=NULL,
                      $contenido=NULL,
                      $destinatario=NULL,
	                    $fechaHora=NULL
                      )
	{
		$this->mensajeRespId = $mensajeRespId;
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

		$sentencia="INSERT INTO mensajesResp (mensajeRespId,mensajeId,referenteId,asunto,contenido,destinatario,fechaHora)
		            VALUES (NULL,
												'". $this->mensajeId."',
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
		$sentencia="SELECT mensajesResp.mensajeRespId,mensajesResp.referenteId,mensajesResp.asunto,mensajesResp.contenido
									,mensajesResp.destinatario,mensajesResp.fechaHora,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
									FROM mensajesResp
									INNER JOIN referentes
									ON referentes.referenteId=mensajesResp.referenteId
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
  			$sentencia.=" mensajesResp.mensajeRespId = $this->mensajeRespId && ";
  		}

			if($this->mensajeRespId!=NULL)
  		{
  			$sentencia.=" mensajesResp.mensajeRespId = $this->mensajeRespId && ";
  		}

  		if($this->referenteId!=NULL)
  		{
  			$sentencia.=" mensajesResp.referenteId = $this->referenteId && ";
  		}

  		if($this->asunto!=NULL)
  		{
  			$sentencia.=" mensajesResp.asunto LIKE '%$this->asunto%' && ";
  		}

      if($this->contenido!=NULL)
      {
        $sentencia.=" mensajesResp.contenido LIKE '%$this->contenido%' && ";
      }

  		if($this->destinatario!=NULL)
  		{
  			$sentencia.=" mensajesResp.destinatario=$this->destinatario && ";
  		}

  		if($this->fechaHora!=NULL)
  		{
  			$sentencia.=" mensajesResp.fechaHora='$this->fechaHora' && ";
  		}
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else


		$sentencia.="  ORDER BY mensajesResp.mensajeId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
	//	echo $sentencia.'<br><br>';
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
