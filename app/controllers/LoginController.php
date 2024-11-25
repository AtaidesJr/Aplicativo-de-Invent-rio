<?php

namespace app\controllers;

use app\database\models\LoginModel;
use app\library\View;
use PDOException;

class LoginController
{
    public function index()
    {

        $viewInstance = new View();
        $viewInstance->renderizar('login');
    }

    public function loginAuth()
    {
        $cod_usuario  = strip_tags($_POST['cod_usuario']);
        $senha        = strip_tags($_POST['senha']);

        $loginModel    = new LoginModel();
        $realiza_login = $loginModel->dadosLogin($cod_usuario, $senha);

        if ($realiza_login == false) {

            $_SESSION['erro'] = 'Usuário e senha incorretos';
            header('location:/');
        } else {

            $_SESSION['usuario']      = $realiza_login->cod_usuario;
            $_SESSION['permissao_id'] = $realiza_login->permissao_id;
            header('location:/home');
        }
    }

    public function sair()
    {
        session_destroy(); // Destrói a sessão limpando todos os valores salvos
        header("Location:/");
        exit; // Redireciona o usuario
    }
}
