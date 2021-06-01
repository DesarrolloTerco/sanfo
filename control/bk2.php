<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>San Felipe. Menu</title>
    <!-- Bootstrap -->
    <link href="../boot/css/bootstrap.min.css" rel="stylesheet">  
    <!-- <link href="../boot/css/bootstrap.css" rel="stylesheet">   -->
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
<!-- <style>body {color: #BB0000; background-image: url(images/fondo.png) }</style> -->

<div class="container bg-success">
   <h3><a href="www.colegiosanfelipe.edu.ar">San Felipe. Control de Becas. Sistemas Administrativos  </a></h3>
   <nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
         <span class="sr-only">Desplegar navegación</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">San Felipe</a>
   </div>

<div class="jumbotron text-center">
  <h3>Colegio San Felipe</h3>
  <p> - Proceso de Backup de Tablas del sistema - </p>
</div>

<div class="container">

<?php 
/**
 * This file contains the Backup_Database class wich performs
 * a partial or complete backup of any given MySQL database
 * @author Daniel López Azaña <http://www.azanweb.com-->
 * @version 1.0
 */

// Report all errors
error_reporting(E_ALL);

/**
 * Define database parameters here
 */
define("DB_USER", 'root');
define("DB_PASSWORD", 't7jm33p');
define("DB_NAME", 'colegiosf');
define("DB_HOST", 'localhost');
define("OUTPUT_DIR", 'bksf');
define("TABLES", '*');

/**
 * Instantiate Backup_Database and perform backup
 */
$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$status = $backupDatabase->backupTables(TABLES, OUTPUT_DIR) ? 'OK' : 'KO';

echo "Resultado del Backup: ".$status;
print "<meta http-equiv=Refresh content=\"5 ; url=../menu2.php\">";

/**
 * The Backup_Database class
 */
class Backup_Database {
    var $host = '';
    var $username = '';
    var $passwd = '';
    var $dbName = '';
    var $charset = '';
    function Backup_Database($host, $username, $passwd, $dbName, $charset = 'utf8')
    {
        $this->host     = $host;
        $this->username = $username;
        $this->passwd   = $passwd;
        $this->dbName   = $dbName;
        $this->charset  = $charset;

        $this->initializeDatabase();
    }

    protected function initializeDatabase()
    {
        $conn = mysql_connect($this->host, $this->username, $this->passwd);
        mysql_select_db($this->dbName, $conn);
        if (! mysql_set_charset ($this->charset, $conn))
        {
            mysql_query('SET NAMES '.$this->charset);
        }
    }

    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'
     * @param string $tables
     */
    public function backupTables($tables = '*', $outputDir = '.')
    
    {
        try
        {
            /**
            * Tables to export
            */
            if($tables == '*')
            {
                $tables = array();
                $result = mysql_query('SHOW TABLES');
                while($row = mysql_fetch_row($result))
                {
                    $tables[] = $row[0];
                }
            }
            else
            {
                $tables = is_array($tables) ? $tables : explode(',',$tables);
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.";\n\n";
            $sql .= 'USE '.$this->dbName.";\n\n";

            /**
            * Iterate tables
            */
            foreach($tables as $table)
            {
                echo "  Haciendo Backup de : ".$table." table...<br>";

                $result = mysql_query('SELECT * FROM '.$table);
                $numFields = mysql_num_fields($result);

                $sql .= 'DROP TABLE IF EXISTS '.$table.';';
                $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
                $sql.= "\n\n".$row2[1].";\n\n";
                

                for ($i = 0; $i < $numFields; $i++) 
                {
                    while($row = mysql_fetch_row($result))
                    {
                        $sql .= 'INSERT INTO '.$table.' VALUES(';

                        for($j=0; $j<$numFields; $j++) 
                        {
                            $row[$j] = addslashes($row[$j]);
                            //$row[$j] = preg_replace("\n","\\n",$row[$j]);
                            if (isset($row[$j]))
                            {
                                $sql .= '"'.$row[$j].'"' ;

                            }
                            else
                            {
                                $sql.= '""';
                            }

                            if ($j < ($numFields-1))
                            {
                                $sql .= ',';
                            }
                        }

                        $sql.= ");\n";
                    }
                }

                $sql.="\n\n\n";

                //echo "<br> echo 127 ".$sql."<br>";

                echo " OK" . "";
            }
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }
        echo  "<br> Directorio de Salida es: ".$outputDir."<br>";
        return $this->saveFile($sql, $outputDir);
    }

    /**
     * Save SQL to file
     * @param string $sql
     */
    protected function saveFile(&$sql, $outputDir = '.')
    {
        if (!$sql) return false;

        try
        {
            $handle = fopen($outputDir.'/db-backup-'.$this->dbName.'-'.date("Ymd-His", time()).'.sql','w+');
            fwrite($handle, $sql);
            fclose($handle);

        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }

        return true;
    }
}

?>

</div>
</body>
</html>
