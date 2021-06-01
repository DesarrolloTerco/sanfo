<?php
session_start();
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;

require ("../configuraciones/aut_verifica.inc.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;

$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos");
$descriptor=mysql_select_db($BaseDeDatos);

$fdesde=$_GET['vfinicio'];
$fhasta=$_GET['vffinal'];
$excell=$_GET['aexel'];
$vactivos=$_GET['vactivos'];

$fechafin= strtotime($fdesde);
$fdesde=date('Y-m-d',$fechafin);
$fechafin= strtotime($fhasta);
$fhasta=date('Y-m-d',$fechafin);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="csscode.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="view.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>CVSI Informes </title>
<style>
        table tr:hover {
        background: #CDCF66;}
</style>   
</head>


<?php
$nombresemana="Edades_".date('y-m-d',time()).".xls";
if ($excell){
    header ("Expires: Mon, 26 Jul 2017 05:00:00 GMT");  
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
    header ("Cache-Control: no-cache, must-revalidate");  
    header ("Pragma: no-cache");  
    header ("Content-Type: application/vnd.ms-excel"); 
    header ('Content-Disposition: attachment; filename='.$nombresemana);    
}
?>
<!-- *********************************************************** Por Edades ************************************************************************** -->        

    <div id="form_container">
    <table bgcolor="white" border="1" align="center" width=40% backgroundcolor="white" class="CSSTableGenerator">
        <tr> <td align="center"> Socios con Edades Desde: <?php echo $fdesde." - Hasta: ".$fhasta; ?> </td></tr>
        <tr><td> </td> </tr>
    </table>
    </div>    

    <h3 align="center"><a> Soicios Fecha de Nacimiento entre: <?php echo $fdesde." - y: ".$fhasta; ?></a></h3>
    <table bgcolor="white" border="2" align="center" width=95% backgroundcolor="white" class="CSSTableGenerator">
    <tr>
      <td width="10%" ><span class="estilo1">Socio</td>
      <td width="40%" ><span class="estilo1">Nombre</td>
      <td width="25%"><span class="estilo1">Ingreso</td>
      <td width="25%"><span class="estilo1">Nacio</td>
    </tr>  
        
<?php

$c1=0;
$c2=0;
$c3=0;
if ($vactivos) {
    $sql_fijo= "SELECT socio, nombre, fin, fna from socios where catego<>'NS' AND relacion<>'BA' and (fna >='$fdesde' and fna <='$fhasta') order by nombre";
}else{
    $sql_fijo= "SELECT socio, nombre, fin, fna from socios where (fna >='$fdesde' and fna <='$fhasta') order by nombre";    
}
$rs_fijo= mysql_query($sql_fijo)or die("Control Edad - 81 ".mysql_error());

if (mysql_num_rows($rs_fijo) > 0) {
    While($row=mysql_fetch_row($rs_fijo)){
      $c1+=1;
      echo "<tr> \n";
      echo "<td><span class='estilo1'>$row[0]</td> \n";
      echo "<td><span class='estilo1'>$row[1]</td> \n";
      echo "<td><span class='estilo1'>$row[2]</td> \n";
      echo "<td><span class='estilo1'>$row[3]</td> \n";
      echo "</tr>";      
    }
    echo "<tr bgcolor='lime'> \n";
    echo "<td></td> \n";
    echo "<td></td> \n";    
    echo "<td>Totales</td> \n";
    echo "<td align='right'>".number_format($c1,2,',','')."</td> \n";
    echo "</tr>";        
}
mysql_free_result($rs_fijo);

?>
</table><br></br>   
<!-- *********************************************************** Por Edades ************************************************************************** -->        
    <div id="form_container">
    <table bgcolor="white" border="1" align="center" width=40% backgroundcolor="white" class="CSSTableGenerator">
        <tr> <td align="center"> Socios con Edades Incorrectas. </td></tr>
        <tr><td> </td> </tr>
    </table>
    </div>    

    <h3 align="center"><a> Socios Fecha de Nacimiento Incorrecta</a></h3>
    <table bgcolor="white" border="2" align="center" width=95% backgroundcolor="white" class="CSSTableGenerator">
    <tr>
      <td width="10%" ><span class="estilo1">Socio</td>
      <td width="40%" ><span class="estilo1">Nombre</td>
      <td width="25%"><span class="estilo1">Ingreso</td>
      <td width="25%"><span class="estilo1">Nacio</td>
    </tr>  
        
<?php
//$fdesde=date('d-m-Y',$fdesde);
//$fhasta=date('d-m-Y',$fhasta);
//echo "<br> Desde 2 : ".$fdesde;
//echo "<br> Hasta 2 : ".$fhasta;
$c1=0;
$c2=0;
$c3=0;
if ($vactivos) {
    $sql_fijo= "SELECT socio, nombre, fin, fna from socios where catego<>'NS' AND relacion<>'BA' and fna='0000-00-00' order by nombre";
}else{
    $sql_fijo= "SELECT socio, nombre, fin, fna from socios where fna='0000-00-00 ' order by nombre";    
}
$rs_fijo= mysql_query($sql_fijo)or die("Control Edad - 132 ".mysql_error());

if (mysql_num_rows($rs_fijo) > 0) {
    While($row=mysql_fetch_row($rs_fijo)){
      $c1+=1;
      echo "<tr> \n";
      echo "<td><span class='estilo1'>$row[0]</td> \n";
      echo "<td><span class='estilo1'>$row[1]</td> \n";
      echo "<td><span class='estilo1'>$row[2]</td> \n";
      echo "<td><span class='estilo1'>$row[3]</td> \n";      
      echo "</tr>";      
    }
    echo "<tr bgcolor='lime'> \n";
    echo "<td></td> \n";
    echo "<td></td> \n";    
    echo "<td>Totales</td> \n";
    echo "<td align='right'>".number_format($c1,2,',','')."</td> \n";
    echo "</tr>";        
}
mysql_free_result($rs_fijo);

?>
</table><br></br>   



</div>
</body>
<html>
    
