<?php

require "./app/database/Database.php";
include("./includes/paginaCadastro.html");

$User = new Database;

if (isset($_POST["nome"])) {

    $nome = addslashes($_POST["nome"]);
    $email = addslashes($_POST["email"]);
    $senha = addslashes($_POST["senha"]);
    $confSenha = addslashes($_POST["confSenha"]);

    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha)) {
        if ($senha == $confSenha) {
            if ($User->cadastrar($nome, $email, $senha)) {
                echo "Cadastrado com sucesso, volte para a página de login para entrar!";
            } else {
                echo "<div class='text-center mt-3'>Usuário já cadastrado!</div>";
            }
        } else {
            echo "<div class='text-center mt-3'>Senhas não conferem!</div>";
        }
    } else {
        echo "<div class='text-center mt-3'>Preencha todos os campos!</div>";
    }
}
