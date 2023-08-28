<?php
// editarenbase_administradores
require "funciones/conecta.php";

$con = conecta();

//Recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$direccion = $_REQUEST['direccion'];
$telefono = $_REQUEST['telefono'];
$edad = $_REQUEST['edad'];
$puesto = $_REQUEST['puesto'];
$id = $_REQUEST['id'];

$passEnc = md5($pass);

if($pass == ""){
    $sql = "UPDATE empleados set nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', direccion = '$direccion', telefono = '$telefono', edad = '$edad', puesto = '$puesto' where idEmpleado = $id";
    $res = $con->query($sql);  
}else{
    $sql = "UPDATE empleados set nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', pass = '$passEnc', direccion = '$direccion', telefono = '$telefono', edad = '$edad', puesto = '$puesto' where idEmpleado = $id";
    $res = $con->query($sql);   
}


header("Location: lista_empleados.php");


?>