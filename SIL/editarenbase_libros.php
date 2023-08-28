<?php
// editarenbase_administradores
require "funciones/conecta.php";

$con = conecta();

//Recibe variables
$nombre = $_REQUEST["nombre"];
$isbn = $_REQUEST["isbn"];
$editorial = $_REQUEST["editorial"];
$year = $_REQUEST["year"];
$autor = $_REQUEST["autor"];
$costo = $_REQUEST["costo"];
$stock = $_REQUEST["stock"];
$id = $_REQUEST['id'];

$passEnc = md5($pass);

$sql = "UPDATE libros set nombre = '$nombre', isbn = '$isbn', editorial = '$editorial', year = '$year', autor = '$autor', costo = '$costo', stock = '$stock' where id = $id";
$res = $con->query($sql);  


header("Location: lista_libros.php");


?>