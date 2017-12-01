<?php

namespace RestClient\Database;

use RestClient\Database\Mysql as DB;

class MysqlTable {

    private static $tableName = '';
    private static $queryBuilderString = '';
    private static $queryBuilderWhere = '';
    private static $queryBuilderAfterWhere = '';
    private static $lastQuery='';

    function __construct($tableNameString) {
        MysqlTable::$tableName = $tableNameString;
        MysqlTable::$queryBuilderString .= "SELECT * FROM ".MysqlTable::$tableName;
        return $this;
    }

    public function getLastQuery() {
      return MysqlTable::$lastQuery;
    }

    private function getQuery(){
      return MysqlTable::$queryBuilderString.' '.MysqlTable::$queryBuilderWhere . ' ' . MysqlTable::$queryBuilderAfterWhere;
    }

    private function resetQueryBuilder(){
      MysqlTable::$lastQuery = MysqlTable::$queryBuilderString.' '.MysqlTable::$queryBuilderWhere . ' ' . MysqlTable::$queryBuilderAfterWhere;
      MysqlTable::$queryBuilderString='';
      MysqlTable::$queryBuilderWhere='';
      MysqlTable::$queryBuilderAfterWhere='';
    }

    public function select($queryString){
      MysqlTable::$queryBuilderString .= "SELECT ".$queryString." FROM ".MysqlTable::$tableName;
      return $this;
    }

    public function orWhere($arrayOrColumnName, $columnValue=NULL){
      if(is_array($arrayOrColumnName)){
        $whereString = '';
        if ($arrayOrColumnName != null) {
            foreach ($arrayOrColumnName as $key => $value) {
                if ($whereString == "") {
                    $whereString = $whereString . " " . $key . "='" . $value . "' ";
                } else {
                    $whereString = $whereString . " OR " . $key . "='" . $value . "' ";
                }
            }
            MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' OR ') . $whereString;
        }
      }else{
        MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' OR ') . $arrayOrColumnName." = '".$columnValue."' ";
      }
      return $this;
    }

    public function andWhere($arrayOrColumnName, $columnValue=NULL){
      if(is_array($arrayOrColumnName)){
        $whereString = '';
        if ($arrayOrColumnName != null) {
            foreach ($arrayOrColumnName as $key => $value) {
                if ($whereString == "") {
                    $whereString = $whereString . " " . $key . "='" . $value . "' ";
                } else {
                    $whereString = $whereString . " AND " . $key . "='" . $value . "' ";
                }
            }
            MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' AND ') . $whereString;
        }
      }else{
        MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' AND ') . $arrayOrColumnName." = '".$columnValue."' ";
      }
      return $this;
    }

    public function where($arrayOrColumnName, $columnValue=NULL, $conditionType = 'AND'){
      if(is_array($arrayOrColumnName)){
        $whereString = '';
        if ($arrayOrColumnName != null) {
            foreach ($arrayOrColumnName as $key => $value) {
                if ($whereString == "") {
                    $whereString = $whereString . " " . $key . "='" . $value . "' ";
                } else {
                    $whereString = $whereString . " ".$conditionType." " . $key . "='" . $value . "' ";
                }
            }
            MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' '.$conditionType.' ') . $whereString;
        }
      }else{
        MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' '.$conditionType.' ') . $arrayOrColumnName." = '".$columnValue."' ";
      }
      return $this;
    }

    public function whereRaw($arrayOrColumnName, $columnValue=NULL, $conditionType = 'AND'){
      if(is_array($arrayOrColumnName)){
        $whereString = '';
        if ($arrayOrColumnName != null) {
            foreach ($arrayOrColumnName as $key => $value) {
                if ($whereString == "") {
                    $whereString = $whereString . " " . $key . " " . $value . " ";
                } else {
                    $whereString = $whereString . " ".$conditionType." " . $key . " " . $value . " ";
                }
            }
            MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' '.$conditionType.' ') . $whereString;
        }
      }else{
        MysqlTable::$queryBuilderWhere .= (MysqlTable::$queryBuilderWhere==''?' WHERE ':' '.$conditionType.' ') . $arrayOrColumnName." ".$columnValue;
      }
      return $this;
    }

    public static function exists() {
        $sql = DB::Query(MysqlTable::getQuery());
        if ($res = mysql_fetch_array($sql))
            return true;
        return false;
    }

    public static function result($mode='rows'){
        $sql = DB::Query(MysqlTable::getQuery());
        $record = array();
        if($sql)
            if($mode=='rows'){
                while ($data = mysqli_fetch_assoc($sql)) {
                    $record[] = $data;
                }
            }elseif ($mode=='row'){
                if ($data = mysqli_fetch_assoc($sql)) {
                    $record = $data;
                }
            }
        MysqlTable::resetQueryBuilder();
        return $record;
    }

    public static function get(){
      $sql = DB::Query(MysqlTable::getQuery());
      $record = array();
      if($sql)
        while ($data = mysqli_fetch_assoc($sql)) {
            $record[] = $data;
        }
      MysqlTable::resetQueryBuilder();
      return (object) $record;
    }

    public static function first(){
      $sql = DB::Query(MysqlTable::getQuery());
      $record = array();
      if($sql)
        if ($data = mysqli_fetch_assoc($sql)) {
            $record = $data;
        }
      MysqlTable::resetQueryBuilder();
      return (object) $record;
    }

    public static function insert($dataArray) {
        $columns = '';
        $values = '';
        if ($dataArray) {
            foreach ($dataArray as $key => $value) {
                if ($columns == '') {
                    $columns = $columns . $key;
                } else {
                    $columns = $columns . "," . $key;
                }
                if ($values == '') {
                    $values = $values . "'" . $value . "'";
                } else {
                    $values = $values . ",'" . $value . "'";
                }
            }
            DB::Query("insert into `" . Table::$tableName . "` (" . $columns . ") values (" . $values . ");");
            $id = mysql_insert_id();
            return $id;
        } else {
            return false;
        }
        return false;
    }

    public static function update($dataArray, $matchArray) {
        $updates = '';
        $matches = '';
        if ($dataArray && $matchArray) {
            foreach ($dataArray as $key => $value) {
                if ($updates == '') {
                    $updates = $updates . $key . "='" . $value . "'";
                } else {
                    $updates = $updates . "," . $key . "='" . $value . "'";
                }
            }
            foreach ($matchArray as $key => $value) {
                if ($matches == '') {
                    $matches = $matches . $key . "='" . $value . "'";
                } else {
                    $matches = $matches . " and " . $key . "='" . $value . "'";
                }
            }
            $tempQuery = "update `" . Table::$tableName . "` set " . $updates . " where " . $matches;
            $response = DB::Query($tempQuery);
            return $response;
        } else {
            return false;
        }
        return false;
    }

    public static function delete($matchArray) {
        $matches = '';
        if ($matchArray) {
            foreach ($matchArray as $key => $value) {
                if ($matches == '') {
                    $matches = $matches . $key . "='" . $value . "'";
                } else {
                    $matches = $matches . " and " . $key . "='" . $value . "'";
                }
            }
            $response = DB::Query("delete from `" . Table::$tableName . "` where " . $matches);
            return $response;
        } else {
            return false;
        }
        return false;
    }

    public static function truncate() {
        DB::Query("truncate table `" . MysqlTable::$tableName . "`");
        return true;
    }

}