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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE persona SET fecha=%s, asunto=%s, primer_nombre=%s, segundo_nombre=%s, primer_apellido=%s, segundo_apellido=%s, fijo=%s, celular=%s, direccion=%s, barrio=%s, descripcion=%s WHERE cedula=%s",
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
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"));

  mysql_select_db($database_carlos, $carlos);
  $Result1 = mysql_query($updateSQL, $carlos) or die(mysql_error());

  $updateGoTo = "menu.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_actualizar = "-1";
if (isset($_GET['cedula'])) {
  $colname_actualizar = $_GET['cedula'];
}
mysql_select_db($database_carlos, $carlos);
$query_actualizar = sprintf("SELECT * FROM persona WHERE cedula = %s", GetSQLValueString($colname_actualizar, "int"));
$actualizar = mysql_query($query_actualizar, $carlos) or die(mysql_error());
$row_actualizar = mysql_fetch_assoc($actualizar);
$totalRows_actualizar = mysql_num_rows($actualizar);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<h1  align="center">tabla de actualizacion</h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Cedula:</td>
      <td><?php echo $row_actualizar['cedula']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fecha:</td>
      <td><input type="date" name="fecha" value="<?php echo htmlentities($row_actualizar['fecha'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Asunto:</td>
      <td><input type="text" name="asunto" value="<?php echo htmlentities($row_actualizar['asunto'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Primer_nombre:</td>
      <td><input type="text" name="primer_nombre" value="<?php echo htmlentities($row_actualizar['primer_nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Segundo_nombre:</td>
      <td><input type="text" name="segundo_nombre" value="<?php echo htmlentities($row_actualizar['segundo_nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Primer_apellido:</td>
      <td><input type="text" name="primer_apellido" value="<?php echo htmlentities($row_actualizar['primer_apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Segundo_apellido:</td>
      <td><input type="text" name="segundo_apellido" value="<?php echo htmlentities($row_actualizar['segundo_apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fijo:</td>
      <td><input type="text" name="fijo" value="<?php echo htmlentities($row_actualizar['fijo'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Celular:</td>
      <td><input type="text" name="celular" value="<?php echo htmlentities($row_actualizar['celular'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Direccion:</td>
      <td><input type="text" name="direccion" value="<?php echo htmlentities($row_actualizar['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Barrio:</td>
      <td><input type="text" name="barrio" value="<?php echo htmlentities($row_actualizar['barrio'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Descripcion:</td>
      <td><input type="text" name="descripcion" value="<?php echo htmlentities($row_actualizar['descripcion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="cedula" value="<?php echo $row_actualizar['cedula']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($actualizar);
?>
