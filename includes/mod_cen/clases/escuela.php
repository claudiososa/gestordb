<?php

include_once('conexion.php');
include_once("localidades.php");

class Escuela
{
	private $escuelaId;
 	private $referenteId;
 	private $cue;
 	private $numero;
 	private $nombre;
 	private $domicilio;
	private $nivel;
	private $localidadId;
 	private $turnos;
 	private $telefono;
	private $supervisorid;//Agregado por arredes en todos los metodos
	private $ubicacion;
	private $sitio;
	private $facebook;
	private $twitter;
	private $youtube;
	private $referenteIdPmi;
	private $referenteIdSuperSec;
	private $referenteIdSuperSup;

 	function __construct($escuelaId=NULL,
											$referenteId=NULL,
											$cue=NULL,
											$numero=NULL,
											$nombre=NULL,
											$domicilio=NULL,
											$nivel=NULL,
											$localidadId=NULL,
											$turnos=NULL,
											$telefono=NULL,
											$supervisorid=NULL,
											$ubicacion=NULL,
											$sitio=NULL,
											$facebook=NULL,
											$twitter=NULL,
											$youtube=NULL,
											$referenteIdPmi=NULL,
											$referenteIdSuperSec=NULL,
											$referenteIdSuperSup=NULL)
	{
			 //seteo los atributos
		 	$this->escuelaId = $escuelaId;
		 	$this->referenteId = $referenteId;
		 	$this->cue = $cue;
		 	$this->numero =$numero;
		 	$this->nombre =$nombre;
		 	$this->domicilio = $domicilio;
		 	$this->nivel = $nivel;
		 	$this->localidadId = $localidadId;
		 	$this->turnos = $turnos;
		 	$this->telefono = $telefono;
			$this->supervisor_id = $supervisorid;
			$this->ubicacion = $ubicacion;
			$this->sitio = $sitio;
			$this->facebook = $facebook;
			$this->twitter = $twitter;
			$this->youtube = $youtube;
			$this->referenteIdPmi = $referenteIdPmi;
			$this->referenteIdSuperSec = $referenteIdSuperSec;
			$this->referenteIdSuperSup = $referenteIdSuperSup;
	}

	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO escuelas (escuelaId,referenteId,cue,numero,nombre,domicilio,nivel,localidadId,turnos,telefono,supervisor,ubicacion,sitio,facebook,twitter,youtube)
		VALUES (NULL,'". $this->referenteId."','". $this->cue."','". $this->numero."','".$this->nombre."','". $this->domicilio."','". $this->nivel."','". $this->localidadId."','". $this->turnos."','".$this->telefono."','".$this->supervisor."','".$this->ubicacion."','".$this->sitio."','".$this->facebook."','".$this->twitter."','".$this->youtube."');";

		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function editar($tipo=NULL)
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		if($tipo=='soloBasico'){
			$sentencia="UPDATE escuelas
									SET nombre = '$this->nombre',
											domicilio = '$this->domicilio',
											localidadId = '$this->localidadId',
											telefono = '$this->telefono'
										WHERE escuelaId = '$this->escuelaId'";

		}else{
			$sentencia="UPDATE escuelas SET referenteId ='$this->referenteId',cue = '$this->cue', numero = '$this->numero', nombre = '$this->nombre',domicilio = '$this->domicilio', nivel = '$this->nivel', localidadId = '$this->localidadId', turnos = '$this->turnos', telefono = '$this->telefono' , ubicacion = '$this->ubicacion', sitio = '$this->sitio', facebook = '$this->facebook', twitter = '$this->twitter', youtube = '$this->youtube' WHERE escuelaId = '$this->escuelaId'";
		}

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function editarref($tipo=NULL)
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		if(isset($tipo)){

		switch ($tipo) {
			case 'pmi':
				$sentencia="UPDATE escuelas SET referenteIdPmi ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
				break;
			case 'supervisor':
					$sentencia="UPDATE escuelas SET referenteIdSuperSec ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
					break;
			case 'superior':
					$sentencia="UPDATE escuelas SET referenteIdSuperSup ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
					break;

			default:
				# code...
				break;
		}

		}else{
			$sentencia="UPDATE escuelas SET referenteId ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
		}

