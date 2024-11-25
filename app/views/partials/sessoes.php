<?php

// verificar se existe o token de login , não existindo finalizar a sessão do sistema até realizar um novo login;

if (!isset($_SESSION["usuario"]) and !isset($_SESSION["usuario"])) {
    header("Location:/");
    exit;
}

if (isset($_SESSION['nome_usuario'])) {

    // Recupera os dados do nome de usuário;
    $_SESSION['nome_usuario'];
} else {
    $_SESSION['nome_usuario'] = null;
}
