<?php
require("../configuraciones/config.php");
$conexion = mysql_connect($Servidor,$Usuario,$Password) or die("Error:No Conecta datos");
$descriptor=mysql_select_db($BaseDeDatos,$conexion);
//require("rutinas.php");    
    
    if ( !isset($_GET['canti1'])  ) {$canti1=0;}else{$canti1=$_GET['canti1'];}
    if ( !isset($_GET['canti2'])  ) {$canti2=0;}else{$canti2=$_GET['canti2'];}
    if ( !isset($_GET['canti3'])  ) {$canti3=0;}else{$canti3=$_GET['canti3'];}
    if ( !isset($_GET['canti4'])  ) {$canti4=0;}else{$canti4=$_GET['canti4'];}
    if ( !isset($_GET['canti5'])  ) {$canti5=0;}else{$canti5=$_GET['canti5'];}
    if ( !isset($_GET['cConcep'])  ) {$cConcep='xx';}else{$cConcep=$_GET['cConcep'];}
    if ( !isset($_GET['cConcep2'])  ) {$cConcep2='xx';}else{$cConcep2=$_GET['cConcep2'];}
    if ( !isset($_GET['cConcep3'])  ) {$cConcep3='xx';}else{$cConcep3=$_GET['cConcep3'];}
    if ( !isset($_GET['cConcep4'])  ) {$cConcep4='xx';}else{$cConcep4=$_GET['cConcep4'];}
    if ( !isset($_GET['cConcep5'])  ) {$cConcep5='xx';}else{$cConcep5=$_GET['cConcep5'];}

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
        // echo "lkdmfñlsknmvblsdnvlkdnldnkn nsjndvsjnvpsjfnv lñkjsnfblkjsnl lkjnvblks vlkdsnm fv    :".$nomsoc."<br>";
    }
    
    

if ($_GET['agrega']){    
    $fnhoy = time();
    $fdhoy=date('Y-m-d',$fnhoy);

    if ($canti1<>0){
        // echo "el concepto a buscar es: ....... ".$cConcep."<br>";
        $xConcepto = mysql_query( "Select * from conceptos where codconc = '$cConcep' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {
                $concef = $row['1'];
                $dDescri= $row['2'];
                $dValor = $row['3'];            
                $importe=round($canti1*$dValor,2);
            }
        }
        $sqlC="INSERT INTO contado (socio,concepto,descri,cantidad,importe,total,fecha)";
        $sqlC.=" VALUES ('$_GET[nrosoc]','$_GET[cConcep]','$dDescri','$canti1','$dValor','$importe','$fdhoy' )";
        $result=mysql_query($sqlC) or die("error 1".mysql_error() );
    
    }
    if ($canti2<>0){
        $xConcepto = mysql_query( "Select * from conceptos where codconc = '$cConcep2' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {
            $concef = $row['1'];
            $dDescri= $row['2'];
            $dValor = $row['3'];            
            $importe=round($canti2*$dValor,2);
            }
        }
        $sqlC="INSERT INTO contado (socio,concepto,descri,cantidad,importe,total,fecha)";
        $sqlC.=" VALUES ('$_GET[nrosoc]','$_GET[cConcep2]','$dDescri','$canti2','$dValor','$importe','$fdhoy' )";
        $result=mysql_query($sqlC) or die("error 1".mysql_error() );
    }
    if ($canti3<>0){
        $xConcepto = mysql_query( "Select * from conceptos where codconc = '$cConcep3' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {
            $concef = $row['1'];
            $dDescri= $row['2'];
            $dValor = $row['3'];            
            $importe=round($canti3*$dValor,2);
            }
        }
        $sqlC="INSERT INTO contado (socio,concepto,descri,cantidad,importe,total,fecha)";
        $sqlC.=" VALUES ('$_GET[nrosoc]','$_GET[cConcep3]','$dDescri','$canti3','$dValor','$importe','$fdhoy' )";
        $result=mysql_query($sqlC) or die("error 1".mysql_error() );
    }
    if ($canti4<>0){
        $xConcepto = mysql_query( "Select * from conceptos where CODCONC = '$cConcep4' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {        
            $concef = $row['1'];
            $dDescri= $row['2'];
            $dValor = $row['3'];            
            $importe=round($canti4*$dValor,2);
            }
        }
        $sqlC="INSERT INTO contado (socio,concepto,descri,cantidad,importe,total,fecha)";
        $sqlC.=" VALUES ('$_GET[nrosoc]','$_GET[cConcep4]','$dDescri','$canti4','$dValor','$importe','$fdhoy' )";
        $result=mysql_query($sqlC) or die("error 1".mysql_error() );
    }
    if ($canti5<>0){
        $xConcepto = mysql_query( "Select * from conceptos where codconc = '$cConcep5' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {
            $concef = $row['1'];
            $dDescri= $row['2'];
            $dValor = $row['3'];            
            $importe=round($canti5*$dValor,2);
            }
        }
        $sqlC="INSERT INTO contado (socio,concepto,descri,cantidad,importe,total,fecha)";
        $sqlC.=" VALUES ('$_GET[nrosoc]','$concef','$dDescri','$canti5','$dValor','$importe','$fdhoy' )";
        $result=mysql_query($sqlC) or die("error 1".mysql_error() );

    }

    echo "Final Socio: ".$nrosoc."<br>";
    echo "Final Nombre: ".$nomsoc."<br>";
    print "<meta http-equiv=Refresh content=\"1 ; url=additem.php?nrosoc=$nrosoc&nomsoc=$nomsoc\">";

}

