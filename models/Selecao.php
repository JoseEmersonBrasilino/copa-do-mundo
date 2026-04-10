<?php
class Selecao {
    private $conn;
    private $table_name = "selecoes";

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function buscarTodos() {
        // Query para selecionar todos os registros
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nome ASC";
        
        // Prepara a execução
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // Retorna os dados como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar($dados) {
        // Adicionamos 'criado_em' na query SQL
        $query = "INSERT INTO " . $this->table_name . " 
                  (nome, grupo, titulos, criado_em) 
                  VALUES (:nome, :grupo, :titulos, :criado_em)";

        $stmt = $this->conn->prepare($query);

        // Vinculação dos dados
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":grupo", $dados['grupo']);
        $stmt->bindParam(":titulos", $dados['titulos']);
        
        // Se o Controller não enviou a data, geramos ela aqui:
        $data_atual = date('Y-m-d H:i:s');
        $stmt->bindParam(":criado_em", $data_atual);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
}