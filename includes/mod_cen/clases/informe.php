<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/TipoInforme.php");
include_once("includes/mod_cen/clases/TipoPermisos.php");
include_once("includes/mod_cen/clases/maestro.php");
//include_once("referente.php");
class informe
{
	private $informeId;
 	private $escuelaId;
 	private $referenteId;
	private $prioridad;
 	private $tipo;
 	private $titulo;
 	private $contenido;
	private $leido;
	private $estado;
 	private $fechaVisita;
 	private $fechaCarga;
 	private $fechaModificado;
	private $nuevoTipo;
	private $subTipo;



function __construct($informeId=NULL,$escuelaId=NULL,$referenteId=NULL,$prioridad=NULL,
	$tipo=NULL,	$titulo=NULL, $contenido=NULL, $leido=NULL, $estado=NULL,
	$fechaVisita=NULL,	$fechaCarga=NULL,
	$fechaModificado=NULL,$nuevoTipo=NULL,$subTipo=NULL)
	{
		$this->informeId = $informeId;
 		$this->escuelaId = $escuelaId;
 		$this->referenteId =$referenteId;
		$this->prioridad = $prioridad;
 		$this->tipo =$tipo;
 		$this->titulo =$titulo;
 		$this->contenido =$contenido;
		$this->leido = $leido;
	  $this->estado = $estado;
 		$this->fechaVisita = $fechaVisita;
 		$this->fechaCarga = $fechaCarga;
 		$this->fechaModificado = $fechaModificado;
		$this->nuevoTipo = $nuevoTipo;
		$this->subTipo = $subTipo;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO informes (informeId,escuelaId,referenteId,prioridad,tipo,titulo,contenido,leido,estado,fechaVisita,fechaCarga,fechaModificado,nuevotipo,subtipo)
		VALUES (NULL,'". $this->escuelaId."','". $this->referenteId."','".$this->prioridad."',
		'".$this->tipo."','".$this->titulo."','". $this->contenido."','". $this->leido."',
		'". $this->estado."','". $this->fechaVisita."','". $this->fechaCarga."',
		'". $this->fechaModificado."','". $this->nuevoTipo."','". $this->subTipo."');";

		//echo $sentencia;

		if ($conexion->query($sentencia)) {
			$informeId=$conexion->insert_id;
			//printf ("Nuevo registro con el id %d.\n", $conexion->insert_id);
			/*$sentencia="INSERT INTO img (imgId,informeId,nombre,formato)
			VALUES (NULL,$informeId,$nombre,'jpg');
			if ($conexion->query($sentencia)) {
			echo 'se guardo todo completo'
		}*/

			return $informeId;
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
		$sentencia="UPDATE informes SET prioridad = '$this->prioridad',tipo = '$this->tipo'
		,titulo = '$this->titulo', contenido = '$this->contenido',
		fechaVisita = '$this->fechaVisita'
		,fechaModificado = '$this->fechaModificado' WHERE informeId = '$this->informeId'";

			//	$sentencia="UPDATE informes SET prioridad = '$this->prioridad',tipo = '$this->tipo'
				//,titulo = '$this->titulo', contenido = '$this->contenido', WHERE informeId = '$this->informeId'";
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM informes WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->informeId = $elemento->informeId;
 		$this->escuelaId = $elemento->escuelaId;
 		$this->referenteId =$elemento->referenteId;
		$this->prioridad =$elemento->prioridad;
 		$this->tipo =$elemento->tipo;
 		$this->titulo =$elemento->titulo;
 		$this->contenido =$elemento->contenido;
		$this->leido =$elemento->leido;
		$this->estado =$elemento->estado;
 		$this->fechaVisita = $elemento->fechaVisita;
 		$this->fechaCarga = $elemento->fechaCarga;
 		$this->fechaModificado = $elemento->fechaModificado;
		$this->nuevoTipo = $elemento->nuevoTipo;
		$this->subTipo = $elemento->subTipo;
		return $this;

    }

    public static function camposet($campo,$tabla){
    	$nuevaConexion=new Conexion();
    	$conexion=$nuevaConexion->getConexion();
    	$sentencia="SHOW COLUMNS FROM $tabla LIKE '$campo'";
    	$query=$conexion->query($sentencia);
    	$result = mysqli_fetch_assoc($query);
    	$result=$result['Type'];
    	$result=substr($result, 5, strlen($result)-5);
    	$result=substr($result, 0, strlen($result)-2);
    	$result = explode("','",$result);
    	return $result;
    }

    public function estructura($campo){
    	$nuevaConexion=new Conexion();
    	$conexion=$nuevaConexion->getConexion();
    	$sentencia="SHOW COLUMNS FROM encuentros LIKE '$campo'";
    	$query=$conexion->query($sentencia);
    	$result = mysqli_fetch_assoc($query);
    	$result=$result['Type'];
    	$result=substr($result, 5, strlen($result)-5);
    	$result=substr($result, 0, strlen($result)-2);
    	$result = explode("','",$result);
    	return $result;
    }

	public function summary($condicion=NULL,$filtro=NULL,$fecha1=NULL,$fecha2=NULL,$mes1=NULL,$año1=NULL,$prioridad=NULL,$referenteId=NULL,$tipo=NULL){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		switch ($condicion) {

			case 'entreFechas':
				if(isset($fecha1)<>NULL && isset($fecha2)<>NULL){
					$sentencia="SELECT ".$filtro." * "."FROM informes WHERE fechaCarga "." BETWEEN '".$fecha1."' AND '".$fecha2."'";
				}else{
					$sentencia="SELECT ".$filtro." * "."FROM informes";
				}
				break;

			case 'mesAñoReferente':
				$sentencia="SELECT ".$filtro." *, DAY(fechaVisita) AS dia FROM informes WHERE MONTH(fechaVisita) = '".$mes1."' AND YEAR(fechaVisita) ='".$año1."' AND referenteId=".$referenteId." ORDER BY escuelaId";
				break;

			case 'mesAño':
				$sentencia="SELECT ".$filtro." * "."FROM informes WHERE MONTH(fechaCarga) = ".$mes1." AND YEAR(fechaCarga) =".$año1;
				break;

			case 'añoPrioridad':
					$sentencia="SELECT ".$filtro." * "."FROM informes WHERE YEAR(fechaCarga) =".$año1." AND prioridad='".$prioridad."'";
					break;


			case 'mesAñoPrioridad':
				$sentencia="SELECT ".$filtro." * "."FROM informes WHERE MONTH(fechaCarga) = ".$mes1." AND YEAR(fechaCarga) =".$año1." AND prioridad='".$prioridad."'";
					break;

			case 'año':
					$sentencia="SELECT ".$filtro." * "."FROM informes WHERE  YEAR(fechaCarga) =".$año1;
					break;

			default:
				# code...
				break;
		}

//echo $sentencia."<br>";
		return $conexion->query($sentencia);
	}

	public function buscarSupervisorSec()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sinParam=0;

		$sentencia="SELECT informes.informeId,informes.escuelaId,informes.referenteId,informes.prioridad,informes.tipo,informes.titulo,informes.contenido
									,informes.leido,informes.estado,informes.fechaVisita,informes.fechaCarga,informes.fechaModificado,informes.nuevotipo,
									informes.subtipo,escuelas.numero,referentes.personaId,personas.nombre,personas.apellido
									FROM informes
									JOIN escuelas
									ON (informes.escuelaId=escuelas.escuelaId)
									JOIN referentes
									ON referentes.referenteId=informes.referenteId
									JOIN personas
									ON personas.personaId=referentes.personaId
									WHERE (informes.nuevotipo=8 || informes.nuevotipo=9) AND ";


		if($this->informeId!=NULL || $this->escuelaId!=NULL || $this->prioridad!=NULL || $this->leido!=NULL
		|| $this->estado!=NULL || $this->tipo!=NULL || $this->referenteId!=NULL
		|| $this->fechaVisita!=NULL || $this->contenido!=NULL || $this->nuevoTipo!=NULL || $this->subTipo!=NULL)
		{
			$sentencia.="  ";


		if($this->informeId!=NULL)
		{
			$sentencia.=" informes.informeId = $this->informeId && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" informes.escuelaId = $this->escuelaId && ";
		}

		if($this->tipo!=NULL)
		{
			$sentencia.=" informes.tipo=$this->tipo && ";
		}

		if($this->nuevoTipo!=NULL)
		{
			$sentencia.=" informes.nuevotipo=$this->nuevoTipo && ";
		}

		if($this->subTipo!=NULL)
		{
			$sentencia.=" informes.subtipo=$this->subTipo && ";
		}

		if($this->prioridad!=NULL)
		{
			$sentencia.=" informes.prioridad = '$this->prioridad' && ";
		}

		if($this->leido!=NULL)
		{
			$sentencia.=" informes.leido=$this->leido && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" informes.estado=$this->estado && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" informes.referenteId='$this->referenteId' && ";
		}

		if($this->fechaVisita!=NULL)
		{
			$sentencia.=" informes.fechaVisita='$this->fechaVisita' && ";
		}

		if($this->contenido!=NULL)
		{
			$sentencia.=" informes.contenido=$this->contenido && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		if ($sinParam==1) {
		$sentencia.=' )';

		}

		}

		  // fin else

		$sentencia.="  ORDER BY informes.informeId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		return $conexion->query($sentencia);

	}

