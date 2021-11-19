<?php
//Abre sesión 
session_start();

//Si inició sesion el usuario, se ejecuta la página
if (isset($_SESSION["seusername"])) {

    //Guardo el id de usuario dependiendo desde que página estoy accediendo a lista vehiculos
    if (isset($_POST["id_usuario"])) {
        $id_usuario_login = $_POST["id_usuario"];
    } else {
        //Si es usuario lo envia a su usuario
        $id_usuario_login = $_SESSION["seusername"];
        //Si es admin lo envia a el usuario sobre el que está trabajando
        if ($_SESSION["seisadmin"] == "si") {
            require("../common/functionencript.php");
            /*Encriptación para evitar que los usuarios puedan cambiar el atributo
                del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
            $id_usuario_login = encrypt_decrypt($_GET["id_usuario"], 'decrypt');
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MachineBreak - Lista vehiculos</title>
        <link rel="stylesheet" href="../../css/footer.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../../css/lista_vehiculos.css">
        <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
        
    </head>

    <body>

        <div class="tittle">
            <h1>Lista de vehiculos</h1>
            <h4>ID usuario: <?php echo ($_SESSION["seusername"]); ?></h4>
        </div>

        <div class="datatable-container">
            <div class="header-tools">
                <div class="tools">

                    <ul>
                        <?php
                        //Si es admin, le deja volver a la lista de usuarios
                        if ($_SESSION["seisadmin"] == "si") {
                            echo ("<a href=\"../listaUsuarios/lista_usuarios.php\"  title=\"Volver\"><img class=\"volver\" src=\"../../img/arrow_back.png\" alt=\"volver\"></a>");
                        }
                        ?>

                        <li>
                            <!--Este botón nos permite agregar un vehiculo nuevo-->
                            <button>
                                <form action="../listaVehiculos/agregar_vehiculos.php" method="POST">
                                    <input class="input-submmit" type="image" src="../../img/car.png" alt="Nuevo Vehículo" title="Nuevo Vehículo">
                                    <input type="hidden" name="id_user" value="<?php echo $id_usuario_login ?>">
                                </form>
                            </button>
                        </li>
                        <li>
                            <!--Este botón nos lleva a la página de información (Funcionalidad en construcción)-->
                            <button>
                                <i class="material-icons" title="Info">info</i>
                            </button>
                        </li>
                        <li>
                            <!--Este botón nos cierra la sesión de usuario -->
                            <button>
                                <a href="../common/cerrar_sesion.php" title="Cerrar Sesión"><i class="material-icons">logout</i></a>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="search">
                    <?php
                    //Requiere la página del footer
                    require("../common/buscador.php");
                    ?>
                </div>
            </div>

            <table class="datatable">
                <h1>Información personal</h1>
                <thead>
                    <tr>
                        <th>Cambiar password</th>
                        <th>Guardar datos</th>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Contacto de emergencia</th>


                        <?php
                        //Utilizamos el require para llamar a la conexión con la BBDD que está en otro fichero
                        require("../BBDD/conexion_BBDD.php");

                        //Consulta si accede desde interfaz
                        $consulta_sql = "select * from registro_usuarios where id_usuario = '$id_usuario_login'";

                        //Consulta si accede desde el buscador
                        if (isset($_POST["buscador"])) {
                            $consulta_sql = "select * from registro_usuarios where id_usuario like '%$id_usuario_login%'";
                        }

                        $resultados = mysqli_query($conexion, $consulta_sql);

                        while ($registros = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {

                        ?>

                <tbody>
                    <!--Aquí mostramos los registros que se encuentran en la base de datos-->
                    <td>
                        <!--Este botón nos cambia la contraseña del usuario-->
                        <form action="../listaUsuarios/cambio_clave.php" method="POST">
                            <input type="image" src="../../img/key.png" alt="Cambiar Clave" title="Cambiar Contraseña">
                            <input type="hidden" name="id_user" value="<?php echo $id_usuario_login ?>">
                        </form>
                    </td>
                    <form action="../listaUsuarios/actualizando_user.php" method="post">
                        <td> <input class="no-editar" type="image" src="../../img/save_as.png" alt="Guardar Cambios" title="Guardar Cambios"></td>
                        <td> <input class="no-editar" readonly type="text" name="id_usuario" value="<?php echo $registros["id_usuario"] ?>"> </td>
                        <td> <input class="no-editar" readonly type="text" name="nombre" value="<?php echo $registros["nombre"] ?>"></td>
                        <td> <input class="no-editar" readonly type="text" name="apellido" value="<?php echo $registros["apellido"] ?>"></td>
                        <td> <input class="editar" require type="text" name="telefono" value="<?php echo $registros["telefono"] ?>"></td>
                        <td> <input class="editar" require type="text" name="email" value="<?php echo $registros["email"] ?>"></td>
                        <td> <input class="editar" require type="text" name="contacto_emergencia" value="<?php echo $registros["contacto_emergencia"] ?>"></td>
                        </tr>
                        <thead>
                            <tr>
                                <th>Fecha de alta</th>
                                <th>Nº de vehiculos</th>
                                <th>Departamento</th>
                                <th>Cargo</th>
                                <th>Administrador</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><input class="no-editar" readonly type="text" name="fecha_alta" value="<?php echo $registros["fecha_alta"] ?>"></td>
                            <td><input class="no-editar" readonly type="text" name="cantidad_vehiculos" value="<?php echo $registros["cantidad_vehiculos"] ?>"></td>
                            <td><input class="no-editar" readonly type="text" name="departamento" value="<?php echo $registros["departamento"] ?>"></td>
                            <td><input class="no-editar" readonly type="text" name="cargo" value="<?php echo $registros["cargo"] ?>"></td>
                            <td><input class="no-editar" readonly type="text" name="administrador" value="<?php echo $registros["administrador"] ?>"></td>
                        </tr>
                </tbody>

                </form>
            <?php
                        }
            ?>

            <thead>
                <div class="info_vehi">
                    <tr>
                        <td class="info_vehi">
                            <h1 class="info_vehi">Información vehicular</h1>
                        </td>
                    </tr>
                </div>
                <tr>
                    <th>Seleccionar</th>
                    <th>Usuario</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                </tr>
            </thead>

            <?php
            //Consulta si accede desde interfaz
            $consulta_sql_coche = "select * from registro_vehiculos where id_usuario = '$id_usuario_login'";

            //Consulta si accede desde el buscador
            if (isset($_POST["buscador"])) {
                $consulta_sql_coche = "select * from registro_vehiculos where id_usuario like '%$id_usuario_login%'";
            }

            $resultados_coche = mysqli_query($conexion, $consulta_sql_coche);
            while ($registros_coche = mysqli_fetch_array($resultados_coche, MYSQLI_ASSOC)) {

            ?>
                <tbody>
                    <tr>
                        <th>
                            <form action="../listaServicios/lista_servicios.php" method="post">
                                <input type="hidden" name="placa" value="<?php echo $registros_coche["placa"] ?>">
                                <input type="hidden" name="id_usuario" value="<?php echo $registros_coche["id_usuario"] ?>">
                                <input class="input-seleccionar" type="submit" value="Seleccionar">
                            </form>
                        </th>

                        <td><?php echo $registros_coche["id_usuario"] ?></td>
                        <td><?php echo $registros_coche["marca"] ?></td>
                        <td><?php echo $registros_coche["modelo"] ?></td>
                        <td><?php echo $registros_coche["placa"] ?></td>
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

    //Requiere la página del footer
    require("../common/footer.php");
    //Sino envía al login
} else {
    header("location:../../index.php");
}
    ?>
    </body>

    </html>