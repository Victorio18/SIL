<?php
session_start();
require "conecta.php";

$con = conecta();
$user = $_REQUEST['user']; 
$pass = $_REQUEST['pass'];
$pass = md5($pass);

$sql = "SELECT * FROM empleados WHERE correo = '$user' and pass = '$pass'";
$res = $con->query($sql);
$num = $res->num_rows;

if($num){
    while($row = $res->fetch_array()){
        $idU  = $row["idEmpleado"];
        $nombre = $row["nombre"].' '.$row["apellidos"];
        $correo = $row["correo"];
        $puesto = $row["puesto"];
    
        $_SESSION['idU'] = $idU;
        $_SESSION['nombre'] = $nombre;  
        $_SESSION['correo'] = $correo;        
        $_SESSION['puesto'] = $puesto;        
    }
       echo 1;
}
else{
    
    echo 0;
}


?>