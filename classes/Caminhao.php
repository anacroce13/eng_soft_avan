<?php
    class Caminhao{

        // Conexão
        private $conn;

        // Tabela
        private $tabela = "caminhao";

        // Atributos
        public $id;
        public $proprietario;

        // Montar conexão
        public function __construct($bd){
            $this->conn = $bd;
        }

        // Buscar todos os registros
        public function buscarCaminhaos(){
            $sqlQuery = "SELECT id, proprietario FROM " . $this->tabela . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // Criar (CREATE)
        public function criarCaminhao(){
            $sqlQuery = "INSERT INTO
                        ". $this->tabela ."
                         SET proprietario = :proprietario";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // Limpar tags HTML
            // $this->proprietario=htmlspecialchars(strip_tags($this->proprietario));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(":proprietario", $this->proprietario);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Ler registro específico (READ)
        public function dadosCaminhao(){
            $sqlQuery = "SELECT id, 
                                proprietario
                           FROM
                        ". $this->tabela ."
                         WHERE id = ?
                         LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->proprietario = $dataRow['proprietario'];
        }        

        // Atualizar registro (UPDATE)
        public function atualizarCaminhao(){
            $sqlQuery = "UPDATE
                        ". $this->tabela ."
                         SET proprietario = :proprietario
                         WHERE id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // Limpar tags HTML
            // $this->proprietario=htmlspecialchars(strip_tags($this->proprietario));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(":proprietario", $this->proprietario);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Excluir registro (DELETE)
        function excluirCaminhao(){
            $sqlQuery = "DELETE FROM " . $this->tabela . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            // Limpar tags HTML        
            // $this->id=htmlspecialchars(strip_tags($this->id));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>