<?php
// Sesión iniciada para utilizar varibales globales
    session_start();
     //Si inició sesion ejecuta la página.
    if (isset($_SESSION["seusername"])) {
        require("../BBDD/conexion_BBDD.php");
        $marca = strtolower($_POST["marca"]);
        $modelo = strtolower($_POST["modelo"]);
        $placa = strtoupper($_POST["placa"]);
        $id_usuario = strtolower($_POST["id_usuario"]);

        //Si falla la conexión, nos muestra el error con su descripción
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }
        //Sentencia sql que actualiza
        $sql_actualizar_data = "update registro_vehiculos set marca= '$marca', modelo = '$modelo' where placa = '$placa'";

        //Si la consulta es correcta y sin errores, guardamos registros
        if ($conexion->query($sql_actualizar_data) === TRUE) {
            $actualizar_datos = mysqli_query($conexion, $sql_actualizar_data);
            require("../common/functionencript.php");
            $datos=$id_usuario."_".$placa;
            $datos=encrypt_decrypt($datos, 'encrypt');/*encriptación para evitar que los usuarios puedan cambiar el atributo
            del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
            header("location:../listaServicios/lista_servicios.php?datos=$datos");
            
            //Si hay un error en la BBDD, mostra descripción del error
        } else {
            echo "Error: " . $sql_actualizar_data . "<br>" . $conexion->error;
        }
        //Conexión a la BBDD cerrada
        $conexion->close();
    }
      //Sino a iniciado sesión, vamos al index
    else {

        header("location:../../index.php");
    }
