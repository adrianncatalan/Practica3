<?php
//Utilizamos variables globales con sesiones
session_start();

//Si inició sesion ejecuta la página
if (isset($_SESSION["seusername"])) {
    $placa = $_POST["placa"];
    $id_usuario = $_POST["id_usuario"];
    require("../listaServicios/cantservicios.php");
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
    <title>MachineBreak - Agregar servicio</title>
    <link rel="stylesheet" href="../../css/agregar_servicio.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="shortcut icon" href="../../img/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="contenedor_padre">

        <div class="contenedor_tittle">
            <h1 class="tittle">¡Agrega un servicio!</h1>
        </div>

        <form action="./insertar_servicios.php" class="form" method="post">

            <div class="form_header">
                <h1 class="form_tittle">Introduce los datos del servicio</h1>
            </div>

            <label for="id_usuario" class="form_label">Tipo de servicio:</label>
            <input required type="text" name="tipo_servicio" class="form_input" placeholder="Escriba el servicio">

            <label for="id_usuario" class="form_label">Descripción:</label>
            <input required type="text" name="descripcion" class="form_input" placeholder="Escriba la descripción">

            <input type="hidden" name="placa" value=<?php echo $placa ?>>
            <input type="hidden" name="cant_servicios" value=<?php echo $cantservicios ?>>
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">

            <input class="añadir" type="submit" value="Añadir servicio">
        </form>
        <?php
        //Requiere la página del footer
        require("../common/footer.php");
        ?>
</body>

</html>