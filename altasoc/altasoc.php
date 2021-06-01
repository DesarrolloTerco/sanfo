
<?php
session_start();
require ("../configuraciones/aut_verifica.inc.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
?>


<!-- ***************************************************************************************************************************** -->


<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>San Felipe Alta Responsables</title>
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
            <h1>San Felipe</h1>
        </div>
        <div class="col-md-4">
            <h2>Alta Responsables <span><?php echo $vsocio2; ?></span> </h2>       
        </div>
    </div>
         
    <form role="form" id="altasoc" class="form-horizontal" action="grabasoc.php" method="POST">

        <div class="form-group">            
            <label class="control-label col-xs-3" for="vnrosocio"> Nro. Familia</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vnrosocio" name="vnrosocio" placeholder= "<?php echo $vnrosocio; ?>" value="<?php echo $vnrosocio; ?>">
            </div>
        </div>

        <div class="form-group">            
            <label class="control-label col-xs-3" for="vnombre"> Nombre</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vnombre" name="vnombre" placeholder= "<?php echo $vnombre; ?>" value="<?php echo $vnombre; ?>">
            </div>
        </div>
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vapellido"> Apellido</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vapellido" name="vapellido" placeholder= "<?php echo $vapellido; ?>" value="<?php echo $vapellido; ?>">
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


        <div class="form-group">                     
            <label class="control-label col-xs-3" for="estcivil">Estado Civil</label>
            <div class="col-xs-6">
            <select class="form-control" id="estcivil" name="estcivil" >
                <?php
                $generos= array('Soltero','Casado','Divorciado','Separado','Concubinato','Viudo/a','Otro');
            
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

        <div class="form-group">            
            <label class="control-label col-xs-3" for="vdocu"> Tipo Documento</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vdocu" name="vdocu" placeholder= "<?php echo $vdocu; ?>" value="<?php echo $vdocu; ?>">
            </div>
        </div>                
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vnrodocu"> Nro Documento</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vnrodocu" name="vnrodocu" placeholder= "<?php echo $vnrodocu; ?>" value="<?php echo $vnrodocu; ?>">
            </div>
        </div>                        

        <div class="form-group">            
            <label class="control-label col-xs-3" for="vcalle"> Calle</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vcalle" name="vcalle" placeholder= "<?php echo $vcalle; ?>" value="<?php echo $vcalle; ?>">
            </div>
        </div>                        


        <div class="form-group">            
            <label class="control-label col-xs-3" for="vciudad"> Ciudad</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vciudad" name="vciudad" placeholder= "<?php echo $vciudad; ?>" value="<?php echo $vciudad; ?>">
            </div>
        </div>                                                
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vregion"> Provincia</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vregion" name="vregion" placeholder= "<?php echo $vregion; ?>" value="<?php echo $vregion; ?>">
            </div>
        </div>                                                
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vpostal"> Cod. Postal</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vpostal" name="vpostal" placeholder= "<?php echo $vpostal; ?>" value="<?php echo $vpostal; ?>">
            </div>
        </div>                                                                
        <div class="form-group">            
            <select class="element select medium" id="vpais" name="vpais">
            <option value="" selected="selected"></option>
            <option value="ARGENTINA" >Argentina</option>
            <option value="Asia     " >Asia</option>
            <option value="Brasil   " >Brasil</option>
            <option value="Canada   " >Canada</option>
            <option value="Chile    " >Chile</option>
            <option value="Colombia " >Colombia</option>
            <option value="Ecuador  " >Ecuador</option>
            <option value="EEUU     " >eeuu</option>
            <option value="Europa   " >Europa</option>
            <option value="Mexico   " >Mexico</option>
            <option value="Oceania  " >Oceania</option>
            <option value="Peru     " >Peru</option>
            <option value="Uruguay  " >Uruguay</option>
            <option value="Venezuela" >Venezuela</option>
            </select>
        </div>                                                                
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vlinea"> Telefono</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vlinea" name="vlinea" placeholder= "<?php echo $vlinea; ?>" value="<?php echo $vlinea; ?>">
            </div>
        </div>                                                                
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vlinea"> Tel.Oficina</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vlinea2" name="vlinea2" placeholder= "<?php echo $vlinea2; ?>" value="<?php echo $vlinea2; ?>">
            </div>
        </div>                                                                
        <div class="form-group">            
            <label class="control-label col-xs-3" for="vlinea3"> Celular</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" id="vlinea3" name="vlinea" placeholder= "<?php echo $vlinea3; ?>" value="<?php echo $vlinea3; ?>">
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
            <label class="control-label col-xs-3" for="vingre"> Fecha Ingreso </label>
            <div class="col-xs-6">
                <input type="date" class="form-control" id="vingre" name="vingre" placeholder= "<?php echo $vingre; ?>" value="<?php echo $vingre; ?>" >
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


