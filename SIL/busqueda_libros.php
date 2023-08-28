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
        <!-- <h1>Lista de Libros</h1><br> -->
        <!-- <h1><a href="alta_libros.php">Crear nuevo registro</a></h1><br> -->
        <div class="buscar">
            <p>Buscar Libro por ID:</p>
            <input type="search" name="id" id="id" onkeyup="buscarId()">
            <input type="button" value="Buscar" class="btn_buscar" onclick="busca(); return false;">
            <br><div class="mensaje buscar"></div>
        </div>
        <div class="finded">
            <table class="lista f">
                <tr id="encabezado">
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
                    // echo "<td>";
                    // echo "<a href=\"edsbros.php?id=$id\">";
                    // echo "Eliminar";
                    // echo "</a>";
                    // echo "</td>";
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

    function buscarId(){
        var id = $('#id').val();

        $.ajax({
                url: 'buscaId.php',
                type: 'post',
                dataType: 'text',
                data: 'id=' + id,
                success: function(res){
                    if(res==0){
                        // $('.m').show();
                        $('.mensaje.buscar').html('Libro no encontrado');
                        setTimeout("$('.mensaje.buscar').html('');", 2000);
                        // setTimeout("$('.mensajeId').hide();", 2000);
                    }else{
                        // $('.mensajeId').show();
                        $('.mensaje.buscar').html(res);
                    }
                },error: function(){
                    alert('Error archivo no encontrado');
                }
            });
     }
</script>