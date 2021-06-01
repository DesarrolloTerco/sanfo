<?php
session_start();
require ("../configuraciones/aut_verifica.inc.php");
$url = explode("?",$_SERVER['HTTP_REFERER']);
$pag_referida=$url[0];
$redir=$pag_referida;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sanfelipe - Alta de Alumnos</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
</head>

<body id="main_body" >

	<img id="top" src="top.png" alt="">
	<div id="form_container">

		<h1><a>San Felipe. - Alta de Alumnos</a></h1>
		<form id="form_275757" class="appnitro"  method="POST" action="/altasoc/grabafam.php">
			<div class="form_description">
			<h2>San Felipe. - Alta de Alumnos</h2>
			<p>Ingreso de Datos de Alumnos.</p>
		</div>
		<ul >

		<li id="li_10" >
		<label class="description" for="vnrosocio">Socio Princ.</label>
		<div>
    <?php
      require("../configuraciones/config.php");
      $conexion = mysql_connect($Servidor,$Usuario,$Password) or die("Error:No Conecta datos");
      $descriptor=mysql_select_db($BaseDeDatos,$conexion);
      $buscar="Select socio,nombre from socios WHERE right(socio,2)='00' and catego<>'NS' AND relacion<>'BA' and nombre<>'' order by nombre asc";      
      $res = mysql_query($buscar);
      if (mysql_num_rows($res) > 0){
        $combobit="<select name='cConcep'>";
        While($row=mysql_fetch_row($res)){  
          $combobit .="\r\n<option value='".$row['0']."'>".substr($row['1'],0,30)."</option>"; //concatenamos el los options para luego ser insertado en el HTML
        }
        $combobit.="\r\n</select>";
      }
      echo $combobit;
      ?>        
 
		</div>
		</li>

        <div class="right">
		<label class="description" for="catego">Categoria</label>
		<span>
      <select class="element select medium" id="catego" name="catego">
        <option value = "ES">Cuota Esposa</option>
        <option value = "HC">Cta.Hijo Cadete (18-20)</option>
        <option value = "HI">Cta.Hijo Infantil (06-11)</option>
        <option value = "HM">Cta.Hijo Menor (13-17)</option>
        <option value = "VI">Vitalicio</option>        
      </select>            
		</span>
    </div>    

		<li id="li_1" >
		<label class="description" for="vnombre">Nombre </label>
		<div>
			<input id="vnombre" name="vnombre" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>

		<li id="li_2" >
		<label class="description" for="vapellido">Apellido </label>
		<div>
			<input id="vapellido" name="vapellido" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>


		<li id="li_12" >
		<label class="description" for="element_12">Sexo </label>
		<span>
			<input id="vsexo1" name="vsexo" class="element radio" type="radio" value="1" />
			<label class="choice" for="vsexo1">Femenino</label>
			<input id="vsexo2" name="vsexo" class="element radio" type="radio" value="2" />
			<label class="choice" for="vsexo2">Masculino</label>
		</span>
		</li>
    
    <div class="right">
		<label class="description" for="estcivil">Estado Civil </label>
		<span>
      <select class="element select medium" id="estcivil" name="estcivil">
			  <option value = "        " selected="selected"></option>
        <option value = "1">Casado     </option>
        <option value = "2">Soltero    </option>
        <option value = "3">Viudo      </option>
        <option value = "4">Divorciado </option>
        <option value = "5">Otros      </option>
      </select>            
		</span>
    </div>
    

		<li id="li_11" >
		<label class="description" for="element_11">Fecha de Ingreso al Club </label>

		<span>
			<input id="element_11_2" name="element_11_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_11_2">DD</label>
		</span>
		<span>
			<input id="element_11_1" name="element_11_1" class="element text" size="2" maxlength="2" value="" type="text">
			<label for="element_11_1">MM</label>
		</span>

		<span>
	 		<input id="element_11_3" name="element_11_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_11_3">YYYY</label>
		</span>

		<span id="calendar_11">
			<img id="cal_img_11" class="datepicker" src="calendar.gif" alt="Pick a date.">
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_11_3",
			baseField    : "element_11",
			displayArea  : "calendar_11",
			button		 : "cal_img_11",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectEuropeDate
			});
		</script>
		</li>
		<li id="li_3" >
		<label class="description" for="vdocu">Documento de Identidad. Tipo y Numero </label>
		<div>
			<input id="vdocu" name="vdocu" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>

		<li id="li_4" >
		<label class="description" for="domicilio">Domicilio </label>

		<div>
			<input id="vcalle" name="vcalle" class="element text large" value="" type="text">
			<label for="vcalle">Barrio / Calles /</label>
		</div>

		<div>
			<input id="vcalle2" name="vcalle2" class="element text large" value="" type="text">
			<label for="calle2">Calle continuacion </label>
		</div>

		<div class="left">
			<input id="vciudad" name="vciudad" class="element text medium" value="" type="text">
			<label for="vciudad">Ciudad</label>
		</div>

		<div class="right">
			<input id="vregion" name="vregion" class="element text medium" value="" type="text">
			<label for="vregion">Provincia / Region</label>
		</div>

		<div class="left">
			<input id="vpostal" name="vpostal" class="element text medium" maxlength="15" value="" type="text">
			<label for="vpostal">Cod.Postal </label>
		</div>

		<div class="right">
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
		<label for="vpais">Pais </label>
   	</div>
	</li>
    <li id="li_5" >
        <label class="description" for="vemail">Email </label>
            <div>
		      <input id="vemail" name="vemail" class="element text medium" type="text" maxlength="255" value=""/>
            </div>
		</li>
        <li id="li_6" >
            <label class="description" for="vlinea">Telefono Linea</label>
    		<div>
	      		<input id="vlinea" name="vlinea" class="element text medium" type="text" maxlength="255" value=""/>
	       	</div>
		</li>
        <li id="li_8" >
            <label class="description" for="vlinea2">Telefono Oficina / Otro</label>
    		<div>
	       		<input id="vlinea2" name="vlinea2" class="element text medium" type="text" maxlength="255" value=""/>
    		</div>
		</li>
        <li id="li_9" >
    		<label class="description" for="vlinea3">Telefono Celular        </label>
            <div>
                <input id="vlinea3" name="vlinea3" class="element text medium" type="text" maxlength="255" value=""/>
            </div>
		</li>
        <li id="li_7" >
            <label class="description" for="vnacio">Fecha de Nacimiento </label>
    		<span>
	   		<input id="vnacio1" name="vnacio1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="vnacio1">DD</label>
            </span>
    		<span>
			<input id="vnacio2" name="vnacio2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="vnacio2">MM</label>
            </span>
            <span>
            <input id="vnacio3" name="vnacio3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="vnacio3">YYYY</label>
            </span>

    		<span id="calendar_7">
	       		<img id="cal_img_7" class="datepicker" src="images/calendar.gif" alt="Pick a date.">
    		</span>
    		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_7_3",
			baseField    : "element_7",
			displayArea  : "calendar_7",
			button		 : "cal_img_7",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectEuropeDate
			});
	       	</script>
		</li>
		<li class="buttons">
            <input type="hidden" name="form_id" value="275757" />
    		<input id="saveForm" class="button_text" type="submit" name="submit" value="Grabar" />
        </li>
		</ul>
		</form>
		<div id="footer">
			Generado by Terco <a href="http://terco2009.blogspot.com">Terco 2011</a>
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
