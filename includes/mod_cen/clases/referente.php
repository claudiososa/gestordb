<?php

include_once('conexion.php');
include_once('persona.php');


class Referente
{
	private $referenteId;
 	private $personaId;
 	private $tipo;
 	private $rol;
 	private $etjcargo;
 	private $fechaIngreso;
	private $titulo;
	private $estado;
	private $etjcargo2;

 	function __construct($referenteId=NULL,$personaId=NULL,$tipo=NULL,$rol=NULL,$etjcargo=NULL,$fechaIngreso=NULL,$titulo=NULL,$estado=NULL,$etjcargo2=NULL)
	{
			 //seteo los atributos
		 	$this->referenteId = $referenteId;
		 	$this->personaId = $personaId;
		 	$this->tipo = $tipo;
		 	$this->rol = $rol;
		 	$this->etjcargo = $etjcargo;
		 	$this->fechaIngreso = $fechaIngreso;
		 	$this->titulo = $titulo;
		 	$this->estado = $estado;
			$this->etjcargo2 = $etjcargo2;
	}

	public function agregar()
		{
			$stmt = ConexionPdo::getConexion()->prepare("INSERT INTO referentes (referenteId,personaId,tipo,rol,etjcargo,fechaIngreso,titulo,estado,etjcargo2)
			VALUES (null,:persona_id,:tipo,:rol,:etjcargo,:fechaingreso,:titulo,:estado,:etjcargo2)");

			//$stmt->bindParam(":referente_id",$this->referenteId);
			$stmt->bindParam(":persona_id",$this->personaId,PDO::PARAM_INT);
			$stmt->bindParam(":tipo",$this->tipo,PDO::PARAM_STR);
			$stmt->bindParam(":rol",$this->rol,PDO::PARAM_STR);
			$stmt->bindParam(":etjcargo",$this->etjcargo,PDO::PARAM_INT);
			$stmt->bindParam(":fechaingreso",$this->fechaIngreso);
			$stmt->bindParam(":titulo",$this->titulo,PDO::PARAM_STR);
			$stmt->bindParam(":estado",$this->estado,PDO::PARAM_STR);
			$stmt->bindParam(":etjcargo2",$this->etjcargo2,PDO::PARAM_INT);
	    //var_dump($stmt);
			if($stmt->execute()){
				return "Referente se guardo con éxito";
			} else{
				return "Error al guardar";
			}


		}

	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="UPDATE referentes SET
																	personaId = '$this->personaId',
																	tipo = '$this->tipo',
																	rol = '$this->rol',
																	etjcargo = '$this->etjcargo',
																	fechaIngreso = '$this->fechaIngreso',
																	titulo = '$this->titulo' ,
																	estado = '$this->estado',
																	etjcargo2 = '$this->etjcargo2'
																	WHERE referenteId = '$this->referenteId'";

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

		$sentencia="DELETE FROM referentes WHERE referenteId=".$this->referenteId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function buscarRef($tipo=NULL,$etj=NULL,$sup=NULL){
		
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		if(isset($tipo)<>null){
			$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId FROM referentes inner join personas on referentes.personaId=personas.personaId
			WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
		}elseif(isset($etj)<>null){
			$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido FROM referentes inner join personas on referentes.personaId=personas.personaId
			WHERE etjcargo=".$etj." AND estado='Activo' ORDER BY apellido ASC";		
		
		}elseif(isset($sup)<>null){
			$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido FROM referentes inner join personas on referentes.personaId=personas.personaId
			WHERE etjcargo2=".$sup." AND estado='Activo' ORDER BY apellido ASC";		

		}else{
			$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId
			WHERE (tipo='ETT' OR tipo='ETJ') AND estado='Activo' ORDER BY apellido ASC";
		}
	//	$sentencia="SELECT * FROM referentes WHERE (tipo='ETT' OR tipo='ETJ') AND estado='Activo'";
	///echo $sentencia;
		return $conexion->query($sentencia);
	}

	public function buscarTipoReferente($tipo)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		if(isset($tipo)){
					$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId,personas.email
											FROM referentes
											inner join personas
											on referentes.personaId=personas.personaId
											WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY personas.apellido ASC";
		return $conexion->query($sentencia);
		}
	}

