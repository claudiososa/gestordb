<?php
class Maestro{
	public function grafico($tipo,$dato,$canvasId){
		$graficoDibujado = '<script type="text/javascript">
		var ctx = document.getElementById("'.$canvasId.'").getContext("2d");';
		$valor=0;
		foreach($dato as $fila)
 		{
			$graficoDibujado.='var '.$fila[0].$valor.'='.$fila[1].';';
			$valor++;
 		}
		$graficoDibujado.='var myChart = new Chart(ctx, {
			type: "pie",
			data: {
				labels: [';
				$valor=0;
				foreach($dato as $fila)
				{
					$graficoDibujado.='"'.$fila[0].'",';
					//echo 'alert ('.$fila[0].');';
					$valor++;
				}
				$graficoDibujado=trim($graficoDibujado, ',');
				$graficoDibujado.='],
				datasets: [{
					backgroundColor: [
						"#2ecc71",
						"#3498db",
						"#95a5a6",
						"#9b59b6",
						"#f1c40f",
						"#e74c3c",
						"#34495e"
					],
					data: [';
					$valor=0;
					foreach($dato as $fila)
			 		{
						$graficoDibujado.=$fila[0].$valor.',';
						$valor++;
			 		}
					$graficoDibujado=trim($graficoDibujado, ',');
					$graficoDibujado.=']
				}]
			},
			options:   {
			pieceLabel: {
				mode: "percentage",
			}
			}
		});
		</script>';
		return $graficoDibujado;
	}

public static function estructura($campo,$tabla){
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

	public function existeCampo($valor,$campo,$tabla)
	{
		$nuevaConexion= new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT ".$campo." FROM ".$tabla." WHERE ".$campo."=".$valor;
		$cantidad=mysqli_num_rows($conexion->query($sentencia));
		if($cantidad>0) {
			return 1;
		}else {
			return 0;
		}
	}
}

?>
