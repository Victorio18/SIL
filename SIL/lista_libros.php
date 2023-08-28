<?php
require "menu.php"
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
        <h1>Lista de Libros</h1><br>
        

        <table class="lista libros">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>ISBN</td>
                <td>Editorial</td>
                <td>Año</td>
                <td>Autor</td>
                <td>Costo</td>
                <td>Stock</td>
                <td>Editar</td>
                <!-- <td>Eliminar</td> -->
            </tr>

            <?php
            require "funciones/conecta.php";
            $con = conecta();
            $sql = "SELECT * from LIBROS";
            $res = $con->query($sql);

            while ($row = $res->fetch_array()) {

                $id = $row["id"];
                $nombre = $row["nombre"];
                $isbn = $row["isbn"];
                $editorial = $row["editorial"];
                $year = $row["year"];
                $autor = $row["autor"];
                $costo = $row["costo"];
                $stock = $row["stock"];

                echo "<tr id = \"$id\">";
                echo "<td>";
                echo "$id";
                echo "</td>";
                echo "<td>";
                echo "$nombre";
                echo "</td>";
                echo "<td>";
                echo "$isbn";
                echo "</td>";
                echo "<td>";
                echo "$editorial";
                echo "</td>";
                echo "<td>";
                echo "$year";
                echo "</td>";
                echo "<td>";
                echo "$autor";
                echo "</td>";
                echo "<td>";
                echo "$costo";
                echo "</td>";
                echo "<td>";
                echo "$stock";
                echo "</td>";
                echo "<td>";
                echo "<a href=\"edita_libros.php?id=$id\">";
                echo "Editar";
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </table>

    </div>

</body>

</html>

<script>
    $('.lista.f tr').hide();

    function busca() {
        var id = $('#id').val();
        $('.lista.f tr').hide();

        if (id == "") {
            $('.lista.f tr').hide();
            $('.finded p').html('Digite el id para buscar');
        } else if (isNaN(id) == true) {
            $('.lista.f tr').hide();
            $('.finded p').html('Digite un número válido');
        } else if (id <= 0) {
            $('.lista.f tr').hide();
            $('.finded p').html('Digite un id mayor a cero');
        } else {


            // $('.finded p').html('Se esta buscando');
            $.ajax({
                url: 'busca_libros.php',
                type: 'post',
                dataType: 'text',
                data: 'id=' + id,
                success: function(res) {
                    if (res == 1) {
                        $('.finded p').html('');
                        $('.lista.f tr#encabezado').show();
                        $('.lista.f tr#' + id).show();
                    } else {
                        $('.finded p').html('');
                        $('.lista.f tr').hide();
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