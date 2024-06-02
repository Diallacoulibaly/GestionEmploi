<?php
$bdserver="localhost"; //127.0.0.1
$username="root";
$password="";
$bd= "emplois_du_temps";
$cnx= mysqli_connect($bdserver,$username,$password,$bd);

if(!$cnx){
    die("Erreur cnx:". mysqli_connect_error());
}

?>