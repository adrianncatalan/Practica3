<?php
//Abre sesión 
session_start(); 

//Si inició sesion ejecuta la página
if (isset($_SESSION["seusername"])) {

    //Requiere la conexión BBDD
    require("../BBDD/conexion_BBDD.php");

    //Pone los id de usuario en minúscula
    $usuario = strtolower($_POST["id_usuario"]);

    $clave1 = $_POST["password1"];

    $clave2 = $_POST["password2"];

    //Si las clave son identicas, se cambian las contraseñas
    if($clave1==$clave2){
        //Encriptamos la nueva contraseña
        $clave1= password_hash($clave1,PASSWORD_DEFAULT);

        //Si falla la conexión, nos muestra el error con su descripción
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }
        //Sentencia sql que actualiza
        $sql_actualizar_clave = "update registro_usuarios set clave= '$clave1' where id_usuario = '$usuario'";

        //Si la consulta es correcta y sin errores, guardamos registros
        if ($conexion->query($sql_actualizar_clave) === TRUE) {
            $actualizar_datos = mysqli_query($conexion, $sql_actualizar_clave);

        
            //Si es administrador, requiere la página de función encriptada
            if($_SESSION["seisadmin"]=="si"){
                require("../common/functionencript.php");
                /*encriptación para evitar que los usuarios puedan cambiar el atributo
                del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
                $usuario=encrypt_decrypt($usuario, 'encrypt');
                header("location:../listaVehiculos/lista_vehiculos.php?id_usuario=$usuario");
            }
            //Una vez la contraseña actualizada, volvemos a la página de lista vehiculos
            else{
                header("location:../listaVehiculos/lista_vehiculos.php");
            }
            //Si hay un error en la BBDD, mostra descripción del error
        } else {
            echo "Error: " . $sql_actualizar_clave . "<br>" . $conexion->error;
        }

        //Conexión a la BBDD cerrada
        $conexion->close();
    }
    else{
        //Vamos a lista de vehiculos
        header("location:./lista_vehiculos.php");
    }    
}
//Sino envía al login
else {
    header("location:./index.php");
}
?>


