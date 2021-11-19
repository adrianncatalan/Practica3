<?php
  //Datos para la coneción en la bbdd
    require("../BBDD/conexion_BBDD.php");

    //Entrada de datos del formulario index.php
    $ent1 = $_POST['id_usuario'];
    $ent2 = $_POST['password'];
    
    //Conexión a la base de datos
    //Error de Conneción, nos informa al momento un error de conexión
    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }
 
    //Sentencias SQL 
    $sql = "SELECT id_usuario,clave,administrador FROM registro_usuarios WHERE id_usuario ='$ent1'";         
    $results = mysqli_query($conexion, $sql);

    //Si la sentencia Sql esta mal formulada, esto imprime el error de la consola sql
    if ($results === false) { 
      
      //Si sentencia correcta, entonces...
        echo mysqli_error($conexion);
    } else {
        $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
        $username=$ent1;
        $contra="";

        //Si la respuesta sql tiene algo, sino es pq no encuentra ese usuario
        //Contraseña encriptada
        if(count($users)!=0){
          $contra=($users[0]['clave']);
          $admin=$users[0]['administrador'];
        }

        //Si contraseña es correcta encriptada
        if(password_verify($ent2, $contra)){

          //Abre sesión 
          session_start();
          $_SESSION["seusername"] = $username;
          $_SESSION["seisadmin"] = (strtolower($admin));

          //Creamos nuestra cookie que guardara el nombre de usuario para autocompletarlo en el login, sino han pasado dos días de su última sesión
          
          setcookie("userAppWebTaller", $ent1, time() + (86400 *2), "/App.WebTaller/");
          
          //Si es admin va a usuarios
          if((strtolower($admin)=="si")){ 
            
            header("location: ../listaUsuarios/lista_usuarios.php");
            exit();
          }
          //Si no, va a vehiculos
          else{
            header('location:../listaVehiculos/lista_vehiculos.php');
            exit();
          }
          
        }
        //Si contra o usuario incorrectos
        else{
          header('location:../../index.php');

        }
    }
