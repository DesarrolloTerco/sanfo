<?php
require_once("../conecta.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
// chequear si se llama directo al script.
if ($_SERVER['HTTP_REFERER'] == " "){
die ("<b><center>Error cod.:DLCTO - Acceso incorrecto! -- <br><br><a href='../index.php'>Click aqui para validarse</a></center></b>");
exit;
}
if (!isset($_GET['vNumDoc'])  )  {
    $vid="Sin Identificar";
    exit;
}else{
    $vid=$_GET['vNumDoc'];
}
if (!isset($_GET['nrosoc'])  )  {
    $nrosoc="Sin Identificar";
    exit;
}else{
    $nrosoc=$_GET['nrosoc'];
}
if (!isset($_GET['nomsoc'])  )  {
    $nomsoc="Sin Identificar";
    exit;
}else{
    $nomsoc=$_GET['nomsoc'];
}
/*
echo " Id./ registro a borrar: ".$vid."<br>";
echo " Id./ socio            : ".$nrosoc."-<br>";
echo " Id./ nombre del camac : ".$nomsoc."-<br>";
*/
//        require("../configuraciones/config.php");
$conexion = mysql_connect($Servidor,$Usuario,$Password) or die("Error:No Conecta datos");
$descriptor=mysql_select_db($BaseDeDatos,$conexion);
$buscar="delete from contado where id='$vid'";
$res = mysql_query($buscar) or die("no pude borrar  ".mysql_error());
print "<meta http-equiv=Refresh content=\"0 ; url=additem.php?nrosoc=$nrosoc&nomsoc=$nomsoc\">";
//exit;
?>
