<?php
include_once('conexionv2.php');

class Carreras
{
	private $id;
 	private $nombre;
 	

    function __construct($id=NULL,$nombre=NULL)
	{
		$this->id= $id;
 		$this->nombre = $nombre; 		
 	}

	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO carreras (id,nombre)
							 VALUES (NULL,'$this->nombre')";		
		if ($bd->ejecutar($sentencia)) {
			return $ultimoId=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
        $bd=Conexion2::getInstance();
        
		$sentencia = "UPDATE carreras SET nombre='$this->nombre' WHERE id=$this->id";
		
		if ($bd->ejecutar($sentencia)) {
			return $this->id;
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function eliminar(){
        $bd=Conexion2::getInstance();
        
		$sentencia = "DELETE FROM carreras WHERE id=$this->id";
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
			$sentencia = "SELECT * FROM carreras";

			if($this->id!=NULL || $this->nombre!=NULL)
			{
				$sentencia.=" WHERE ";


			if($this->id!=NULL)
			{
				$sentencia.=" id = $this->id && ";
			}

			if($this->nombre!=NULL)
			{
				$sentencia.=" nombre like '%$this->nombre%'  && ";
			}
			

			$sentencia=substr($sentencia,0,strlen($sentencia)-3);

			}

			$sentencia.="  ORDER BY id ASC";
			if(isset($limit)){
				$sentencia.=" LIMIT ".$limit;
			}
			//return $sentencia;
			if (isset($count)) {
				return mysqli_num_rows($bd->ejecutar($sentencia));# code...
			}else{
				return $bd->ejecutar($sentencia);
			}
		} else {
			$sentencia="SELECT * FROM carreras WHERE id=$this->id";
			
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