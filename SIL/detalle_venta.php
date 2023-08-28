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
            $sql = "SELECT libros.isbn, libros.nombre, detalle_venta.costo, detalle_venta.cantidad from detalle_venta, libros where detalle_venta.id_venta = $id and libros.id = detalle_venta.id_libro";
            $total = 0;
            $res = $con->query($sql);

            
        ?>
        <h1 class="detail">Detalle de venta con folio:<?php echo $id;?><br>
        <br>
        <table class="lista libros">
            <tr>
                <td>ISBN</td>
                <td>Titulo</td>
                <td>Costo</td>
                <td>Cantidad</td>
                <td>Subtotal</td>
            </tr>

            <?php 
            while($row = $res->fetch_array()){
                $isbn = $row["isbn"];
                $titulo = $row["nombre"];
                $costo = $row["costo"];
                $cantidad = $row["cantidad"];
                ?>
                <tr>
                <td><?php echo $isbn; ?></td>
                <td><?php echo $titulo; ?></td>
                <td><?php echo '$'.$costo; ?></td>
                <td><?php echo $cantidad; ?></td>
                <?php $subtotal = $costo * $cantidad;
                $total += $subtotal?>
                <td><?php echo '$'.$subtotal;?></td>
                </tr>

           <?php }?>
           <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><span class="total">$<?php echo $total;?></span></td>
            </tr>
            
        </table>
                <div class="regresar">
                    <a href="lista_venta.php"><p>Regresar a lista de venta</p></a>
                    <a href="busqueda_venta.php"><p>Volver a consulta de venta</p></a>
                </div>
    </div>
    
</body>
</html>