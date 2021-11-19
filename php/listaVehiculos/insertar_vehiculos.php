<?php
//Utilizamos variables globales con sesiones
  session_start(); 
  //Si inició sesion ejecuta la página
  if (isset($_SESSION["seusername"])) { 
    //Requiere la página fecha de alta
    require("../common/fecha_alta.php");

    //Requiere la conexión BBDD
    require("../BBDD/conexion_BBDD.php");

    $id_usuario = strtolower($_POST["id_usuario"]);
    $placa = strtoupper($_POST["placa"]);
    $marca = strtolower($_POST["marca"]);
    $modelo = strtolower($_POST["modelo"]);
    $cant_vehiculos = $_POST["cant_vehiculos"];
    $cant_vehiculos++;

    //Consulta que suma 1 en cant_vehiculos tabla usuarios
    if ($conexion->connect_error) {
      die("Connection failed: " . $conexion->connect_error);
    }
    //Sentencia sql 
    $sql2 = "update registro_usuarios set cantidad_vehiculos= '$cant_vehiculos' where id_usuario = '$id_usuario'";

    //Si la consulta es correcta y sin errores, guardamos registros
    if ($conexion->query($sql2) === TRUE) {
      $insercion_datos = mysqli_query($conexion, $sql2);
    } 
    //Si hay un error en la BBDD, mostra descripción del error
    else {
      echo "Error: " . $sql2 . "<br>" . $conexion->error;
    }

    //Si hay un error en la BBDD, mostra descripción del error
    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
      }
      //Sentencia sql para insertar datos
      $sql = "INSERT INTO registro_vehiculos (id_usuario, marca, modelo, placa,fecha_alta)
      VALUES ('$id_usuario', '$marca', '$modelo', '$placa', '$sysdate')";

      //Si la consulta es correcta y sin errores, guardamos registros
      if ($conexion->query($sql) === TRUE) {
        $insercion_datos = mysqli_query($conexion, $sql);

        //Si es administrador, requiere la página de función encriptada
        if($_SESSION["seisadmin"]=="si"){
          require("../common/functionencript.php");
          /*encriptación para evitar que los usuarios puedan cambiar el atributo
          del get en la url. de esta manera solo se puede acceder a datos mediante la interfaz*/
          $id_usuario=encrypt_decrypt($id_usuario, 'encrypt');
          header("location:../listaVehiculos/lista_vehiculos.php?id_usuario=$id_usuario");
            
        }
        else{
          //Vamos a la lista de vehiculos
            header("location:../listaVehiculos/lista_vehiculos.php");
        }

      } 
      else {
        //Si hay un error en la BBDD, mostra descripción del error
        echo "Error: " . $sql . "<br>" . $conexion->error;
      }
      //Cerramos conexión
      $conexion->close();
    }
    //Sino envía al login
    else {
      header("location:./index.php");
    }
