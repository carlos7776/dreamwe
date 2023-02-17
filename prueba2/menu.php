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

$maxRows_lisper = 100;
$pageNum_lisper = 0;
if (isset($_GET['pageNum_lisper'])) {
  $pageNum_lisper = $_GET['pageNum_lisper'];
}
$startRow_lisper = $pageNum_lisper * $maxRows_lisper;

mysql_select_db($database_carlos, $carlos);
$query_lisper = "SELECT * FROM persona ORDER BY primer_apellido ASC";
$query_limit_lisper = sprintf("%s LIMIT %d, %d", $query_lisper, $startRow_lisper, $maxRows_lisper);
$lisper = mysql_query($query_limit_lisper, $carlos) or die(mysql_error());
$row_lisper = mysql_fetch_assoc($lisper);

if (isset($_GET['totalRows_lisper'])) {
  $totalRows_lisper = $_GET['totalRows_lisper'];
} else {
  $all_lisper = mysql_query($query_lisper);
  $totalRows_lisper = mysql_num_rows($all_lisper);
}
$totalPages_lisper = ceil($totalRows_lisper/$maxRows_lisper)-1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<style>
 h1{
            text-align: center;
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin-bottom: 50px;
        }
        .resg{
            text-align: center;
            display: grid;      
			margin-bottom:200px:
	    }
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th, td {
			padding: 8px;
			text-align: left;
			border: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
			color: #333;
			font-weight: bold;}


</style>
</head>

<body>
<h1>Tabla persona</h1>
<a href="registrar.php" class="resg">registro</a> <br><br>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_lisper['cedula']; ?></td>
      <td><?php echo $row_lisper['fecha']; ?></td>
      <td><?php echo $row_lisper['asunto']; ?></td>
      <td><?php echo $row_lisper['primer_nombre']; ?></td>
      <td><?php echo $row_lisper['segundo_nombre']; ?></td>
      <td><?php echo $row_lisper['primer_apellido']; ?></td>
      <td><?php echo $row_lisper['segundo_apellido']; ?></td>
      <td><?php echo $row_lisper['fijo']; ?></td>
      <td><?php echo $row_lisper['celular']; ?></td>
      <td><?php echo $row_lisper['direccion']; ?></td>
      <td><?php echo $row_lisper['barrio']; ?></td>
      <td><?php echo $row_lisper['descripcion']; ?></td>
      <td><a href="actualizar.php?cedula=<?php echo $row_lisper['cedula']; ?>">actualizar</a></td>
     <td><a href="eliminar.php?cedula=<?php echo $row_lisper['cedula']; ?>">eliminar</a></td>
    
    </tr>
    <?php } while ($row_lisper = mysql_fetch_assoc($lisper)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($lisper);
?>
