[readme.md](https://github.com/user-attachments/files/26758587/readme.md)
<?php
require_once './controllers/SelecaoController.php';

$app = new SelecaoController();

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

// --- LÓGICA DO CONTROLLER (sem HTML)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'atualizar') {
        $app->atualizarDados();
    } else {
        $app->salvar();
    }
} else {
    switch ($action) {
        case 'novo':
            require_once './views/create.php';
            exit;
            break;

        case 'editar':
            $app->editar($id);
            exit;
            break;

        case 'deletar':
            $app->deletar($id);
            exit;
            break;

        default:
            $app->index(); // aqui você popula $totalSelecoes, $somaTitulos e $selecoesPorGrupo
            break;
    }
}

// --- HTML A PARTIR DAQUI
// Supondo que $totalSelecoes, $somaTitulos e $selecoesPorGrupo
// já foram setados dentro de $app->index()
?>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Total de Seleções</h5>
                <p class="display-4 font-weight-bold"><?php echo (int) $totalSelecoes; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Títulos Mundiais</h5>
                <p class="display-4 font-weight-bold"><?php echo (int) $somaTitulos; ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light shadow">
            <div class="card-body">
                <h5 class="card-title text-center">Seleções por Grupo</h5>
                <ul class="list-group list-group-flush">
                    <?php foreach ($selecoesPorGrupo as $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Grupo <?php echo htmlspecialchars($item['grupo']); ?>
                            <span class="badge badge-primary badge-pill"><?php echo (int) $item['qtd']; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<hr>

