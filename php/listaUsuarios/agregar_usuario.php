<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MachineBreak - Agregar usuario</title>
    <link rel="stylesheet" href="../../css/agregar_usuario.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="contenedor_padre">
        <div class="contenedor_tittle">
            <h1 class="tittle">¡Introduce tus datos!</h1>
        </div>
        <form action="./insertar_usuario.php" class="form" method="post">
            <div class="form_header">
                <h1 class="form_tittle">Agregar usuario</h1>
            </div>
            <label for="id_usuario" class="form_label">ID de usuario:</label>
            <input required type="text" name="id_usuario" class="form_input" placeholder="Escriba su ID de usuario" >

            <label for="id_usuario" class="form_label">Nombre:</label>
            <input required type="text" name="nombre" class="form_input" placeholder="Escriba su nombre" >

            <label for="id_usuario" class="form_label">Apellido:</label>
            <input required type="text" name="apellido" class="form_input" placeholder="Escriba su apellido" >

            <label for="id_usuario" class="form_label">Teléfono:</label>
            <input required type="tel" name="telefono" class="form_input" placeholder="Escriba su teléfono" >

            <label for="id_usuario" class="form_label">Email:</label>
            <input required type="email" name="email" class="form_input" placeholder="Escriba su email" >

            <label for="id_usuario" class="form_label">Password:</label>
            <input required type="password" name="password" class="form_input" placeholder="Escriba su password" >

            <label for="id_usuario" class="form_label">Contacto de emergencia:</label>
            <input required type="tel" name="con_emer" class="form_input" placeholder="Escriba su contacto de emergencia" >

            <label for="id_usuario" class="form_label">Departamento:</label>
            <input required type="text" name="depa" class="form_input" placeholder="Escriba su departamento" >

            <label for="id_usuario" class="form_label">Cargo:</label>
            <input required type="text" name="cargo" class="form_input" placeholder="Escriba su cargo laboral" >

            
            <?php

            //Sesiones para utilizar variables globales
            session_start();

            //Si es admin agregando usuarios o si es un usuario nuevo desde el login
            if (isset($_SESSION["seisadmin"])) {

                if (($_SESSION["seisadmin"]) == 'si') {
                    ?>
                    <div class="administrador">
                    <label class="admin">Admin:</label>
                    <select class="select"name=\"admin\">
                    <option value=\"no\">No</option>
                    <option value=\"si\">Si</option>
                    </select>";
                    </div>
                    <?php 
                }

            } else {

        echo "<input type=\"hidden\" name=\"admin\" value \"no\">";
            }
            ?>
            <input type="submit" class="button_submit" value="Entrar">
        </form>
    </div>
    <?php
    //Requerimos footer
    require("../common/footer.php");

    ?>

</body>

</html>