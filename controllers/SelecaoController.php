<?php 
require_once './models/Selecao.php';
require_once './config/database.php';

class SelecaoController {
    private $db;
    private $selecao;

    public function __construct() {
        // Preparar conexão com BD
        $database = new Database();
        $this->db = $database->getConnection();

        // Instanciar a Model Selecao
        $this->selecao = new Selecao($this->db);
    }

    // Listar todas as seleções na tela inicial
    public function index() {
        $selecoes = $this->selecao->buscarTodos();
        require_once './views/index.php';
    }

    // Carregar o formulário de criação
    public function criar() {
        require_once './views/create.php';    
    }

    // Salvar nova seleção
    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Coletando dados e tratando possíveis campos vazios/inexistentes
            $dados = [
                'nome'    => htmlspecialchars(trim($_POST['nome'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'grupo'   => htmlspecialchars(trim($_POST['grupo'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'titulos' => isset($_POST['titulos']) ? (int)$_POST['titulos'] : 0,
                // Caso seu banco não tenha DEFAULT CURRENT_TIMESTAMP, descomente a linha abaixo:
                // 'criado_em' => date('Y-m-d H:i:s')
            ];  
    
            // Validação simples
            if (empty($dados['nome']) || empty($dados['grupo'])) {
                header("Location: index.php?status=erro&msg=Preencha os campos obrigatórios!");
                exit;
            }
    
            if ($this->selecao->salvar($dados)) {
                header("Location: index.php?status=sucesso&msg=Seleção cadastrada!");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao salvar no banco de dados");
                exit;
            }
        }
    }

    // Carregar formulário de edição
    public function editar($id) {
        $selecao = $this->selecao->buscarPorId($id);
        if ($selecao) {
            require_once './views/edit.php';
        } else {
            header("Location: index.php?status=erro&msg=Seleção não encontrada");
            exit;
        }
    }

    // Processar a atualização dos dados
    public function atualizarDados() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id'      => (int)$_POST['id'],
                'nome'    => htmlspecialchars(trim($_POST['nome'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'grupo'   => htmlspecialchars(trim($_POST['grupo'] ?? ''), ENT_QUOTES, 'UTF-8'),
                'titulos' => (int)($_POST['titulos'] ?? 0)
            ];

            if ($this->selecao->atualizarDados($dados)) {
                header("Location: index.php?status=sucesso&msg=Dados atualizados com sucesso!");
                exit;
            } else {
                header("Location: index.php?status=erro&msg=Erro ao atualizar");
                exit;
            }
        }
    }

    // Excluir uma seleção
    public function deletar($id) {
        if ($this->selecao->deletar($id)) {
            header("Location: index.php?status=sucesso&msg=Seleção excluída!");
            exit;
        } else {
            header("Location: index.php?status=erro&msg=Erro ao excluir");
            exit;
        }
    }
}