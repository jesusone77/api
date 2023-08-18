<?php 

$server = 'localhost';
$$user = 'root';
$pass = '';
$dbname = 'prueba';

$conn = new mysqli($server,$user,$pass,$dbname);

if($conn->connect_error) {
    die($conn->connect_error);
}






