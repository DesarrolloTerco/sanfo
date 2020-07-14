<?php
session_start();
include('configuraciones/config.php');
include_once("libreria.php");
if (!isset($_POST['myusername'])){
    header("location:index.php");
    exit;
}else{
    $myusername = $_POST['myusername'];
}

if (!isset($_POST['mypassword'])){
    header("location:index.php");
    exit;
}  else {
    $mypassword = $_POST['mypassword'];
}

$usuarios_sesion = "usuarios";
$sql_tabla = "usuarios";

mysql_connect("$Servidor", "$Usuario", "$Password")or die("Imposible Conectar".mysql_err());
mysql_select_db("$BaseDeDatos")or die("La Base No Esta Disponible".mysql_err());
$sql="SELECT * FROM $sql_tabla WHERE usuario='$myusername' and pass='$mypassword'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if($count==1){
    while($row=mysql_fetch_array($result)){
        $_SESSION["myusername"]= $row["usuario"];
        $_SESSION["mypassword"]= $row["pass"];
        $_SESSION['habilitado']= $row['nivel_acceso'];
    }
    write_log("Ingreso al sistema ".$myusername." ".$mypassword,"Ingresos");
    ?>
    <meta http-equiv="Refresh" content="0.5; url=menu2.php" />
    <?php
}else {
        echo "No existe El usuario Especificado..... a Llorar a la Iglesia y/o contrase�a";
        write_log("Error usuario no existe ".$myusername." ".$mypassword,"Ingresos");
	?>
   	    <meta http-equiv="Refresh" content="4; url=index.php" />
        <?php
}
?>

