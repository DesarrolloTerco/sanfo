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
    if ($_POST['vsexo']=="0"){
        $vsexo='F';
    }else if ($_POST['vsexo']=="1"){
        $vsexo='M';
    }else{
      $vsexo='O';
    }
}
$vfing=$_POST['vingreso'];
$vfingreso=substr($vfing,8,2)."/".substr($vfing,5,2)."/".substr($vfing,2,2);
$vcalle   = $_POST['vdireccion'];
$vciudad  = $_POST['vlocalidad'];
$vlinea   = $_POST['vlinea'];
$vpostal  = $_POST['vcodpos'];
$vdocu    = $_POST['vtipodoc'];
$vtipodoc = $_POST['vtipodoc'];
$vnrodoc  = $_POST['vnrodoc'];
$vnumero  = $_POST['vnumero'];
$vpais    = $_POST['vpais'];
$vemail   = $_POST['vemail'];
$catego   = $_POST['vcatego'];
$catego   = $_POST['cGrado'];
$vnacio1  = $_POST['vnacio1'];
$vnacio2  = $_POST['vnacio2'];
$vnacio3  = $_POST['vnacio3'];
$vingreso = $_POST['vingreso'];
$vantiguedad=$_POST['vantiguedad'];
$vcumple=$_POST['vcumple'];
$vfnac=$_POST['vcumple'];
$vfnacio=substr($vfnac,8,2)."/".substr($vfnac,5,2)."/".substr($vfnac,2,2);
$vfahora=date("Y-m-d");
$vtelefono = $_POST['vtelefono'];
$sqlins1="INSERT INTO `socios`(`SOCIO`,`NOMBRE`,`TIPODOC`,`NRODOC`,`CATEGO`,`SUBCATEGO`,`FECHAINGR`,`FECHACATE`,`SEXO`,`FECHANAC`,`DIRECCION`,
`LOCALIDAD`, `CODPOS`, `TE`, `JEFEFAM`, `RELACION`, `NACION`,`ESTCIV`,`EMAIL`,`FIN`,`FCA`,`FNA`,`FOPER`)";
$sqlins1.= "VALUES ('$newsoc','$vapelynom','$vtipodoc','$vnumero','$catego','S','$vfingreso','$vfingreso','$vsexo','$vfnacio','$vcalle',
'$vciudad','$vpostal','$vtelefono','$jefefam','VI','$vpais','S','$vemail','$vingreso','$vantiguedad','$vcumple','$vfahora'  )";
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
mysql_close($conexion) ;
print "<meta http-equiv=Refresh content=\"1 ; url=../menu2.php\">";
exit;
   
?>
