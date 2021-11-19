<?php
//Utilizamos variables globales con la sesión
session_start();
//Si inició sesion ejecuta la página
if (isset($_SESSION["seusername"])) {
    $id_usuario = $_POST["id_user"];
    require("./cantvehiculos.php");
}
//Sino envía al login
else {
    header("location:../../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MachineBreak - Agregar vehiculo</title>
    <link rel="stylesheet" href="../../css/agregar_vehiculo.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="contenedor_padre">

        <div class="contenedor_tittle">
            <h1 class="tittle">¡Registra tu vehículo!</h1>
        </div>

        <form action="./insertar_vehiculos.php" class="form" method="post">

            <div class="form_header">
                <h1 class="form_tittle">Introduce los datos de tu vehículo</h1>
            </div>

            <label for="id_usuario" class="form_label">Placa:</label>
            <input required type="text" name="placa" class="form_input" placeholder="Escriba la Placa">

            <label for="id_usuario" class="form_label">Marca:</label>
            <input required type="text" name="marca" class="form_input" placeholder="Escriba la Marca">

            <label for="id_usuario" class="form_label">Modelo:</label>
            <input required type="text" name="modelo" class="form_input" placeholder="Escriba el Modelo">

            <input type="hidden" name="id_usuario" value=<?php echo $id_usuario ?>>
            <input type="hidden" name="cant_vehiculos" value=<?php echo $cantvehiculos ?>>

            <input class="añadir" type="submit" value="Añadir vehículo">
        </form>
        <?php
        //Requiere la página del footer
        require("../common/footer.php");
        ?>
</body>

</html>