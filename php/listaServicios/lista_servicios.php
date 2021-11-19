<?php
//Abre sesión, nos permite utilizar variables globales
session_start();

//Si inició, sesion ejecuta la página
if (isset($_SESSION["seusername"])) {

    //Guardo el id de usuario en una variable para realizar la consulta SQL y mostrar su información
    if (isset($_POST["placa"])) {
        $placa = $_POST["placa"];
        $id_usuario = $_POST["id_usuario"];
    } else {
        require("../common/functionencript.php");
        /*encriptación para evitar que los usuarios puedan cambiar el atributo
                del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
        $datos = encrypt_decrypt($_GET["datos"], 'decrypt');
        $datos = explode("_", $datos);
        $id_usuario = $datos[0];
        $placa = $datos[1];
    }
    //Utilizamos el require para llamar a la conexión con la BBDD que está en otro fichero
    require("../BBDD/conexion_BBDD.php");

    //consulta para cuando se accede desde la interfaz
    $consulta_sql_coche = "select * from registro_vehiculos where placa = '$placa' and id_usuario = '$id_usuario'";

    //Consulta para cuando se accede desde el buscador(de la página lista vehiculos)
    if (isset($_POST["buscador"])) {
        $id_usuario = $_POST["id_usuario"];
        $consulta_sql_coche = "select * from registro_vehiculos where placa LIKE '%$placa%' and id_usuario = '$id_usuario'";
    }

    $resultados_coche = mysqli_query($conexion, $consulta_sql_coche);
    $registros_coche = mysqli_fetch_all($resultados_coche, MYSQLI_ASSOC);
    $placa = $registros_coche[0]["placa"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MachineBreak - Lista servicios</title>
        <link rel="stylesheet" href="../../css/footer.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../../css/lista_servicios.css">
        <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    </head>

    <body>

        <div class="tittle">
            <h1>Lista de servicios</h1>
            <h4>ID usuario: <?php echo ($_SESSION["seusername"]); ?></h4>
        </div>

        <div class="datatable-container">
            <div class="header-tools">
                <div class="tools">
                    <ul>
                        <li>
                            <form action="../listaVehiculos/lista_vehiculos.php" method="post">
                                <!--Botón que le permite volver al usuario a lista vehiculos-->
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                                <input class="volver" type="image" src="../../img/arrow_back.png" title="Volver">
                            </form>
                        </li>
                        <li>
                            <form action="../listaServicios/agregar_servicios.php" method="post">
                                <!--Botón que le permite agregar servicio al usuario-->
                                <input type="hidden" name="placa" value="<?php echo $placa ?>">
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                                <div class="testing"><input class="llave" type="image" src="../../img/llave.png" title="Agregar Servicio"></div>
                            </form>
                        </li>
                        <li>
                            <button>
                                <!--Botón que le permite ir a la página de información (En construcción)-->
                                <i class="material-icons" title="Info">info</i>
                            </button>
                        </li>
                        <li>
                            <button>
                                <!--Botón que le permite cerrar sesión al usuario-->
                                <a href="../common/cerrar_sesion.php" title="Cerrar Sesión"><i class="material-icons">logout</i></a>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="search">
                    <!--Require la página buscardor-->
                    <?php
                    require("../common/buscador.php");
                    ?>
                </div>
            </div>

            <table class="datatable">
                <h1>Información del Vehiculo</h1>
                <thead>
                    <tr>
                        <th>Guardar datos</th>
                        <th>ID Usuario</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Placa</th>
                    </tr>
                </thead>

                <form action="../listaVehiculos/actualizando_vehiculo.php" method="post">
                    <tbody>
                        <tr>
                            <!--Muestra los registros que están alojados en la BBDD-->
                            <!--Botón que nos permite guardar los cambios realizados-->
                            <td> <input class="no-editar" type="image" src="../../img/save_as.png" alt="Icono de guardar" title="Guardar Cambios"></td>
                            <td> <input class="no-editar" readonly type="text" name="id_usuario" value="<?php echo $registros_coche[0]["id_usuario"] ?>"> </td>
                            <td><input class="editar" require type="text" name="marca" value="<?php echo $registros_coche[0]["marca"] ?>"></td>
                            <td><input class="editar" require type="text" name="modelo" value="<?php echo $registros_coche[0]["modelo"] ?>"></td>
                            <td><input class="no-editar" readonly type="text" name="placa" value="<?php echo $placa ?>"></td>
                        </tr>
                    </tbody>
                </form>
                <thead>
                    <div class="info_vehi">
                        <tr>
                            <td class="info_vehi">
                                <h1 class="info_vehi">Información de Servicios</h1>
                            </td>
                        </tr>
                    </div>
                    <tr>
                        <th>Seleccionar</th>
                        <th>ID servicio</th>
                        <th>Placa</th>
                        <th>Tipo de servicio</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>

                <?php
                //Consulta SQL, la guardamos en una variable y con el bucle while mostramos los registros encontrados en la BBDD
                $consulta_sql_servicios = "select * from registro_servicios where placa = '$placa'";
                $resultados_servicios = mysqli_query($conexion, $consulta_sql_servicios);
                while ($registros_servicios = mysqli_fetch_array($resultados_servicios, MYSQLI_ASSOC)) {
                ?>
                    <tbody>
                        <tr>
                            <th>
                                <form action="./detalle_servicios.php" method="post">
                                    <input type="hidden" name="id_servicio" value="<?php echo $registros_servicios["id_servicio"] ?>">
                                    <input type="hidden" name="placa" value="<?php echo $placa ?>">
                                    <input type="hidden" name="id_usuario" value="<?php echo $registros_coche[0]["id_usuario"] ?>">
                                    <input class="input-seleccionar" type="submit" value="Seleccionar">
                                </form>
                            </th>
                            <td><?php echo $registros_servicios["id_servicio"] ?></td>
                            <td><?php echo $registros_servicios["placa"] ?></td>
                            <td><?php echo $registros_servicios["tipo_servicio"] ?></td>
                            <td><?php echo $registros_servicios["descripcion"] ?></td>
                            <td><?php echo $registros_servicios["fecha"] ?></td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
            <div class="footer-tools">
                <div class="list-items">
                    Mostrar
                    <select name="n-entries" id="n-enties" class="n-entries">
                        <option value="1" selected>1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                    Entradas
                </div>
                <div class="pages">
                    <ul>
                        <li><span class="active">1</span></li>
                        <li><button>2</button></li>
                        <li><button>3</button></li>
                        <li><button>4</button></li>
                        <li><button>...</button></li>
                        <li><button>9</button></li>
                        <li><button>10</button></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    //Requerimos la página del footer
    require("../common/footer.php");
    //Sino envía al login
} else {
    header("location:../../index.php");
}
    ?>
    </body>

    </html>