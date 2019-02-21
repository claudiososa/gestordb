<?php
include_once('conexionv2.php');

class DocumentoEscuelaPermiso
{
	 private $id;
     private $id_category;
     private $id_tipoReferentes;
 	

    function __construct($id=NULL,$id_category=NULL,$id_tipoReferentes=NULL)
	{
		$this->id= $id;
        $this->id_category = $id_category;
        $this->id_tipoReferentes = $id_tipoReferentes;  		
 	}

	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO Documento_escuela_permiso (id,id_category,id_tipoReferentes)
									VALUES (NULL,$this->id_category,$this->id_tipoReferentes)";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoId=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE Documento_escuela_permiso 
                      SET id_category=$this->id_category, id_tipoReferentes=$this->id_tipoReferentes 
                      WHERE id=$this->id";
		
		if ($bd->ejecutar($sentencia)) {
			return $this->id;
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function eliminar(){
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM Documento_escuela_permiso WHERE id=$this->id";
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
			$sentencia="SELECT * FROM Documento_escuela_permiso";

			if($this->id!=NULL || $this->id_category!=NULL || $this->id_tipoReferentes!=NULL)
			{
				$sentencia.=" WHERE ";


			if($this->id!=NULL)
			{
				$sentencia.=" id = $this->id && ";
			}

			if($this->id_category!=NULL)
			{
				$sentencia.=" id_category = $this->id_category  && ";
            }
            
            if($this->id_tipoReferentes!=NULL)
			{
				$sentencia.=" id_tipoReferentes = $this->id_tipoReferentes  && ";
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
			$sentencia="SELECT * FROM Documento_escuela_permiso WHERE id=$this->id";
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