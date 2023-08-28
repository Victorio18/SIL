<?php

require "funciones/conecta.php";

$con = conecta();

$id = $_REQUEST['id'];

$sql =  "SELECT * from libros where id = '$id'";

$num = mysqli_num_rows($con->query($sql));
$res = $con->query($sql);


if($num > 0){    
    $row = $res->fetch_array();
    $respuesta = array('mensaje' => '1',
        'id' => $row["id"],
        'isbn' => $row["isbn"],
        'nombre' => $row["nombre"],
        'costo' => $row["costo"],
        'stock' => $row["stock"]);
    // echo json_encode($respuesta);

    // $id = $row["id"];
    // $nombre = $row["nombre"]; 
    // $isbn = $row["isbn"]; 
    // $editorial = $row["editorial"]; 
    // $year = $row["year"]; 
    // $autor = $row["autor"]; 
    // echo $id.'/';
      //fue encontrado
    // , $nombre, $isbn, $editorial, $year, $autor;

}else{
    $respuesta = array('mensaje' => '0');
    //no encontrado
}
// echo $respuesta;
echo json_encode($respuesta);

?>