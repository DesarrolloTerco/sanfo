<?
    /*  
  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	
	Autores: Pedro Obregón Mejías
			 Rubén D. Mancera Morán
			 Luis Ignacio Albacete
	
	Fecha Liberación del código: 1/10/2007
	Factusyn 2007 -- Murcia		 
	
	*/
	
  include("config.php"); 
  $conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar con la base de datos");
  $descriptor=mysql_select_db($BaseDeDatos,$conexion);
  //Parche variables PHP5
  require_once('variablesPHP5.php');
  $variablesPHP5 = new variablesPHP5();

//Seguridad para todas las páginas  
  require ("aut_verifica.inc.php");

$nivel_acceso=999;
  if ($nivel_acceso < $_SESSION['usuario_nivel']){
  header ("Location: $redir?error_login=5");
  exit;
}

?>
