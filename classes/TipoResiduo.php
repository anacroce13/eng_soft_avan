<?php
    class TipoResiduo{

        // Conexão
        private $conn;

        // Tabela
        private $tabela = "tipo_residuo";

        // Atributos
        public $id;
        public $nome;

        // Montar conexão
        public function __construct($bd){
            $this->conn = $bd;
        }

        // Buscar todos os registros
        public function buscarTipoResiduos(){
            $sqlQuery = "SELECT id, nome FROM " . $this->tabela . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // Criar (CREATE)
        public function criarTipoResiduo(){
            $sqlQuery = "INSERT INTO
                        ". $this->tabela ."
                         SET nome = :nome";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // Limpar tags HTML
            // $this->nome=htmlspecialchars(strip_tags($this->nome));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(":nome", $this->nome);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Ler registro específico (READ)
        public function dadosTipoResiduo(){
            $sqlQuery = "SELECT id, 
                                nome
                           FROM
                        ". $this->tabela ."
                         WHERE id = ?
                         LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nome = $dataRow['nome'];
        }        

        // Atualizar registro (UPDATE)
        public function atualizarTipoResiduo(){
            $sqlQuery = "UPDATE
                        ". $this->tabela ."
                         SET nome = :nome
                         WHERE id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // Limpar tags HTML
            // $this->nome=htmlspecialchars(strip_tags($this->nome));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Excluir registro (DELETE)
        function excluirTipoResiduo(){
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