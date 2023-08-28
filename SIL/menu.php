<?php
session_start();
if (isset($_SESSION['idU'])) {
    $idU = $_SESSION['idU'];
    $nombre = $_SESSION['nombre'];
    // $puesto = $_SESSION['puesto'];
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-reset.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <title>Solución Integral para Librerías</title>
</head>

<body>
    <div class="header-container">
        <header>
            <nav>
                <!-- <a href="lista_empleados.php"> -->
                <div class="navbutton">EMPLEADO
                    <div class="dropdown-box">
                        <a href="lista_empleados.php">
                            <div class="navbutton">
                                Lista
                            </div>
                        </a>
                        <a href="alta_empleados.php">
                            <div class="navbutton">
                                Registro
                            </div>
                        </a>
                        <a href="busqueda_empleado.php">
                            <div class="navbutton">
                                Buscar
                            </div>
                        </a>
                    </div>
                </div>
                <!-- </a> -->

                <!-- <a href="lista_libros.php"> -->
                    <div class="navbutton">LIBRO
                    <div class="dropdown-box">
                        <a href="lista_libros.php">
                            <div class="navbutton">
                                Lista
                            </div>
                        </a>
                        <a href="alta_libros.php">
                            <div class="navbutton">
                                Registro
                            </div>
                        </a>
                        <a href="busqueda_libros.php">
                            <div class="navbutton">
                                Buscar
                            </div>
                        </a>
                    </div>
                    </div>
                <!-- </a> -->


                <div class="navbutton">SURTIDO
                    <div class="dropdown-box">
                        <a href="lista_surtido.php">
                            <div class="navbutton">
                                Lista
                            </div>
                        </a>
                        <a href="registro_surtido.php">
                            <div class="navbutton">
                                Registro
                            </div>
                        </a>
                        <a href="busqueda_surtido.php">
                            <div class="navbutton">
                                Buscar
                            </div>
                        </a>
                    </div>
                </div>



                <div class="navbutton">VENTA
                    <div class="dropdown-box">
                        <a href="lista_venta.php">
                            <div class="navbutton">
                                Lista
                            </div>
                        </a>
                        <a href="registro_venta.php">
                            <div class="navbutton">
                                Registro
                            </div>
                        </a>
                        <a href="busqueda_venta.php">
                            <div class="navbutton">
                                Buscar
                            </div>
                        </a>

                    </div>

                </div>

                <!-- <div class="navbutton">DEVOLUCIÓN
                    <div class="dropdown-box dev">
                        <a href="#">
                            <div class="navbutton">
                                Lista
                            </div>
                            <div class="navbutton">
                                Registro
                            </div>
                            <div class="navbutton">
                                Consulta
                            </div>
                        </a>
                    </div>

                </div> -->

                <div class="navbutton">
                    <p class="bienvenido">Bienvenido <?php echo $nombre; ?></p>
                </div>

                <a href="salir.php">
                    <div class="navbutton">
                        CERRAR SESION
                    </div>
                </a>





            </nav>
        </header>
    </div>
</body>

</html>