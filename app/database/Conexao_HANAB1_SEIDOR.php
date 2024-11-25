<?php

namespace app\database;

use PDOException;
use PDO;

class Conexao_HANAB1_SEIDOR
{

    private $host = "pitecnomhdb.b1cloud.com.br:30075";
    private $db_name = "SBO_TST_TECNOMETAL";
    private $username = 'ATAIDES';
    private $password = "Ata@2024";
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_PERSISTENT => false,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public function conectar()
    {
        try {
            $dsn = "odbc:Driver={HDBODBC};ServerNode=$this->host;Database=$this->db_name;CHARSET=UFT-8";
            $conn = new PDO($dsn, $this->username, $this->password, $this->options);

            return $conn;
        } catch (PDOException $e) {
            echo "Falha na conexão: " . $e->getMessage();
        }
    }
}
