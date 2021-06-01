<?php
echo " session iniciada....   ";
session_start();
header("Location:http://intranet/index.html");
/*
if ( !isset($_POST['user'])) {header("location:http://instranet/index.html")
else { $login=$_POST['user'] };

echo "paso a controlar pass  ";
if ( !isset($_POST['pass']) ){header("location:http://instranet/index.html")
else {$password=$_POST['pass'] };

echo "controlando maca 123456..    ";
if (($login=='maca') && ($password !='123456')) {
    session_start();
    header("Location:http://instranet/index.html");
}else {
    header("Location:http://instranet/login.php");}
*/
?>
