<?php

include_once('conexion.php');
include_once('conexionv2.php');
include_once("maestro.php");

class Autoridades
{
	private $autoridadesId;
 	private $escuelaId;
 	private $tipoId;
 	private $personaId;
 	private $mañana;
 	private $intermedio;
 	private $tarde;
 	private $vespertino;
 	private $noche;
 	private $extendida;



function __construct($autoridadesId=NULL,$escuelaId=NULL,$tipoId=NULL,
	$personaId=NULL,$mañana=NULL,$intermedio=NULL,
	$tarde=NULL,$vespertino=NULL,$noche=NULL,$extendida=NULL)
	{
		$this->autoridadesId = $autoridadesId;
 		$this->escuelaId = $escuelaId;
 		$this->tipoId = $tipoId;
		$this->personaId = $personaId;
		$this->mañana = $mañana;
		$this->intermedio = $intermedio;
		$this->tarde = $tarde;
		$this->vespertino = $vespertino;
		$this->noche = $noche;
		$this->extendida = $extendida;


	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="INSERT INTO autoridades (autoridadesId,escuelaId,tipoId,personaId,mañana,intermedio,tarde,vespertino,noche,extendida)
		VALUES (NULL,'". $this->escuelaId."','". $this->tipoId."','". $this->personaId."','". $this->mañana."','". $this->intermedio."',
			'". $this->tarde."','". $this->vespertino."','". $this->noche."','". $this->extendida."');";



		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}



	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		//$sentencia="UPDATE autoridades SET  escuelaId ='$this->escuelaId', tipoId = '$this->tipoId',
		//personaId = '$this->personaId', mañana = '$this->mañana', intermedio = '$this->intermedio', tarde = '$this.tarde',
		//vespertino = '$this->vespertino', noche = '$this->noche', extendida = '$this->extendida'
		//WHERE autoridadesId = '$this->autoridadesId'";

		$sentencia="UPDATE autoridades SET  escuelaId =$this->escuelaId, tipoId = $this->tipoId,
		personaId = $this->personaId
		WHERE autoridadesId = $this->autoridadesId";


