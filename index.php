<?php

require "./app/database/Database.php";
include("./includes/paginaLogin.html");

$User = new Database;


if (isset($_POST["email"])) {

    $email = addslashes($_POST["email"]);
    $senha = addslashes($_POST["senha"]);

    if (!empty($email) && !empty($senha)) {

        if ($User->logar($email, $senha)) {

            header("location: home.php");
        } else {

            echo "<div class='text-center mt-4'>Email ou senha incorretos!</div>";
        }
    } else {
        echo "<div class='text-center mt-4'>Preencha todos os campos!!!</div>";
    }
}
