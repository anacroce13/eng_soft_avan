<?php 
    class Bancodados {
        private $host = "localhost";
        private $nomebanco = "phpapidb";
        private $usuario = "root";
        private $senha = "xxxxxxxx";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->nomebanco, $this->usuario, $this->senha);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Não foi possível conectar ao banco de dados: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>