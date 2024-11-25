<?php

namespace app\database\models;

use app\database\Conexao;
use PDO;

class LoginModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    /***
     * VERIFICAR SE JÁ CONTÉM O REGISTRO CADASTRADO NA BASE DE DADOS
     */
    public function dadosLogin($cod_usuario, $senha)
    {
        $pdo = $this->conexao->conectar();

        $query = 'SELECT cod_usuario, senha, permissao_id FROM usuarios WHERE cod_usuario = :cod_usuario AND senha = :senha';
        $stmt  = $pdo->prepare($query);
        $stmt->bindValue(':cod_usuario', $cod_usuario);
        $stmt->bindValue(':senha', md5($senha));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
