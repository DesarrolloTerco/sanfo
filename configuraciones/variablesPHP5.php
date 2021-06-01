<?php


	class variablesPHP5

	{

	function variablesPHP5() {

	    foreach ($_GET as $indice => $valor) {

	        global $$indice;

	        $$indice = $valor;

	    }

	    foreach ($_POST as $indice => $valor) {

	        global $$indice;

	        $$indice = $valor;

	    }
		
		// Parche para que funcione la subida de archivos en PHP5
		
		global $foto_name, $foto;
		$foto_name = $_FILES['foto']['name'];
		$foto = $_FILES['foto']['tmp_name'];
		
    }

}
?>