/* ************************************************************************************************************************************** */
/* ************************************************************************************************************************************** */

if ($_GET['final']){
    $numfactu=0;
    $sql= "select * from ctrlnum where codigo='FCA'";
    $rs1= mysql_query($sql);
    While($row=mysql_fetch_row($rs1)){
        $numfactu=$row[2];
    }
    mysql_free_result($rs1);
    
    $numerador=0;
    $sql= "select * from ctrlnum where codigo='OPE'";
    $rs2= mysql_query($sql);
    While($row=mysql_fetch_row($rs2)){
        $numerador=$row[2];
    }
    mysql_free_result($rs2);  

    // $file='/var/www/html/club/recibos/'.substr($bcac,0,5).$numfactu;
    //$file='/xampp/htdocs/recibos/'.substr($bcac,0,5).$numfactu;
    //$file .= '.pdf';  
    //$pdf->Output($file, 'F');
//    $pdf->Output();  
// *****************************************************************************************************************************************
// *** Agrega Cabefac e Items   
    $paraelpe=time();
    $mesdehoy=date(Ym,$paraelpe);
    $periodo=substr($mesdehoy,2,4);
    
    $sqlinsertacdo= "insert into cabefac (fecha,tipodoc,numdoc,periodo,socio,importe,aplicado,saldo,leyenda) values
    ( curdate(),'FCA','$numfactu','$periodo','$nrosoc','$recibido','0','$recibido','Ajuste')";
    $inserta= mysql_query($sqlinsertacdo)  or die('Error #150' .mysql_error() );
  
    
    if ($canti1<>0){
        $xConcepto = mysql_query( "Select * from conceptos where codconc = '$cConcep' ");   
        if (mysql_num_rows($xConcepto) > 0){
            while ($row = mysql_fetch_row($xConcepto)) {
                $concef = $row['1'];
                $dDescri= $row['2'];
                $dValor = $row['3'];            
                $importe=round($canti1*$dValor,2);
            }
        }
 
        $sqlinserta= "insert into itemfac (socio,codigo,importe,periodo,fecha,nromov,codmov,numdoc,saldo,leyenda,pagado) values
        ('$nrosoc','$cConcep','$importe','$periodo',curdate(),'$numerador','FCA','$numfactu','$importe','$leyenda','0')";
        $inserta= mysql_query($sqlinserta) or die('Error #332 '.mysql_error() );        
    }
    
    
    
    ++$numfactu;
    ++$numerador;
    $ahora=date(Y-m-d,$paraelpe);
    $sqlfactu="UPDATE ctrlnum SET valor=$numfactu,fecha=$ahora WHERE codigo='FCA'";
    $updatefactu= mysql_query($sqlfactu) or die ("Problema Actualizando CtrlNum L.157");
    
    $sqlnum="UPDATE ctrlnum SET valor=$numerador,fecha=$ahora WHERE codigo='OPE'";
    $updatenume= mysql_query($sqlnum) or die ("Problema Actualizando CtrlNum L.160");
    
   
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
