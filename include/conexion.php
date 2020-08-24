<?php

//conexión
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'curso';
$db = mysqli_connect($server,$username,$password,$database);

mysqli_query($db, "SET NAMES 'utf8'");

if (!isset($_SESSION)) {
	session_start();
}