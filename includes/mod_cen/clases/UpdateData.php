<?php
include_once('conexionv2.php');

class UpdateData
{
	private $id;
 	private $table_name;
 	private $table_id;
	private $updated_date;
	private $referente_id;

function __construct($id=NULL,$table_name=NULL,$table_id=NULL,$updated_date=NULL,$referente_id=NULL)
	{
		$this->id= $id;
 		$this->table_name = $table_name;
 		$this->table_id =$table_id;
		$this->updated_date = $updated_date;
		$this->referente_id = $referente_id;
 	}


	public function agregar(){
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO UpdateData (id,table_name,table_id,updated_date,referente_id)
									VALUES (NULL,'".$this->table_name."',$this->table_id,'".$this->updated_date."',$this->referente_id)";
		if ($bd->ejecutar($sentencia)) {
			return $ultimotable_id=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}


	public function buscar($limit=NULL,$count=NULL)
	{
		// INNER JOIN escuelas
		// ON escuelatable_id.table = escuelas.table
		$bd=conexion2::getInstance();
	  $sentencia="SELECT * FROM UpdateData";

		if($this->id!=NULL || $this->table_name!=NULL || $this->table_id!=NULL || $this->updated_date!=NULL || $this->referente_id!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->id!=NULL)
		{
			$sentencia.=" id = $this->id && ";
		}

		if($this->table_name!=NULL)
		{
			$sentencia.=" table_name = '$this->table_name'  && ";
		}

		if($this->table_id!=NULL)
		{
			$sentencia.=" table_id = $this->table_id && ";
		}

		if($this->updated_date!=NULL)
		{
			$sentencia.=" updated_date = $this->updated_date && ";
		}

		if($this->referente_id!=NULL)
		{
			$sentencia.=" referente_id = $this->referente_id && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY id DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//return $sentencia;
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
