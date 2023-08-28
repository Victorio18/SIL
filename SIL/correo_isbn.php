<?php

require "funciones/conecta.php";

$con = conecta();

$isbn = $_REQUEST['isbn'];

$sql =  "SELECT isbn from libros where isbn = '$isbn'";

$res = mysqli_num_rows($con->query($sql));

if($res > 0){     
    echo 0;   //fue encontrado
}else{
    echo 1;  //no encontrado
}

?>