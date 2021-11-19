<?php
    //Utilizamos variables globales con sesiones
    session_start();

    //Si inició sesion ejecuta la página
    if (isset($_SESSION["seusername"])) {
        require("../BBDD/conexion_BBDD.php");

        $id_servicio = $_POST["id_servicio"];
        $tipo_servicio = strtolower($_POST["tipo_servicio"]);
        $descripcion = $_POST["descripcion"];
        $placa = $_POST["placa"];
        $id_usuario = $_POST["id_usuario"];

        //Si falla la conexión, nos muestra el error con su descripción
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }
        //Sentencia sql que actualiza
        $sql_actualizar_data = "update registro_servicios set tipo_servicio= '$tipo_servicio', descripcion = '$descripcion' where id_servicio = '$id_servicio'";

        //Si la consulta es correcta y sin errores, guardamos registros
        if ($conexion->query($sql_actualizar_data) === TRUE) {
            $actualizar_datos = mysqli_query($conexion, $sql_actualizar_data);
                
                $data=$id_servicio."_".$placa."_".$id_usuario;
                require("../common/functionencript.php");
                /*encriptación para evitar que los usuarios puedan cambiar el atributo
                del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
                $data=encrypt_decrypt($data, 'encrypt');
                header("location:./detalle_servicios.php?data=$data");

        //Si falla la conexión, nos muestra el error con su descripción
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
?>


