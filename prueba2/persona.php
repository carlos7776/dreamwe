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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO persona (cedula, fecha, asunto, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fijo, celular, direccion, barrio, descripcion) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['asunto'], "text"),
                       GetSQLValueString($_POST['primer_nombre'], "text"),
                       GetSQLValueString($_POST['segundo_nombre'], "text"),
                       GetSQLValueString($_POST['primer_apellido'], "text"),
                       GetSQLValueString($_POST['segundo_apellido'], "text"),
                       GetSQLValueString($_POST['fijo'], "int"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['barrio'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"));

  mysql_select_db($database_carlos, $carlos);
  $Result1 = mysql_query($insertSQL, $carlos) or die(mysql_error());

  $insertGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_resgistros = "-1";
if (isset($_GET['cedula'])) {
  $colname_resgistros = $_GET['cedula'];
}
mysql_select_db($database_carlos, $carlos);
$query_resgistros = sprintf("SELECT * FROM persona WHERE cedula = %s", GetSQLValueString($colname_resgistros, "int"));
$resgistros = mysql_query($query_resgistros, $carlos) or die(mysql_error());
$row_resgistros = mysql_fetch_assoc($resgistros);
$totalRows_resgistros = mysql_num_rows($resgistros);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin t??tulo</title>
</head>

<body>
<h1 align="center">Tabla de registro</h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Cedula:</td>
      <td><input type="text" name="cedula" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fecha:</td>
      <td><input type="date" name="fecha" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Asunto:</td>
      <td><input type="text" name="asunto" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Primer_nombre:</td>
      <td><input type="text" name="primer_nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Segundo_nombre:</td>
      <td><input type="text" name="segundo_nombre" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Primer_apellido:</td>
      <td><input type="text" name="primer_apellido" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Segundo_apellido:</td>
      <td><input type="text" name="segundo_apellido" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fijo:</td>
      <td><input type="text" name="fijo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Celular:</td>
      <td><input type="text" name="celular" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Barrio:</td>
      <td><input type="text" name="barrio" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Descripcion:</td>
      <td><input type="text" name="descripcion" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insertar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($resgistros);
?>
