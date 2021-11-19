<?php
    //Abre sesión y utilizamos variables globales
    session_start();

    //Borra todos los valores de la variables de sesión
    session_unset();

    //Cierra la sesión
    session_destroy();

    //Va al login
    header('Location:../../index.php');
    exit();
?>