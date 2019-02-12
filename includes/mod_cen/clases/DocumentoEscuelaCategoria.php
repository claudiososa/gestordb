<?php
include_once('conexionv2.php');

class DocumentoEscuelaCategoria
{
	private $id;
 	private $description;
 	

    function __construct($id=NULL,$description=NULL)
	{
		$this->id= $id;
 		$this->description = $description; 		
 	}

	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO Documento_escuela_categoria (id,description)
									VALUES (NULL,'$this->description')";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoId=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE Documento_escuela_categoria SET description='$this->description' WHERE id=$this->id";
		
		if ($bd->ejecutar($sentencia)) {
			return $this->id;
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function eliminar(){
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM Documento_escuela_categoria WHERE id=$this->id";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoestado=$bd->lastID();
		}else{
	    	return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}
	
	public function buscar($limit=NULL,$count=NULL,$unico=NULL)
	{
		$bd=conexion2::getInstance();
		if (!isset($unico)) {
			$sentencia="SELECT * FROM Documento_escuela_categoria";

			if($this->id!=NULL || $this->description!=NULL)
			{
				$sentencia.=" WHERE ";


			if($this->id!=NULL)
			{
				$sentencia.=" id = $this->id && ";
			}

			if($this->description!=NULL)
			{
				$sentencia.=" description = $this->description  && ";
			}
			

			$sentencia=substr($sentencia,0,strlen($sentencia)-3);

			}

			$sentencia.="  ORDER BY id ASC";
			if(isset($limit)){
				$sentencia.=" LIMIT ".$limit;
			}
			//echo $sentencia;
			if (isset($count)) {
				return mysqli_num_rows($bd->ejecutar($sentencia));# code...
			}else{
				return $bd->ejecutar($sentencia);
			}
		} else {
			$sentencia="SELECT * FROM Documento_escuela_categoria WHERE id=$this->id";
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