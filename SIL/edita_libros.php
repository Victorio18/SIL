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
//edita_libros.php

require "funciones/conecta.php";

$con = conecta();

//Recibe valores 
$id = $_REQUEST['id'];

$sql = "SELECT * FROM LIBROS WHERE id = $id";

$res = $con->query($sql);
$row = $res->fetch_array();
$id_row = $row["id"];
$nombre = $row["nombre"];
$isbn = $row["isbn"];
$editorial = $row["editorial"];
$year = $row["year"];
$autor = $row["autor"];
$costo = $row["costo"];
$stock = $row["stock"];

?>


<body>
    <div class="container">

        <form name="forma01" class="form_edit" enctype="multipart/form-data">
            <input type="text" id="id" name="id" value="<?php echo $id_row; ?>">
            <h1>Edición de libros</h1>

            <div class="line">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
            </div>

            <div class="line">
                <input type="text" id="isbn" name="isbn" placeholder="ISBN" value="<?php echo $isbn; ?>" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
            </div>

            <div class="line">
                <input type="text" id="editorial" name="editorial" placeholder="Editorial" value="<?php echo $editorial; ?>">
            </div>

            <div class="line">
                <input type="number" name="year" id="year" placeholder="Año" value="<?php echo $year; ?>">
                <!-- <span id="mensaje2"></span> -->
            </div>

            <div class="line">
                <input type="text" id="autor" name="autor" placeholder="Autor" value="<?php echo $autor; ?>">
            </div>

            <div class="line">
                <input type="number" id="costo" name="costo" placeholder="Costo" step=".01" value="<?php echo $costo; ?>">
            </div>

            <div class="line">
                <input type="number" id="stock" name="stock" placeholder="Stock" value="<?php echo $stock; ?>">
            </div>

            <div class="boton edita"><input class="boton_edit" type="submit" onclick="edita(); return false;" value="Editar"></div><br>
            <div id="mensaje1"></div>

        </form>
        <div class="regresar">
            <p><a href="lista_libros.php">Regresar al listado</a></p>
        </div>
    </div>
</body>

</html>

<script>
    $('#id').hide();

    function edita() {
        var id = $('#id').val();
        var nombre = $('#nombre').val();
        var isbn = $('#isbn').val();
        var editorial = $('#editorial').val();
        var year = $('#year').val();
        var autor = $('#autor').val();
        var costo = $('#costo').val();
        var stock = $('#stock').val();
        var largoISBN = isbn.length;

        if (nombre == "" || isbn == "" || editorial == "" || year == "" || autor == "" || costo == "" || stock == "") {
            // alert("Faltan campos por llenar");
            $('#mensaje1').html('Faltan campos por llenar');
            setTimeout("$('#mensaje1').html('');", 5000);
        } else if(isNaN(isbn)){
            $('#mensaje1').html("El isbn deben ser dígitos");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(largoISBN != 13){
            $('#mensaje1').html("El isbn se debe componer de 13 dígitos");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(eval(year)>2022 || eval(year) <-100000){
            $('#mensaje1').html("Debe ser un año válido");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(eval(stock)>10000){
            $('#mensaje1').html("El stock debe ser menor a 10,000");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(eval(stock)<0){
            $('#mensaje1').html("El stock debe ser mayor a 0");
            setTimeout("$('#mensaje1').html('');", 2000);   
        }else if(eval(costo)>100000){
            $('#mensaje1').html("El costo debe ser menor a 100,000");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(eval(costo)<0){
            $('#mensaje1').html("El costo debe ser mayor a 0");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else {
            $.ajax({
                url: 'isbneditar_libros.php',
                type: 'post',
                dataType: 'text',
                data: 'isbn=' + isbn + '&id=' + id,
                success: function(res) {
                    if (res == 0) {
                        $('#mensaje1').html('El isbn ' + isbn + ' ya existe');
                        setTimeout("$('#mensaje1').html('');", 5000);
                    } else {
                        document.forma01.method = 'post';
                        document.forma01.action = 'editarenbase_libros.php';
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
</script>