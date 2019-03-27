<?php
include_once('conexionv2.php');
//include_once("referente.php");
//include_once("maestro.php");

class MigracionServidores
{
		private $id;
    private $escuela_id;
    private $fecha_registracion;
    private $referente_id;
    private $observaciones;

function __construct($id=NULL,$escuela_id=NULL,$fecha_registracion=NULL,$referente_id=NULL,$observaciones=NULL
										 )
	{
		$this->id = $id;
 		$this->escuela_id = $escuela_id;
        $this->referente_id = $referente_id;
        $this->fecha_registracion = $fecha_registracion;
        $this->observaciones = $observaciones;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO escuela_migracion_servidores (id,escuela_id,fecha_registracion,referente_id,observaciones)
                    VALUES (NULL,$this->escuela_id,'$this->fecha_registracion',$this->referente_id,'$this->observaciones')";
        //return $sentencia;
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoProfesor=$bd->lastID();
		 }else{
				return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE escuela_migracion_servidores 
                      SET fecha_registracion ='$this->fecha_registracion',
                          referente_id = $this->referente_id,
                          observaciones = '$this->observaciones'
                      WHERE id = $this->id";
       // return $sentencia;
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

    public function buscar($tipo=null,$limit=null,$order=null)
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
								FROM escuela_migracion_servidores
								INNER JOIN escuelas
								ON escuelas.escuelaId = escuela_migracion_servidores.escuela_id
								WHERE 1";

        if($this->id!=NULL 
            || $this->escuela_id!=NULL 
            || $this->referente_id!=NULL
            || $this->fecha_registracion!=NULL
            || $this->observaciones!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->id!=NULL)
  		{
  			$sentencia.=" escuela_migracion_servidores.id = $this->id && ";
  		}

  		if($this->escuela_id!=NULL)
  		{
  			$sentencia.=" escuela_migracion_servidores.escuela_id = $this->escuela_id && ";
  		}

  		if($this->referente_id!=NULL)
  		{
  			$sentencia.=" escuela_migracion_servidores.referente_id=$this->referente_id && ";
        }
         
        if($this->fecha_registracion!=NULL)
  		{
  			$sentencia.=" escuela_migracion_servidores.fecha_registracion='$this->fecha_registracion' && ";
  		}

        if($this->observaciones!=NULL)
  		{
  			$sentencia.=" escuela_migracion_servidores.observaciones like '%$this->observaciones%' && ";
  		}

			$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else

		if (!isset($order)) {
			$sentencia.="  ORDER BY escuela_migracion_servidores.escuela_id ASC";
		}else{
			$sentencia.="  ORDER BY escuela_migracion_servidores.escuela_id ".$order;
		}

		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
	
		if (isset($tipo)) {
			switch ($tipo) {
				case 'unico':
					$unico = mysqli_fetch_object($bd->ejecutar($sentencia));
					return $unico;
					break;
				case 'total':
							return $bd->ejecutar($sentencia);
						break;
                case 'cantidad':
                              
								$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));
								return $cantidad;
								break;
				default:
					# code...
					break;
			}
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

