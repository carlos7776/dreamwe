<?php require_once('Connections/carlos.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_carlos, $carlos);
$query_personas = "SELECT * FROM persona";
$personas = mysql_query($query_personas, $carlos) or die(mysql_error());
$row_personas = mysql_fetch_assoc($personas);
$totalRows_personas = mysql_num_rows($personas);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>menu</title>
</head>

<body>
<h1> Tabla de registros</h1>
<a href="resgistro.php">registrate</a>
<br>
<table border="1">
  <tr>
    <td>cedula</td>
    <td>fecha</td>
    <td>asunto</td>
    <td>primer_nombre</td>
    <td>segundo_nombre</td>
    <td>primer_apellido</td>
    <td>segundo_apellido</td>
    <td>fijo</td>
    <td>celular</td>
    <td>direccion</td>
    <td>barrio</td>
    <td>descripcion</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_personas['cedula']; ?></td>
      <td><?php echo $row_personas['fecha']; ?></td>
      <td><?php echo $row_personas['asunto']; ?></td>
      <td><?php echo $row_personas['primer_nombre']; ?></td>
      <td><?php echo $row_personas['segundo_nombre']; ?></td>
      <td><?php echo $row_personas['primer_apellido']; ?></td>
      <td><?php echo $row_personas['segundo_apellido']; ?></td>
      <td><?php echo $row_personas['fijo']; ?></td>
      <td><?php echo $row_personas['celular']; ?></td>
      <td><?php echo $row_personas['direccion']; ?></td>
      <td><?php echo $row_personas['barrio']; ?></td>
      <td><?php echo $row_personas['descripcion']; ?></td>
    </tr>
    <?php } while ($row_personas = mysql_fetch_assoc($personas)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($personas);
?>
