<?php
// Sesión iniciada para utilizar varibales globales
session_start(); 

//Si inició sesion y es admin ejecuta la página
if ((isset($_SESSION["seusername"])) && ($_SESSION["seisadmin"] == "si")) { 
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MachineBreak - Lista de usuarios</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../../css/lista_usuarios.css">
        <link rel="stylesheet" href="../../css/footer.css">
        <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
        
        
    </head>

    <body>

        <div class="tittle">
            <h1>Lista de usuarios</h1>
            <h4>ID usuario: <?php echo ($_SESSION["seusername"]); ?></h4>

        </div>

        <div class="datatable-container">
            <div class="header-tools">
                <div class="tools">
                    <ul>
                        <li>
                            <!--Este botón nos recarga la página de lista de usuarios-->
                            <button name="lista_usuarios">
                                <a href="lista_usuarios.php" title="Lista Usuarios"><i style="color: #fff;" class="material-icons">description</i></a>
                            </button>
                        </li>
                        <li>

                            <?php
                            //Utilizamos el require para llamar a la conexión con la BBDD que está en otro fichero
                            require("../BBDD/conexion_BBDD.php");

                            //Hacemos una consulta SQL y la guardamos en una variable
                            $consulta_sql = "select * from registro_usuarios ORDER BY id_usuario";

                            /*
                            Luego en otra variable nueva llamada resultados guardamos una función mysqli_query()
                            que se utiliza para guardar en el buffer del usuario o cliente la consulta que se está
                            ejecutando, en primer lugar, se hace la conexión a la base de datos, y luego se realiza
                            la consulta SQL. A este tipo de variable se le llama record-set, lo que significa que se
                            crea una tabla virtual con los datos consultados.
                            */
                            $resultados = mysqli_query($conexion, $consulta_sql);
                            ?>

                        </li>

                        <li>
                            <!--Este botón nos lleva a la página de lista de vehiculos del usuario que ha iniciado sesión (Admin)-->
                            <form action="../listaVehiculos/lista_vehiculos.php" method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["seusername"] ?>">
                                <div class="testing"><input class="input-submmit" type="image" src="../../img/input-submmit.png" title="Mis Vehículos"></div>
                            </form>
                        </li>
                        </li>
                        <li>
                            <!--Este botón nos lleva a la página de agregar usuario-->
                            <button>
                                <a href="../listaUsuarios/agregar_usuario.php" title="Agregar Usuario"><i class="material-icons">person_add_alt_1</i></a>
                            </button>
                        </li>
                        <li>
                            <!--Este botón nos lleva a la página de eliminar usuario (Funcionalidad en construcción)-->
                            <button>
                                <i class="material-icons" title="Eliminar Usuario">person_remove</i>
                            </button>
                        </li>
                        <li>
                            <!--Este botón nos lleva a la página de configuración (Funcionalidad en construcción)-->
                            <button>
                                <i class="material-icons" title="Configuración">settings_applications</i>
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
                    //Requiere la página del buscador
                    require("../common/buscador.php");
                    ?>
                </div>
            </div>

            <table class="datatable">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Contacto de emergencia</th>
                        <th>Fecha de alta</th>
                        <th>Nº de vehiculos</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Administrador</th>
                    </tr>
                </thead>

                <?php
                /*
        Mostramos los datos de los usuarios con el bucle while, haciendo uso de la función mysqli_fetch_array.
        Dicha función debe ser implementada con dos párametros, la variable que guarda los resultados de la consulta SQL
        y otro párametro que es una constante que nos permite indicar que trabajamos con arrays asociativos.
        */
                while ($registros = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {

                ?>
                    <tbody>
                        <tr>
                            <form action="../listaVehiculos/lista_vehiculos.php" class="lista_users" method="post">
                                <input type="hidden" name="id_usuario" value="<?php echo $registros["id_usuario"] ?>">
                                <td class="table-checkbox"><button class="input-seleccionar" type="submit" name="seleccionar">Seleccionar</button></td>
                            </form>
                            <td><?php echo $registros["id_usuario"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["telefono"] ?></td>
                            <td><?php echo $registros["email"] ?></td>
                            <td><?php echo $registros["contacto_emergencia"] ?></td>
                            <td><?php echo $registros["fecha_alta"] ?></td>
                            <td><?php echo $registros["cantidad_vehiculos"] ?></td>
                            <td><?php echo $registros["departamento"] ?></td>
                            <td><?php echo $registros["cargo"] ?></td>
                            <td><?php echo $registros["administrador"] ?></td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
            <div class="footer-tools">
                <!--Estos botones nos muestran más registros de usuarios (Funcionalidad en construcción)-->
                <div class="list-items">
                    Mostrar
                    <select name="n-entries" id="n-enties" class="n-entries">
                        <option value="15">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                    </select>
                    Entradas
                </div>

                <div class="pages">
                    <ul>
                        <!--Estos botones nos muestran más registros de usuarios (Funcionalidad en construcción)-->
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
    //Requerimos el footer
    require("../common/footer.php");

    //Sino envía al login
} else {
    header("location:../../index.php");
}
    ?>
    </body>

    </html>