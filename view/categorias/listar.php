<?php
// Listar Categorias
require_once(__DIR__ . '/../../controller/CategoriaController.php');
$title = "Listar Categorias";
$categoriaCont = new CategoriaController();
$categorias = $categoriaCont->listar();
$msgErro = isset($msgErro) ? $msgErro : null;

include_once(__DIR__ . '/../include/header.php');
include_once(__DIR__ . '/../include/nav.php');
?>
<div class="container my-4">
    <div class="row g-3 align-items-center justify-content-center mb-4">
        <div class="row justify-content-center mb-5">
            <div class="col-12 w-100 d-flex justify-content-center align-items-center gap-2 flex-wrap">
                <img src="../../src/img/categoria.png" alt="Estrela esquerda" class="d-none d-md-block" style="height:clamp(80px, 12vw, 150px);width:auto;transform: scaleX(-1);">
                <h1 class="pobrelist-subtitulo fw-bold text-nowrap text-center m-0"
                    style="font-family:'More Sugar','Fredoka One',cursive; color:#4b2673; text-shadow: 4px 4px 0 #fff, 7px 7px 0 #a084ca; letter-spacing:4px; font-size:clamp(2rem, 6vw, 3.5rem);">
                    Gerenciar Categorias
                </h1>
                <img src="../../src/img/categoria.png" alt="Estrela direita" class="d-none d-md-block" style="height:clamp(80px, 12vw, 150px);width:auto;">
            </div>
        </div>
        <div class="col-auto mb-3">
            <a href="inserir.php" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;">
                <span class="me-2"><i class="bi bi-plus-circle"></i></span>
                ADICIONAR CATEGORIA
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm align-middle bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Cor</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categorias)): ?>
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma categoria cadastrada.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($categorias as $cat): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cat->getNome()) ?></td>
                                    <td class="text-center" style="background-color: <?= htmlspecialchars($cat->getCor()) ?>; color: #222; font-weight: bold;">
                                        <span class="badge rounded-pill px-3 py-2 border shadow-sm"
                                              style="background: #fff; color: #222; font-size: 1rem;">
                                            <?= htmlspecialchars($cat->getCor()) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap justify-content-center gap-1">
                                            <a href="alterar.php?id=<?= $cat->getId() ?>" class="btn btn-sm btn-primary flex-fill">
                                                <i class="bi bi-pencil mx-1"></i>Editar
                                            </a>
                                            <a href="excluir.php?id=<?= $cat->getId() ?>" class="btn btn-sm btn-danger flex-fill"
                                               onclick="return confirm('Tem certeza que deseja excluir <?= $cat->getNome()?>?');">
                                                <i class="bi bi-trash mx-1"></i>Excluir
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
                    <a href="listar.php" class="btn btn-secondary">Voltar</a>
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
<?php include_once(__DIR__ . '/../include/footer.php'); ?>
