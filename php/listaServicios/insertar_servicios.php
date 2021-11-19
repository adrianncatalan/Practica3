<?php

//Abre sesión, nos permite utilizar variables globales
session_start(); 

//Si inició sesion, se ejecuta la página
if (isset($_SESSION["seusername"])) {  

    require("../common/fecha_alta.php");

    require("../BBDD/conexion_BBDD.php");

    $cant_servicios = ($_POST["cant_servicios"]);

    $cant_servicios++;

    $placa = strtoupper($_POST["placa"]);

    $tipo_servicio = strtolower($_POST["tipo_servicio"]);

    $descripcion = $_POST["descripcion"];
    
    $id_usuario = $_POST["id_usuario"];

    //Consulta agregar servicio
    //Si la conexión falla, nos muestra el error con su descripción
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
      }
      //Sentencia sql que nos permite ingresar datos de servicios
      $sql = "INSERT INTO registro_servicios (id_servicio, placa, tipo_servicio, descripcion,fecha)
      VALUES ('$cant_servicios', '$placa', '$tipo_servicio', '$descripcion', '$sysdate')";

      //Si la consulta está correctamente formulada y no tiene errores, se guardan los registros en la variable
      if ($conexion->query($sql) === TRUE) {
        $insercion_datos = mysqli_query($conexion, $sql);

        //Al ser exoitosa la consulta, requerimos la página functionencript
        require("../common/functionencript.php");
        $datos = $id_usuario."_".$placa;
        /*Encriptación para evitar que los usuarios puedan cambiar el atributo
          del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
        $datos=encrypt_decrypt($datos, 'encrypt');
                
        header("location:./lista_servicios.php?datos=$datos");
            
      } 
      else {
        //Nos muestra error de la BBDD
        echo "Error: " . $sql . "<br>" . $conexion->error;
      }

      //Cerramos la conexión de la BBDD
      $conexion->close();

    }
    //Sino, se envía al login
    else {

      header("location:../../index.php");
    }
