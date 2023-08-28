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
        <!-- <h1>Lista de empleados</h1><br>
        <h1><a href="alta_empleados.php">Crear nuevo registro</a></h1>
        <br> -->
        <div class="buscar">
            <p>Buscar Empleado por Id:</p>
            <input type="search" name="id" id="id" onkeyup="buscarId()">
            <input type="button" value="Buscar" class="btn_buscar" onclick="busca(); return false;">
            <br><div class="mensaje buscar"></div>
        </div>

        <div class="finded">
            <table class="lista f">
                <tr id="encabezado">
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Correo</td>
                    <td>Dirección</td>
                    <td>Telefono</td>
                    <td>Edad</td>
                    <td>Puesto</td>
                    <td>Editar</td>
                    <!-- <td>Eliminar</td> -->
                </tr>

                <?php
                require "funciones/conecta.php";
                $con = conecta();
                $sql = "SELECT * FROM EMPLEADOS";
                $res = $con->query($sql);
                while ($row = $res->fetch_array()) {
                    $id =        $row["idEmpleado"];
                    $nombre =    $row["nombre"];
                    $apellidos = $row["apellidos"];
                    $correo    = $row["correo"];
                    $direccion = $row["direccion"];
                    $telefono = $row["telefono"];
                    $edad = $row["edad"];
                    $puesto       = $row["puesto"];
                    $puestoImpreso = ($puesto == '1') ? 'Administrador' : (($puesto  == '2') ? 'Cajero' : 'Almacenista');
                    // $identificador = "fila"  .$id;
                    echo "<tr id = \"$id\">";
                    echo "<td>";
                    echo "$id";
                    echo "</td>";
                    echo "<td>";
                    echo "$nombre";
                    echo "</td>";
                    echo "<td>";
                    echo "$apellidos";
                    echo "</td>";
                    echo "<td>";
                    echo "$correo";
                    echo "</td>";
                    echo "<td>";
                    echo "$direccion";
                    echo "</td>";
                    echo "<td>";
                    echo "$telefono";
                    echo "</td>";
                    echo "<td>";
                    echo "$edad";
                    echo "</td>";
                    echo "<td>";
                    echo "$puestoImpreso";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=\"edita_empleados.php?id=$id\">";
                    echo "Editar";
                    echo "</a>";
                    echo "</td>";
                    // echo "<td>";
                    // echo "<a href=\"javascript:void(0);\" onclick=\"eliminaFilas($id);\">";
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
                url: 'busca_empleados.php',
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
                url: 'buscaEmpleadoAjax.php',
                type: 'post',
                dataType: 'text',
                data: 'id=' + id,
                success: function(res){
                    if(res==0){
                        // $('.m').show();
                        $('.mensaje.buscar').html('Empleado no encontrado');
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