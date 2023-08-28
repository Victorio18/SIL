<?php
require "funciones/conecta.php";

$con = conecta();

$isbn = $_REQUEST['isbn'];

$id = $_REQUEST['id'];

$sql =  "SELECT isbn from libros where isbn = '$isbn' and id <> '$id'";

$res = $con->query($sql);   
$row = $res->fetch_array();

// $id_row = $row['id'];

$num_rows = mysqli_num_rows($con->query($sql));

// echo $id;
    
if($num_rows > 0){     
    //Fue encontrado.
    echo 0;

}else{ //No fue encontrado
    echo 1;  //pasa la prueba
}
?>