	public function buscarRef2($tipo=NULL){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		if(isset($tipo)){
			switch ($tipo) {
				case 'ATT':
					$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
											FROM referentes
											inner join personas
											on referentes.personaId=personas.personaId
					WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
					break;
				case 'Supervisor-Secundaria':
						$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
												FROM referentes
												inner join personas
												on referentes.personaId=personas.personaId
						WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";

						break;
				case 'Supervisor-Nivel-Superior':
								$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
														FROM referentes
														inner join personas
														on referentes.personaId=personas.personaId
								WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";

								break;
					case 'SupervisorAdultos':
										$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
																FROM referentes
																inner join personas
																on referentes.personaId=personas.personaId
										WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";

										break;
					 case 'Facilitador':
															$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
																					FROM referentes
																					inner join personas
																					on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";

															break;
							case 'ETT':
							case 'ETJ':
															$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
																					FROM referentes
																					inner join personas
																					on referentes.personaId=personas.personaId
																					WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
				 																	break;
							case 'SNP':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;

							case 'SR':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;

							case 'SEP':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;

							case 'SH':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;

							case 'SI':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;

							case 'SP':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;

							case 'CAS':
							  							$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;
						  case 'AS':
															$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;
							case 'SSUP':
															$sentencia="SELECT referentes.referenteId, personas.nombre, personas.apellido,personas.personaId
															FROM referentes
															inner join personas
															on referentes.personaId=personas.personaId
															WHERE tipo='".$tipo."' AND estado='Activo' ORDER BY apellido ASC";
															break;



				default:
					# code...
					break;
			}
		}

		return $conexion->query($sentencia);
	}

	public function buscar($nombrePersona=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		if(isset($nombrePersona))
		{
			$sentencia="SELECT referentes.referenteId,personas.email, CONCAT(LOWER(personas.apellido),' ',LOWER(personas.nombre)) AS nombre ";
			//$$sentencia="SELECT referentes.referenteId, personas.nombre) ";
		}else{
			$sentencia="SELECT
												referentes.referenteId,referentes.personaId ,referentes.tipo ,referentes.rol ,referentes.etjcargo,
												referentes.fechaIngreso,referentes.titulo,referentes.estado,referentes.etjcargo2,personas.nombre,personas.apellido,personas.telefonoM,personas.telefonoC,personas.email,personas.fotoPerfil	";
		}

	 $sentencia.=" FROM referentes
							 JOIN personas
							 ON referentes.personaId=personas.personaId";
		if($this->referenteId!=NULL ||$this->personaId!=NULL ||$this->personaId!=NULL || $this->tipo!=NULL || $this->rol!=NULL || $this->etjcargo!=NULL || $this->fechaIngreso!=NULL || $this->titulo!=NULL || $this->estado!=NULL || $this->etjcargo2!=NULL )
		{
			$sentencia.=" WHERE ";

			if(isset($nombrePersona))
			{
				$sentencia.=" (personas.nombre LIKE '%$nombrePersona%' || personas.apellido LIKE '%$nombrePersona%') && ";
				//$sentencia.=" personas.nombre LIKE '%$nombrePersona%' && ";
			}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId=$this->referenteId && ";
		}

		if($this->personaId!=NULL)
		{
			$sentencia.=" referentes.personaId=$this->personaId && ";
		}

		if($this->tipo!=NULL)
		{
			$sentencia.=" tipo = '$this->tipo' && ";
		}

		if($this->rol!=NULL)
		{
			$sentencia.=" rol LIKE '%$this->rol%' && ";
		}

		if($this->etjcargo!=NULL)
		{
			$sentencia.=" etjcargo LIKE '%$this->etjcargo%' && ";
		}

		if($this->fechaIngreso!=NULL)
		{
			$sentencia.=" fechaIngreso LIKE '%$this->fechaIngreso%' && ";
		}

		if($this->titulo!=NULL)
		{
			$sentencia.=" titulo LIKE '%$this->titulo%' && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" referentes.estado = '$this->estado' && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY referentes.tipo";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}

	public function getTotal()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes WHERE tipo='ETT'";
		$resultado=$conexion->query($sentencia);
		return mysqli_num_rows($resultado);

	}

	public function Cargo2($estado=null,$referenteId)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE etjcargo=".$referenteId." AND estado='".$estado."'" ;
		$sentencia.=" ORDER BY personas.apellido DESC";
		return $conexion->query($sentencia);
		}


