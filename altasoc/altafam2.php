<?php
session_start();
require ("../configuraciones/aut_verifica.inc.php");

$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
define("Empresa","San Felipe");
$conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error:Conexion Datos L10 altafam2");
$descriptor=mysql_select_db($BaseDeDatos,$conexion);

?>
<!-- ***************************************************************************************************************************** -->


<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo "".Empresa." Alta Alumnos"?></title>
    <!-- Bootstrap -->
    <link href="../boot/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../boot/js/bootstrap.min.js"></script>
<div class="container">
    <div class="row">
        <p> </p>
    </div>    
    <div class="row">
        <div class="col-md-4">
            <h1><?php echo "".Empresa."";?></h1>
        </div>
        <div class="col-md-4">
            <h2>Alta Alumnos<span><?php echo $vsocio2; ?></span> </h2>       
        </div>
    </div>
         
    <form role="form" id="altafam2" class="form-horizontal" action="grabafam2.php" method="POST">


<!--  ****************************************************************************************************************** -->

<?php
$buscar="Select socio,nombre from socios WHERE right(socio,2)='00' and catego<>'NS' AND relacion<>'BA' and nombre<>'' order by nombre asc";    
$res = mysql_query($buscar);
    if (mysql_num_rows($res) > 0){
        $combobit="<select class='form-control' id='cConcep' name='cConcep'>";
?>
    <div class="form-group">            
        <label class="control-label col-xs-3" for="cConcep"> Socio Titular</label>    
        <div class="col-xs-6">
<?php
        While($row=mysql_fetch_row($res)){  
            $combobit .="\r\n<option value='".$row['0']."'>".substr($row['1'],0,30)."</option>"; //concatenamos el los options para luego ser insertado en el HTML
        }
        $combobit.="\r\n</select>";
    }
    echo $combobit;
?>
        </div>
    </div>
<!--  ************************************************************************************************************************ -->
        
    <div class="form-group">
        <label class="control-label col-xs-3" for="cConcep">Nro.Socio</label>
        <div class="col-xs-3">        
            <input type="text" class="form-control" id="cConcep" name="cConcep" value="<?php echo $cConcep; ?>" placeholder="<?php echo $cConcep; ?>" disabled>                     
        </div>
    </div>
    
    <?php $vnombre=$cConcep;?>
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vnombre"> Apellido y Nombre</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" id="vnombre" name="vnombre" placeholder= "<?php echo $vnombre; ?>" value="<?php echo $vnombre; ?>">
        </div>
    </div>

    <div class="form-group">                     
        <label class="control-label col-xs-3" for="sel1">Sexo / Genero</label>
        <div class="col-xs-6">
        <select class="form-control" id="vsexo" name="vsexo" >
            <?php
            $generos= array('Femenino','Masculino','Otros');
            
            for ($i=0; $i<sizeof($generos); $i++){
                if ($generos[$i]==$genderRadios){
                    echo "<option value='$i' selected='selected'>". $generos[$i] .'</option>';
                }else{
                    echo "<option value='$i'>". $generos[$i] . '</option>';                 
                }
            }
            echo '</select>';
            ?>
        </select>
        </div>
    </div>
    
<!--   
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vtelefono"> Tel./ Cel.</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" id="vtel" name="vtelefono" placeholder= "<?php echo $vtelefono; ?>" value="<?php echo $vtelefono; ?>" >
        </div>
    </div>

    <div class="form-group">            
        <label class="control-label col-xs-3" for="vemail"> E - Mail /Correo Electronico</label>
        <div class="col-xs-6">
            <input type="email" class="form-control" id="vemail" name="vemail" placeholder= "<?php echo $vemail; ?>" value="<?php echo $vemail; ?>">
        </div>
    </div>
    
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vcumple"> Fecha Nacimiento </label>
        <div class="col-xs-6">
            <input type="date" class="form-control" id="vcumple" name="vcumple" placeholder= "<?php echo $vcumple; ?>" value="<?php echo $vcumple; ?>" >
        </div>
    </div>
    
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vdireccion"> Domicilio</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" id="vdireccion" name="vdireccion" placeholder= "<?php echo $vdireccion; ?>" value="<?php echo $vdireccion; ?>" >
        </div>
    </div>
        
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vlocalidad"> Localidad / Cod.Pos. </label>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="vlocalidad" name="vlocalidad" placeholder= "<?php echo $vlocalidad; ?>" value="<?php echo $vlocalidad; ?>" >
        </div>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="vcodpos" name="vcodpos" placeholder= "<?php echo $vcodpos; ?>" value="<?php echo $vcodpos; ?>" >
        </div>
    </div>            
  
    <div class="form-group">
        <label class="control-label col-xs-3" for="vtpodoc"> Tpo y Nro. Doc.</label>
        <div class="col-xs-3">        
            <input type="text" class="form-control" id="vtipodoc" name="vtipodoc" placeholder="<?php echo $vtipodoc; ?>" value="<?php echo $vtipodoc; ?>" >                     
        </div>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="vnrodoc" name="vnumero" placeholder= "<?php echo $vnumero; ?>" value="<?php echo $vnumero; ?>">
        </div>
    </div>
-->
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vingreso"> F.Ingreso - Antig.</label>
        <div class="col-xs-3">
            <input type="date" class="form-control" id="vingreso" name="vingreso" placeholder= "<?php echo $vingreso; ?>" value="<?php echo $vingreso; ?>" >
        </div>
        <?php
         //$antiguedad= today();
        ?>
        <div class="col-xs-3">
            <input type="text" class="form-control" id="vantiguedad" name="vantiguedad" placeholder="<?php echo $vantiguedad; ?>" disabled>
        </div>
    </div>
<!-- ******************************************************************************************************************* -->
    <?php
    $grado="Select codconc,descrip from conceptos WHERE activo='S' and escuota='S' order by descrip asc";    
    $resgrado = mysql_query($grado);
    if (mysql_num_rows($resgrado) > 0){
        $combobitgrado="<select class='form-control' id='cGrado' name='cGrado'>";
    ?>
    <div class="form-group">            
        <label class="control-label col-xs-3" for="cGrado"> Grado:</label>    
        <div class="col-xs-6">
        <?php
            While($row=mysql_fetch_row($resgrado)){  
                $combobitgrado .="\r\n<option value='".$row['0']."'>".substr($row['1'],0,30)."</option>"; //concatenamos el los options para luego ser insertado en el HTML
            }
            $combobitgrado.="\r\n</select>";
    }
    echo $combobitgrado;
    ?>
        </div>
    </div>

    <div class="form-group">            
        <label class="control-label col-xs-3" for="vcatego"> Categoria</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" id="vcatego" name="vcatego" placeholder= "<?php echo $vcatego; ?>" value="<?php echo $vcatego; ?>" >
        </div>
    </div>


<!-- ******************************************************************************************************************* -->
  
    <div class="form-group">            
        <label class="control-label col-xs-3" for="vsubcatego"> Estado</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" id="vsubcatego" name="vsubcatego" placeholder= "<?php echo $vsubcatego; ?>" value="<?php echo $vsubcatego; ?>" >
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-9">
            <input type="submit" class="btn btn-primary" value="Guardar">
            <input type="reset"  class="btn btn-default" value="Limpiar">
        </div>
    </div>
</form>
    
<a href="http://athome65.dyndns.org/">by Terco 2009</a>
</div>
</body>
</html>
