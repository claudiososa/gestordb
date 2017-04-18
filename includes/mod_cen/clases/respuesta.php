<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class Respuesta
{
	private $respuestaId;
 	private $informeId;
 	private $referenteId;
	private $contenido;
 	private $fechaVisita;
 	private $fechaCarga;
 	private $fechaModificado;



function __construct($respuestaId=NULL,$informeId=NULL,$referenteId=NULL, $contenido=NULL,
	$fechaVisita=NULL,	$fechaCarga=NULL,
	$fechaModificado=NULL)
	{
		$this->respuestaId = $respuestaId;
 		$this->informeId = $informeId;
 		$this->referenteId =$referenteId;
 		$this->contenido =$contenido;
 		$this->fechaVisita = $fechaVisita;
 		$this->fechaCarga = $fechaCarga;
 		$this->fechaModificado = $fechaModificado;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO respuestas (respuestaId,informeId,referenteId,contenido,fechaVisita,fechaCarga,fechaModificado)
		VALUES (NULL,'". $this->informeId."','". $this->referenteId."','". $this->contenido."',
		'". $this->fechaVisita."','". $this->fechaCarga."',
		'". $this->fechaModificado."');";
    //echo $sentencia;

		if ($conexion->query($sentencia)) {
			$respuestaId=$conexion->insert_id;
			return $respuestaId;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	public function editar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
				$sentencia="UPDATE respuestas SET contenido = '$this->contenido',
				fechaVisita = '$this->fechaVisita'
				,fechaModificado = '$this->fechaModificado' WHERE respuestaId = '$this->respuestaId'";
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM respuestas WHERE respuestaId=".$this->respuestaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->informeId = $elemento->informeId;
 		$this->referenteId =$elemento->referenteId;
		$this->contenido =$elemento->contenido;
		$this->fechaVisita = $elemento->fechaVisita;
 		$this->fechaCarga = $elemento->fechaCarga;
 		$this->fechaModificado = $elemento->fechaModificado;

		return $this;

    }

    public static function camposet($campo,$tabla){
    	$nuevaConexion=new Conexion();
    	$conexion=$nuevaConexion->getConexion();
    	$sentencia="SHOW COLUMNS FROM $tabla LIKE '$campo'";
    	$query=$conexion->query($sentencia);
    	$result = mysqli_fetch_assoc($query);
    	$result=$result['Type'];
    	$result=substr($result, 5, strlen($result)-5);
    	$result=substr($result, 0, strlen($result)-2);
    	$result = explode("','",$result);
    	return $result;
    }

		public function summary($condicion=NULL,$filtro=NULL,$campo_principal=NULL,$fecha1=NULL,$fecha2=NULL,$mes1=NULL,$año1=NULL,$prioridad=NULL){

			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();
			$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas";

		switch ($condicion) {

			case 'totalRespuestasUnicos':
				$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas";
				break;

			case 'entreFechas':
				if(isset($fecha1)<>NULL && isset($fecha2)<>NULL){
					$sentencia="SELECT ".$filtro." * "."FROM respuestas WHERE fechahora "." BETWEEN '".$fecha1."' AND '".$fecha2."'";
				}else{
					$sentencia="SELECT ".$filtro." * "."FROM respuestas";
				}
				break;

			case 'mesAño':
				$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas WHERE informeId IN (SELECT informeId FROM informes WHERE MONTH(fechaCarga) = ".$mes1." AND YEAR(fechaCarga) =".$año1.")";
				break;

			case 'mesAñoPrioridad':
				$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas WHERE informeId IN (SELECT informeId FROM informes WHERE MONTH(fechaCarga) = ".$mes1." AND YEAR(fechaCarga) =".$año1." AND prioridad='".$prioridad."')";
				break;

			case 'añoUnicosPrioridad':
					$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas WHERE informeId IN (SELECT informeId FROM informes WHERE YEAR(fechaCarga) = 2017 AND prioridad='".$prioridad."')";
					break;

			case 'añoUnicos':
				$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas WHERE informeId IN (SELECT informeId FROM informes WHERE YEAR(fechaCarga) = 2017)";
				break;
			default:
				//$sentencia="SELECT ".$filtro." ".$campo_principal." FROM respuestas";
				break;
		}
		//	echo $sentencia;
			return $conexion->query($sentencia);
		}

	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM respuestas";
		if($this->informeId!=NULL || $this->referenteId!=NULL
		|| $this->fechaVisita!=NULL || $this->fechaCarga!=NULL || $this->contenido!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->informeId!=NULL)
		{
			$sentencia.=" informeId = $this->informeId && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId='$this->referenteId' && ";
		}

		if($this->fechaVisita!=NULL)
		{
			$sentencia.=" fechaVisita='$this->fechaVisita' && ";
		}

		if($this->fechaCarga!=NULL)
		{
			$sentencia.=" fechaCarga='$this->fechaCarga' && ";
		}

		if($this->contenido!=NULL)
		{
			$sentencia.=" contenido=$this->contenido && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY fechaCarga ASC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
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
