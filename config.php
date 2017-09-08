<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bestow";

$conn = mysql_connect($servername, $username, $password);
if(!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname);
?>