	public function buscarSupervisorSuperior()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sinParam=0;

		$sentencia="SELECT informes.informeId,informes.escuelaId,informes.referenteId,informes.prioridad,informes.tipo,informes.titulo,informes.contenido
									,informes.leido,informes.estado,informes.fechaVisita,informes.fechaCarga,informes.fechaModificado,informes.nuevotipo,
									informes.subtipo,escuelas.numero,referentes.personaId,personas.nombre,personas.apellido
									FROM informes
									JOIN escuelas
									ON (informes.escuelaId=escuelas.escuelaId)
									JOIN referentes
									ON referentes.referenteId=informes.referenteId
									JOIN personas
									ON personas.personaId=referentes.personaId
									WHERE (informes.nuevotipo=3 || informes.nuevotipo=4) AND ";


		if($this->informeId!=NULL || $this->escuelaId!=NULL || $this->prioridad!=NULL || $this->leido!=NULL
		|| $this->estado!=NULL || $this->tipo!=NULL || $this->referenteId!=NULL
		|| $this->fechaVisita!=NULL || $this->contenido!=NULL || $this->nuevoTipo!=NULL || $this->subTipo!=NULL)
		{
			$sentencia.="  ";


		if($this->informeId!=NULL)
		{
			$sentencia.=" informes.informeId = $this->informeId && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" informes.escuelaId = $this->escuelaId && ";
		}

		if($this->tipo!=NULL)
		{
			$sentencia.=" informes.tipo=$this->tipo && ";
		}

		if($this->nuevoTipo!=NULL)
		{
			$sentencia.=" informes.nuevotipo=$this->nuevoTipo && ";
		}

		if($this->subTipo!=NULL)
		{
			$sentencia.=" informes.subtipo=$this->subTipo && ";
		}

		if($this->prioridad!=NULL)
		{
			$sentencia.=" informes.prioridad = '$this->prioridad' && ";
		}

		if($this->leido!=NULL)
		{
			$sentencia.=" informes.leido=$this->leido && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" informes.estado=$this->estado && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" informes.referenteId='$this->referenteId' && ";
		}

		if($this->fechaVisita!=NULL)
		{
			$sentencia.=" informes.fechaVisita='$this->fechaVisita' && ";
		}

		if($this->contenido!=NULL)
		{
			$sentencia.=" informes.contenido=$this->contenido && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		if ($sinParam==1) {
		$sentencia.=' )';

		}

		}

