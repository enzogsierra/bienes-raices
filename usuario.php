<?php
    /*
        * Este archivo se debe borrar en producción luego de crear los usuarios.

        Para crear un usuario nuevo, inicia el servidor PHP en la carpeta raíz del proyecto. Luego dirigete a "<address>:<port>/usuario.php" y el usuario se creará automáticamente.
        Mostrará "success" o "failed" en la página, según si se creó el usuario correctamente o no.
        Para cambiar las credenciales simplemente cambia los valores de "email" y "password".
    */

    include "include.php";

    $user = "admin";
    $password = "admin";
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $resultado = mysqli_query($db, "INSERT INTO usuarios (user, password) VALUES ('${user}', '${hash}')");

    echo $resultado ? "success" : "failed";
?>