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
        <form name="forma01" enctype="multipart/form-data">
            <h1>Alta de empleados</h1>

            <!-- <div class="line"><input type="search" name="" id=""></div> -->

            <div class="line">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            </div>

            <div class="line">
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
            </div>

            <div class="line">
                <input type="email" name="correo" id="correo" placeholder="Correo">
            </div>

            <div class="line">
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </div>

            <div class="line">
                <input type="text" name="direccion" id="direccion" placeholder="Dirección">
            </div>

            <div class="line">
                <input type="tel" name="telefono" id="telefono" placeholder="Teléfono">
            </div>

            <div class="line">
                <input type="number" name="edad" id="edad" placeholder="Edad">
            </div>

            <div class="line">
                <select name="puesto" id="puesto">
                    <option value="0">Puesto</option>
                    <option value="1">Administrador</option>
                    <option value="2">Cajero</option>
                    <option value="3">Colaborador</option>
                </select>
            </div>

            <div class="boton"><input type="submit" onclick="recibe(); return false;" value="Registrar"></div>
            <div id="mensaje1"></div>

        </form>

        <div class="regresar">
            <p><a href="lista_empleados.php">Regresar a Lista de empleados</a></p><br><br>
        </div>
    </div>
</body>

</html>


<script>
    function recibe() {
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var correo = $('#correo').val();
        var password = $('#pass').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();
        var edad = $('#edad').val();
        var puesto = $('#puesto').val();
        var largoTel = telefono.length;

        if (nombre == "" || apellidos == "" || correo == "" || password == "" || telefono == "" || edad == "" || puesto == 0) {
            $('#mensaje1').html("Faltan campos por llenar");
            setTimeout("$('#mensaje1').html('');", 2000);
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
        }else{
            $.ajax({
                url: 'correo_empleados.php',
                type: 'post',
                dataType: 'text',
                data: 'correo=' + correo,
                success: function(res) {
                    if (res == 0) {
                        $('#mensaje1').html('El correo ' + correo + ' ya existe');
                        setTimeout("$('#mensaje1').html('');", 2000);
                    } else {
                        document.forma01.method = 'post';
                        document.forma01.action = 'salva_empleados.php';
                        document.forma01.submit();
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado');
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