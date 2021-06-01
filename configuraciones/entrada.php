<?php
require("aut_verifica.inc.php");

//echo "Nivel Acceso ".$nivel_acceso."<br>";
//$caca=$_SESSION['usuario_nivel'];
//echo 'usuario  nivel es: '.$caca;
//$nivel_acceso=1000; 
//if ($nivel_acceso <= $_SESSION['usuario_nivel']){
//header ("Location: $redir?error_login=5");
//exit;
//}
?>
<html>
<title>San Felipe Acceso</title>

<head>
 <!-- <link rel="stylesheet" type="text/css" href="../efectos/estilo_principal.css" media="screen"/> -->
<script type="text/javascript" src="../efectos/ajax.js"></script>
</script>
</head>

<body>
 
<div id="inegua_progressPane">
	<div id="inegua_progressBar_bg">
		<div id="inegua_progressBar_outer">
			<div id="inegua_progressBar"></div>
		</div>
		<div id="inegua_progressBar_txt">0 %</div>
	</div>
</div>
<? 
  // defino las variables de si existe factusyn Os, Tpvsyn y los fondos de pantalla que tengo guardados
  $os = '../os.php';
  
 if (file_exists ($os)) { ?>
 
<script language="javascript">
<!--
if (navigator.appName == "Microsoft Internet Explorer") {
   alert("Tu navegador no es soportado será redirigido a Modo Clasico. Si desea entrar utilice un navegador que respete los estandares web") 
        
		//document.location = "../clasico.php"; 
		document.location="../menu2.php";
} else {
		document.location = "../os.php"; 
}// -->
</script>
<? } ?>
<script language="javascript">
	document.location = "../index.html";
</script>
</body>
</html>
