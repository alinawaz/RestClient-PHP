<?php

namespace RestClient\Database;

use Config\Config;
use RestClient\Database\MysqlTable;

class Mysql {

    private static $connected = false;
    private static $conn = FALSE;
    private static $lastQuery = '';
    private static $lastTableQuery = '';
    private static $lastTable = NULL;

    public static function getLastQuery(){
        return Array(
            'Last Direct Query' => Mysql::$lastQuery,
            'Last Table Query' => Mysql::$lastTable->getLastQuery()
        );
    }

    public static function Connect() {
        Mysql::Close();
        self::$conn = mysqli_connect(
          Config::$server, 
          Config::$username, 
          Config::$password, 
          Config::$database
        );
        if (mysqli_connect_errno()) {
            echo "Crazy Database MSQLI Error: " . mysqli_connect_error();
        }
        Mysql::$connected = true;
        return true;
    }

    public static function Close() {
        if (Mysql::$connected == true) {
            mysqli_close(self::$conn);
            Mysql::$connected = false;
            return true;
        }
        return false;
    }

    public static function Query($QueryString) {
        Mysql::Connect();
        Mysql::$lastQuery = $QueryString;
        $result = mysqli_query(self::$conn,$QueryString);
        Mysql::Close();
        return $result;
    }

    public static function table($table){
        Mysql::$lastTable = new MysqlTable($table);
        return Mysql::$lastTable;
    }

}



?>