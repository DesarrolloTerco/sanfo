<?php
session_start();
require ("../configuraciones/aut_verifica.inc.php");
$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos GRS");
$descriptor=mysql_select_db($BaseDeDatos);

$jefefam   = $_POST["cConcep"];
$socioprin = $_POST["cConcep"];
$socioprin = substr($socioprin,0,5);

// *************************************************************************************************************************************
function StrZero($num, $size)
         {
         return str_pad($num, $size, "0", STR_PAD_LEFT);
}
// *************************************************************************************************************************************
//Echo "el socioprin antes del query es:".$socioprin."<br>";
//Echo "Lo que voy a Buscar es: ".substr('00868-00',0,5)."<br>";
$buscar="Select socio,count(*) as cantidad from socios WHERE substr(socio,1,5)='$socioprin'";      
$res = mysql_query($buscar);
$xCant=99;
if (mysql_num_rows($res) > 0){
  While($row=mysql_fetch_row($res)){
//    echo $row[0]."<br>";    
//    echo $row[1]."<br>";  
    $xCant=$row[1];
    $xCant=StrZero($xCant,2);
    $newsoc=$socioprin."-".$xCant;
  }
//  Echo "La cantidad de socios encontrados es: ".$xCant."<br>";
//  Echo "Socio Principal es     ".$socioprin."<br>";
//  Echo "El Socio Adherente es  ".$newsoc."<br>";  
}Else {
  Echo "No encontre ningun registro mayor a 0 de ".$socioprin;
  print "<meta http-equiv=Refresh content=\"3 ; url=../menu2.php\">";
  mysql_close($conexion) ;
  exit;  
}

mysql_free_result($res);

$vnombre  = $_POST['vnombre'];
print("Numero socio................................: ").$newsoc."<br>";
print("Nombre: ").$vnombre."<br>";
$vapellido=$_POST['vapellido'];
print("Apellido: ").$vapellido."<br>";
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
//echo "dia de Ingreso ".$elemento_111." /".$elemento_112." /".$elemento_113."<br>";
$vfingreso=$elemento_111." /".$elemento_112." /".$elemento_113;

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

//$vcalle2 = $_POST['vcalle2'];
//echo "Documento: ".$vdocu."<br>";

$vpais =$_POST['vpais'];
//echo "pais ".$vpais."<br>";
$vemail=$_POST['vemail'];
//echo "e-mail  ".$vemail."<br>";

$catego=$_POST['catego'];

$vnacio1=$_POST['vnacio1'];
$vnacio2=$_POST['vnacio2'];
$vnacio3=$_POST['vnacio3'];
//echo "fecha nacimiento".$vnacio1."/".$vnacio2."/".$vnacio3."<br>";
$vfnacio=$vnacio1."/".$vnacio2."/".$vnacio3;

$sqlins1="INSERT INTO `socios`(`SOCIO`, `NOMBRE`,`TIPODOC`,`NRODOC`, `CATEGO`, `SUBCATEGO`, `FECHAINGR`, `FECHACATE`, `SEXO`, `FECHANAC`, `DIRECCION`,
`LOCALIDAD`, `CODPOS`, `TE`, `JEFEFAM`, `RELACION`, `NACION`,`ESTCIV`,`EMAIL`)";
$sqlins1.= "VALUES ('$newsoc','$vapelynom',substr('$vdocu',1,3),substr('$vdocu',4,12),'$catego','S','$vfingreso','$vfingreso','$vsexo','$vfnacio','$vcalle',
'$vciudad','$vpostal','$vlinea','$jefefam','VI','$vpais','S','$vemail'  )";
$result=mysql_query($sqlins1);
if ($result){
    echo mysql_affected_rows()." fila(s) afectada(s). Informaci&oacute;n Grabada Correctamente";
}else{
    echo "Ha ocurrido un Problema Grabando los datos ALCLI".'<br>';
    echo "MySQL dice: ".mysql_error();
}

/*
$sqlupdate= "UPDATE ctrlnum SET valor=$nuevosocio WHERE codigo='SOC'";
$inserta= mysql_query($sqlupdate);
if ($inserta){
    echo mysql_affected_rows()." fila(s) afectada(s). Informaci&oacute;n Grabada Correctamente";
}else{
    echo "Ha ocurrido un Problema Grabando los datos. Ctrl Num.-".'<br>';
    echo "MySQL dice: ".mysql_error();
}
*/
print "<meta http-equiv=Refresh content=\"1 ; url=../menu2.php\">";
mysql_close($conexion) ;
exit;
   
?>
