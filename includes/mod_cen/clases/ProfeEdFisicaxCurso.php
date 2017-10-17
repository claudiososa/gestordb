<?php

include_once('conexion.php');
//include_once('persona.php');
//include_once('ProfeEdFisicaxEscuela')
//include_once('conexionv2.php');
//include_once('maestro.php');

class ProfeEdFisicaxCurso
   {
	private $id_Ed_FisicaxCurso;
	private $id_Ed_FisicaxEscuela;
	private $turno;
	private $nivel;
	private $horasSemanales;
 	private $tipoCargo;
 	private $gradoAño;
 	private $seccionDivision;


 	function __construct($id_Ed_FisicaxCurso=NULL,$id_Ed_FisicaxEscuela=NULL,$turno=NULL,$nivel=NULL,$horasSemanales=NULL,$tipoCargo=NULL,$gradoAño=NULL,$seccionDivision=NULL)
	{
			 //seteo los atributos
			$this->id_Ed_FisicaxCurso = $id_Ed_FisicaxCurso;
			$this->id_Ed_FisicaxEscuela = $id_Ed_FisicaxEscuela;
			$this->turno = $turno;
			$this->nivel = $nivel;
		 	$this->horasSemanales = $horasSemanales;
		 	$this->tipoCargo = $tipoCargo;
		 	$this->gradoAño = $gradoAño;
		 	$this->seccionDivision = $seccionDivision;
	}

	public function agregar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO  ProfeEdFisicaxCurso (id_Ed_FisicaxCurso,id_Ed_FisicaxEscuela,turno,nivel,horasSemanales,tipoCargo,gradoAño,seccionDivision)
		VALUES (NULL,'". $this->id_Ed_FisicaxEscuela."','". $this->turno."','".$this->nivel."','".$this->horasSemanales."','".$this->tipoCargo."','".$this->gradoAño."','".$this->seccionDivision."');";
    //echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}


   // buscar

public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM ProfeEdFisicaxCurso";
		if($this->id_Ed_FisicaxCurso!=NULL || $this->id_Ed_FisicaxEscuela!=NULL || $this->turno!=NULL || $this->nivel!=NULL || $this->horasSemanales!=NULL || $this->tipoCargo!=NULL || $this->gradoAño!=NULL || $this->seccionDivision!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->id_Ed_FisicaxCurso!=NULL)
		{
			$sentencia.=" id_Ed_FisicaxCurso=$this->id_Ed_FisicaxCurso && ";
		}

		if($this->id_Ed_FisicaxEscuela!=NULL)
		{
			$sentencia.=" id_Ed_FisicaxEscuela=$this->id_Ed_FisicaxEscuela && ";
		}


		if($this->turno!=NULL)
		{
			$sentencia.=" turno=$this->turno && ";
		}

		if($this->nivel!=NULL)
		{
			$sentencia.=" nivel=$this->nivel && ";
		}

		if($this->horasSemanales!=NULL )
		{
			$sentencia.=" horasSemanales=$this->horasSemanales && ";
		}


		if($this->tipoCargo!=NULL)
		{
			$sentencia.=" tipoCargo=$this->tipoCargo && ";
		}


		if($this->gradoAño!=NULL)
		{
			$sentencia.=" gradoAño=$this->gradoAño && ";
		}
		if($this->seccionDivision!=NULL)
		{
			$sentencia.=" seccionDivision=$this->seccionDivision && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY id_Ed_FisicaxCurso";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}


public function buscarCursos($escuelaID,$personaID)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();



		$sentencia= "SELECT ProfeEdFisicaxCurso.gradoAño, ProfeEdFisicaxCurso.seccionDivision, ProfeEdFisicaxCurso.turno, ProfeEdFisicaxCurso.nivel, ProfeEdFisicaxCurso.tipoCargo, ProfeEdFisicaxCurso.horasSemanales
                     FROM ProfeEdFisicaxCurso
                      JOIN ProfeEdFisicaxEscuela
                     	ON ( ProfeEdFisicaxCurso.id_Ed_FisicaxEscuela = ProfeEdFisicaxEscuela.id_Ed_FisicaxEscuela )
                         JOIN personas
                             ON ( personas.personaId = ProfeEdFisicaxEscuela.personaId )";





           if( $escuelaID!=NULL && $personaID!=NULL)
           {


					$sentencia.=" WHERE ProfeEdFisicaxEscuela.escuelaId = '".$escuelaID."'";
					$sentencia.=" AND personas.personaId = '".$personaID."'";

				//$sentencia=substr($sentencia,0,strlen($sentencia)-3);




			}

		$sentencia.="  ORDER BY gradoAño ASC";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}



} // fin de la CLASE


?>
