<?php
    // Definir classe que será rodada nesta API
    $classe = htmlspecialchars($_GET["classe"]);
    
    // Preparar cabeçalho das requisições
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    // Importar dependências
    include_once '../config/bancodados.php';
    include_once '../classes/Aterro.php';
    include_once '../classes/Caminhao.php';
    include_once '../classes/Devedor.php';
    include_once '../classes/TipoResiduo.php';
    include_once '../classes/Movimentacao.php';
    
    // Instanciar conexão do banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Criar objeto
    $objeto = '';
    // $stmt;
    switch ($classe) {
        case "aterro":
            $objeto = new Aterro($db);
            $stmt = $objeto->buscarAterros();
            break;
        case "caminhao":
            
            break;
        case "devedor":
            
            break;
        case "movimentacao":
            
            break;
        case "tiporesiduo":
            
            break;
    }
    $contagem = $stmt->rowCount();

    echo json_encode($contagem);

    if($contagem > 0){
        
        $objetoArr = array();
        $objetoArr["body"] = $stmt->fetchAll();
        $objetoArr["itemCount"] = $contagem;
        echo json_encode($objetoArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("mensagem" => "Nenhum registro encontrado.")
        );
    }
?>