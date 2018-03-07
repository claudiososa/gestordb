<?php
//inclusion de archivo de configuracion
include('conf.php');
//include('activos.php');
//verificamos se pide algun modulo en especial sino seleccionar modulo por defecto
if (!empty($_GET['mod']))
    $modulo=$_GET['mod'];
else
    $modulo = modulo_defecto;
// verificacion si exist el modulo solicitado caso contrario se carga por defecto
if (empty($conf[$modulo]))
   $modulo=modulo_defecto;
if (empty($conf[$modulo]['layout']))
   $conf[$modulo]['layout']=layout_defecto;
//cargamos el archivo layout que a su vez cargara el modulo
//si el layout no existe se carga directamente el modulo
//y si no existiera el modulo  mensaje de error

$path_layout=layout_path.'/'.$conf[$modulo]['layout'];
$path_modulo1=modulo_path.'/'.$conf[$modulo]['titulos'];
$path_modulo2=modulo_path.'/'.$conf[$modulo]['menu'];
$path_modulo3=modulo_path.'/'.$conf[$modulo]['m_izquierda'];
$path_modulo4=modulo_path.'/'.$conf[$modulo]['m_derecha'];
$path_modulo5=modulo_path.'/'.$conf[$modulo]['m_pie'];
$path_modulo6=modulo_path.'/'.$conf[$modulo]['m_encabe'];
$path_modulo7=modulo_path.'/'.$conf[$modulo]['centro'];

if (file_exists($path_layout))
   include($path_layout);
else
   if (file_exists($path_modulo3))
       include($path_modulo3);
   else
       die ('Error al cargar el m?dulo <b> '.$modulo.'</b>. No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>');
  ?>