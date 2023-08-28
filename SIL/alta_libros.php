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
            <h1>Alta de Libros</h1>

            <!-- <div class="line"><input type="search" name="" id=""></div> -->

            <div class="line">
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            </div>

            <div class="line">
                <input type="text" name="isbn" id="isbn" placeholder="ISBN" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
            </div>

            <div class="line">
                <input type="text" name="editorial" id="editorial" placeholder="Editorial">
            </div>

            <div class="line">
                <input type="number" name="year" id="year" max="2022" placeholder="Año">
            </div>

            <div class="line">
                <input type="text" name="autor" id="autor" placeholder="Autor">
            </div>

            <div class="line">
                <input type="number" name="costo" id="costo" step=".01" placeholder="Costo">
            </div>

            <div class="line">
                <input type="number" name="stock" id="stock" placeholder="Stock">
            </div>

            <div class="boton libro"><input type="submit" onclick="recibe(); return false;" value="Registrar"></div><br>
            <div id="mensaje1"></div>

        </form>

        <div class="regresar">
            <p><a href="lista_libros.php">Regresar a Lista de Libros</a></p>
        </div><br><br>
    </div>
</body>

</html>


<script>
    function recibe() {
        var nombre = $('#nombre').val();
        var isbn = $('#isbn').val();
        var editorial = $('#editorial').val();
        var year = $('#year').val();
        var autor = $('#autor').val();
        var costo = $('#costo').val();
        var stock = $('#stock').val();
        var largoISBN = isbn.length;

        if (nombre == "" || isbn == "" || editorial == "" || year == "" || autor == "" || costo == "" || stock == "") {
            $('#mensaje1').html("Faltan campos por llenar");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(isNaN(isbn)){
            $('#mensaje1').html("El isbn deben ser dígitos");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(largoISBN != 13){
            $('#mensaje1').html("El isbn se debe componer de 13 dígitos");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(eval(year)>2022 || eval(year) <-100000){
            $('#mensaje1').html("Debe ser un año válido");
            setTimeout("$('#mensaje1').html('');", 2000);
        }else if(eval(stock)>1000){
            $('#mensaje1').html("El stock debe ser menor a 1,000");
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
                url: 'correo_isbn.php',
                type: 'post',
                dataType: 'text',
                data: 'isbn=' + isbn,
                success: function(res){
                    if(res==0){
                        $('#mensaje1').html('El ISBN '+isbn+' ya existe');
                        setTimeout("$('#mensaje1').html('');", 2000);
                    }else{
                        document.forma01.method = 'post';
                        document.forma01.action = 'salva_libros.php';
                        document.forma01.submit();
                    }
                },error: function(){
                    alert('Error archivo no encontrado');
                }
            });
        }
    }
</script>