<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<?php
if (isset($_SESSION['myusername'])){
    session_unset();
    session_destroy();
}
session_start();
$_SESSION['myusername']='';
$_SESSION['mypassword']='';
// $_SESSION[]='';
?>
<head>
   <title>San Felipe. Login</title>
   <link rel="stylesheet" type="text/css" href="total.css" />
   <meta name="google-site-verification" content="Ly1w1Lk4hDRJKvG996qVCpgzPNN2SP1BLuPcxnSlZYA" />
</head>

<body>
<!--
<div class="container">
  <div class="row">
    
    <h1 class="text-center"><a href="#myModal" role="button" class="btn btn-primary btn-lg" data-toggle="modal">Contact Us</a></h1>
    
  </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">We'd Love to Hear From You</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal col-sm-12">
          <div class="form-group"><label>Name</label><input class="form-control required" placeholder="Your name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text"></div>
          <div class="form-group"><label>Message</label><textarea class="form-control" placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea></div>
          <div class="form-group"><label>E-Mail</label><input class="form-control email" placeholder="email@you.com (so that we can contact you)" data-placement="top" data-trigger="manual" data-content="Must be a valid e-mail address (user@gmail.com)" type="text"></div>
          <div class="form-group"><label>Phone</label><input class="form-control phone" placeholder="999-999-9999" data-placement="top" data-trigger="manual" data-content="Must be a valid phone number (999-999-9999)" type="text"></div>
          <div class="form-group"><button type="submit" class="btn btn-success pull-right">Send It!</button> <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p></div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>
    </div>
  </div>
</div>

************************************************************************************** -->

<style>body {color: #BB0000; background-image: url(images/logo.png) }</style>
<div id="contenedor bg-success">
	<div class="row">
    	<div id="page-header">
        	<h1><a href="www.colegiosanfelipe.edu.ar">San Felipe. St.Philip</a></h1>
        	<p><span><style font-size: 12px;>  dise�o Gustavo De Poli</style></span></p>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-12 col-md-12">
        <table width="300" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#CCCDDD">
        	<tr>
            	<form name="validar" method="post" action="verificalog.php">
                	<td>
                		<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                        	<tr>
                           		<td colspan="3"><strong>Usuario Login </strong></td>
                        	</tr>
                        	<tr>
                            	<td width="78">Usuario </td>
                            	<td width="6">:</td>
                            	<td width="294"><input name="myusername" type="text" id="myusername"></td>
                        	</tr>
                        	<tr>
                            	<td>Password </td>
                            	<td>:</td>
                            	<td><input name="mypassword" type="password" id="mypassword"></td>
                        	</tr>
                        	<tr>
                           		<td>&nbsp;</td>
                            	<td>&nbsp;</td>
                            	<td><input type="submit" name="Submit" value="Login"></td>
                        	</tr>
                        </table>
                    </td>
                </form>
            </tr>
        </table>
    	</div>
    </div>
 </div>
</body>
</html>

