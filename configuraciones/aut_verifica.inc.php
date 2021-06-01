<?php
session_start();
include 'config.php';
// include '../configuraciones/config.php';
$xx=$_SESSION['myusername'];
$zz=$_SESSION['mypassword'];
if (!isset($_SESSION['myusername']) && !isset($_SESSION['mypassword'])){
	echo '<script type="text/javascript">', 'alertame2();', '</script>';
	//die ("Error Autentificacion - Acceso incorrecto!  ".mysql_error());
	//exit;
}
?>

<script type="text/javascript">
    
	*/
	function alertame2() {

    var mensaje;
    var opcion = confirm("Error de Autenticacion. Debe Logearse de Nuevo");
    if (opcion == true) {
        return(opcion);
        var volverahora = `<meta http-equiv=Refresh content=\"5 ; url=../menu2.php\">`
        } else {
        mensaje = "Has clickado Cancelar";
    }
    return(opcion);
    }  




</script>


