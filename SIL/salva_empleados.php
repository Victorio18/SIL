<?php
//salva_empleados.php
require "funciones/conecta.php";

$con = conecta();

//Recibe variables

$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$correo = $_REQUEST["correo"];
$pass = $_REQUEST["pass"];
$direccion = $_REQUEST["direccion"];
$telefono = $_REQUEST["telefono"];
$edad = $_REQUEST["edad"];
$puesto = $_REQUEST["puesto"];
$pasEnc = md5($pass);

$sql = "INSERT INTO empleados (nombre, apellidos, correo, pass, direccion, telefono, edad, puesto) VALUES ('$nombre', '$apellidos', '$correo', '$pasEnc', '$direccion', '$telefono', '$edad', '$puesto')";

$res = $con->query($sql);

header("Location: lista_empleados.php");


?>