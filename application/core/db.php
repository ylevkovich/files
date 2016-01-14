<?php
/**
 * Created by PhpStorm.
 * User: Жирик
 * Date: 28.05.2015
 * Time: 21:30
 */

class db
{
    const server = "localhost";
    const USER = "root";
    const PASS = "";

    public $db;

    public function __construct()
    {
        $this->db = mysql_connect(self::server, self::USER, self::PASS);
        mysql_select_db("database_cms", $this->db);
        mysql_set_charset('utf8');
    }

    public function insert($table,$values)
    {
        mysql_query("INSERT into $table VALUES $values") or die(" insert error in database");
    }

    public function select($fields,$table,$condition)
    {
        return mysql_query("SELECT $fields FROM $table $condition");
    }

    public function update($table,$fieldsWithCur,$condition,$db)
    {
        return mysql_query("UPDATE $table SET $fieldsWithCur WHERE $condition",$db);
    }

    public function delete($table,$condition)
    {
        mysql_query("DELETE from $table $condition");
    }
}

?>