<?php
require("../configuraciones/config.php");
$conexion = mysql_connect($Servidor,$Usuario,$Password) or die("Error:No Conecta datos Cargos Add");
$descriptor=mysql_select_db($BaseDeDatos,$conexion);
//require("rutinas.php");    
    
    if ( !isset($_GET['canti1'])  ) {$canti1=0;}else{$canti1=$_GET['canti1'];}
    if ( !isset($_GET['cConcep'])  ) {$cConcep='xx';}else{$cConcep=$_GET['cConcep'];}

    if ( !isset($_GET['nrosoc'])  ) {
        echo "No llego el nro de socio";
    }else{
        $nrosoc=$_GET['nrosoc'];
        $bcac=$_GET['nrosoc'];
    }
    if ( !isset($_GET['nomsoc'])  ) {
        echo "no llego el mobre del socio ";        
    }else{     
        $nomsoc=$_GET['nomsoc'];
        // echo "El nombre del Socio es.....:    :".$nomsoc."<br>";
    }

/* ************************************************************************************************************************************** */

if ($_GET['agrega']){
    
    $numfactu=0;
    $sql= "select * from ctrlnum where codigo='FAC'";
    $rs1= mysql_query($sql)or die("Error: Problemas nros FAC ".mysql_err());
    While($row=mysql_fetch_row($rs1)){
        $numfactu=$row[2];
    }
    mysql_free_result($rs1);
    
    $numerador=0;
    $sql= "select * from ctrlnum where codigo='OPE'";
    $rs2= mysql_query($sql) or die("Error: Problemas nros OPE ".mysql_err());
    While($row=mysql_fetch_row($rs2)) {
        $numerador=$row[2];
    }
    mysql_free_result($rs2);  

    $paraelpe=time();
    $mesdehoy=date(Ym,$paraelpe);
    $periodo=substr($mesdehoy,2,4);
    echo "Nro Fac   ".$numfactu."<br>";
    echo "Numerador ".$numerador."<br>";    

    if ($canti1<>0){
        $xConcepto = mysql_query( "Select * from conceptos where codconc = '$cConcep' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {
                $concef = $row['1'];
                $dDescri= $row['2'];
                $dValor = $row['3'];            
                $importe=round($canti1*$dValor,2);
            }
        
 
        $sqlinserta= "insert into itemfac (socio,codigo,importe,periodo,fecha,nromov,codmov,numdoc,saldo,leyenda,pagado) values
        ('$nrosoc','$cConcep','$importe','$periodo',curdate(),'$numerador','FAC','$numfactu','$importe','$leyenda','0')";
        $inserta= mysql_query($sqlinserta) or die('Error #332 '.mysql_error() );        
    
        $sqlinsertacdo= "insert into cabefac (fecha,tipodoc,numdoc,periodo,socio,importe,aplicado,saldo,leyenda) values
        ( curdate(),'FAC','$numfactu','$periodo','$nrosoc','$importe','0','$importe','Ajuste')";
        $inserta= mysql_query($sqlinsertacdo)  or die('Error #150' .mysql_error() );
        }
    }
    
    ++$numfactu;
    ++$numerador;
    
    echo "Nro Fac  +++ ".$numfactu."<br>";
    echo "Numerador ++ ".$numerador."<br>";    
    
    $ahora=date(Y-m-d,$paraelpe);
   
    $sqlnum="UPDATE ctrlnum SET valor=$numerador,fecha=$ahora WHERE codigo='OPE'";
    $updatenume= mysql_query($sqlnum) or die ("Problema Actualizando CtrlNum L.160".mysql_err());
    
    $sql_factu="UPDATE ctrlnum SET valor=$numfactu,fecha=$ahora WHERE codigo='FAC'";
    $updatefactu= mysql_query($sql_factu) or die ("Problema Actualizando CtrlNum L.157".mysql_err());
    
   
//    $ctrlNumero=actualiza_numer($numfactu,'REC');
//    $ctrlNumero=actualiza_numer($numerador,'OPE');

    print "<meta http-equiv=Refresh content=\"1 ; url=../menu2.php\">";        
}    
if ($_GET['cancela']){
//    echo "ak cacela y se va al menu";
    mysql_close($conexion) ;
    print "<meta http-equiv=Refresh content=\"1 ; url=../menu2.php\">";
}

?>
