<?php
// Exibir todos os erros do PHP para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../controller/PrioridadeController.php');

$prioridadeCont = new PrioridadeController();
$prioridade = isset($prioridade) ? $prioridade : null;
$msgErro = isset($msgErro) ? $msgErro : null;

$title = $prioridade && $prioridade->getId() > 0 ? 'Alterar' : 'Adicionar';
include_once(__DIR__ . '/../include/header.php');
include_once(__DIR__ . '/../include/nav.php');
?>

<div class="container my-2 d-flex justify-content-center ">
    <div class="w-100" style="max-width: 500px; background-color: #fdcfe1ff; border-radius: 18px; box-shadow: 0 2px 16px #0001; padding: 32px 24px;">
        <h3 class="mb-4 text-center" style="font-family:'Fredoka One', Arial, sans-serif; color:#4b2673;">
            <?= $title ?> Prioridade
        </h3>
        <form method="POST" class="row g-3 mx-auto">
            <input type="hidden" name="id" value="<?= $prioridade ? $prioridade->getId() : '' ?>">
            <div class="col-12">
                <label for="txtNivel" class="form-label fw-bold">Nível da Prioridade:</label>
                <input type="text" class="form-control" id="txtNivel" name="nivel" placeholder="Ex: Alta, Média, Baixa" value="<?= $prioridade ? $prioridade->getNivel() : '' ?>">
            </div>
            <div class="mb-3">
                <label for="cor" class="form-label">Cor da Prioridade:</label>
                <input type="color" class="form-control form-control-color" id="cor" name="cor"
                    value="<?= $prioridade ? htmlspecialchars($prioridade->getCor()) : '#FFD700' ?>">
            </div>
            <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                <button type="submit" class="btn btn-success px-4 fw-bold">Salvar</button>
                <a href="listar.php" class="btn btn-secondary">Voltar</a>
            </div>
            <?php if ($msgErro): ?>
                <!-- Modal de Erro -->
                <div class="modal fade" id="erroModal" tabindex="-1" aria-labelledby="erroModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="erroModalLabel">Erro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body text-center">
                                <?= $msgErro ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var erroModal = new bootstrap.Modal(document.getElementById('erroModal'));
                        erroModal.show();
                    });
                </script>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php include_once(__DIR__ . '/../include/footer.php'); ?>