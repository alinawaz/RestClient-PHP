<?php

namespace System\Database;

use System\Database\QueryInterface;

class MysqlQuery implements QueryInterface {

    private static $connected = false;
    private static $conn = FALSE;
    private static $lastQuery = '';
    private static $lastTableQuery = '';
    private static $lastTable = NULL;

    public static function getLastQuery(){
        return Array(
            'Last Direct Query' => MysqlQuery::$lastQuery,
            'Last Table Query' => MysqlQuery::$lastTable->getLastQuery()
        );
    }

    public static function connect() {
        MysqlQuery::Close();
        $default = config('database')['default'];
        self::$conn = mysqli_connect(
          config('database')['connections'][$default]['host'], 
          config('database')['connections'][$default]['username'], 
          config('database')['connections'][$default]['password'], 
          config('database')['connections'][$default]['database'],
          config('database')['connections'][$default]['port']
        );
        if (mysqli_connect_errno()) {
            echo "Crazy Database MSQLI Error: " . mysqli_connect_error();
        }
        MysqlQuery::$connected = true;
        return true;
    }

    public static function close() {
        if (MysqlQuery::$connected == true) {
            mysqli_close(self::$conn);
            MysqlQuery::$connected = false;
            return true;
        }
        return false;
    }

    public static function query($QueryString) {
        MysqlQuery::Connect();
        MysqlQuery::$lastQuery = $QueryString;
        $result = mysqli_query(self::$conn,$QueryString);
        if(!$result)
            $result = mysqli_error(self::$conn);
        MysqlQuery::Close();        
        return $result;
    }

    public static function table($table){
        MysqlQuery::$lastTable = new MysqlTable($table);
        return MysqlQuery::$lastTable;
    }

}



?>