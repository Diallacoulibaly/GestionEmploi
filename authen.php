<?php
$dbserver="localhost";
$username="root";
$pass="";
$db="gestionemploitemps";
$cn=mysqli_connect($dbserver,$username,$pass,$db);
if (!$cn) {
    die("erreur connect:".mysqli_connect_error());
}

?>