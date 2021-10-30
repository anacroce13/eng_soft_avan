<?php
    class Movimentacao{

        // Conexão
        private $conn;

        // Tabela
        private $tabela = "movimentacao";

        // Atributos
        public $id;
        public $aterro_id;
        public $caminhao_id;
        public $devedor_id;
        public $tipo_residuo_id;
        public $volume;

        // Montar conexão
        public function __construct($bd){
            $this->conn = $bd;
        }

        // Buscar todos os registros
        public function buscarMovimentacoes(){
            $sqlQuery = "SELECT id, aterro_id, caminhao_id, devedor_id, tipo_residuo_id, volume 
                           FROM " . $this->tabela . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // Criar (CREATE)
        public function criarMovimentacao(){
            $sqlQuery = "INSERT INTO
                        ". $this->tabela ."
                         SET aterro_id = :aterro_id,
                             caminhao_id = :caminhao_id,
                             devedor_id = :devedor_id,
                             tipo_residuo_id = :tipo_residuo_id,
                             volume = :volume";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // Limpar tags HTML
            // $this->volume=htmlspecialchars(strip_tags($this->volume));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(":aterro_id", $this->aterro_id);
            $stmt->bindParam(":caminhao_id", $this->caminhao_id);
            $stmt->bindParam(":devedor_id", $this->devedor_id);
            $stmt->bindParam(":tipo_residuo_id", $this->tipo_residuo_id);
            $stmt->bindParam(":volume", $this->volume);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Ler registro específico (READ)
        public function dadosMovimentacao(){
            $sqlQuery = "SELECT id,
                                aterro_id,
                                caminhao_id,
                                devedor_id,
                                tipo_residuo_id,
                                volume
                           FROM
                        ". $this->tabela ."
                         WHERE id = ?
                         LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->aterro_id = $dataRow['aterro_id'];
            $this->caminhao_id = $dataRow['caminhao_id'];
            $this->devedor_id = $dataRow['devedor_id'];
            $this->tipo_residuo_id = $dataRow['tipo_residuo_id'];
            $this->volume = $dataRow['volume'];
        }        

        // Atualizar registro (UPDATE)
        public function atualizarMovimentacao(){
            $sqlQuery = "UPDATE
                        ". $this->tabela ."
                         SET aterro_id = :aterro_id,
                             caminhao_id = :caminhao_id,
                             devedor_id = :devedor_id,
                             tipo_residuo_id = :tipo_residuo_id,
                             volume = :volume
                         WHERE id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // Limpar tags HTML
            // $this->volume=htmlspecialchars(strip_tags($this->volume));
        
            // Atribuir ligação dos dados
            $stmt->bindParam(":aterro_id", $this->volume);
            $stmt->bindParam(":caminhao_id", $this->volume);
            $stmt->bindParam(":devedor_id", $this->volume);
            $stmt->bindParam(":tipo_residuo_id", $this->volume);
            $stmt->bindParam(":volume", $this->volume);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Excluir registro (DELETE)
        function excluirMovimentacao(){
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