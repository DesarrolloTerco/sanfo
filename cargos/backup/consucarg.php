<?php
session_start();
require_once("../conecta.php");
/*
$Usuario='root';
$Password='t7jm33p';
$Servidor='localhost';
$BaseDeDatos='club';
$Usuarios_sesion='usuario';
*/
require ("../configuraciones/config.php");
//require ("../configuraciones/aut_verifica.inc.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="view.css" media="all">
    <link href="../total.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="view.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Conceptos y Cargos</title>
</head>

<body id="main_body">
    <img id="top" src="top.png" alt="">
    <div id="form_container">
        <div class="form_description">
            <h2><a> Club Veleros San isidro </a></h2>
            <?php
                echo "<input type='button' value='Atras' onClick='history.go(-1);'>";
            ?>
        </div>
    </div>
    <table bgcolor="white" border="2" align="center" width=95% backgroundcolor="white" >
    <tr>
        <td width="10%"><span class="estilo1">Codigo</td>
        <td width="35%"><span class="estilo1">Descripcion</td>
        <td width="10%"><span class="estilo1">Valor</td>
    </tr>
    <tr>
    <?php
    
    $conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos");
    $descriptor=mysql_select_db($BaseDeDatos);
    $sql = "SELECT * FROM conceptos order by descrip desc";
    $rs=  mysql_query($sql);
//	$rs= mysql_query("Select * from socios where nombre like '%".$bcac."%' order by nombre desc LIMIT '$offset,$limit' ") ;
    
    if (mysql_num_rows($rs) > 0) {
        $registros=mysql_num_rows($rs);
	$records_per_page = 10;
    	echo "Cantidad de registros Encontrados : ".$registros."<br>";
    	While($row=mysql_fetch_row($rs)){
            echo "<tr> \n";
            echo "<td><span class='estilo1'>$row[0]</td> \n";
            echo "<td><span class='estilo1'>$row[1]</td> \n";
            // echo "<td>$row[6]</td> \n";
            echo "<td><span class='estilo1'>$row[2]</td> \n";
            echo '<td><a href="modiconcep.php?bcac='.$row[0]'"> Modifica</a></td>';
            echo '<td><a href="modiconcep.php?bcac='.$row[0]'">  Baja </a></td>';
        }
    }else {
        echo" No Existe Informacion para la Consulta requerida";
    	print "<meta http-equiv=Refresh content=\"55 ; url=../menu2.php\">";
    	exit;
    }
    ?>
    </tr>
    </table>
    
</body>
</html>

