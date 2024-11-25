<?php

namespace app\database\models;

use app\database\Conexao;
use PDO;
use PDOException;

class InventarioModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }


    /***
     * VERIFICAR SE JÁ CONTÉM O REGISTRO CADASTRADO NA BASE DE DADOS
     */
    public function verificaDuplicidade($chave_consulta)
    {
        $pdo = $this->conexao->conectar();

        $query = 'SELECT chave_consulta FROM inventario WHERE chave_consulta = :chave_consulta';
        $stmt  = $pdo->prepare($query);
        $stmt->bindValue(':chave_consulta', $chave_consulta);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    /***
     * CADASTRA REGISTRO ATRAVÉS DA LEITURA DO QRCODE  
     */
    public function insertInventario(
        $cod_item,
        $descricao_item,
        $unid_item,
        $deposito_item,
        $num_formulario,
        $quantidade,
        $chave_consulta,
        $usuario
    ) {
        $pdo = $this->conexao->conectar();

        $query = "INSERT INTO inventario (cod_item, descricao_item, unid_item, deposito_item, num_formulario, quantidade_item, chave_consulta, usuario)
                  VALUES           (:cod_item, :descricao_item, :unid_item, :deposito_item, :num_formulario, :quantidade_item,:chave_consulta, :usuario)";

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':cod_item',        $cod_item);
        $stmt->bindValue(':descricao_item',  $descricao_item);
        $stmt->bindValue(':unid_item',       $unid_item);
        $stmt->bindValue(':deposito_item',   $deposito_item);
        $stmt->bindValue(':num_formulario',  $num_formulario);
        $stmt->bindValue(':quantidade_item', $quantidade);
        $stmt->bindValue(':chave_consulta',  $chave_consulta);
        $stmt->bindValue(':usuario',         $usuario);

        return $stmt->execute();
    }

    /***
     * CADASTRA MULTIPLOS REGISTROS ATRAVÉS DA LEITURA DO QRCODE  
     */
    public function insertInventarioMultiplos(array $itens)
    {
        $pdo = $this->conexao->conectar();

        $query = "INSERT INTO inventario (cod_item, descricao_item, unid_item, deposito_item, num_formulario, quantidade_item, chave_consulta, usuario)
                  VALUES           (:cod_item, :descricao_item, :unid_item, :deposito_item, :num_formulario, :quantidade_item,:chave_consulta, :usuario)";

        try {

            $stmt = $pdo->prepare($query);

            foreach ($itens as $item) {
                $stmt->bindValue(':cod_item',        $item['cod_item']);
                $stmt->bindValue(':descricao_item',  $item['descricao_item']);
                $stmt->bindValue(':unid_item',       $item['unid_item']);
                $stmt->bindValue(':deposito_item',   $item['deposito_item']);
                $stmt->bindValue(':num_formulario',  $item['num_formulario']);
                $stmt->bindValue(':quantidade_item', $item['quantidade_item']);
                $stmt->bindValue(':chave_consulta',  $item['chave_consulta']);
                $stmt->bindValue(':usuario',         $item['usuario']);

                $stmt->execute();
            }

            return true;
        } catch (PDOException $e) {

            error_log("Erro ao inserir dados na Base: " . $e->getMessage());
            return false;
        }
    }


    /***
     * REALIZAR A CONTAGEM DE REGISTRO NA BASE DE DADOS  
     */
    public function countItens()
    {
        $pdo = $this->conexao->conectar();
        $query = 'SELECT COUNT(*) AS "Contador" FROM inventario';

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    /***
     * RETORNA TODOS OS DADOS DA BASE 
     */
    public function retornaTodosItens()
    {
        $pdo = $this->conexao->conectar();
        $query = 'SELECT 
                    id,
                    usuario,
                    cod_item,
                    descricao_item,
                    unid_item,
                    quantidade_item,
                    deposito_item,
                    num_formulario,
                    data_criacao
                FROM 
                    inventario';

        $stmt = $pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function updateItens($unid_item, $deposito_item, $num_formulario, $quantidade_item, $id_item)
    {
        $pdo = $this->conexao->conectar();

        $query = 'UPDATE inventario 
                  SET unid_item       = :unid_item,
                      deposito_item   = :deposito_item,
                      num_formulario  = :num_formulario,
                      quantidade_item = :quantidade_item
                  WHERE 
                      id = :id_item    
                    ';

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':unid_item',       $unid_item);
        $stmt->bindValue(':deposito_item',   $deposito_item);
        $stmt->bindValue(':num_formulario',  $num_formulario);
        $stmt->bindValue(':quantidade_item', $quantidade_item);
        $stmt->bindValue(':id_item',         $id_item);

        return $stmt->execute();
    }
}
