<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");
include_once("includes/mod_cen/clases/localidades.php");

class AulaSatelite
{
	private $aulaSateliteId;
  private $escuelaId;
  private $nombre;
  private $domicilio;
  private $telefono;
  private $localidadId;
 	private $otroCue;
 	private $internado;
 	private $totalCargos;
 	private $matricula;
 	private $energia;
	private $tipoInstalacion;
	private $comoFunciona;
	private $cantidadAulas;
 	private $cantidadPcInstaladas;
 	private $heladera;
	private $otros;
	private $suficienteEnergia;
	private $calefon;
	private $necesitaCalefonSolar;
	private $necesitaBombeoAgua;
	private $conectividad;
	private $tipoConectividad;
	private $comentario;

 	function __construct($aulaSateliteId=NULL,
                      $escuelaId=NULL,
                      $nombre=NULL,
                      $domicilio=NULL,
                      $telefono=NULL,
                      $localidadId=NULL,
											$otroCue=NULL,
											$internado=NULL,
											$totalCargos=NULL,
											$matricula=NULL,
											$energia=NULL,
											$tipoInstalacion=NULL,
											$comoFunciona=NULL,
											$cantidadAulas=NULL,
											$cantidadPcInstaladas=NULL,
											$heladera=NULL,
											$otros=NULL,
											$suficienteEnergia=NULL,
											$calefon=NULL,
											$necesitaCalefonSolar=NULL,
											$necesitaBombeoAgua=NULL,
											$conectividad=NULL,
											$tipoConectividad=NULL,
											$comentario=NULL)
	{
			 //seteo los atributos
		 	$this->aulaSateliteId = $aulaSateliteId;
      $this->escuelaId = $escuelaId;
      $this->nombre = $nombre;
      $this->domicilio = $domicilio;
      $this->telefono = $telefono;
      $this->localidadId = $localidadId;
		 	$this->otroCue = $otroCue;
		 	$this->internado = $internado;
		 	$this->totalCargos = $totalCargos;
		 	$this->matricula =$matricula;
		 	$this->energia = $energia;
		 	$this->tipoInstalacion = $tipoInstalacion;
			$this->comoFunciona = $comoFunciona;
		 	$this->cantidadAulas = $cantidadAulas;
		 	$this->cantidadPcInstaladas = $cantidadPcInstaladas;
		 	$this->heladera = $heladera;
			$this->otros = $otros;
			$this->suficienteEnergia = $suficienteEnergia;
			$this->calefon = $calefon;
			$this->necesitaCalefonSolar = $necesitaCalefonSolar;
			$this->necesitaBombeoAgua = $necesitaBombeoAgua;
			$this->conectividad = $conectividad;
			$this->tipoConectividad = $tipoConectividad;
			$this->comentario = $comentario;
	}

	public function agregar($tipo)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
    if($tipo=='soloAula'){
      $sentencia="INSERT INTO aulaSatelite (aulaSateliteId,escuelaId,nombre,domicilio,telefono,localidadId)
      VALUES (NULL,
              '". $this->escuelaId."',
              '". $this->nombre."',
              '". $this->domicilio."',
              '". $this->telefono."',
              '". $this->localidadId."');";
    }elseif($tipo=='relevamiento'){
      $sentencia="INSERT INTO aulaSatelite (aulaSateliteId,escuelaId,nombre,domicilio,telefono,localidadId,otroCue,internado,totalCargos,matricula,energia,tipoInstalacion,comoFunciona,cantidadAulas,cantidadPcInstaladas,heladera,otros,suficienteEnergia,calefon,necesitaCalefonSolar,necesitaBombeoAgua,conectividad,tipoConectividad,comentario)
      VALUES ($this->aulaSateliteId,'". $this->escuelaId."','". $this->nombre."','". $this->domicilio."','". $this->telefono."','". $this->localidadId."','". $this->otroCue."','". $this->internado."','". $this->totalCargos."','".$this->matricula."','". $this->energia."','". $this->tipoInstalacion."','". $this->comoFunciona."','". $this->cantidadAulas."','". $this->cantidadPcInstaladas."','".$this->heladera."','".$this->otros."','".$this->suficienteEnergia."','".$this->calefon."','".$this->necesitaCalefonSolar."','".$this->necesitaBombeoAgua."','".$this->conectividad."','".$this->tipoConectividad."','".$this->comentario."');";

    }

