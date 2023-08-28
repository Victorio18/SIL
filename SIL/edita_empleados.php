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
<?php
//edita_empleados.php

require "funciones/conecta.php";

$con = conecta();

//Recibe valores 
$id = $_REQUEST['id'];

$sql = "SELECT * FROM empleados WHERE idEmpleado = $id";

$res = $con->query($sql);
$row = $res->fetch_array();
$id_row = $row["idEmpleado"];
$nombre = $row["nombre"];
$apellidos = $row["apellidos"];
$correo = $row["correo"];
$direccion = $row["direccion"];
$telefono = $row["telefono"];
$edad = $row["edad"];
$puesto = $row["puesto"];
$puestoImpreso = ($puesto == '1') ? 'Administrador' : (($puesto  == '2') ? 'Cajero' : 'Colaborador');

?>


<body>
    <div class="container">

        <form name="forma01" class="form_edit" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $id_row; ?>">
            <h1>Edición de empleados</h1>

            <div class="line">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
            </div>

            <div class="line">
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidos; ?>">
            </div>

            <div class="line">
                <input type="email" name="correo" id="correo" placeholder="Correo" value="<?php echo $correo; ?>">
                <span id="mensaje2"></span>
            </div>

            <div class="line">
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>

            <div class="line">
                <input type="text" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">
            </div>

            <div class="line">
                <input type="tel" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
            </div>

            <div class="line">
                <input type="number" id="edad" name="edad" placeholder="Edad" value="<?php echo $edad; ?>">
            </div>

            <div class="line">
                <select name="puesto" id="puesto">
                    <?php
                    $cargos = [
                        0 => 'Puesto',
                        1 => 'Administrador',
                        2 => 'Cajero',
                        3 => 'Colaborador'
                    ];
                    for ($i = 0; $i < 4; $i++) {
                        $selected = ($puesto == $i) ? ' selected' : ' ';
                        echo '<option' . $selected . ' value=' . $i . '>' . $cargos[$i] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="boton"><input class="boton_edit" type="submit" onclick="edita(); return false;" value="Editar"></div>
            <div id="mensaje1"></div>

        </form>
        <div class="regresar">
            <p><a href="lista_empleados.php">Regresar al listado</a></p>
        </div>
    </div>
</body>

</html>

<script>
    $('#id').hide();

    function edita() {
        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var password = $('#pass').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();
        var edad = $('#edad').val();
        var puesto = $('#puesto').val();
        var largoTel = telefono.length;

        if (nombre == "" || apellidos == "" || correo == "" || puesto == 0 || direccion == "" || telefono == "" || edad == "") {
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        }else if(isNaN(telefono) == true){
            $('#mensaje1').html("Digite un telefono valido");
            setTimeout("$('#mensaje1').html('');", 2000);

        }else if(largoTel != 10){
            $('#mensaje1').html("El telefono debe tener 10 numeros");
            setTimeout("$('#mensaje1').html('');", 2000);

        } else if(edad < 0 || edad > 100){
            $('#mensaje1').html("Digite una edad valida");
            setTimeout("$('#mensaje1').html('');", 2000);
            
        }else if(validarEmail(correo) == false){
            $('#mensaje1').html("Digite un correo valido");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(edad < 18 ){
            $('#mensaje1').html("El empleado debe ser mayor de edad ");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else {
            $.ajax({
                url: 'correoeditar_empleados.php',
                type: 'post',
                dataType: 'text',
                data: 'correo=' + correo + '&id=' + id,
                success: function(res) {
                    if (res == 0) {
                        $('#mensaje1').html('El correo ' + correo + ' ya existe');
                        setTimeout("$('#mensaje1').html('');", 5000);
                    } else {
                        document.forma01.method = 'post';
                        document.forma01.action = 'editarenbase_empleados.php';
                        document.forma01.submit();
                    }
                    // alert(res);
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        }
    }

    function validarEmail(valor) {
  if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)){
   return true;
  } else {
   return false;
  }
}
</script>