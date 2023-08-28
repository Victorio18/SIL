<!DOCTYPE html>

<?php
require "menu.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require "funciones/conecta.php";
$con = conecta();
$sql = "SELECT max(id) as maxId FROM surtido";
$res = $con->query($sql);
$row = $res->fetch_array();

//  echo $row["maxId"];
if (isset($row["maxId"])) {
    $id = $row["maxId"];
    $id++;
} else {
    $id = 1;
}
?>

<body>
    <div class="container">
        <form class="ingresar surtido" enctype="multipart/form-data">
            <div class="linea">
                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" id="fecha" disabled>
            </div>
            <div class="linea">
                <label for="folio">Folio de surtido</label>
                <input type="text" name="folio" id="folio" value="<?php echo $id; ?>" disabled>
            </div>
            <div class="linea">
                <label for="id">Id Libro</label>
                <input type="text" name="id" id="id" onkeyup="buscarId()">
                <div class="mensajeId"></div>
            </div>
            <div class="linea">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad">
            </div>

            <div class="registrar_dv">
                <input type="button" class="registrar_btn" onclick="recibe(); return false;" value="Registrar">
                <div id="mensaje1"></div>
            </div>

        </form>

        <div class="grid">
            <table class="grid_table">
                <tr>
                    <td>ISBN</td>
                    <td>Titulo</td>
                    <td>Cantidad</td>
                    <td>Eliminar</td>
                </tr>
            </table>
        </div>

        <div class="finalizarEspacio">
            <input type="button" class="registrar_btn" onclick="finalizar(); return false;" value="Finalizar">
            <div class="mensajeFinalizar"></div>
        </div>
    </div>
</body>

</html>