		if ($conexion->query($sentencia)) {
			return 'agregarcompleto';
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function editar($tipo)
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
    if($tipo=='soloAula'){
    $sentencia="UPDATE aulaSatelite
                SET escuelaId ='$this->escuelaId',
										nombre ='$this->nombre',
                    domicilio ='$this->domicilio',
                    telefono ='$this->telefono',
                    localidadId ='$this->localidadId'
                WHERE aulaSateliteId = '$this->aulaSateliteId'";
    }elseif($tipo=='relevamiento'){
      $sentencia="UPDATE aulaSatelite
                  SET otroCue ='$this->otroCue',
                      internado = '$this->internado',
                      totalCargos = '$this->totalCargos',
                      matricula = '$this->matricula',
                      energia = '$this->energia',
                      tipoInstalacion = '$this->tipoInstalacion',
                      comoFunciona = '$this->comoFunciona',
                      cantidadAulas = '$this->cantidadAulas',
                      cantidadPcInstaladas = '$this->cantidadPcInstaladas',
                      heladera = '$this->heladera',
                      otros = '$this->otros',
                      suficienteEnergia = '$this->suficienteEnergia',
                      calefon = '$this->calefon',
                      necesitaCalefonSolar = '$this->necesitaCalefonSolar',
                      necesitaBombeoAgua = '$this->necesitaBombeoAgua',
                      conectividad = '$this->conectividad',
                      tipoConectividad = '$this->tipoConectividad',
                      comentario = '$this->comentario'
                    WHERE aulaSateliteId = '$this->aulaSateliteId'";
    }

		//echo $sentencia;

		if ($conexion->query($sentencia)) {
			return 'editarcompleto';
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
    $nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM aulaSatelite WHERE aulaSateliteId=".$this->aulaSateliteId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM aulaSatelite";
		$carga=0;
		$cargalocali=0;
		if($this->otroCue!=NULL || $this->internado!=NULL || $this->aulaSateliteId!=NULL
			 || $this->totalCargos!=NULL || $this->matricula!=NULL
			 || $this->energia!=NULL || $this->tipoInstalacion!=NULL
			 || $this->cantidadAulas!=NULL || $this->cantidadPcInstaladas!=NULL
			 || $this->aulaSateliteId!=NULL || $this->otroCue!=NULL || $this->escuelaId!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->otroCue!=NULL)
		{
			$sentencia.=" otroCue LIKE '%$this->otroCue%' && ";
			$carga=1;
		}

		if($this->internado!=NULL)
		{
			$sentencia.=" internado LIKE '%$this->internado%' && ";
			$carga=1;
		}

		if($this->totalCargos!=NULL)
		{
			$sentencia.=" totalCargos = $this->totalCargos && ";
			$carga=1;
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId = $this->escuelaId && ";
			$carga=1;
		}

		if($this->aulaSateliteId!=NULL)
		{
			$sentencia.=" aulaSateliteId=$this->aulaSateliteId && ";
			$carga=1;
		}

		if($this->matricula!=NULL)
		{
			$sentencia.=" matricula = $this->matricula && ";
			$carga=1;
		}

		if($this->energia!=NULL)
		{
			$sentencia.=" energia  LIKE '%$this->energia%' && ";
			$carga=1;
		}

		if($this->tipoInstalacion!=NULL)
		{
			$sentencia.=" tipoInstalacion LIKE '%$this->tipoInstalacion%' && ";
			$carga=1;
		}

		if($this->cantidadPcInstaladas!=NULL)
		{
			$sentencia.=" cantidadPcInstaladas =$this->cantidadPcInstaladaS && ";
			$carga=1;
		}

		if($carga==1 ) $sentencia=substr($sentencia,0,strlen($sentencia)-3);
		//$sentencia=substr($sentencia,0,strlen($sentencia)-3);


		}

		$sentencia.="  ORDER BY aulaSateliteId";

	//echo $sentencia."<br>";
		return $conexion->query($sentencia);

	}

	public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM aulaSatelite WHERE aulaSateliteId=".$this->aulaSateliteId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->aulaSateliteId = $elemento->aulaSateliteId;
    $this->escuelaId = $elemento->escuelaId;
    $this->nombre = $elemento->nombre;
    $this->telefono = $elemento->telefono;
    $this->domicilio = $elemento->domicilio;
		$this->localidadId = $elemento->localidadId;
	 	$this->otroCue = $elemento->otroCue;
	 	$this->internado = $elemento->internado;
	 	$this->totalCargos = $elemento->totalCargos;
	 	$this->matricula = $elemento->matricula;
	 	$this->energia = $elemento->energia;
	 	$this->tipoInstalacion = $elemento->tipoInstalacion;
	 	$this->cantidadAulas = $elemento->cantidadAulas;
	 	$this->cantidadPcInstaladas = $elemento->cantidadPcInstaladas;
	 	$this->heladera = $elemento->heladera;
		$this->otros = $elemento->otros;
	 	$this->suficienteEnergia = $elemento->suficienteEnergia;
	 	$this->calefon = $elemento->calefon;
	 	$this->necesitaCalefonSolar = $elemento->necesitaCalefonSolar;
	 	$this->necesitaBombeoAgua = $elemento->necesitaBombeoAgua;
		$this->conectividad = $elemento->conectividad;
		$this->tipoConectividad = $elemento->tipoConectividad;
	 	$this->comentario = $elemento->comentario;
		return $this;

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
