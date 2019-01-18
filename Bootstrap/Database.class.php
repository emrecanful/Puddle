<?php
namespace Bootstrap;

class Database {

    private static function connect()
    {
        $pdo = new \PDO("mysql:host=localhost;dbname=noviacloud_db", "emrecanful", "1321912199haha");
        // $pdo->setAttribute(/*\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION*/);
        
        return $pdo;
    }

    public static function query($query, $params = array())
    {
        $statement = self::connect()->prepare($query);
        $status = $statement->execute($params);

        if( explode(' ', $query)[0] == 'SELECT' )
        {
            if( $status )
            {
                $data = $statement->fetchAll();
                return $data;
            }
            else
            {
                return false;
            }
            
        }
        else if( explode(' ', $query)[0] == 'INSERT' )
        {
            if( $status )
            {
                return self::connect()->lastInsertId();
            }
            else
            {
                return false;
            }
        }
        else if( explode(' ', $query)[0] == 'UPDATE' )
        {
            // Do again.
        }
        else if( explode(' ', $query)[0] == 'CREATE' )
        {
            if( $status )
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
    }

}