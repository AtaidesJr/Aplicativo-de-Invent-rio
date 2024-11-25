<?php

namespace app\database\models;

use app\database\Conexao;
use PDO;

class UsuarioModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }


    /***
     * VERIFICAR SE JÁ EXISTE O USUÁRIO CADASTRADO NA BASE DE DADOS
     */
    public function verificaDuplicidade($cod_usuario)
    {
        $pdo = $this->conexao->conectar();

        $query = 'SELECT cod_usuario FROM usuarios WHERE cod_usuario = :cod_usuario';
        $stmt  = $pdo->prepare($query);
        $stmt->bindValue(':cod_usuario', $cod_usuario);
        $stmt->execute();

        return $stmt->fetch();
    }

    /***
     * CADASTRA NOVO USUÁRIO 
     */
    public function insertUsuario($cod_usuario, $senha, $permissao_id)
    {
        $pdo = $this->conexao->conectar();

        $query = "INSERT INTO usuarios (cod_usuario, senha, permissao_id)
                  VALUES               (:cod_usuario, (md5(:senha)), :permissao_id)";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':cod_usuario',   $cod_usuario);
        $stmt->bindValue(':senha',         $senha);
        $stmt->bindValue(':permissao_id',  $permissao_id);

        return $stmt->execute();
    }
}
