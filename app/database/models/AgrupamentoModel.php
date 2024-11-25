<?php

namespace app\database\models;

use app\database\Conexao_HANAB1_SEIDOR;
use PDO;
use PDOException;

class AgrupamentoModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao_HANAB1_SEIDOR();
    }

    public function resultadoAgrupado($qrcode)
    {
        $pdo = $this->conexao->conectar();

        $query = 'SELECT 
                    "U_TI_ItemCode",
                    "U_TI_ItemName",
                    "U_TI_Unid",
                    "U_TI_WhsCode",
                    CAST("U_TI_OnHand" AS DECIMAL) AS "U_TI_OnHand",
                    "U_TI_Secao",
                    "U_TI_Caixa"
                FROM 
                    "SBO_TST_TECNOMETAL"."@TI_INVT1" 
                WHERE
                    "U_TI_WhsCode"||\'_\'||"U_TI_Secao"||\'_\'||"U_TI_Caixa" = :qrcode
                  ';

        try {

            $stmt  = $pdo->prepare($query);
            $stmt->bindValue(':qrcode', $qrcode);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {

            $_SESSION['erro'] =  $e->getMessage();
            header('location:/caixa_agrupamento');
            exit;
        }
    }
}
