<?php
  class Connection {
    public $connection;

    public function __construct() {
      try {
        $this->connection = new PDO("mysql:dbname=pweb;host=localhost:3307", "root", "");
      } catch (PDOException $e) {
        echo "Erro com banco de dados: ".$e->getMessage();
      } catch (Exception $e) {
        echo "Erro generico: ".$e->getMessage();
      }
    }

    public function getConnection() {
      return $this->connection;
    }
  }
?>
