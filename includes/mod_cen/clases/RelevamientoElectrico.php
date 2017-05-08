<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class RelevamientoElectrico
{
	private $escuelaId;
 	private $otroCue;
 	private $internado;
 	private $totalCargos;
 	private $matricula;
 	private $energia;
	private $tipoInstalacion;
	private $cantidadAulas;
 	private $cantidadPcInstaladas;
 	private $heladera;
	private $otros;
	private $suficienteEnergia;
	private $calefon;
	private $necesitaCalefonSolar;
	private $necesitaBombeoAgua;
	private $comentario;

 	function __construct($escuelaId=NULL,
											$otroCue=NULL,
											$internado=NULL,
											$totalCargos=NULL,
											$matricula=NULL,
											$energia=NULL,
											$tipoInstalacion=NULL,
											$cantidadAulas=NULL,
											$cantidadPcInstaladas=NULL,
											$heladera=NULL,
											$otros=NULL,
											$suficienteEnergia=NULL,
											$calefon=NULL,
											$necesitaCalefonSolar=NULL,
											$necesitaBombeoAgua=NULL,
											$comentario=NULL)
	{
			 //seteo los atributos
		 	$this->escuelaId = $escuelaId;
		 	$this->otroCue = $otroCue;
		 	$this->internado = $internado;
		 	$this->totalCargos = $totalCargos;
		 	$this->matricula =$matricula;
		 	$this->energia = $energia;
		 	$this->tipoInstalacion = $tipoInstalacion;
		 	$this->cantidadAulas = $cantidadAulas;
		 	$this->cantidadPcInstaladas = $cantidadPcInstaladas;
		 	$this->heladera = $heladera;
			$this->otros = $otros;
			$this->suficienteEnergia = $suficienteEnergia;
			$this->calefon = $calefon;
			$this->necesitaCalefonSolar = $necesitaCalefonSolar;
			$this->necesitaBombeoAgua = $necesitaBombeoAgua;
			$this->comentario = $comentario;
	}

	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO relevamientoElectrico (escuelaId,otroCue,internado,totalCargos,matricula,energia,tipoInstalacion,cantidadAulas,cantidadPcInstaladas,heladera,otros,suficienteEnergia,calefon,necesitaCalefonSolar,necesitaBombeoAgua,comentario)
		VALUES (NULL,'". $this->otroCue."','". $this->internado."','". $this->totalCargos."','".$this->matricula."','". $this->energia."','". $this->tipoInstalacion."','". $this->cantidadAulas."','". $this->cantidadPcInstaladas."','".$this->heladera."','".$this->otros."','".$this->suficienteEnergia."','".$this->calefon."','".$this->necesitaCalefonSolar."','".$this->necesitaBombeoAgua."','".$this->comentario."');";

		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="UPDATE relevamientoElectrico SET otroCue ='$this->otroCue',internado = '$this->internado', totalCargos = '$this->totalCargos', matricula = '$this->matricula',energia = '$this->energia', tipoInstalacion = '$this->tipoInstalacion', cantidadAulas = '$this->cantidadAulas', cantidadPcInstalados = '$this->cantidadPcInstaladas', heladera = '$this->heladera' , suficienteEnergia = '$this->suficienteEnergia', calefon = '$this->calefon', necesitaCalefonSolar = '$this->necesitaCalefonSolar', necesitaBombeoAgua = '$this->necesitaBombeoAgua', comentario = '$this->comentario' WHERE escuelaId = '$this->escuelaId'";

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
        $nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM relevamientoElectrico WHERE escuelaId=".$this->escuelaId;
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

		$sentencia="SELECT * FROM relevamientoElectrico";
		$carga=0;
		$cargalocali=0;
		if($this->otroCue!=NULL || $this->internado!=NULL
			 || $this->totalCargos!=NULL || $this->matricula!=NULL
			 || $this->energia!=NULL || $this->tipoInstalacion!=NULL
			 || $this->cantidadAulas!=NULL || $this->cantidadPcInstaladas!=NULL
			 || $this->escuelaId!=NULL || $this->otroCuePmi!=NULL)
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
			$sentencia.=" escuelaId=$this->escuelaId && ";
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

		$sentencia.="  ORDER BY escuelaId";

	echo $sentencia."<br>";
		return $conexion->query($sentencia);

	}

	public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM relevamientoElectrico WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->escuelaId = $elemento->escuelaId;
	 	$this->otroCue = $elemento->otroCue;
	 	$this->internado = $elemento->internado;
	 	$this->totalCargos = $elemento->totalCargos;
	 	$this->matricula = $elemento->matricula;
	 	$this->energia = $elemento->energia;
	 	$this->tipoInstalacion = $elemento->tipoInstalacion;
	 	$this->cantidadAulas = $elemento->cantidadAulas;
	 	$this->cantidadPcInstaladas = $elemento->cantidadPcInstaladas;
	 	$this->heladera = $elemento->heladera;
	 	$this->suficienteEnergia = $elemento->suficienteEnergia;
	 	$this->calefon = $elemento->calefon;
	 	$this->necesitaCalefonSolar = $elemento->necesitaCalefonSolar;
	 	$this->necesitaBombeoAgua = $elemento->necesitaBombeoAgua;
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

$estado=array();

if(isset($_POST["referente_id"])) {
	//incluye clase referente - crear referente y busca segun el referente_id enviado por post
	include_once('referente.php');
	$referente=new Referente($_POST["referente_id"]);
	$buscar_referente=$referente->buscar();
	$dato_referente=mysqli_fetch_object($buscar_referente);
	//****************************************************************************

	// crea persona y busca persona de acuerdo a personaId obtenido del objeto $dato_referente
	$persona=new Persona($dato_referente->personaId);

	$buscar_persona=$persona->buscar();
	$dato_persona=mysqli_fetch_object($buscar_persona);
	//********************************************************************************
$escuela=new Escuela($_POST["escuela_id"],$_POST["referente_id"]);
	//busca escueala de acuerdo a escuelaId enviado por post y actualiza el referenteId acargo del colegio
	if(isset($_POST['pmi'])){
		$editar_escuela=$escuela->editarref("pmi");
	}else{
		$editar_escuela=$escuela->editarref();
	}


	$editar_escuela=$escuela->editarref("pmi");

	if($editar_escuela==1){
		$borrar= 1;
	}


	if($borrar==1) {

		$estado=array("estado"=>$dato_persona->apellido.", ".$dato_persona->nombre,	"total"=>$dato_persona->apellido,);
	}
	echo json_encode($estado);
}
