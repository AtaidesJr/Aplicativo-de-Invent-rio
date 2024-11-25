<?php

namespace app\database;

use PDO;
use PDOException;


class Conexao
{
  private $host     = "127.0.0.1";  // Endereço do servidor MySQL
  private $dbname   = "inventario"; // Nome do banco de dados
  private $user     = "root";       // Nome de usuário do banco de dados
  private $password = "root@2024"; // Senha do banco de dados

  public function conectar()
  {
    try {
      $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->user, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
      return $pdo;
    } catch (PDOException $e) {
      echo "Erro na conexão ao banco de dados: " . $e->getMessage();
    }
  }
}
