<?php
require_once('db.php');

$database = new db();
$database->db;

$login = $_GET['login'];
$query = $database->select('login','user',"where login = '$login'");
$result = mysql_num_rows($query);
echo $result;
?>