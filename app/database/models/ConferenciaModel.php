<?php

namespace app\database\models;

use app\database\Conexao;
use PDO;
use PDOException;

class ConferenciaModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function resultadoCaixaAgrupada($cod_form)
    {
        $pdo = $this->conexao->conectar();

        $query = 'SELECT DISTINCT
                    SUBSTRING_INDEX(chave_consulta, \'_\', 1) 						      AS "Deposito",
                    SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 2), \'_\', -1) AS "Secao",
                    SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 3), \'_\', -1) AS "Caixa",
                    SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 4), \'_\', -1) AS "Formulario",
                    usuario                                                               AS "Usuario",
                    COUNT(*) 														      AS "Total"
                FROM 
                    inventario i
                WHERE 
                    num_formulario = :cod_form
                    AND SUBSTRING(num_formulario, 2,2) = \'CA\'
                GROUP BY 
                    SUBSTRING_INDEX(chave_consulta, \'_\', 1),
                    usuario,
                    SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 2), \'_\', -1),
                    SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 3), \'_\', -1),
                    SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 4), \'_\', -1);
                  ';

        try {

            $stmt  = $pdo->prepare($query);
            $stmt->bindValue(':cod_form', $cod_form);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            $_SESSION['erro'] =  $e->getMessage();
            header('location:/home_conferencia');
            exit;
        }
    }


    public function resultadoItemForm($cod_form)
    {
        $pdo = $this->conexao->conectar();

        $query = 'SELECT 
                    usuario,
                    cod_item,
                    descricao_item,
                    quantidade_item,
                    deposito_item,
                    num_formulario
                FROM 
                    inventario
                WHERE
                    num_formulario = :cod_form
                    AND SUBSTRING(num_formulario, 2,2) NOT IN (\'CA\')';

        try {

            $stmt  = $pdo->prepare($query);
            $stmt->bindValue(':cod_form', $cod_form);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            $_SESSION['erro'] =  $e->getMessage();
            header('location:/home_conferencia');
            exit;
        }
    }

    // public function countResultadoCaixaAgrupada($cod_form)
    // {
    //     $pdo = $this->conexao->conectar();

    //     $query = 'SELECT COUNT(*) AS "Contador" 
    //             FROM (
    //             SELECT DISTINCT
    //                 SUBSTRING_INDEX(chave_consulta, \'_\', 1) 						      AS "Deposito",
    //                 SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 2), \'_\', -1) AS "Secao",
    //                 SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 3), \'_\', -1) AS "Caixa",
    //                 SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 4), \'_\', -1) AS "Formulario",
    //                 COUNT(*) 														      AS "Total"
    //             FROM 
    //                 inventario i
    //             WHERE 
    //                 num_formulario = :cod_form
    //             GROUP BY 
    //                 SUBSTRING_INDEX(chave_consulta, \'_\', 1),
    //                 SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 2), \'_\', -1),
    //                 SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 3), \'_\', -1),
    //                 SUBSTRING_INDEX(SUBSTRING_INDEX(chave_consulta, \'_\', 4), \'_\', -1)
    //                 ) dbvrcnt';

    //     try {

    //         $stmt  = $pdo->prepare($query);
    //         $stmt->bindValue(':cod_form', $cod_form);
    //         $stmt->execute();

    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {

    //         $_SESSION['erro'] =  $e->getMessage();
    //         header('location:/home_conferencia');
    //         exit;
    //     }
    // }
}
