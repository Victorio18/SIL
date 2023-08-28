<?php

require "funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id'];

$sql =  "SELECT idEmpleado from empleados where idEmpleado = '$id'";

$res = mysqli_num_rows($con->query($sql));

if($res > 0){     
    echo 1;   //fue encontrado
}else{
    echo 0;  //no encontrado
}

?>