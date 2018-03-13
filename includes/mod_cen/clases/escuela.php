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
	private $referenteIdSuperAdultos;
	private $referenteIdFacilitador;
	private $email;

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
											$referenteIdSuperSup=NULL,
											$referenteIdSuperAdultos=NULL,
											$referenteIdFacilitador=NULL,
											$email=NULL)
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
			$this->email = $email;
			$this->supervisor_id = $supervisorid;
			$this->ubicacion = $ubicacion;
			$this->sitio = $sitio;
			$this->facebook = $facebook;
			$this->twitter = $twitter;
			$this->youtube = $youtube;
			$this->referenteIdPmi = $referenteIdPmi;
			$this->referenteIdSuperSec = $referenteIdSuperSec;
			$this->referenteIdSuperSup = $referenteIdSuperSup;
			$this->referenteIdSuperAdultos = $referenteIdSuperAdultos;
			$this->referenteIdSuperAdultos = $referenteIdFacilitador;
	}

	public static function estructura($campo,$tabla){
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

	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO escuelas (escuelaId,referenteId,cue,numero,nombre,domicilio,nivel,localidadId,turnos,telefono,email,supervisor_id,ubicacion,sitio,facebook,twitter,youtube,referenteIdPmi,referenteIdSuperSec,referenteIdSuperSup,referenteIdSuperAdultos,referenteIdFacilitador)
		VALUES (NULL,'". $this->referenteId."','". $this->cue."','". $this->numero."','".$this->nombre."','". $this->domicilio."','". $this->nivel."','". $this->localidadId."','". $this->turnos."','".$this->telefono."','".$this->email."','".$this->supervisor."','".$this->ubicacion."','".$this->sitio."','".$this->facebook."','".$this->twitter."','".$this->youtube."','".$this->referenteIdPmi."','".$this->referenteIdSuperSec."','".$this->referenteIdSuperSup."','".$this->referenteIdSuperAdultos."','".$this->referenteIdFacilitador."');";

		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			//header("Location:index.php?id=1");
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}


   /*
	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia =" INSERT INTO escuelas (escuelaId,referenteId,cue,numero,nombre,domicilio,nivel,localidadId,turnos,telefono,supervisor_id,ubicacion,sitio,facebook,twitter,youtube,referenteIdPmi,referenteIdSuperSec,referenteIdSuperSup)
		VALUES (NULL,'". $this->referenteId."','". $this->cue."','". $this->numero."','".$this->nombre."','". $this->domicilio."','". $this->nivel."','". $this->localidadId."','". $this->turnos."','".$this->telefono."','".$this->supervisor_id"','".$this->ubicacion."','".$this->sitio."','".$this->facebook."','".$this->twitter."','".$this->youtube."','".$this->referenteIdPmi."','".$this->referenteIdSuperSec."','".$this->referenteIdSuperSup."');";

		if ($conexion->query($sentencia)) {

			return 1;
			//header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	} */

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
			$sentencia="UPDATE escuelas SET referenteId ='$this->referenteId',
																										cue = '$this->cue',
																										numero = '$this->numero',
																										nombre = '$this->nombre',
																										domicilio = '$this->domicilio',
																										nivel = '$this->nivel',
																										localidadId = '$this->localidadId',
																										turnos = '$this->turnos',
																										telefono = '$this->telefono',
																										ubicacion = '$this->ubicacion',
																										sitio = '$this->sitio',
																										facebook = '$this->facebook',
																										twitter = '$this->twitter',
																										youtube = '$this->youtube',
																										email = '$this->email'
																										WHERE escuelaId = '$this->escuelaId'";
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
			case 'adultos':
							$sentencia="UPDATE escuelas SET referenteIdSuperAdultos ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
							break;
			case 'facilitador':
							$sentencia="UPDATE escuelas SET referenteIdFacilitador ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
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
		}elseif($tipoReferente=="Facilitador"){
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteIdFacilitador=$this->referenteIdFacilitador";
		}elseif($tipoReferente=="Supervisor-Nivel-Superior"){
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteIdSuperSup=$this->referenteIdSuperSup";
		}elseif($tipoReferente=="SupervisorAdultos"){
			$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteIdSuperAdultos=$this->referenteIdSuperAdultos";
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

	public function buscarUnico(){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$smt="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId";
		//echo $stm;
		if($conexion->query($smt)){
			//return 'encontrado';
			return mysqli_fetch_object($conexion->query($smt));
		}else{
			return 'error';
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
			 || $this->escuelaId!=NULL || $this->referenteIdPmi!=NULL ||
			  $this->referenteIdSuperSec!=NULL || $this->referenteIdSuperSup!=NULL || $this->referenteIdSuperAdultos!=NULL || $this->referenteIdFacilitador!=NULL)
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

		if($this->referenteIdSuperAdultos!=NULL)
		{
			$sentencia.=" referenteIdSuperAdultos =$this->referenteIdSuperAdultos && ";
			$carga=1;
		}

		if($this->referenteIdFacilitador!=NULL)
		{
			$sentencia.=" referenteIdFacilitador =$this->referenteIdFacilitador && ";
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
		}elseif($tipoReferente=="SupervisorAdultos"){
			$sentencia="SELECT * FROM escuelas WHERE referenteIdSuperAdultos=".$this->referenteIdSuperAdultos;
		}elseif($tipoReferente=="Facilitador"){
			$sentencia="SELECT * FROM escuelas WHERE referenteIdFacilitador=".$this->referenteIdFacilitador;
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
		$this->email = $elemento->email;
	 	$this->ubicacion = $elemento->ubicacion;
	 	$this->sitio = $elemento->sitio;
	 	$this->facebook = $elemento->facebook;
	 	$this->twitter = $elemento->twitter;
	 	$this->youtube = $elemento->youtube;
		$this->referenteIdPmi = $elemento->referenteIdPmi;
		$this->referenteIdSuperSec = $elemento->referenteIdSuperSec;
		$this->referenteIdSuperAdultos = $elemento->referenteIdSuperAdultos;
		$this->referenteIdFacilitador = $elemento->referenteIdFacilitador;

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
	public function getEmail()
	{
		return $this->email;
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
	include_once('EscuelaReferentes.php');
	include_once('Autoridades.php');
	$referente=new Referente($_POST["referente_id"]);
	$buscar_referente=$referente->buscar();
	$dato_referente=mysqli_fetch_object($buscar_referente);
	//****************************************************************************

	// crea persona y busca persona de acuerdo a personaId obtenido del objeto $dato_referente
	$persona=new Persona($dato_referente->personaId);

	$buscar_persona=$persona->buscar();
	$dato_persona=mysqli_fetch_object($buscar_persona);
	//********************************************************************************

	if(isset($_POST['tipo'])){
		$escuelaReferentes = new EscuelaReferentes(null,$_POST["escuela_id"],$_POST['tipo'],$_POST["referente_id"]);
		// buscamos el referente en la tabla escuela referente
		$buscarReferente = $escuelaReferentes->existe();
		if ($buscarReferente==0) {
			$escuelaReferentes->agregar();
		}else{
			$escuelaReferentes->escuelaReferentesId = $buscarReferente;
			$editar_escuela= $escuelaReferentes->editar();
		}

		// buscamos el referente  en la tabla autoridades para cargar o actualizar

		switch ($_POST['tipo']) {
			case '19': // si es ETT

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],30,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{

					      if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					    }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }


					}

				break;
			case '20': // si es ETJ

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],31,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{

						  if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					    }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }
						}

				break;
			case '4': // si es SNP

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],4,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{
 							if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					         }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }
						}

				break;

				case '5': // si es SEP

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],5,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{
 							if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					         }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }
						}

				break;

				case '6': // si es SI

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],6,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{
 							if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					         }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }
						}

				break;

				case '7': // si es S Hospitalaria

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],7,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{
 							if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					         }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }
						}

				break;

				case '12': // si es Sup. Religion

				$autoridadEscolar = new Autoridades(null,$_POST["escuela_id"],12,$dato_persona->personaId);
		        $buscarAutoridad = $autoridadEscolar->existe();

					if ($buscarAutoridad==0)
					{
							$autoridadEscolar->agregar();

					}else{
 							if ($dato_persona->personaId == 1) { // esta sin asignar entonces borramos

						        $autoridadEscolar->autoridadesId=$buscarAutoridad;
					    		$borrar_autoridad=$autoridadEscolar->eliminar();


					         }else{ // tiene referente asignado entonces editamos

					    	   $autoridadEscolar->autoridadesId=$buscarAutoridad;
							   $editar_autoridad=$autoridadEscolar->editar();
					         }
						}

				break;


			default:
				# code...
				break;
		}

		// fin de carga de referente en tabla autoridades


	}else{
		$escuela=new Escuela($_POST["escuela_id"],$_POST["referente_id"]);
			//busca escueala de acuerdo a escuelaId enviado por post y actualiza el referenteId acargo del colegio
			if(isset($_POST['pmi'])){
				$editar_escuela=$escuela->editarref("pmi");
			}elseif(isset($_POST['supervisor'])){
				$editar_escuela=$escuela->editarref("supervisor");
			}elseif(isset($_POST['facilitador'])){
				$editar_escuela=$escuela->editarref("facilitador");
			}elseif(isset($_POST['superior'])){
				$editar_escuela=$escuela->editarref("superior");
			}elseif(isset($_POST['adultos'])){
				$editar_escuela=$escuela->editarref("adultos");
			}else{
				$editar_escuela=$escuela->editarref();
			}
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
if(isset($_POST["escuelaId"]))
{
	include_once ('FacilEscuelas.php');
	include_once ('rti.php');

	$facilitador = new FacilEscuelas(null,$_POST["escuelaId"]);
	$buscarFacil= $facilitador->buscar();
	$datoFacil =  mysqli_num_rows($buscarFacil);
	//echo $datoFacil;

	//$dato_rti= new Rtixinstitucion(null,$_POST["escuelaId"]);
	$buscarRti= Rti::existeRtixinstitucion($_POST["escuelaId"]);
	$cantidadRti=mysqli_num_rows($buscarRti);

	if ($cantidadRti > 0) {
		echo '<option value="referentes&id=8">Ver Rti</option>';
	}

	if ($datoFacil > 0) {
		echo '<option value="referentes&id=11">Ver Facilitadores</option>';
}/*if ($rti > 0) {
	echo '<option value="referentes&id=8">Ver RTI</option>';
}*/

//<option value="referentes&id=8">Ver RTI</option>

}
