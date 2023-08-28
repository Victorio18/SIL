<?php

require "funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id'];

$sql =  "SELECT * from empleados where idEmpleado = '$id'";

$num = mysqli_num_rows($con->query($sql));
$res = $con->query($sql);


if($num > 0){    
    $row = $res->fetch_array();
    $nombre = $row["nombre"]; 
   
    echo $nombre;   //fue encontrado
 

}else{
    echo 0;  //no encontrado
}

?>