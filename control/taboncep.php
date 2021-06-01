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
            ?>
        </div>
    </div>
    <div class="entry"></div>
        <table border="1" align="center" cellpadding="1" cellspacing="2" class="CSSTableGenerator">
            <caption align="top"> Novedades Cargadas a los Socios</caption>
                <tr>
    		<td width="5%" ><span class="estilo1">Socio</td>
    		<td width="8%" ><span class="estilo1">Nombre</td>        
    		<td width="5%"><span class="estilo1">Telefono</td>
                    <td width="10%"><span class="estilo1">Email</td>
    		<td width="5%"><span class="estilo1">Cpto</td>
                    <td width="5%" ><span class="estilo1">Descripcion</td>
                    <td width="5%" ><span class="estilo1">Cantidad</td>
                    <td width="5%" ><span class="estilo1">importe</td>                
                    <td width="5%" ><span class="estilo1">Count</td>                                    
                </tr>
                <?php
                $conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos");
                $descriptor=mysql_select_db($BaseDeDatos);
/*                $sql = "SELECT n.id, n.socio, n.concepto, n.descri ,n.cantidad, n.importe, s.socio, s.nombre, s.te, s.email, count(*) as canti1 FROM novedades as n
                INNER JOIN socios AS s ON n.socio=s.socio where s.catego<>'NS' and s.relacion<>'BA' group by n.socio order by n.socio asc";
                $rs =  mysql_query($sql) or die ("Erro de lpm. ".mysql_err() );  
                if (mysql_num_rows($rs) > 0) {
                    $registros=mysql_num_rows($rs);
                    echo "Cantidad de registros Encontrados : ".$registros."<br>";
                    While($row=mysql_fetch_row($rs)){
                        echo "<tr> \n";
                        echo "<td><span class='estilo1'>$row[1]</td> \n";
                        echo "<td><span class='estilo1'>$row[7]</td> \n";
                        echo "<td><span class='estilo1'>$row[8]</td> \n";
                        echo "<td><span class='estilo1'>$row[9]</td> \n";
                        echo "<td><span class='estilo1'>$row[2]</td> \n";
                        echo "<td><span class='estilo1'>$row[3]</td> \n";
                        echo "<td><span class='estilo1'>$row[4]</td> \n";
                        echo "<td><span class='estilo1'>$row[5]</td> \n";                                                            	
                        echo "<td><span class='estilo1'>$row[10]</td> \n";                                                            	                        
                        echo "</tr> \n";
                     }
                }else {
                    echo" No Existe Informacion para la Consulta requerida";
                    print "<meta http-equiv=Refresh content=\"3 ; url=../menu2.php\">";
                    exit;
                }
                */
//*                  ********************************************************************************************************************************************
                $sql2 = "SELECT n.id, n.socio, n.concepto, n.descri ,n.cantidad, n.importe, s.socio, s.nombre, s.te, s.email, count(*) as canti1 FROM novedades as n
                INNER JOIN socios AS s ON n.socio=s.socio where s.catego<>'NS' and s.relacion<>'BA' group by n.concepto order by canti1 desc";
                $rs2 =  mysql_query($sql2);  
                if (mysql_num_rows($rs2) > 0) {
                    $registros2=mysql_num_rows($rs2);
                    echo "Cantidad de registros Encontrados : ".$registros2."<br>";
                    While($row2=mysql_fetch_row($rs2)){
                        echo "<tr> \n";
                        echo "<td><span class='estilo1'>$row2[1]</td> \n";
                        echo "<td><span class='estilo1'>$row2[7]</td> \n";
                        echo "<td><span class='estilo1'>$row2[8]</td> \n";
                        echo "<td><span class='estilo1'>$row2[9]</td> \n";
                        echo "<td><span class='estilo1'>$row2[2]</td> \n";
                        echo "<td><span class='estilo1'>$row2[3]</td> \n";
                        echo "<td><span class='estilo1'>$row2[4]</td> \n";
                        echo "<td><span class='estilo1'>$row2[5]</td> \n";                                                            	
                        echo "<td><span class='estilo1'>$row2[10]</td> \n";                                                            	                        
                        echo "</tr> \n";
                     }
                     
                }else {
                    echo" No Existe Informacion para la Consulta requerida";
                    print "<meta http-equiv=Refresh content=\"3 ; url=../menu2.php\">";
                    exit;
                }                

                ?>
        </div>
    </div>
</body>
</html>

