<?php
// Exibir todos os erros do PHP para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/../../controller/CategoriaController.php');
require_once(__DIR__ . '/../../controller/PrioridadeController.php');
require_once(__DIR__ . '/../../controller/ItemController.php');

$categoriaCont = new CategoriaController();
$prioridadeCont = new PrioridadeController();
$itemCont = new ItemController();
$categorias = $categoriaCont->listar();
$prioridades = $prioridadeCont->listar();
$item = isset($item) ? $item : null;
$msgErro = isset($msgErro) ? $msgErro : null;

$title =  $item && $item->getId() > 0 ? 'Alterar' : 'Adicionar';
include_once(__DIR__ . "/../include/header.php");
include_once(__DIR__ . "/../include/nav.php");
?>

<span id="confUrlBase" data-url-base="<?= defined('URL_BASE') ? URL_BASE : '' ?>"></span>

<div class="container my-2 d-flex justify-content-center ">
    <div class="w-100" style="max-width: 650px; background-color: #fdcfe1ff; border-radius: 18px; box-shadow: 0 2px 16px #0001; padding: 32px 24px;">
    <h3 class="mb-4 text-center" style="font-family:'Fredoka One', Arial, sans-serif; color:#4b2673;">
        <?= $title?> Item
    </h3>
    <form method="POST" class="row g-3 mx-auto">
        <input type="hidden" name="id" value="<?= $item ? $item->getId() : '' ?>">
        <div class="col-12">
            <label for="txtNome" class="form-label fw-bold">Nome do Item:</label>
            <input type="text" class="form-control" id="txtNome" name="nome" placeholder="Ex: Fone de ouvido" value="<?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ($item ? $item->getNome() : '') ?>">
        </div>
        <div class="col-12">
            <label for="txtDescricao" class="form-label fw-bold">Descrição:</label>
            <textarea class="form-control" id="txtDescricao" name="descricao" rows="2" placeholder="Detalhes do item"><?= isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ($item ? $item->getDescricao() : '') ?></textarea>
        </div>
        <div class="col-12">
            <label for="txtUrlImagem" class="form-label fw-bold">URL da Imagem:</label>
            <input type="text" class="form-control" id="txtUrlImagem" name="url_imagem" placeholder="https://exemplo.com/imagem.jpg" value="<?= isset($_POST['url_imagem']) ? htmlspecialchars($_POST['url_imagem']) : ($item ? $item->getUrlImagem() : '') ?>">
        </div>
        <div class="col-12">
            <label for="txtUrlWeb" class="form-label fw-bold">Link do Item (opcional):</label>
            <input type="url" class="form-control" id="txtUrlWeb" name="url_web" placeholder="https://exemplo.com/produto" value="<?= isset($_POST['url_web']) ? htmlspecialchars($_POST['url_web']) : ($item ? $item->getUrlWeb() : '') ?>">
        </div>
        <div class="col-md-6">
            <label for="selCategoria" class="form-label fw-bold">Categoria:</label>
            <select class="form-select" id="selCategoria" name="categoria" idSelecionado="<?= isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : ($item && $item->getCategoria() ? $item->getCategoria()->getId() : '0') ?>">
                <option value="">Carregando...</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="selPrioridade" class="form-label fw-bold">Prioridade:</label>
            <select class="form-select" id="selPrioridade" name="prioridade">
                <option value="">Selecione</option>
                <?php foreach ($prioridades as $p): ?>
                    <option value="<?= $p->getId() ?>" <?= $item && $item->getPrioridade() && $item->getPrioridade()->getId() == $p->getId() ? 'selected' : '' ?>><?= $p->getNivel() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="txtPreco" class="form-label fw-bold">Preço Estimado (R$):</label>
            <input type="number" step="0.01" min="0" class="form-control" id="txtPreco" name="preco_estimado" placeholder="0,00" value="<?= $item ? $item->getPrecoEstimado() : '' ?>">
        </div>
        <div class="col-md-6">
            <label for="txtDataDesejo" class="form-label fw-bold">Data Desejada:</label>
            <input type="date" class="form-control" id="txtDataDesejo" name="data_desejo" value="<?= $item ? $item->getDataDesejo() : '' ?>">
        </div>
        <div class="col-12 d-flex align-items-center mt-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="chkComprado" name="comprado" value="1" <?= $item && $item->isComprado() ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold" for="chkComprado">Já foi comprado?</label>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between align-items-center mt-3">
            <button type="submit" class="btn btn-success px-4 fw-bold">Salvar</button>
            <a href="listar.php" class="btn btn-secondary">Voltar</a>
        </div>
        <?php  if ($msgErro): ?>
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

<script src="js/carregar_categorias.js"></script>