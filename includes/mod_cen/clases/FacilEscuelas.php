<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class FacilEscuelas
{
	private $facilEscuelasId;
 	private $escuelaId;
 	private $referenteId;


function __construct($facilEscuelasId=NULL,
                          $escuelaId=NULL,
                          $referenteId=NULL)
	{
		$this->facilEscuelasId= $facilEscuelasId;
 		$this->escuelaId = $escuelaId;
 		$this->referenteId =$referenteId;
 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO facilEscuelas (facilEscuelasId,escuelaId,referenteId)
		VALUES (NULL,'". $this->escuelaId."','". $this->referenteId."');";
    //echo $sentencia;

		if ($conexion->query($sentencia)) {
			$orden="SELECT MAX(facilEscuelasId) AS id FROM facilEscuelas";

			$datoFila = mysqli_fetch_object($conexion->query($orden));
			return $datoFila->id;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	public function editar()
	{
	//	$fecha_a=date("Y-m-d H:i:s");
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="UPDATE facilEscuelas SET escuelaId = '$this->escuelaId',referenteId = '$this->referenteId'
                WHERE facilEscuelasId = '$this->facilEscuelasId'";
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

  public function Cargo($tipoReferente=NULL)
  {
    $nuevaConexion=new Conexion();
    $conexion=$nuevaConexion->getConexion();

    $sentencia="SELECT *
                FROM facilEscuelas
								INNER JOIN escuelas
								ON facilEscuelas.escuelaId=escuelas.escuelaId
                WHERE facilEscuelas.referenteId=".$this->referenteId;

    //echo $sentencia;
    //echo $this->referenteId;
    return $conexion->query($sentencia);
    }

	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	  $sentencia="SELECT facilEscuelas.escuelaId,facilEscuelas.referenteId,
												personas.nombre,personas.apellido,personas.telefonoM,personas.dni,
												personas.telefonoC,personas.email
								FROM facilEscuelas
								INNER JOIN referentes
								ON referentes.referenteId=facilEscuelas.referenteId
								INNER JOIN personas
								ON personas.personaId=referentes.personaId ";


		if($this->facilEscuelasId!=NULL || $this->escuelaId!=NULL || $this->referenteId!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->facilEscuelasId!=NULL)
		{
			$sentencia.=" facilEscuelasId = $this->facilEscuelasId && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId =$this->escuelaId  && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" facilEscuelas.referenteId=$this->referenteId && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY escuelaId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		return $conexion->query($sentencia);

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
