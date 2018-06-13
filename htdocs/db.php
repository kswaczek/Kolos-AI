<?php
session_start();
/*Połączenie z bazą danych*/
$dbhost = 'localhost';
$dblogin = 'root';
$dbpass = '';
$dbselect = 'studenci';
$link = mysqli_connect('localhost', 'root', '', 'studenci');
$con = new mysqli($dbhost,$dblogin,$dbpass);
if(!$con) die("Brak połączenia z serwerem bazy danych");

$con -> select_db($dbselect) or die("Brak połączenia z bazą danych");

$con -> query("SET CHARACTER SET UTF8");
?>