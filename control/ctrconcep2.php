<?php
session_start();
require_once("../conecta.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="csscode.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="view.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Terco by De Poli CSS Templates </title>
    <link href="default.css" rel="stylesheet" type="text/css" media="screen" />
    <style>
        table tr:hover {
        background: #BFCC66;}
    </style>    
</head>

<body id="main_body">
	<img id="top" src="top.png" alt="">
	<div id="form_container">
    	<div class="form_description">
            <h2><a> Club Veleros San isidro </a></h2>
            <?php
            echo "<input type='button' value='Atras' onClick='history.go(-1);'>";
/*            
            $nombrenov="Novedades_".date('y-m-d',time()).".xls";
                header ("Expires: Mon, 26 Jul 2017 05:00:00 GMT");  
                header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");  
                header ("Cache-Control: no-cache, must-revalidate");  
                header ("Pragma: no-cache");  
                header ("Content-Type: application/vnd.ms-excel"); 
                header ('Content-Disposition: attachment; filename='.$nombrenov);    
 */           
            ?>
        </div>
    </div>
    <div class="entry"></div>
        <table border="1" align="center" cellpadding="1" cellspacing="2" class="CSSTableGenerator">
        <caption align="top"> Novedades Cargadas a los Socios</caption>
   		<tr>
    		<td width="5%" ><span class="estilo1">Socio</td>
    		<td width="8%" ><span class="estilo1">Nombre</td>        
    		<td width="5%"><span class="estilo1">Concepto</td>
            <td width="10%"><span class="estilo1">Descripcion</td>
    		<td width="5%"><span class="estilo1">Cantidad</td>
            <td width="5%" ><span class="estilo1">Importe</td>
            <td width="5%" ><span class="estilo1">Cat.Soc</td>
            <td width="5%" ><span class="estilo1">Est.Soc</td>                
    	</tr>
    	<?php
        $conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos");
        $descriptor=mysql_select_db($BaseDeDatos);
        $sql = "SELECT n.socio,s.nombre,n.concepto,n.descri,n.cantidad,n.importe,s.socio,s.catego,s.relacion FROM novedades as n
        INNER JOIN socios AS s ON n.socio=s.socio where s.catego<>'NS' and s.relacion<>'BA' order by n.descri asc";
        $rs =  mysql_query($sql);  
    	if (mysql_num_rows($rs) > 0) {
    		$registros=mysql_num_rows($rs);
		   	echo "Cantidad de registros Encontrados : ".$registros."<br>";
    		While($row=mysql_fetch_row($rs)){
    			echo "<tr> \n";
    			echo "<td><span class='estilo1'>$row[0]</td> \n";
    			echo "<td><span class='estilo1'>$row[1]</td> \n";
    			echo "<td><span class='estilo1'>$row[2]</td> \n";
    			echo "<td><span class='estilo1'>$row[3]</td> \n";
    			echo "<td><span class='estilo1'>$row[4]</td> \n";
                echo "<td><span class='estilo1'>$row[5]</td> \n";
                echo "<td><span class='estilo1'>$row[7]</td> \n";
                echo "<td><span class='estilo1'>$row[8]</td> \n";                                                            	
      	        echo "</tr> \n";
            }
       	}else {
    	   echo" No Existe Informacion para la Consulta requerida";
    	   print "<meta http-equiv=Refresh content=\"3 ; url=../menu2.php\">";
    	   exit;
       	}
    	?>
        </div>
</body>
</html>

