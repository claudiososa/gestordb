<?php
/* archivo de configuracion  - aplicaci�n modularizada. 
  definimos valores por defecto y datos para cada uno de nuestros m�dulos.
*/
define('modulo_defecto','inicio');
define('layout_defecto','layout_slat.php');
define('layout_slat','layout_slat.php');
define('modulo_path',realpath('./modulos/'));
define("layout_path",realpath('./layouts/'));

/* Array con datos de cada modulo*/
$conf['inicio']=array(
'titulos'=>'titulos.php',
'menu'=>'menu.php',
'centro'=>'centro.php',
'm_derecha'=>'m_derecha.php',
'm_pie'=>'m_pie.php',
'm_encabe'=>'m_encabe.php',
'm_izquierda'=>'m_izquierda.php',
'layout'=>layout_defecto);

$conf['slat']=array(
'titulos'=>'titulos.php',
'menu'=>'menu.php',
'centro'=>'centro.php',
'm_derecha'=>'m_derecha.php',
'm_pie'=>'m_pie.php',
'm_encabe'=>'m_encabe.php',
'm_izquierda'=>'m_izquierda.php',
'layout'=>layout_slat);
?>