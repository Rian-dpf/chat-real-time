<?php

class Database
{
    private $connection;

    public function __construct()
    {
        $this->conexaoDB();
    }

    public function conexaoDB()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=cadastroelogin", "root", "");
        } catch (PDOException $e) {
            echo "Não consigo conectar ao banco " . $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $senha)
    {
        // Verificar se email cadastro já existe na base de dados

        $sql = $this->connection->prepare("SELECT id FROM usuarios WHERE email = :e");

        $sql->bindValue(":e", $email);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {

            // Senão existir cadastramos o usuário

            $sql = $this->connection->prepare("INSERT INTO usuarios (nome,email,senha) VALUES (:n,:e,:s)");

            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));

            $sql->execute();

            return true;
        }
    }

    public function logar($email, $senha)
    {
        // Verificar se o usuário existe na base de dados

        $sql = $this->connection->prepare("SELECT id FROM usuarios WHERE email = :e AND senha = :s");

        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));

        $sql->execute();

        if ($sql->rowCount() > 0) {

            // Entrando no sistema
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado["id"];

            return true;
        } else {
            return false;
        }
    }
}
