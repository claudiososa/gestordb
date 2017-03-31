<?php

include_once('conexion.php');
include_once('conexionPdo.php');

class ViceDirector
{
	private $vicedirectorId;
 	private $escuelaId;
 	private $personaId;
 	private $turno;
 	private $fechaModif;
	private $userModif;
	
 	
 	function __construct($vicedirectorId=NULL,$escuelaId=NULL,$personaId=NULL,$turno=NULL,$fechaModif=NULL,$userModif=NULL)
	{
			 //seteo los atributos
		 	
		 	$this->vicedirectorId = $vicedirectorId;
		 	$this->escuelaId = $escuelaId;
		 	$this->personaId = $personaId;
		 	$this->turno = $turno;
		 	$this->fechaModif = $fechaModif;
			$this->userModif = $userModif;

	}

	public function agregar()
	{

		$stmt = ConexionPdo::getConexion()->prepare("INSERT INTO vicedirector (vicedirectorId, escuelaId,personaId,turno,fechaModif,userModif)
			VALUES (null, :escuelaId, :personaId, :turno, :fechaModif, :userModif)");


			$stmt->bindParam(":escuelaId",$this->escuelaId,PDO::PARAM_INT);
			$stmt->bindParam(":personaId",$this->personaId,PDO::PARAM_INT);
			$stmt->bindParam(":turno",$this->turno);
			$stmt->bindParam(":fechaModif",$this->fechaModif);
			$stmt->bindParam(":userModif",$this->userModif,PDO::PARAM_INT);
			
		var_dump($stmt);
			if($stmt->execute()){
				return "vicedirector guardado con éxito!!";
			} else{
				return "Error al guardar";
			}


	}

public function editar()
	{

		$stmt = ConexionPdo::getConexion()->prepare("UPDATE vicedirector SET escuelaId = :escuelaId, personaId = :personaId, turno = :turno, fechaModif = :fechaModif, userModif = :userModif WHERE vicedirectorId = '$this->vicedirectorId'");


			$stmt->bindParam(":escuelaId",$this->escuelaId,PDO::PARAM_INT);
			$stmt->bindParam(":personaId",$this->personaId,PDO::PARAM_INT);
			$stmt->bindParam(":turno",$this->turno);
			$stmt->bindParam(":fechaModif",$this->fechaModif);
			$stmt->bindParam(":userModif",$this->userModif,PDO::PARAM_INT);


		var_dump($stmt);
		if($stmt->execute()){
			return " Actualización Exitosa.!!";
		} else{
			return "Error al actualizar";
		}


	}
	



/*

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM directores WHERE directorId=".$this->directorId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	*/
	
}


?>
