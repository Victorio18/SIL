<?php 
    require "menu.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
            require "funciones/conecta.php";
            $con = conecta();
            $id = $_REQUEST["id"];
            $sql = "SELECT libros.isbn, libros.nombre, detalle_surtido.cantidad from detalle_surtido, libros where detalle_surtido.id_surtido = $id and libros.id = detalle_surtido.id_libro";
            $total = 0;
            $res = $con->query($sql);

            
        ?>
        <h1>Detalle de surtido <?php echo $id;?></h1><br>
        <table class="lista empleados">
            <tr>
                <td>ISBN</td>
                <td>Titulo</td>
                <td>Cantidad</td>
            </tr>

            <?php 
            while($row = $res->fetch_array()){
                $isbn = $row["isbn"];
                $titulo = $row["nombre"];
                $cantidad = $row["cantidad"];
                ?>
                <tr>
                <td><?php echo $isbn; ?></td>
                <td><?php echo $titulo; ?></td>
                <td><?php echo $cantidad; ?></td>
                </tr>

           <?php }?>
            
        </table>
                <div class="regresar">
                    <a href="lista_surtido.php"><p>Regresar a lista de surtido</p></a>
                    <a href="busqueda_surtido.php"><p>Regresar a Busqueda de surtido</p></a>
                </div>
                
    </div>
    
</body>
</html>