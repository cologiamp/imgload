<?php
$host = "localhost";
$user = "root";
$pass = "Colo36585!";
$db = "imgload";
$conexion = mysql_connect($host, $user, $pass);
mysql_select_db($db,$conexion)or die (mysql_error());

?>