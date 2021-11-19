<?php
    //Utilizamos variables globales con sesiones
    session_start();
    //Si inició sesion ejecuta la página
    if (isset($_SESSION["seusername"])) { 

        //Requiere la conexión BBDD
        require("../BBDD/conexion_BBDD.php");

        $usuario = strtolower($_POST["id_usuario"]);
        $telefono = $_POST["telefono"];
        $email = strtolower($_POST["email"]);
        $con_emer = strtolower($_POST["contacto_emergencia"]);

        //Si falla la conexión, nos muestra el error con su descripción
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }
        //Sentencia sql que actualiza
        $sql_actualizar_data = "update registro_usuarios set telefono= '$telefono', email = '$email', contacto_emergencia = '$con_emer'
        where id_usuario = '$usuario'";

        //Si la consulta es correcta y sin errores, guardamos registros
        if ($conexion->query($sql_actualizar_data) === TRUE) {
            $actualizar_datos = mysqli_query($conexion, $sql_actualizar_data);
         
            //Si es administrador, requiere la página de función encriptada
            if($_SESSION["seisadmin"]=="si"){
                require("../common/functionencript.php");
                /*encriptación para evitar que los usuarios puedan cambiar el atributo
                del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
                $usuario=encrypt_decrypt($usuario, 'encrypt');
                header("location:../listaVehiculos/lista_vehiculos.php?id_usuario=$usuario");
            }
            else{
                //Volvemos a lista de vehiculos
                header("location:../listaVehiculos/lista_vehiculos.php");
            }
        } else {
            //Si hay un error en la BBDD, mostra descripción del error
            echo "Error: " . $sql_actualizar_data . "<br>" . $conexion->error;
        }
        //Conexión a la BBDD cerrada
        $conexion->close();
    }
    //Sino a iniciado sesión, vamos al index
    else {
        header("location:../../index.php");
    } 

?>


