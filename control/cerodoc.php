<?php
session_start();
require ("../configuraciones/aut_verifica.inc.php");
require ("Log.class.php");
require("../varios/enviar.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <title>Anula Doc</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!--
<a data-toggle="modal" href="#example" class="btn btn-primary btn-large">Abrir ventana modal</a>
<div id="example" class="modal hide fade in" style="display: none;">
    <div class="modal-header">
        <a data-dismiss="modal" class="close">×</a>
        <h3>Cabecera de la ventana</h3>
     </div>
     <div class="modal-body">
         <h4>Texto de la ventana</h4>
        <p>Mas texto en la ventana.</p>                
    </div>
    <div class="modal-footer">
        <a href="index.html" class="btn btn-success">Guardar</a>
        <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
    </div>
</div>
-->


<?php
//echo "linea 10 <br>";

$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error Datos cerodoc");
$descriptor=mysql_select_db($BaseDeDatos,$conexion);

Function DepoAlert($tpM,$fuerteM,$textoM){
    if ($tpM ='B'){
        $classA="alert alert-success alert-dismissable";
    }elseif ($tpM='W') {
        $classA="alert alert-warning alert-dismissable";
    }elseif ($tpM='D') {
        $classA="alert alert-danger alert-dismissable";
    }else{
        $classA="alert alert-info alert-dismissable";
    }
    //echo $classA;
    //echo $aPantalla;
    ?>
    <div class="container-fuid">
        <div class="row">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class= " <?php echo $classA ; ?> ">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php echo $fuerteM; ?></strong><?php echo $textoM; ?>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        </div>
    </div>
    <?php
}

function LimpiaReg($tpodoc,$nrodoc,$Credito,$cSoc){
    /*
    echo "<br> En Funcion Docu y Numero = ".$tpodoc." / ".$nrodoc."<br>" ;
    echo "<br> el username es: ".$_SESSION['myusername']."<br>";
    echo "<br> La fecha a poner es: ".date( 'Y-m-d',time() )."<br>";
    echo "<br> La fecha a poner es: ".date( 'Y-m-d H:i:s',time() )."<br>";
    */
    $hoper=date( 'Y-m-d H:i:s',time() );
    $cUser= $_SESSION['myusername'];
    $fresu0="update cabefac set importe=0,aplicado=0,saldo=0,coper='$cUser',hoper='$hoper',entidad='Anulada' where tipodoc='$tpodoc' and numdoc='$nrodoc' ";
    $Aplicafresu0=mysql_query($fresu0) or die ("Error Anulando Documento ".mysql_error() ); 
    
    $aSald1="select * from saldos where socio='$cSoc'";
    $aSaldResu= mysql_query($aSald1) or die ("Error Buscando Saldos ".mysql_error() ); 
    If (mysql_num_rows($aSaldResu) > 0) {
		While( $row = mysql_fetch_row($aSaldResu)){        
        $aSaldImp = $row[2];
        $aSaldAnt = $row[3];
		}
	 }else{
		  $aSaldImp = 0;
        $aSaldAnt = 0;
	 }
    
    if ($tpdoc="FAC"){
		  //$fresu1="update saldos set importe=(importe-'$Credito'),saldoant=(saldoant-'$Credito') where socio='$cSoc' ";
		  $fresu1="update saldos set importe=(importe-'$Credito'),saldoant=(saldoant-'$aSaldAnt') where socio='$cSoc' ";
	 }
    if ($tpdoc=="REC"){ $fresu1="update saldos set importe=(importe+'$Credito'),saldoant=(saldoant-'$aSaldAnt') where socio='$cSoc' "; }
    if ($tpdoc=="NDB"){ $fresu1="update saldos set importe=(importe-'$Credito'),saldoant=(saldoant-'$aSaldAnt') where socio='$cSoc' "; }    
    if ($tpdoc=="NCR"){ $fresu1="update saldos set importe=(importe+'$Credito'),saldoant=(saldoant-'$aSaldAnt') where socio='$cSoc' "; }
    $aplicafresu1=mysql_query($fresu1) or die ("Error Ajustando Saldo ".mysql_error() );
    return true;
}

//*************************************************************************************************************

$tipodocuX=$_GET["tipodocu"];
$IdNumeroX=$_GET["IdNumero"];


If ($tipodocuX=="Factura"){
    $tipodocuZ="FAC";
}elseif ($tipodocuX=="Nota de Credito"){
    $tipodocuZ="NCR";
}elseif ($tipodocuX=="Intereses"){
    $tipodocuZ="INT";
}elseif ($tipodocuX=="Recibos"){
    $tipodocuZ="REC";
}elseif ($tipodocuX=="Debitos"){
    $tipodocuZ="NDB";
}

echo "tipodoc = ".$tipodocuZ."    numdoc = ".$IdNumeroX;
// $BuscaDoc = "select * from cabefac where tipodoc='$tipodocuZ' and numdoc='$IdNumeroX' and saldo<>0 ";
$BuscaDoc = "select * from cabefac where tipodoc='$tipodocuZ' and numdoc='$IdNumeroX' ";
$FoundDoc = mysql_query($BuscaDoc) ;
If (mysql_num_rows($FoundDoc) > 0) {
    While( $row = mysql_fetch_row($FoundDoc)){        
        if ($row[7]==0){
            $darvuelta=$row[6];
            $cSoc=$row[5];
            $xGood= LimpiaReg($tipodocuZ,$IdNumeroX,$darvuelta,$cSoc);
            //echo "<br> todo bien encontre el registro <br>".$row[7];
            DepoAlert('B','BIEN  ','   Documento Anulado Exitosamente');
            //echo '<script language="javascript">alert("Documento Anulado!!!!");</script>'; 
        }else{ 
            DepoAlert('W','ERROR !! ',' Imposible Anular Hay Recibos Aplicados');
            //echo "<br> Registro aplicado no puede bajar <br>".$row[7];
            //echo '<script language="javascript">alert("Documento Aplicado Imposible Anular");</script>'; 
        }
    }
}else{
    DepoAlert('D','ERROR !! ',' No Existe Documento Solicitado o se Encuentra Sin Saldo');
    //echo '<script language="javascript">alert("No se Encontro el Documento pedido");</script>'; 
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap-modal.js"></script>

</body>
</html>
<?php
print "<meta http-equiv=Refresh content=\"10 ; url=../menu2.php\">";                                          
?>




