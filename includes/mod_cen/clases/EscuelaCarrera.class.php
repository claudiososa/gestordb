<?php
include_once('conexionv2.php');

class EscuelaCarrera
{
	private $id;
    private $escuelaId;
    private $carrera_id;
    private $fecha_inicio;
    private $fecha_final;
    private $estado;
 	

    function __construct($id=NULL,$escuelaId=NULL,$carrera_id=NULL,$fecha_inicio=NULL,$fecha_final=NULL,$estado=NULL)
	{
		$this->id= $id;
        $this->escuelaId = $escuelaId; 		
        $this->carrera_id = $carrera_id; 
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->estado = $estado; 
 	}

	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO escuelas_carrerass (id,escuelaId,carrera_id,fecha_inicio,fecha_final,estado)
							 VALUES (NULL,'$this->escuelaId','$this->carrera_id','$this->fecha_inicio','$this->fecha_final','$this->estado',)";		
		if ($bd->ejecutar($sentencia)) {
			return $ultimoId=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
        $bd=Conexion2::getInstance();
        
		$sentencia = "UPDATE escuelas_carreras SET escuelaId='$this->escuelaId', 
                                                 carrera_id='$this->carrera_id',
                                                 fecha_inicio='$this->fecha_inicio',
                                                 fecha_final='$this->fecha_final',
                                                 estado='$this->estado'
                      WHERE id=$this->id";
		
		if ($bd->ejecutar($sentencia)) {
			return $this->id;
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function eliminar(){
        $bd=Conexion2::getInstance();
        
		$sentencia = "DELETE FROM escuelas_carreras WHERE id=$this->id";
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
            $sentencia = "SELECT escuelas_carreras.id, carreras.nombre,
                        escuelas_carreras.escuelaId,
                        escuelas_carreras.fecha_inicio,
                        escuelas_carreras.fecha_final,
                        escuelas_carreras.estado
                        FROM escuelas_carreras
                        INNER JOIN carreras
                        ON carreras.id = escuelas_carreras.carrera_id";

			if($this->id!=NULL || $this->escuelaId!=NULL || $this->carrera_id!=NULL || $this->fecha_inicio!=NULL || $this->fecha_final!=NULL || $this->estado!=NULL)
			{
				$sentencia.=" WHERE ";


			if($this->id!=NULL)
			{
				$sentencia.=" id = $this->id && ";
			}

			if($this->escuelaId!=NULL)
			{
				$sentencia.=" escuelaId = $this->escuelaId  && ";
            }
            
            if($this->carrera_id!=NULL)
			{
				$sentencia.=" carrera_id = $this->carrera_id  && ";
            }
            
            if($this->fecha_inicio!=NULL)
			{
				$sentencia.=" fecha_inicio = '$this->fecha_inicio'  && ";
            }
            
            if($this->fecha_final!=NULL)
			{
				$sentencia.=" fecha_final = '$this->fecha_final'  && ";
            }
            
            if($this->estado!=NULL)
			{
				$sentencia.=" estado = '$this->estado'  && ";
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
			$sentencia="SELECT * FROM escuelas_carreras WHERE id=$this->id";
			
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