<?php

  //Esta página no lleva sesiones al poder entrar desde el login para agregar un nuevo usuario
  require("../common/fecha_alta.php");
  //Requiere conexión BBDD
  require("../BBDD/conexion_BBDD.php");

  $id_usuario = strtolower($_POST["id_usuario"]);
  $nombre = strtolower($_POST["nombre"]);
  $apellido = strtolower($_POST["apellido"]);
  $telefono = $_POST["telefono"];
  $email = strtolower($_POST["email"]);
  $password = $_POST["password"];
  //Encriptación de la contraseña
  $password=password_hash($password,PASSWORD_DEFAULT);
  $con_emer = $_POST["con_emer"];
  $depa = strtolower($_POST["depa"]);
  $cargo = strtolower($_POST["cargo"]);
  $admin = strtolower($_POST["admin"]);

  //Si hay fallo de conexión, mostramos descripción dele error
  if ($conexion->connect_error) {
      die("Connection failed: " . $conexion->connect_error);
    }
    //Sentencia sql que crea el usuario
    $sql = "INSERT INTO registro_usuarios (id_usuario, nombre, apellido, telefono, email, clave, contacto_emergencia, fecha_alta, departamento,
    cargo, administrador) VALUES ('$id_usuario', '$nombre', '$apellido', '$telefono', '$email', '$password', '$con_emer', '$sysdate', '$depa', '$cargo', '$admin')";

    //Si la consulta es correcta y sin errores, guardamos registros
    if ($conexion->query($sql) === TRUE) {
      $insercion_datos = mysqli_query($conexion, $sql);
      session_start();
      //Admin registra usuario
      if($_SESSION["seisadmin"]=="si"){ 
        header("location:../listaUsuarios/lista_usuarios.php");
      }
      //Usuario nuevo se registra en el login
      else{
        header("location:../../index.php");
      }
    } 
    else {
      //Si hay fallo, mostramos página de errores (En construcción)
      echo "Error: " . $sql . "<br>" . $conexion->error;
    }
    //Cerramos conexión
    $conexion->close();
