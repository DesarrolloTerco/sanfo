<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../boot/css/bootstrap.min.css" rel="stylesheet">  
    <title>Backup de La Base de Datos</title>
</head>
<body>
<div class="container" style="margin-top:50px;">
<button class="btn btn-info" data-togglr="modal" data-tagert="#aguarde">
Aguarde Procesando
</button>
</div>

<script src="https://code.jquery.com/jquery.js"></script>
<scripr src="dist/js/bootstrap.min.js"></scripr>

<div class="modal fade" id="aguarde" tabindex="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dissmiss="modal" aria-hidden="true">&times;</button>
                <h4> Procesando Aplicaciones automaticas al Socios:</h4>
            </div>
            <div class="modal-body">
                aka ba el cuerpo
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>  

        </div>
    </div>
</div>
</body>
</html>



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
define("DB_NAME", 'club');
define("DB_HOST", 'localhost');
define("OUTPUT_DIR", 'bkcvsi');
define("TABLES", '*');

/**
 * Instantiate Backup_Database and perform backup
 */
$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$status = $backupDatabase->backupTables(TABLES, OUTPUT_DIR) ? 'OK' : 'KO';

echo "Backup result: ".$status;

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
                echo "Backing up ".$table." table...<br>";

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