   //echo $sentencia;
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

		$sentencia="DELETE FROM escuelas WHERE escuelaId=".$this->escuelaId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function buscarRef($tipoReferente=NULL){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		if($tipoReferente=="ATT"){
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteIdPmi=$this->referenteIdPmi";
		}elseif($tipoReferente=="Supervisor-Secundaria"){
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteIdSuperSec=$this->referenteIdSuperSec";
		}elseif($tipoReferente=="Supervisor-Nivel-Superior"){
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteIdSuperSup=$this->referenteIdSuperSup";
		}else{
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteId=$this->referenteId";
		}


		return $conexion->query($sentencia);
	}

	public function buscarcue()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM escuelas WHERE cue=$this->cue";
		$resultado=$conexion->query($sentencia);
		$cant=mysqli_num_rows($resultado);
		//echo $cant;
		if($cant>0) {
			return 1;
		}else {
			return 0;
		}
	}

	public function buscarLocalidad(){

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT CONCAT (nombre,', ',departamentos.descripcion) AS Localidad FROM `localidades`
								JOIN departamentos
								ON departamento=departamentos.departamentoId
								WHERE localidadId=".$this->localidadId;
		//echo $sentencia;
		$resultado=$conexion->query($sentencia);
		$cant=mysqli_num_rows($resultado);
		//echo $cant;
		if($cant>0) {
			return $resultado=$conexion->query($sentencia);
		}else {
			return 0;
		}

	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM escuelas";
		$carga=0;
		$cargalocali=0;
		if($this->referenteId!=NULL || $this->cue!=NULL
			 || $this->numero!=NULL || $this->nombre!=NULL
			 || $this->domicilio!=NULL || $this->nivel!=NULL
			 || $this->localidadId!=NULL || $this->turnos!=NULL
			 || $this->escuelaId!=NULL || $this->referenteIdPmi!=NULL || $this->referenteIdSuperSec!=NULL || $this->referenteIdSuperSup!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId =$this->referenteId && ";
			$carga=1;
		}

		if($this->referenteIdPmi!=NULL)
		{
			$sentencia.=" referenteIdPmi =$this->referenteIdPmi && ";
			$carga=1;
		}

		if($this->referenteIdSuperSec!=NULL)
		{
			$sentencia.=" referenteIdSuperSec =$this->referenteIdSuperSec && ";
			$carga=1;
		}

		if($this->referenteIdSuperSup!=NULL)
		{
			$sentencia.=" referenteIdSuperSup =$this->referenteIdSuperSup && ";
			$carga=1;
		}

		if($this->cue!=NULL)
		{
			$sentencia.=" cue LIKE '%$this->cue%' && ";
			$carga=1;
		}

		if($this->numero!=NULL)
		{
			$sentencia.=" numero=$this->numero && ";
			$carga=1;
		}
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId=$this->escuelaId && ";
			$carga=1;
		}

		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre LIKE '%$this->nombre%' && ";
			$carga=1;
		}

		if($this->domicilio!=NULL)
		{
			$sentencia.=" domicilio LIKE '%$this->domicilio%' && ";
			$carga=1;
		}

		if($this->nivel!=NULL)
		{
			$sentencia.=" nivel='$this->nivel' && ";
			$carga=1;
		}

		if($this->turnos!=NULL)
		{
			$sentencia.=" turnos LIKE '%$this->turnos%' && ";
			$carga=1;
		}



		if($this->localidadId!=NULL)
		{
				if($this->localidadId>0)
					{
					$localidad= new Localidad(null,null,$this->localidadId);
					$resultado1=$localidad->buscar();
					$sentencia.="(";
					while($fila1=mysqli_fetch_object($resultado1))
						{
							$sentencia.=" localidadId=$fila1->localidadId || ";
			     		}

$sentencia=substr($sentencia,0,strlen($sentencia)-3);
			     		$sentencia.=")";
			     		$cargalocali=1;

				}else{

					$sentencia.=" localidadId > 0 && ";
					$carga=1;

				}

		}


		if($carga==1 && $cargalocali<>1) $sentencia=substr($sentencia,0,strlen($sentencia)-3);
		//$sentencia=substr($sentencia,0,strlen($sentencia)-3);


		}

		$sentencia.="  ORDER BY numero";

	//echo $sentencia."<br>";
		return $conexion->query($sentencia);

	}

	public function Cargo($tipoReferente=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		if($tipoReferente=="ATT"){
			$sentencia="SELECT * FROM escuelas WHERE referenteIdPmi=".$this->referenteIdPmi;
		}elseif($tipoReferente=="Supervisor-Secundaria"){
			$sentencia="SELECT * FROM escuelas WHERE referenteIdSuperSec=".$this->referenteIdSuperSec;
		}elseif($tipoReferente=="Supervisor-Nivel-Superior"){
			$sentencia="SELECT * FROM escuelas WHERE referenteIdSuperSup=".$this->referenteIdSuperSup;
		}else{
			$sentencia="SELECT * FROM escuelas WHERE referenteId=".$this->referenteId;
		}

		//echo $sentencia;
		//echo $this->referenteId;
		return $conexion->query($sentencia);
    }

   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM escuelas WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->escuelaId = $elemento->escuelaId;
	 	$this->referenteId = $elemento->referenteId;
	 	$this->cue = $elemento->cue;
	 	$this->numero = $elemento->numero;
	 	$this->nombre = $elemento->nombre;
	 	$this->domicilio = $elemento->domicilio;
	 	$this->nivel = $elemento->nivel;
	 	$this->localidadId = $elemento->localidadId;
	 	$this->turnos = $elemento->turnos;
	 	$this->telefono = $elemento->telefono;
	 	$this->ubicacion = $elemento->ubicacion;
	 	$this->sitio = $elemento->sitio;
	 	$this->facebook = $elemento->facebook;
	 	$this->twitter = $elemento->twitter;
	 	$this->youtube = $elemento->youtube;
		$this->referenteIdPmi = $elemento->referenteIdPmi;
		$this->referenteIdSuperSec = $elemento->referenteIdSuperSec;
		$this->referenteIdSuperSup = $elemento->referenteIdSuperSup;
		return $this;

    }

   public function getReferenteId()
   {
		return $this->referenteId;
	}

	public function getEscuelaId()
	{
	 return $this->escuelaId;
 }

	public function getCue()
   {
		return $this->cue;
	}

	public function getNumero()
   {
		return $this->numero;
	}
	public function getSupervisor_id()
   {
		return $this->supervisor_id;
	}

	public function getNombre()
   {
		return $this->nombre;
	}

	public function getDomicilio()
   {
		return $this->domicilio;
	}

	public function getNivel()
   {
		return $this->nivel;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function getLocalidadId()
   {
		return $this->localidadId;
	}

	public function getTurnos()
   {
		return $this->turnos;
	}

	public function getUbicacion()
	{
		return $this->ubicacion;
	}

	public function getFacebook()
	{
		return $this->facebook;
	}

	public function getTwitter()
	{
		return $this->twitter;
	}

	public function getYoutube()
	{
		return $this->youtube;
	}

	public function getSitio()
	{
		return $this->sitio;
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
	}elseif(isset($_POST['supervisor'])){
		$editar_escuela=$escuela->editarref("supervisor");
	}elseif(isset($_POST['superior'])){
		$editar_escuela=$escuela->editarref("superior");
	}else{
		$editar_escuela=$escuela->editarref();
	}


	//$editar_escuela=$escuela->editarref("pmi");

	if($editar_escuela==1){
		$borrar= 1;
	}


	if($borrar==1) {

		$estado=array("estado"=>$dato_persona->apellido.", ".$dato_persona->nombre,	"total"=>$dato_persona->apellido,);
	}
	echo json_encode($estado);
}
