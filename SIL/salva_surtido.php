<?php
//salva_empleados.php
require "funciones/conecta.php";

$con = conecta();

//Recibe variables

$folio = json_decode($_REQUEST['folio']);
$idArreglo = json_decode($_REQUEST['idArreglo']);
$idCantidad = json_decode($_REQUEST['cantidad']);

// echo $idArreglo[0].' '.$idCantidad[0].' '.$costo[0].' folio:'.$folio;

$cantidad = count($idArreglo);

$sql = "INSERT INTO surtido (id) VALUES ($folio)";

$res = $con->query($sql);

$sql= "INSERT INTO detalle_surtido (id_surtido, id_libro, cantidad)  VALUES ";

for($i=0; $i < $cantidad; $i++){
    if($i != $cantidad-1)
    $sql.="($folio, $idArreglo[$i], $idCantidad[$i]), ";
    if($i == $cantidad-1){
        $sql.="($folio, $idArreglo[$i], $idCantidad[$i]);";
    }
}
// echo $sql;
 $res = $con->query($sql);

//  echo $sql;

 if(mysqli_affected_rows($con)> 0){ 
    echo 1;
}else{
    echo 0;
}

?>








<?php
    



    for($i=0; $i < $cantidad; $i++){
        $consulta = "SELECT stock from libros where id = $idArreglo[$i]";
        $res = $con->query($consulta);
        $row = $res->fetch_array();
        $cantidadAntes = $row["stock"];

        $cantAux = $cantidadAntes + $idCantidad[$i];
        $sql = "UPDATE libros set stock = $cantAux where id = $idArreglo[$i]";
        $res = $con->query($sql);
    }

    

?>