		//return $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;

		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	// eliminar

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM autoridades WHERE autoridadesId = '$this->autoridadesId'";
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}




	//eliminar




	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM autoridades WHERE autoridadesId=".$this->autoridadesId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);


 		$this->autoridadesId = $elemento->autoridadesId;
 		$this->escuelaId =$elemento->escuelaId;
		$this->tipoId =$elemento->tipoId;
		$this->personaId =$elemento->personaId;
		$this->mañana =$elemento->mañana;
		$this->intermedio =$elemento->intermedio;
		$this->tarde =$elemento->tarde;
		$this->vespertino =$elemento->vespertino;
		$this->noche =$elemento->noche;
		$this->extendida =$elemento->extendida;


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

	public function buscarAutoridad($tipo=NULL)
		{
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();

			$sentencia="SELECT autoridades.escuelaid,autoridades.tipoReferente,personas.personaId,
									personas.nombre,personas.apellido
			 						FROM autoridades
									INNER JOIN personas
									ON personas.personasId=autoridades.personaId
									INNER JOIN tipoAutoridades
									ON tipoAutoridades.tipoId=autoridades.tipoId
									WHERE tipoAutoridades.tipoReferente =$tipo";
			$sentencia.="  ORDER BY autoridades.autoridadesId ASC";
			//return $sentencia;
			return mysqli_fetch_object($conexion->query($sentencia));


			//return 'hola mundo';
		}

		public function buscarAutoridad3($tipo=null)
			{
				$bd=Conexion2::getInstance();

				if (isset($tipo)) {
					if ($tipo=='all') {
						$sentencia="SELECT *
												FROM autoridades
												INNER JOIN personas
												ON personas.personaId=autoridades.personaId
												INNER JOIN tipoAutoridades
												ON tipoAutoridades.tipoId=autoridades.tipoId
												WHERE escuelaId=".$this->escuelaId;
						$sentencia.="  ORDER BY autoridades.autoridadesId ASC";
					}

					return $bd->ejecutar($sentencia);
				}else{
					$sentencia="SELECT *
											FROM autoridades
											WHERE escuelaId=".$this->escuelaId." AND tipoId=".$this->tipoId;
					$sentencia.="  ORDER BY autoridades.autoridadesId ASC";
					$dato = mysqli_fetch_object($bd->ejecutar($sentencia));
					return $dato->personaId;
				}



				//if (mysqli_num_rows($bd->ejecutar($sentencia))>0) {
					//	return $ultimoRegistroId=$bd->lastID();
						//return '1';
					//return $ultimoRegistroId=$bd->lastID();
			 //}else{
					//	return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
			 //}


				//return 'hola mundo';
			}

		public function buscarAutoridad2()
			{
				$bd=Conexion2::getInstance();

				$sentencia="SELECT *
										FROM autoridades
										WHERE escuelaId=".$this->escuelaId." AND tipoId=".$this->tipoId;
				$sentencia.="  ORDER BY autoridades.autoridadesId ASC";


				$dato = mysqli_fetch_object($bd->ejecutar($sentencia));
				return $dato->autoridadesId;
				//if (mysqli_num_rows($bd->ejecutar($sentencia))>0) {
					//	return $ultimoRegistroId=$bd->lastID();
						//return '1';
	 				//return $ultimoRegistroId=$bd->lastID();
	 		 //}else{
	 				//	return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
	 		 //}


				//return 'hola mundo';
	}



	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM autoridades
								INNER JOIN tipoAutoridades
								ON tipoAutoridades.tipoId=autoridades.tipoId";

		if($this->autoridadesId!=NULL || $this->escuelaId!=NULL || $this->tipoId!=NULL || $this->personaId!=NULL

			|| $this->mañana!=NULL || $this->intermedio!=NULL || $this->tarde!=NULL || $this->vespertino!=NULL
			|| $this->noche!=NULL || $this->extendida!=NULL )
		{
			$sentencia.=" WHERE ";



		if($this->autoridadesId!=NULL)
		{
			$sentencia.=" autoridadesId = $this->autoridadesId && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId = $this->escuelaId && ";
		}

		if($this->tipoId!=NULL)
		{
			$sentencia.=" tipoId = $this->tipoId && ";
		}

		if($this->personaId!=NULL)
		{
			$sentencia.=" personaId = $this->personaId && ";
		}

		if($this->mañana!=NULL)
		{
			$sentencia.=" mañana = $this->mañana && ";
		}

		if($this->intermedio!=NULL)
		{
			$sentencia.=" intermedio = $this->intermedio && ";
		}

		if($this->tarde!=NULL)
		{
			$sentencia.=" tarde = $this->tarde && ";
		}

		if($this->vespertino!=NULL)
		{
			$sentencia.=" vespertino = $this->vespertino && ";
		}

		if($this->noche!=NULL)
		{
			$sentencia.=" noche = $this->noche && ";
		}

		if($this->extendida!=NULL)
		{
			$sentencia.=" extendida = $this->extendida && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY autoridadesId ASC";
		//if(isset($limit)){
			//$sentencia.=" LIMIT ".$limit;
		//}
		echo $sentencia;
		return $conexion->query($sentencia);

	}

// metodo existe

public function existe()
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT * FROM autoridades
		 						WHERE escuelaId=".$this->escuelaId." AND tipoId=".$this->tipoId;

		$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));
		if ($cantidad > 0) {
			 $id = mysqli_fetch_object($bd->ejecutar($sentencia));
			 $dato = $id->autoridadesId; 
			 return $dato;
		}else{
			return 0;
		}

	}


// fin metodo existe

// metodo existe2

public function existe2()
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT * FROM autoridades
		 						WHERE escuelaId=".$this->escuelaId." AND tipoId=".$this->tipoId;

		$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));
		if ($cantidad > 0) {
			 $id = mysqli_fetch_object($bd->ejecutar($sentencia));
			 $dato = $id->personaId; 
			 return $dato;
		}else{
			return 0;
		}

	}



// fin metodo existe2



	public function __get($var)
	{
		return $this->$var;

	}


	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}

}
