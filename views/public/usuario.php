<?php
    include "includes/app.php";

    $db = conectarDB();
    $email = "admin";
    $password = "admin";
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $resultado = mysqli_query($db, "INSERT INTO usuarios (email, password) VALUES ('${email}', '${hash}')");

    echo $resultado ? "success" : "failed";
?>