<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    $('#fecha').val(today);

    $('#mensaje1').hide();
    $('.mensajeId').hide();

    let cantidadArreglo =[];
    let idArreglo =[];

    function recibe(){
        var id = $('#id').val();
        var cantidad = $('#cantidad').val();

        if(id == "" || cantidad == ""){
            $('#mensaje1').show();
            $('#mensaje1').html("Faltan campos por llenar");
            setTimeout("$('#mensaje1').html('');", 2000);
            setTimeout("$('#mensaje1').hide();", 2001);
            // $('#mensaje1').hide();
        }else if(cantidad <=0){
            $('#mensaje1').show();
            $('#mensaje1').html("La cantidad debe ser mayor a 0");
            setTimeout("$('#mensaje1').html('');", 2000);
            setTimeout("$('#mensaje1').hide();", 2001);
        }else if(isNaN(id)){
            $('#mensaje1').show();
            $('#mensaje1').html("El id debe ser un número válido");
            setTimeout("$('#mensaje1').html('');", 2000);
            setTimeout("$('#mensaje1').hide();", 2001);
        } else if(Number.isInteger(eval(cantidad)) == false){
            $('#mensaje1').show();
            $('#mensaje1').html("La cantidad debe ser un valor entero");
            setTimeout("$('#mensaje1').html('');", 2000);
            setTimeout("$('#mensaje1').hide();", 2001);
        }else{
            // console.log("");
            $.ajax({
                url: 'buscarVenta.php',
                type: 'post',
                dataType: 'json',
                data: 'id=' + id,
                success: function(res){
                    if(res.mensaje == '1'){
                        if(idArreglo.indexOf(res.id) == -1){  // Evalua si el id a ingresar ya se ingreso o si es nuevo
                            
                            console.log("Nuevo id");
                            // alert(res.stock);
                            if(eval(cantidad) > 1000){ //Evalua que la cantidad del nuevo no supere a la anterior
                                console.log("false");
                                $('#mensaje1').show();
                                $('#mensaje1').html("Cantidad excede 1000 unidades");
                                setTimeout("$('#mensaje1').html('');", 2000);
                                setTimeout("$('#mensaje1').hide();", 2001);
                            }else{
                                idArreglo.push(res.id);
                                $('.grid_table').append('<tr id='+res.id+'><td>'+res.isbn+'</td><td>'+res.nombre+'</td><td class = "cantidad">'+cantidad+'</td><td><a href= "javascript:void(0);" onclick="eliminaFilas('+res.id+');">Eliminar</a></td></tr>'); 
                
                            }
                            
                        }else{
                            console.log("Ya lo agregaste carnal");
                            if(eval($('#'+res.id+' .cantidad').text()) >= 1000){
                                console.log("false");
                                $('#mensaje1').show();
                                $('#mensaje1').html("Cantidad excede 1000 unidades");
                                setTimeout("$('#mensaje1').html('');", 2000);
                                setTimeout("$('#mensaje1').hide();", 2001);
                            }else{
                                // var costoActual = $('#'+res.id+' .costo').text();
                                var actual = $('#'+res.id+' .cantidad').text();
                                var nuevaCantidad = eval(actual) + eval(cantidad);
                                // var nuevoCosto = nuevaCantidad * eval(costoActual);
                                if(eval(nuevaCantidad)<=1000){
                                    $('#'+res.id+' .cantidad').text(nuevaCantidad);
                                    // $('#'+res.id+' .subtotal').text('$'+nuevoCosto.toFixed(2));
                                    // totalCalcular();
                                }else{
                                    console.log("false");   
                                    $('#mensaje1').show();
                                $('#mensaje1').html("Cantidad excede 1000 unidades");
                                setTimeout("$('#mensaje1').html('');", 2000);
                                setTimeout("$('#mensaje1').hide();", 2001);
                                }
                                
                            }
                        }   
                        
                    }else{
                        $('#mensaje1').show();
                        $('#mensaje1').html('Necesita registrar el libro para avanzar');
                        setTimeout("$('#mensaje1').html('');", 2000);
                        setTimeout("$('#mensaje1').hide();", 2001);
                    }
                },error: function(){
                    alert('Error archivo no encontrado');
                }
            });
        }
     }

     function buscarId(){
        var id = $('#id').val();
        if(isNaN(id)){
            $('.mensajeId').show();
            $('.mensajeId').html('Libro no encontrado');
            setTimeout("$('.mensajeId').html('');", 2000);
            setTimeout("$('.mensajeId').hide();", 2000);
        }else{
            $.ajax({
                url: 'buscaId.php',
                type: 'post',
                dataType: 'text',
                data: 'id=' + id,
                success: function(res){
                    if(res==0){
                        $('.mensajeId').show();
                        $('.mensajeId').html('Libro no encontrado');
                        setTimeout("$('.mensajeId').html('');", 2000);
                        setTimeout("$('.mensajeId').hide();", 2000);
                    }else{
                        $('.mensajeId').show();
                        $('.mensajeId').html(res);
                    }
                },error: function(){
                    alert('Error archivo no encontrado');
                }
            });
        }
       
     }

     function eliminaFilas(id){
        for(let i=0; i<idArreglo.length; i++){
            console.log(idArreglo[i]);
        }

        const valor = idArreglo.indexOf(String(id));
        console.log("valor= "+valor);

        if(valor > -1){
            idArreglo.splice(valor, 1);     
        }
       
        for(let i=0; i<idArreglo.length; i++){
            console.log(idArreglo[i]);
        }
        $('#'+id).hide();
        $('#'+id).remove();
     }

     function finalizar(){
        var cantidadArr = [];
        
         if(idArreglo.length == 0){
            $('.mensajeFinalizar').html('Necesita ingresar libros para finalizar');
            setTimeout("$('.mensajeFinalizar').html('');", 2000);
            
         }else{
            for(let i=0; i<idArreglo.length; i++){
                cantidadArr[i] = $('#'+idArreglo[i]+' .cantidad').text();
            }
   
            
            var folio = $('#folio').val();
                
            $.ajax({
                url: 'salva_surtido.php',
                type: 'post',
                dataType: 'text',
                data: {'folio':JSON.stringify(folio) ,'idArreglo': JSON.stringify(idArreglo), 'cantidad': JSON.stringify(cantidadArr)},
                success: function(res){
                    // console.log(res);
                    if(res == 1){
                        setTimeout(function(){window.location.href = "lista_surtido.php";}, 1000);
                    }else{
                        alert("No se pudo");
                    }
                    
                },error: function(){
                    alert('Error archivo no encontrado');
                }
            });
         }
     }


</script>