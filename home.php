<?php

include("./includes/paginaHome.html");
include("./includes/paginaChat.html");

session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("location: index.php");
    exit();
}
