<?php 
    if (isset($_COOKIE["userAppWebTaller"])){ 

        $cookieuser = ($_COOKIE["userAppWebTaller"]);
    }
    else{
        $cookieuser ="";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MachineBreak - Login</title>
    <link rel="stylesheet" href="css/index_login.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="contenedor_padre">

        <div class="contenedor_tittle">
            <h1 class="tittle">¡Manos a la obra!</h1>
        </div>

        <form action="../App.WebTaller/php/login/verificacion_login.php" class="form" method="post">

            <div class="form_header">
                <h1 class="form_tittle">Acceso de entrada</h1>
            </div>

            <label for="id_usuario" class="form_label">ID de usuario:</label>
            <input type="text" name="id_usuario" class="form_input" placeholder="Escriba su ID de usuario" value="<?php  echo $cookieuser?>" required>

            <label for="password" class="form_label">Contraseña:</label>
            <input type="password" name="password" class="form_input" placeholder="Escriba su contraseña" required>

            <input type="submit" class="button_submit" value="Entrar">

            <div class="enlaces">
                <a href="#">¿Has olvidado la contraseña?</a>
                <a class="registrarse" href="../App.WebTaller/php/listaUsuarios/agregar_usuario.php">¿Eres nuevo? Registrate!</a>
            </div>
        </form>

    </div>

    <?php
    //Requerimos el footer
    require("../App.WebTaller/php/common/footer.php");
    ?>

</body>


</html>