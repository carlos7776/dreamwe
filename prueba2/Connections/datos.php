<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_datos = "localhost";
$database_datos = "prueba2";
$username_datos = "root";
$password_datos = "";
$datos = mysql_pconnect($hostname_datos, $username_datos, $password_datos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>