<?php

namespace app\controllers;

use app\database\models\UsuarioModel;
use app\library\View;
use PDOException;

class UsuarioController
{
    public function index()
    {

        $viewInstance = new View();
        $viewInstance->renderizar('usuarios');
    }

    public function cadastrar()
    {

        $cod_usuario    = (isset($_POST['cod_usuario']))  ? $_POST['cod_usuario']  : '';
        $senha          = (isset($_POST['senha']))        ? $_POST['senha']        : '';
        $permissao_id   = (isset($_POST['permissao_id'])) ? $_POST['permissao_id'] : '';


        $usuarioModel = new UsuarioModel();

        try {

            $usuario_existe = $usuarioModel->verificaDuplicidade($cod_usuario);

            if (!empty($usuario_existe)) {

                $_SESSION['erro'] =  "Usuário $cod_usuario já cadastrado na base de dados!";
                header('location:/usuarios');
                exit;
            } else {

                $usuarioModel->insertUsuario($cod_usuario, $senha, $permissao_id);

                $_SESSION['sucesso'] = "Usuário cadastrado com sucesso!";
                header('location:/usuarios');
                exit;
            }
        } catch (PDOException $e) {
            $_SESSION['erro'] =  $e->getMessage();
            header('location:/usuarios');
            exit;
        }
    }
}
