<?php
include_once('conexionv2.php');

class Conectividad
{
	private $id;
    private $escuela_id;
    private $conectividad_servicio_id;
    private $created_at; 
    private $referente_id;

    function __construct($id=NULL,$escuela_id=NULL,$conectividad_servicio_id=NULL,$created_at=NULL,$referente_id=NULL)
	{
		$this->id= $id;
        $this->escuela_id = $escuela_id; 		
        $this->conectividad_servicio_id = $conectividad_servicio_id;
        $this->created_at = $created_at; 		
        $this->referente_id = $referente_id; 		
 	}

	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO conectividad (id,escuela_id,conectividad_servicio_id,created_at,referente_id)
							 VALUES (NULL,$this->escuela_id,$this->conectividad_servicio_id,'$this->created_at',$this->referente_id)";		
		if ($bd->ejecutar($sentencia)) {
			return $ultimoId=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
        $bd=Conexion2::getInstance();
        
		$sentencia = "UPDATE conectividad SET 
                        escuela_id = $this->escuela_id, 
                        conectividad_servicio_id = $this->conectividad_servicio_id,
                        created_at = '$this->created_at',
                        referente_id = $this->referente_id
                        WHERE id=$this->id";
		
		if ($bd->ejecutar($sentencia)) {
			return $this->id;
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function eliminar(){
        $bd=Conexion2::getInstance();
        
		$sentencia = "DELETE FROM conectividad WHERE escuela_id = $this->escuela_id";
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
			$sentencia = "SELECT * FROM conectividad";

			if($this->id!=NULL || $this->escuela_id!=NULL || $this->conectividad_servicio_id!=NULL || $this->referente_id!=NULL)
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

            if($this->conectividad_servicio_id!=NULL)
			{
				$sentencia.=" conectividad_servicio_id = $this->conectividad_servicio_id  && ";
			}

		
            
            if($this->referente_id!=NULL)
			{
				$sentencia.=" referente_id = $this->referente_id  && ";
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
				//return mysqli_num_rows($bd->ejecutar($sentencia));# code...
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