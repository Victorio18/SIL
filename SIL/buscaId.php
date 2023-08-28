<?php

require "funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id'];

$sql =  "SELECT * from libros where id = '$id'";

$num = mysqli_num_rows($con->query($sql));
$res = $con->query($sql);


if($num > 0){    
    $row = $res->fetch_array();
    // $id = $row["id"];
    $nombre = $row["nombre"]; 
    // $isbn = $row["isbn"]; 
    // $editorial = $row["editorial"]; 
    // $year = $row["year"]; 
    // $autor = $row["autor"]; 
    // echo $id.'/';
    echo $nombre;   //fue encontrado
    // , $nombre, $isbn, $editorial, $year, $autor;

}else{
    echo 0;  //no encontrado
}

?>