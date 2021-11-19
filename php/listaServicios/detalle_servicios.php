<?php
//Abre sesión, nos permite utilizar variables globales
session_start(); //abre sesión 

//Si inició, sesion ejecuta la página
if (isset($_SESSION["seusername"])) {

    //Dependiendo de donde acceda el usuario, atrapa los datos de una manera u otra
    if (((isset($_POST["id_servicio"])) || ((isset($_POST["tipo_servicio"])))) && (isset($_POST["placa"]))) {

        //Si viene desde el buscador, guardamos el tipo servicio
        if (isset($_POST["tipo_servicio"])) {
            $tipo_servicio = $_POST["tipo_servicio"];
        }
        //Si viene desde la interfaz de lista de servicios, guardamos el ID servicio
        else {
            $id_servicio = $_POST["id_servicio"];
        }
        $placa = $_POST["placa"];
        $id_usuario = $_POST["id_usuario"];

        //Si viene desde actualizar servicio, requerimos los datos por get
    } else {
        require("../common/functionencript.php");
        $data = encrypt_decrypt($_GET["data"], 'decrypt');/*encriptación para evitar que los usuarios puedan cambiar el atributo
        del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
        $data = explode("_", $data);
        $id_servicio = $data[0];
        $placa = $data[1];
        $id_usuario = $data[2];
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MachineBreak - Detalle servicios</title>
        <link rel="stylesheet" href="../../css/footer.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../../css/detalle_servicio.css">
        <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div class="tittle">
            <h1>Detalle de servicios</h1>
            <h4>ID usuario: <?php echo ($_SESSION["seusername"]); ?></h4>
        </div>

        <div class="datatable-container">
            <div class="header-tools">
                <div class="tools">
                    <ul>
                        <li>
                            <form action="./lista_servicios.php" method="post">
                                <!--Botón que le permite volver al usuario a lista vehiculos-->
                                <input type="hidden" name="placa" value="<?php echo $placa ?>">
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                                <input class="volver" type="image" src="../../img/arrow_back.png" title="Volver">

                            </form>

                        </li>
                        <li>
                            <form action="./agregar_servicios.php" method="post">
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
            </div>

            <table class="datatable">
                <h1>Información del Vehiculo</h1>
                <thead>
                    <tr>
                        <th>Guardar datos</th>
                        <th>ID Servicio</th>
                        <th>Placa</th>
                        <th>Tipo Servicio</th>
                        <th>Descripción</th>
                        <th>Fecha Servicio</th>
                    </tr>
                </thead>

                <?php
                //Utilizamos el require para llamar a la conexión con la BBDD que está en otro fichero
                require("../BBDD/conexion_BBDD.php");

                //Consulta si accede desde el buscador
                if (isset($_POST["buscador"])) {
                    $consulta_sql_srv =  "select * from registro_servicios where tipo_servicio like '%$tipo_servicio%' and placa = '$placa'";

                    //Consulta desde la interfaz
                } else {
                    $consulta_sql_srv = "select * from registro_servicios where id_servicio = '$id_servicio' and placa = '$placa'";
                }

                $resultados_srv = mysqli_query($conexion, $consulta_sql_srv);
                while ($registros_srv = mysqli_fetch_array($resultados_srv, MYSQLI_ASSOC)) {

                ?>
                    <form action="./actualizando_servicio.php" method="post">
                        <tbody>
                            <tr>
                                <td><input class="no-editar" type="image" src="../../img/save_as.png" alt="Icono de guardar" title="Guardar Cambios"></td>
                                <td><input class="no-editar" readonly type="text" name="id_servicio" value="<?php echo $registros_srv["id_servicio"] ?>"> </td>
                                <td><input class="no-editar" readonly type="text" name="placa" value="<?php echo $registros_srv["placa"] ?>"></td>
                                <td><input class="editar" require type="text" name="tipo_servicio" value="<?php echo $registros_srv["tipo_servicio"] ?>"></td>
                                <td><input class="editar" require type="text" name="descripcion" value="<?php echo $registros_srv["descripcion"] ?>"></td>
                                <td><input class="no-editar" readonly type="text" name="fecha" value="<?php echo $registros_srv["fecha"] ?>"></td>
                                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                            </tr>
                        </tbody>
                    </form>
                <?php
                }
                ?>
            </table>
        </div>
    <?php
    //Requiere la página del footer
    require("../common/footer.php");

    //Sino envía al login
} else {
    header("location:../../index.php");
}
    ?>
    </body>

    </html>