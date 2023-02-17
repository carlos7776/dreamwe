<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_carlos = "localhost";
$database_carlos = "tarea";
$username_carlos = "root";
$password_carlos = "";
$carlos = mysql_pconnect($hostname_carlos, $username_carlos, $password_carlos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>