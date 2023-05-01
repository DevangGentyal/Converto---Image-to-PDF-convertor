<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpmicro";

$con = mysqli_connect($servername,$username,$password,$dbname);

if(!$con){
    die("Conncectin to DB failed");
}

?>