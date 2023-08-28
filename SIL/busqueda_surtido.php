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
    <!-- <h1>Lista de surtido de mercancía</h1><br> -->
    <div class="buscar">
            <p>Buscar Surtido por ID:</p>
            <input type="search" name="id" id="id">
            <input type="button" value="Buscar" class="btn_buscar" onclick="busca(); return false;">
        </div>
        <div class="finded">
            <table class="lista venta f">
                <tr id="encabezado">
                    <td>ID</td>
                    <td>Fecha</td>
                    <td>Detalle</td>
                </tr>

                <?php
                require "funciones/conecta.php";
                $con = conecta();
                $sql = "SELECT * from SURTIDO";
                $res = $con->query($sql);

                while ($row = $res->fetch_array()) {

                    $id = $row["id"];
                    $fecha = $row["fecha"];
                    
                    echo "<tr id = \"$id\">";
                    echo "<td>";
                    echo "$id";
                    echo "</td>";
                    echo "<td>";
                    echo "$fecha";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=\"detalle_surtido.php?id=$id \">";
                    echo "Ver detalle";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>

            </table>

            <p></p>
        </div>

       

    </div>

</body>

</html>

<script>
    $('.lista.venta.f tr').hide();

    function busca() {
        var id = $('#id').val();
        $('.lista.venta.f tr').hide();

        if (id == "") {
            $('.lista.venta.f tr').hide();
            $('.finded p').html('Digite el id para buscar');
        } else if (isNaN(id) == true) {
            $('.lista.venta.f tr').hide();
            $('.finded p').html('Digite un número válido');
        } else if (id <= 0) {
            $('.lista.venta.f tr').hide();
            $('.finded p').html('Digite un id mayor a cero');
        } else {


            // $('.finded p').html('Se esta buscando');
            $.ajax({
                url: 'busca_surtido.php',
                type: 'post',
                dataType: 'text',
                data: 'id=' + id,
                success: function(res) {
                    if (res == 1) {
                        $('.finded p').html('');
                        $('.lista.venta.f tr#encabezado').show();
                        $('.lista.venta.f tr#' + id).show();
                    } else {
                        $('.finded p').html('');
                        $('.lista.venta.f tr').hide();
                        $('.finded p').html('No Encontrado');
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado');
                }
            });

        }
    }
</script>