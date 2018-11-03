<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "imgwolf";
$conexion = mysql_connect($host, $user, $pass);
mysql_select_db($db,$conexion)or die (mysql_error());

?>