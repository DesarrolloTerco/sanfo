<?php
require ("../configuraciones/config.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error:conectar datos");
$descriptor=mysql_select_db($BaseDeDatos);

/*
$sql = 'DROP DATABASE club2';
if (mysql_query($sql, $conexion)) {
    echo "La base de datos mi_bd fue eliminada con éxito\n";
} else {
    echo 'Error al eliminar la base de datos: ' . mysql_error() . "\n";
}
*/
$directorio = '/var/www/html/athome65.dyndns.org/control/bkcvsi';
echo "directorio: ".$directorio."<br>";

$ficheros1  = scandir($directorio);
//print_r($ficheros1);
echo "<br> ---------------------------------------------------- <br>";
$todo= "<select name='$nombre' id='$nombre'>";
//echo $todo;
for ($i=0; $i<sizeof($ficheros1); $i++){
		$todo .= "<option value='$i'>". $ficheros1[$i] . '</option>';
	}
$todo .= '</select>';

echo "<form>";
echo $todo;
echo "</form>";

echo "<br> ---------------------------------------------------- <br>";

?>
