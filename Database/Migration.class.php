<?php
namespace Database;

require_once("../Bootstrap/Model.class.php");

use Bootstrap\Model;
use Bootstrap\Database as DB;

class Migration extends Model {

    protected static $migrationSQL;

    function __construct()
    {
        echo "\033[036m MIGRATION ENGINE BY EMRE CAN CAKIROGLU COPYRIGHT 2019\n\n";
        echo "\33[033m Creating Migration Engine Constructor...\n";
        $status = DB::query("SELECT 1 FROM migrations LIMIT 1");
        

        if( !is_array($status) )
        {
            require_once("migrations.db.php");
            $migrationsTableSQL = createMigrationsTable();
            $insertMigrationTable = DB::query($migrationsTableSQL);

            if( $insertMigrationTable )
            {
                echo "Coludn't locate 'migrations' table. Created new one...\n";
            }
            else
            {
                echo "\033[031m ERROR! Can't find 'migrations' table and couldn't create one! Please check your configurations.\nABORTED!";
                exit;
            }
        }
        else
        {
            echo "\033[032m OK! 'migrations' table found. Proceeding...\n";
        }
    }

    public function getAllFiles()
    {
        echo "\033[033m Files inside directory:";

        $files = glob("Tables/*.db.php");
        print_r($files);

        return $files;
    }

    public function Start()
    {
        foreach( glob("Tables/*.class.php") as $filename )
        {
            require_once($filename);
        }
    }





    public function migrationsMigrate($fileNames)
    {
        if( !empty(self::$migrationSQL) )
        {
            $status = DB::query("INSERT INTO migrations (date, tableList, batch) VALUES (:date, :tableList, :batch)", [":date" => date("Y-m-d H:i:s"), ":tableList" => $fileNames, ":batch" => self::$migrationSQL]);
            if( $status !== false )
            {
                echo "\033[033m MIGRATION HAS BEEN COMPLETED SUCCESSFULLY. SEE YA LATER!\n";
                exit;
            }
            else if( $status == false )
            {
                echo "\033[031m FATAL ERROR! SYSTEM BROKEN. UnMigrate changes by hand before continue.";
                exit;
            }
        }
    }






    public function engineStart($name, $params)
    {
        /**
         * Check if table exists.
         */
        $check = DB::query("SELECT 1 FROM $name LIMIT 1");
        echo " \n---------------------------------------------\n";
        if( !is_array($check) )
        {
            echo "\033[032m Table '$name' not found. Table will be created...\n\n";

            $query[0] = "CREATE TABLE `$name` (`id` int(0) NOT NULL AUTO_INCREMENT,";

            $i = 1;
            foreach( $params['Columns'] as $columnName => $columnData )
            {
                $columnData = explode("|", $columnData);

                $typeCheck = explode("(", $columnData[0]);

                if( $typeCheck[0] == "text" || $typeCheck[0] == "varchar" )
                {
                    $collateSet = "CHARACTER SET utf8 COLLATE utf8_general_ci";
                }
                else
                {
                    $collateSet = "";
                }

                if( $columnData[1] == "null" )
                {
                    $nullData = "NULL";
                }
                else if( $columnData[1] == "notnull" )
                {
                    $nullData = "NOT NULL";
                }

                if( !isset($columnData[2]) )
                {
                    $columnData[2] = "";
                }

                $columnData[2] = strtoupper($columnData[2]);

                $query[$i] = "`$columnName` $columnData[0] $collateSet $nullData $columnData[2], ";

                $i++;
            }
            $query[$i++] = "PRIMARY KEY (`id`)";
            $query[$i] = ");";

            $totalQuery = "";

            foreach($query as $queryItem)
            {
                $totalQuery .= $queryItem;
            }

            //echo $totalQuery;

            $status = DB::query($totalQuery);

            if( $status )
            {
                echo "\033[032m\n Table has been created now proceeding to next one.\n";
            }
            else
            {
                echo "\033[031m\n Error while creating this table. Proceeding to next one.\n";
            }

            self::$migrationSQL .= "{".$totalQuery."}";
            
        }
        else
        {
            echo "\033[032m $name table found. Checking Table for updates.\n";
        }

    }
    
}