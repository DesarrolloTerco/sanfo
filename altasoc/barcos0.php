<?php






// actualizar o modificar

<?php
/// In order to use this script freely
/// you must leave the following copyright
/// information in this file:
/// Copyright 2012 www.turningturnip.co.uk
/// All rights reserved.

include("connect.php");



// ya actualizado..... ya actualizado
<?php
/// In order to use this script freely
/// you must leave the following copyright
/// information in this file:
/// Copyright 2012 www.turningturnip.co.uk
/// All rights reserved.

include("connect.php");

$id = $_POST['id'];

$socio = trim(mysql_real_escape_string($_POST["socio"]));
		$nombreb = trim(mysql_real_escape_string($_POST["nombreb"]));
		$matric = trim(mysql_real_escape_string($_POST["matric"]));
		$bid = trim(mysql_real_escape_string($_POST["bid"]));
		$clase = trim(mysql_real_escape_string($_POST["clase"]));
		$categoria = trim(mysql_real_escape_string($_POST["categoria"]));
		$eslora = trim(mysql_real_escape_string($_POST["eslora"]));
		$manga = trim(mysql_real_escape_string($_POST["manga"]));
		$puntal = trim(mysql_real_escape_string($_POST["puntal"]));
		$metros = trim(mysql_real_escape_string($_POST["metros"]));
		$metrospag = trim(mysql_real_escape_string($_POST["metrospag"]));
		$calado = trim(mysql_real_escape_string($_POST["calado"]));
		$tonelaje = trim(mysql_real_escape_string($_POST["tonelaje"]));
		$modelo = trim(mysql_real_escape_string($_POST["modelo"]));
		$caso = trim(mysql_real_escape_string($_POST["caso"]));
		$motor = trim(mysql_real_escape_string($_POST["motor"]));
		$anio = trim(mysql_real_escape_string($_POST["anio"]));
		
$rsUpdate = mysql_query("UPDATE cvsi
	SET  socio = '$socio',  nombreb = '$nombreb',  matric = '$matric',  bid = '$bid',  clase = '$clase',  categoria = '$categoria',  eslora = '$eslora',  manga = '$manga',  puntal = '$puntal',  metros = '$metros',  metrospag = '$metrospag',  calado = '$calado',  tonelaje = '$tonelaje',  modelo = '$modelo',  caso = '$caso',  motor = '$motor',  anio = '$anio'
	WHERE id = '$id' ");

if($rsUpdate) { echo "Successfully updated"; } else { die('Invalid query: '.mysql_error()); }
?>

<a href="index.php">Back to index</a>

// este es el index



?>