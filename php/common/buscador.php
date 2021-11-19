<?php
//Si inició sesion ejecuta la página
if (isset($_SESSION["seusername"])) {
    //Obtengo la url de la pagina actual y con un contains defino que propiedades va a tener el buscador

    //Atrapa la url del navegador
    $url = $_SERVER['REQUEST_URI'];

    //Buscador para lista de usuarios
    if (strpos($url, 'lista_usuarios')) {
        $action = "../listaVehiculos/lista_vehiculos.php";
        $placeholder = "Introducir ID de usuario";
        $name = "id_usuario";
        
        //Buscador para lista de vehiculos
    } else if (strpos($url, 'lista_vehiculos')) {
        $action = "../listaServicios/lista_servicios.php";
        $placeholder = "Introducir Matricula del Vehiculo";
        $name = "placa";

        //Hidden para controlar que solo busque de ese usuario
        $hiddename = "id_usuario";

        //Variable que va a agarrar de la otra pagina
        $variable = "$id_usuario_login";

        //Buscador para lista de servicios
    } else if (strpos($url, 'lista_servicios')) {
        $action = "../listaServicios/detalle_servicios.php";
        $placeholder = "Introducir Tipo de Servicio";
        $name = "tipo_servicio";
        $hiddename = "placa";
        $variable = "$placa";
        $hiddename2 = "id_usuario";
        $variable2 = "$id_usuario";

        //Buscador para detalle servicios
    } else if (strpos($url, 'detalle_servicios')) {
        $action = "./detalle_servicios.php";
        $placeholder = "Introducir ";
        $name = "";
    }
?>
    <form action="<?php echo $action ?>" method="POST">

        <input type="text" name="<?php echo $name ?>" class="search-input" placeholder="<?php echo $placeholder ?>">
        <input pointer="cursor" class="boton_buscar" type="submit" value="Buscar">
        <input type="hidden" name="buscador" value=" ">
    <?php
    //Si necesita enviar un valor hidden
    if (isset($hiddename)) {
        echo ("<input type=\"hidden\" name=\"$hiddename\" value=\"$variable\"> ");
    }

    //Si necesita enviar un  segundo valor hidden
    if (isset($hiddename2)) {
        echo ("<input type=\"hidden\" name=\"$hiddename2\" value=\"$variable2\"> ");
    }
} else {

    //Sino a iniciado sesión, vamos al index
    header("location:./index.php");
}
    ?>
    </form>