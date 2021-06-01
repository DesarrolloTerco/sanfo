<?php
function write_log($cadena,$tipo)
{
	//$absolute_path = realpath("fileDir.php");
	//$arch = fopen(realpath( '.' )."/logs/milog_".date("Y-m-d").".txt", "a+"); 
	$arch = fopen("../logs/milog_".date("Y-m-d").".txt", "a+"); 

//	echo "<br> el archivo es: ".$arch."<br>";

	fwrite($arch, "[".date("Y-m-d H:i:s.u")." ".$_SERVER['REMOTE_ADDR']." ".
                   $_SERVER['HTTP_X_FORWARDED_FOR']." - $tipo ] ".$cadena."\n");
	fclose($arch);
}
?>