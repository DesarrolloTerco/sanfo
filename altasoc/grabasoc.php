<?php
session_start();
require ("../configuraciones/aut_verifica.inc.php");
$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos GRS");
$descriptor=mysql_select_db($BaseDeDatos);

function StrZero($num, $size)
         {
         return str_pad($num, $size, "0", STR_PAD_LEFT);
}

$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;

$sql= "select * from ctrlnum where codigo='SOC'";
$rs= mysql_query($sql);
if (mysql_num_rows($rs)>=0){
  $row=mysql_fetch_array($rs);
  echo "salida".$row[0]."-".$row[1]."-".$row[2]."<br>"; 
  $nuevosocio=$row[2];
}

//echo "nuevo socio es:".$nuevosocio."<br>";
$nuevosocio=$nuevosocio+1;
//echo "nuevo socio es:".$nuevosocio."<br>";
$newsoc = StrZero($nuevosocio, 5);
$newsoc.="-00";
echo "socio con zero es:".$newsoc."<br>";
mysql_free_result($rs);

//print "la url es: ".$url[0]."<br>";
$vnombre  = $_POST['vnombre'];
//print("Numero socio................................: ").$newsoc."<br>";
//print("Nombre: ").$vnombre."<br>";
$vapellido=$_POST['vapellido'];
//print("Apellido: ").$vapellido."<br>";
$vapelynom=$vapellido." ".$vnombre;
if(isset($_POST['vsexo'])){
    if ($_POST['vsexo']=="1"){
//        echo "Sexo es Femenino:  ".$_POST['vsexo']."<br>";
        $vsexo='F';
    }else{
//        echo "Sexo es Masculino:  ".$_POST['vsexo']."<br>";
        $vsexo='M';
    }
}
$elemento_111 = $_POST['element_11_2'];
$elemento_112 = $_POST['element_11_1'];
$elemento_113 = $_POST['element_11_3'];
echo "dia de Ingreso ".$elemento_111." /".$elemento_112." /".$elemento_113."<br>";
$vfingreso=$elemento_111." /".$elemento_112." /".$elemento_113;
$vfingreso=$_POST['vingre'];
/*
if (checkdate($vmes,$vdia,$vano )){
}else{	echo" Fecha DESDE No es Correcta";
			print "<meta http-equiv=Refresh content=\"7 ; url=consuentra.php\">";
			exit;
}
*/
$vcalle  = $_POST['vcalle'];
$vciudad = $_POST['vciudad'];
$vlinea  = $_POST['vlinea'];
$vpostal = $_POST['vpostal'];
$vdocu   = $_POST['vdocu'];
$vnrodocu   = $_POST['vnrodocu'];
//$vcalle2 = $_POST['vcalle2'];
//echo "Documento: ".$vdocu."<br>";

$vpais =$_POST['vpais'];
//echo "pais ".$vpais."<br>";
$vemail=$_POST['vemail'];
//echo "e-mail  ".$vemail."<br>";

$vnacio1=$_POST['vnacio1'];
$vnacio2=$_POST['vnacio2'];
$vnacio3=$_POST['vnacio3'];
//echo "fecha nacimiento".$vnacio1."/".$vnacio2."/".$vnacio3."<br>";
$vfnacio=$vnacio1."/".$vnacio2."/".$vnacio3;
$vnacio=$_POST['vcumple'];
$vingre=$_POST['vingre'];

$sqlins1="INSERT INTO `socios`(`SOCIO`, `NOMBRE`,`TIPODOC`,`NRODOC`, `CATEGO`, `SUBCATEGO`, `FECHAINGR`, `FECHACATE`, `SEXO`, `FECHANAC`, `DIRECCION`,
`LOCALIDAD`, `CODPOS`, `TE`, `JEFEFAM`, `RELACION`, `NACION`,`ESTCIV`,`EMAIL`,fin,fca,fna)";
$sqlins1.= "VALUES ('$newsoc','$vapelynom','$vdocu','$vnrodocu','AC','S','$vfingreso','$vfingreso','$vsexo','$vfnacio','$vcalle',
'$vciudad','$vpostal','$vlinea','$newsoc','VI','$vpais','S','$vemail','$vingre','$vingre','$vnacio'  )";
$result=mysql_query($sqlins1);
if ($result){
    echo mysql_affected_rows()." fila(s) afectada(s). Informaci&oacute;n Grabada Correctamente";
}else{
    echo "Ha ocurrido un Problema Grabando los datos ALCLI".'<br>';
    echo "MySQL dice: ".mysql_error();
}

$sqlupdate= "UPDATE ctrlnum SET valor=$nuevosocio WHERE codigo='SOC'";
$inserta= mysql_query($sqlupdate);
if ($inserta){
    echo mysql_affected_rows()." fila(s) afectada(s). Informaci&oacute;n Grabada Correctamente";
}else{
    echo "Ha ocurrido un Problema Grabando los datos. Ctrl Num.-".'<br>';
    echo "MySQL dice: ".mysql_error();
}

print "<meta http-equiv=Refresh content=\"3 ; url=../menu2.php\">";
mysql_close($conexion) ;
exit;
   
?>