	public function Cargo($estado=null)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE etjcargo=".$this->referenteId." AND estado='".$estado."'" ;
		$sentencia.=" ORDER BY personas.apellido ASC";
		//echo $sentencia;
		return $conexion->query($sentencia);
    }

		public function CargoEtj2($estado=null)
		{
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();

			$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE etjcargo2=".$this->referenteId." AND estado='".$estado."'" ;
			$sentencia.=" ORDER BY personas.apellido ASC";
			//echo $sentencia;
			return $conexion->query($sentencia);
			}
			
			public function CargoEtj3($estado=null)
		{
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();

			$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE etjcargo3=".$this->referenteId." AND estado='".$estado."'" ;
			$sentencia.=" ORDER BY personas.apellido ASC";
			//echo $sentencia;
			return $conexion->query($sentencia);
	    }

		public function tipoReferente(){
 	 	$nuevaConexion=new Conexion();
  		$conexion=$nuevaConexion->getConexion();
  		$sentencia="SELECT DISTINCT tipo FROM referentes";
 		return $conexion->query($sentencia);
 	 }

    public function Tipo($tipo=mull,$estado=null)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE tipo='".$tipo."' AND estado='".$estado."'";
		//return $sentencia;
		return $conexion->query($sentencia);
    }

    public function DatoPersona()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE referenteId=".$this->referenteId;
		return $conexion->query($sentencia);
    }

		public function Persona($id)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId
		WHERE referenteId=".$id;
		return $conexion->query($sentencia);
    }

  public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes WHERE referenteId=".$this->referenteId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->referenteId = $elemento->referenteId;
	 	$this->personaId = $elemento->personaId;
	 	$this->tipo = $elemento->tipo;
	 	$this->rol = $elemento->rol;
	 	$this->etjcargo = $elemento->etjcargo;
	 	$this->fechaIngreso = $elemento->fechaIngreso;
	 	$this->titulo = $elemento->titulo;
	 	$this->estado = $elemento->estado;
		$this->etjcargo2 = $elemento->etjcargo2;
		//echo $sentencia;
		return $this;

    }


	public function getPersonaId()
	{
		return $this->personaId;
	}
	public function setReferenteId($referenteId)
	{
		$referenteId=$this->referenteId;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getReferenteId()
	{
		return $this->referenteId;
	}


	public function getNombre()
	{
		$persona = new Persona($this->personaId);
		$persona = $persona->getContacto();
		return $persona->getNombre();
	}

	public function getApellido()
	{
		$persona = new Persona($this->personaId);
		$persona = $persona->getContacto();
		return $persona->getApellido();
	}

	public function getTipo()
   {
		return $this->tipo;
	}

	public function getRol()
   {
		return $this->rol;
	}

	public function getEtj()
   {
		return $this->etjcargo;
	}

	public function getFechaIngreso()
   {
		return $this->fechaIngreso;
	}

	public function getTitulo()
   {
		return $this->titulo;
	}

	public function getEstado()
	{
		return $this->estado;
	}

}
?>
