<?php
//Si inició sesion ejecuta la página
session_start();
if (isset($_SESSION["seusername"])) {
    $id_usuario = $_POST["id_user"];
}
//Sino envía al login
else {
    header("location:./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MachineBreak - Cambiar Contraseña</title>
    <link rel="stylesheet" href="../../css/cambio_clave.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="contenedor_padre">

        <div class="contenedor_tittle">
            <h1 class="tittle">¡Cambia tu contraseña!</h1>
        </div>

        <form action="./actualizando_clave.php" class="form" method="post">

            <div class="form_header">
                <h1 class="form_tittle">Introduce tus nuevos datos</h1>
            </div>

            <label for="id_usuario" class="form_label">Nueva Contraseña:</label>
            <input required type="password" name="password1" class="form_input" placeholder="Nueva Contraseña">

            <label for="id_usuario" class="form_label">Repite la Contraseña:</label>
            <input required type="password" name="password2" class="form_input" placeholder="Repite la Contraseña">


            <input type="hidden" name="id_usuario" value=<?php echo $id_usuario ?>>

            <input class="añadir" type="submit" value="Cambiar contraseña">
        </form>
        <?php
        //Requerimos el footer
        require("../../php/common/footer.php");
        ?>
</body>

</html>