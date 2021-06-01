<?php
session_start();
require_once("../conecta.php");
$nombresoc="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="csscode.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="view.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Terco by De Poli CSS Templates </title>
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
<!--        <div id="resultado">  -->
<!--            <form>  -->
<!--    		<table border="3" align="center" cellpadding="2"cellspacing=2 width=100% >    -->
    </div>
    		<table bgcolor="white" border="2" align="center" width=95% backgroundcolor="white" class="CSSTableGenerator">
    		<tr>
    		<td width="6%" ><span class="estilo1">Socio</td>
    		<td width="18%"><span class="estilo1">Nombre</td>
        	<td width="12%"><span class="estilo1">Telefono</td>
    		<td width="18%"><span class="estilo1">email</td>
    		<td width="4%" ><span class="estilo1">CARGO</td>

    		</tr>
    		<?php
    		$bcac="";
    		if (!isset($_POST['cSocio'])  )  {
    			header("location: $redir?error_login=3");
    			exit;
    		}
    		if ($_POST['cSocio']== "") {
    			header("location: $redir?error_login=3");
    			exit;
    		}
    		$bcac=$_POST['cSocio'];

    		$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar datos");
    		$descriptor=mysql_select_db($BaseDeDatos);

    		if (!empty($bcac))	{
                $desde=5;
                $sql = "SELECT * FROM socios where nombre like '%".$bcac."%' and catego<>'NS' AND relacion<>'BA' order by nombre desc";
                $rs=  mysql_query($sql);
    		}
    		if (mysql_num_rows($rs) > 0) {
    			$registros=mysql_num_rows($rs);
		        $records_per_page = 10;
    			echo "Cantidad de registros Encontrados : ".$registros."<br>";
    			While($row=mysql_fetch_row($rs)){
                            $socprin=substr($row[0],-2);
                            echo "<tr> \n";
                            echo "<td><span class='estilo1'>$row[0]</td> \n";
                            echo "<td align='left'><span class='estilo1'>$row[1]</td> \n";
                            echo "<td><span class='estilo1'>$row[13]</td> \n";
                            echo "<td><span class='estilo1'>$row[43]</td> \n";
//                            echo '<td><a href="/factu/additem.php?bcac='.$row[0].'&nombresoc='.$row[1].'">CARGO.</a></td>';
                            echo '<td><a href="/cargos/additec.php?nrosoc='.$row[0].'&nomsoc='.$row[1].'">FACTURA.</a></td>';
                        ?>
    			</tr>
    			<?php
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

