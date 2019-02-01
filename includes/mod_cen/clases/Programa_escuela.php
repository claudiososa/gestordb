<?php
include_once('conexionv2.php');

class Programa_escuela
{
	private $id;
 	private $escuela_id;
	private $programa_id;	
	private $estado;	

    function __construct($id=NULL,$escuela_id=NULL,$programa_id=NULL,$estado=NULL)
	{
		$this->id= $id;
 		$this->escuela_id = $escuela_id;
		$this->programa_id =$programa_id;
		$this->estado = $estado; 		
 	}


	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO programa_escuela (id,escuela_id,programa_id,estado)
									VALUES (NULL,$this->escuela_id,$this->programa_id,$this->estado)";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoprograma_id=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE programa_escuela SET escuela_id=$this->escuela_id,programa_id=$this->programa_id,estado =$this->estado WHERE id=$this->id";
		if ($bd->ejecutar($sentencia)) {
			return $this->id;
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function eliminar(){
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM programa_escuela WHERE id=$this->id";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoprograma_id=$bd->lastID();
		}else{
	    	return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function ultimoId(){
		$bd=conexion2::getInstance();
		$sentencia = 'SELECT * FROM programa_escuela ORDER BY id DESC LIMIT 1';
		//return $sentencia;
		return $bd->ejecutar($sentencia);
	}
	

	public function buscar($limit=NULL,$count=NULL)
	{
		$bd=conexion2::getInstance();
		$sentencia="SELECT escuelas.nombre,escuelas.escuelaId,escuelas.numero,escuelas.cue,programa_escuela.programa_id 
					FROM programa_escuela
					INNER JOIN escuelas
					ON escuelas.escuelaId = programa_escuela.escuela_id";

		if($this->id!=NULL || $this->escuela_id!=NULL || $this->programa_id!=NULL || $this->estado)
		{
			$sentencia.=" WHERE ";


		if($this->id!=NULL)
		{
			$sentencia.=" id = $this->id && ";
		}

		if($this->escuela_id!=NULL)
		{
			$sentencia.=" escuela_id = $this->escuela_id  && ";
		}

		if($this->programa_id!=NULL)
		{
			$sentencia.=" programa_id = $this->programa_id && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" estado = $this->estado && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY id DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		
		if (isset($count)) {
			return mysqli_num_rows($bd->ejecutar($sentencia));# code...
		}else{
			return $bd->ejecutar($sentencia);
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
