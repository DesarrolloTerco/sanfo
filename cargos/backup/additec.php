<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<style>
        table tr:hover {
        background: #CCFF66;}
</style>   
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<TITLE>Agrega Conceptos a Socio</TITLE>
<script type="text/javascript" src="view.js"></script>
<link rel="stylesheet" href="botones.css" type="text/css">

<?php

require("../configuraciones/config.php");
$conexion = mysql_connect($Servidor,$Usuario,$Password) or die("Error:No Conecta datos");
$descriptor=mysql_select_db($BaseDeDatos,$conexion);

//require_once("../conecta.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
  // chequear si se llama directo al script.
if ($_SERVER['HTTP_REFERER'] == " "){
    die ("<b><center>Error cod.:1 - Acceso incorrecto! -- <br><br><a href='../index.php'>Click aqui para validarse</a></center></b>");
    exit;
}
if (!isset($_POST['accion'])){
    $accion="agrega";
}Else {
    $accion=$_POST['accion'];
}
if (!isset($_POST['nrosoc'])){$nrosoc="Cliente Contado ";} else {
    $nrosoc=$_POST['nrosoc'];
    echo "nro de socio: ".$nrosoc."<br>";
    $_SESSION['nrosoc']=$_POST['nrosoc'];
}
if (!isset($_POST['nomsoc'])){$nomsoc="Cliente Contado ";} else {$nomsoc=$_POST['nomsoc'];}  

if (!isset($_SESSION['bcac'])  )  {
    $bcac="Sin Identificar";
}else{
    $bcac=$_SESSION['bcac'];
    
}
if (!isset($_SESSION['nombresoc'])  )  {
    $nombresoc="Sin Identificar";
}else{
    $nombresoc=$_SESSION['nombresoc'];
}  
  
switch ($accion) {
    case 'agrega';
    case 'final' ;
    case 'cancela';       
}    

?>

</head>
<html>
<body>
<div id="form_container">
    <h1><a aling='center'>C.V.S.I. - Carga de Venta al Contado a Socios </a></h1>
    <form id="form_634721" class="appnitro"  method="GET" action="writeitec.php">
        <div class="form_description">
            <?php 
            
                echo "<p>Agregar Conceptos de Facturacion DE CORRECCION !!. </p>".$_POST['nomsoc'];
            ?>
	</div>
        <?php
        $nrosoc=$_GET['nrosoc'];
        $nomsoc=$_GET['nomsoc'];        
        $buscar="Select id,codconc,descrip,valor from conceptos where activo='S' order by descrip asc";
        $res = mysql_query($buscar);
        if (mysql_num_rows($res) > 0){
            $combobit ="<select name='cConcep'>";
            $combobit2="<select name='cConcep2'>";
            $combobit3="<select name='cConcep3'>";
            $combobit4="<select name='cConcep4'>";
            $combobit5="<select name='cConcep5'>";
            While($row=mysql_fetch_row($res)){  
                $combobit .="\r\n<option value='".$row['1']."'>".substr($row['2'],0,30)."   -         $".$row['3']."</option>";
                $combobit2.="\r\n<option value='".$row['1']."'>".substr($row['2'],0,30)."   -         $".$row['3']."</option>";                
                $combobit3.="\r\n<option value='".$row['1']."'>".substr($row['2'],0,30)."   -         $".$row['3']."</option>";
                $combobit4.="\r\n<option value='".$row['1']."'>".substr($row['2'],0,30)."   -         $".$row['3']."</option>";
                $combobit5.="\r\n<option value='".$row['1']."'>".substr($row['2'],0,30)."   -         $".$row['3']."</option>";                
                }
            $combobit.="\r\n</select>";
            $combobit2.="\r\n</select>";
            $combobit3.="\r\n</select>";
            $combobit4.="\r\n</select>";
            $combobit5.="\r\n</select>";            
        }      
        
        $xcontado= "Select sum(importe*cantidad) from contado " ;
        $xresuconta= mysql_query($xcontado) or die("El contado No existe".mysql_err() );
        While($rowc=mysql_fetch_row($xresuconta)){
            echo "<h2>Suma De Conceptos a Facturar: ".number_format($rowc[0],2)."</h2> \n";
        }
        ?>
               
        <table border="1" align="center" cellpadding="3" cellspacing="0" >
        <caption align="top"> Venta Contado al Socio <?php echo " ".$nrosoc." - ".$nomsoc." "; ?></caption>
        <tr>
            <td width="10%" align="center">ID</td>            
            <td width="10%" align="center">Concepto</td>
            <td width="35%" align="center">Descripcion</td>            
            <td width="10%" align="center">Cantidad</td>
            <td width="15%" align="center">Precio U. </td>
            <td width="35%" align="center"> Total  </td>            
            <td width="25%" align="center">Eliminar</td>            
        </tr>                        
        <?php
//        require("../configuraciones/config.php");
//        $conexion = mysql_connect($Servidor,$Usuario,$Password) or die("Error:No Conecta datos");
//        $descriptor=mysql_select_db($BaseDeDatos,$conexion);
            
        $xcontado= "Select id,concepto, cantidad, importe, (importe*cantidad), descri from contado order by id asc" ;
        $xresuconta= mysql_query($xcontado) or die("El contado No existe".mysql_err() );
        While($rowc=mysql_fetch_row($xresuconta)){
            echo "<tr> \n";
            echo "<td>$rowc[0]</td> \n";
            echo "<td>$rowc[1]</td> \n";
            echo "<td>$rowc[5]</td> \n";            
            echo "<td>$rowc[2]</td> \n";
            echo "<td align='right'>$rowc[3]</td> \n";
            echo "<td align='right'>".number_format($rowc[4],2)."</td> \n";
            echo '<td><a href="delitem.php?vNumDoc='.$rowc[0].'&nrosoc='.$nrosoc.'&nomsoc='.$nomsoc.'" > Delete </a></td>'; 
        }
        echo "</tr> \n";
        ?> 
        
        </table>
        
        <div>
            <br>
                
            <br>    
        </div>
        
        <table border="1" align="center" cellpadding="3" cellspacing="0" >
            <tr>
        	<td width="70%">Concepto</td>
         	<td width="30%">Cantidad</td>
            </tr>
            <tr>
                <td><?php echo $combobit; ?> </td>
                <td><input id="canti1" name="canti1" class="element text medium" type="text" maxlength="10" value="0.00"/></td>                
            </tr>
            <tr>
                <td><?php echo $combobit2; ?> </td>
                <td><input id="canti2" name="canti2" class="element text medium" type="text" maxlength="10" value="0.00"/></td>                                    
            </tr>
            <tr>
                <td><?php echo $combobit3; ?> </td>
                <td><input id="canti3" name="canti3" class="element text medium" type="text" maxlength="10" value="0.00"/></td>                                    
            </tr>
            <tr>
                <td><?php echo $combobit4; ?> </td>
                <td><input id="canti4" name="canti4" class="element text medium" type="text" maxlength="10" value="0.00"/></td>                                    
            </tr>
            <tr>
                <td><?php echo $combobit5; ?> </td>
                <td><input id="canti5" name="canti5" class="element text medium" type="text" maxlength="10" value="0.00"/></td>                                    
            </tr>                
        </table>
     
	<div id="footer">
            Generado by Terco <a href="http://terco2009.blogspot.com">GDePoli</a>
	</div>
      
<!--        <img id="bottom" src="bottom.png" alt="">   -->
        <HR width=100% size=3 style="color: #0056b2;" align="center">
 
    </table>

    
    <br>
        
    </br>
    <table align="center">
        <tr>
            <td><input type="hidden" name="nrosoc" value="<?php echo $nrosoc; ?>" /></td>
            <td><input type="hidden" name="nomsoc" value="<?php echo $nomsoc; ?>" /></td>  
        </tr>
        <tr>
        <td><input type="submit" name="agrega"  value="Agrega" id="boton3" /></td>
        <td><input type="submit" name="cancela" value="Menu" id="boton3"/></td>
        </tr>
        </table> 
    </table>

</form>            
</div>
<?php
/*
echo "Socio    :".$nrosoc."<br>";
echo "Nombre   :".$nomsoc."<br>";
echo "Cantidad :".$element_1."<br>";
echo "Seleccion:".$cConcep;
echo $."<br>";
 */
?>
</body>
</html>