			// fin else

		$sentencia.="  ORDER BY informes.informeId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		return $conexion->query($sentencia);

	}






public function buscar($limit=NULL,$tiporeferente=NULL,$listaRefer=NULL,$tipoConsulta=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		/**
		 * busca las categorias de tipo exclusivas "si"
		 *
		 */
		$objTipo = new TipoInforme();
		$objTipo->exclusiva='si';
		$buscarTipo=$objTipo->buscar();

		$sinParam=0;

		$sentencia="SELECT informes.informeId,informes.escuelaId,informes.referenteId,informes.prioridad,informes.tipo,informes.titulo,informes.contenido
									,informes.leido,informes.estado,informes.fechaVisita,informes.fechaCarga,informes.fechaModificado,informes.nuevotipo,
									informes.subtipo,escuelas.numero,referentes.personaId,referentes.tipo,personas.nombre,personas.apellido
									FROM informes
									JOIN escuelas ";

									if (isset($tipoConsulta ))
									{

									      $sentencia.="ON (informes.escuelaId=escuelas.escuelaId AND escuelas.referenteId = '".$_SESSION["referenteId"]."')";
									}
									else{

										$sentencia.="ON (informes.escuelaId=escuelas.escuelaId)";

									    }


									$sentencia.=" JOIN referentes
									ON referentes.referenteId=informes.referenteId
									JOIN personas
									ON personas.personaId=referentes.personaId ";
									$sentencia.=" WHERE ";
									$cantExclusiva=0;
									$encontrado=0;
									if(!isset($tiporeferente) || !isset($listaRefer ) || isset($tipoConsulta )){ //si el metodo no se llamada con los parametros tipode referente y listaRef entonces verifica los permisos
										while ($fila = mysqli_fetch_object($buscarTipo)) { //recorre las categorias exclusivas
												$objTipoPermiso = new TipoPermisos(null,$fila->tipoInformeId);
												$buscarTipoPermiso=$objTipoPermiso->buscar();

												while ($row = mysqli_fetch_object($buscarTipoPermiso)) { //recorre los permisos para la categoria exclusiva

													if ($_SESSION['tipo']==$row->tipoReferente) { //si el usuario logueado es igual al tipo de referente que tiene permiso entonces cambia el estado de $encontrado
														$encontrado=1;
													}
												}
												if ($encontrado==0) {//si encontrado es igual a 0, significaque ,el ,usuario ,logueado no tiene permiso a esta categoria de informe
													$sentencia.=" informes.nuevotipo<>".$fila->tipoInformeId." AND";	# code...
													$cantExclusiva=1;
												}
												$encontrado=0;

												//var_dump($fila);
										}

									}
									if($cantExclusiva==1){
										$sentencia=substr($sentencia,0,strlen($sentencia)-3);
									}else{
										$sentencia.=" 1 ";
									}

							/*		if ($_SESSION['tipo']=='Supervisor-Secundaria' || $_SESSION['tipo']=='DirectorNivelSecundario' || $_SESSION['tipo']=='Supervisor-General-Secundaria')
									{
										if(isset($tipoConsulta)){
											$sentencia.=" AND informes.nuevotipo<>8 ";
										}else{
											if (isset($tiporeferente) || isset($listaRefer) ) {
												$sentencia.=" AND (informes.nuevotipo<>8 || informes.nuevotipo<>9)  ";
											}else{
												$sentencia.=" AND (informes.nuevotipo=8 || informes.nuevotipo=9)  ";
											}
										}
									}else{
										$sentencia.=" 1 ";
									}*/


		if($tiporeferente<>NULL){
			$sinParam=1;

			$sentencia.= " AND ( referentes.tipo='".$tiporeferente."'";
		}

		if ($listaRefer <> NULL){
				$sinParam=1;
				$sentencia.="  AND ( ";
				foreach ($listaRefer as $value) {
					$sentencia.=" referentes.tipo='".$value."' || ";
				}
				$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		if ($sinParam==1) {
			$sentencia.=' ) ';
		}


		if($this->informeId!=NULL || $this->escuelaId!=NULL || $this->prioridad!=NULL || $this->leido!=NULL
		|| $this->estado!=NULL || $this->tipo!=NULL || $this->referenteId!=NULL
		|| $this->fechaVisita!=NULL || $this->contenido!=NULL || $this->nuevoTipo!=NULL || $this->subTipo!=NULL)
		{
			$sentencia.=" AND ";


		if($this->informeId!=NULL)
		{
			$sentencia.=" informes.informeId = $this->informeId && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" informes.escuelaId = $this->escuelaId && ";
		}

		if($this->tipo!=NULL)
		{
			$sentencia.=" informes.tipo=$this->tipo && ";
		}

		if($this->nuevoTipo!=NULL)
		{
			$sentencia.=" informes.nuevotipo=$this->nuevoTipo && ";
		}

		if($this->subTipo!=NULL)
		{
			$sentencia.=" informes.subtipo=$this->subTipo && ";
		}

		if($this->prioridad!=NULL)
		{
			$sentencia.=" informes.prioridad = '$this->prioridad' && ";
		}

		if($this->leido!=NULL)
		{
			$sentencia.=" informes.leido=$this->leido && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" informes.estado=$this->estado && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" informes.referenteId='$this->referenteId' && ";
		}

		if($this->fechaVisita!=NULL)
		{
			$sentencia.=" informes.fechaVisita='$this->fechaVisita' && ";
		}

		if($this->contenido!=NULL)
		{
			$sentencia.=" informes.contenido=$this->contenido && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);


		}

		  // fin else


		$sentencia.="  ORDER BY informes.informeId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia.'<br><br>';
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
