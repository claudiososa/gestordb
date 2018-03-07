<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class Leido
{
	private $leidoId;
 	private $informeId;
 	private $referenteId;
 	private $fechaHora;


function __construct($leidoId=NULL,$informeId=NULL,$referenteId=NULL, $fechaHora=NULL)
	{
		$this->leidoId = $leidoId;
 		$this->informeId = $informeId;
 		$this->referenteId =$referenteId;
 		$this->fechaHora = $fechaHora;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO leido (leidoId,informeId,referenteId,fechaHora)
		VALUES (NULL,'". $this->informeId."','". $this->referenteId."','". $this->fechaHora."');";
    //echo $sentencia;

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	/*public function editar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
				$sentencia="UPDATE leido SET contenido = '$this->contenido',
				fechaVisita = '$this->fechaVisita'
				,fechaHora = '$this->fechaHora' WHERE leidoId = '$this->leidoId'";
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}*/

	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM leido WHERE leidoId=".$this->leidoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->informeId = $elemento->informeId;
 		$this->referenteId =$elemento->referenteId;
		$this->fechaHora = $elemento->fechaHora;
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


			switch ($condicion) {

				case 'totalLeidosUnicos':
					$sentencia="SELECT ".$filtro." ".$campo_principal." FROM leido";
					break;

				case 'entreFechas':
					if(isset($fecha1)<>NULL && isset($fecha2)<>NULL){
						$sentencia="SELECT ".$filtro." * "."FROM leido WHERE fechaCarga "." BETWEEN '".$fecha1."' AND '".$fecha2."'";
					}else{
						$sentencia="SELECT ".$filtro." * "."FROM leido";
					}
					break;

				case 'mesAño':
					$sentencia="SELECT ".$filtro." ".$campo_principal." FROM leido WHERE informeId IN (SELECT informeId FROM informes WHERE MONTH(fechaCarga) = ".$mes1." AND YEAR(fechaCarga) = 2017)";
					break;

				case 'mesAñoPrioridad':
					$sentencia="SELECT ".$filtro." ".$campo_principal." FROM leido WHERE informeId IN (SELECT informeId FROM informes WHERE MONTH(fechaCarga) = ".$mes1." AND YEAR(fechaCarga) =".$año1." AND prioridad='".$prioridad."')";
					break;

				case 'añoUnicosPrioridad':
						$sentencia="SELECT ".$filtro." ".$campo_principal." FROM leido WHERE informeId IN (SELECT informeId FROM informes WHERE YEAR(fechaCarga) = 2017 AND prioridad='".$prioridad."')";
						break;

				case 'añoUnicos':
					$sentencia="SELECT ".$filtro." ".$campo_principal." FROM leido WHERE informeId IN (SELECT informeId FROM informes WHERE YEAR(fechaCarga) = 2017)";
					break;
				default:
					//$sentencia="SELECT ".$filtro." ".$campo_principal." FROM leido";
					break;
			}

		  //  echo $sentencia."<br>";
			return $conexion->query($sentencia);
		}

		public function buscarLeido()
		{
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();

			$sentencia="SELECT leido.referenteId, leido.leidoId, leido.informeId, leido.fechaHora, personas.nombre, personas.apellido
									FROM leido
									INNER JOIN referentes
									ON leido.referenteId=referentes.referenteId
									INNER JOIN personas
									ON referentes.personaId=personas.personaId
									WHERE leido.informeId=".$this->informeId." AND leido.referenteId<>".$this->referenteId;
			$sentencia.="  ORDER BY leido.fechaHora ASC";
			//return $sentencia;
			return $conexion->query($sentencia);
	}

	public function buscar($limit=NULL,$tipo=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();



		$sentencia="SELECT leido.referenteId, leido.leidoId, leido.informeId, leido.fechaHora, personas.nombre, personas.apellido FROM leido
												INNER JOIN referentes
												ON leido.referenteId=referentes.referenteId
												INNER JOIN personas
												ON referentes.personaId=personas.personaId";
		if($this->informeId!=NULL || $this->referenteId!=NULL
		|| $this->fechaHora!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->informeId!=NULL)
		{
			$sentencia.=" leido.informeId = $this->informeId && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" leido.referenteId='$this->referenteId' && ";
		}

		if($this->fechaHora!=NULL)
		{
			$sentencia.=" leido.fechaHora='$this->fechaHora' && ";
		}



		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY leido.fechaHora ASC";
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
