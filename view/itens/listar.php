<?php
require_once(__DIR__ . "/../../controller/ItemController.php");
$title = "Listar Itens";
$itemCont = new ItemController();
$itens = $itemCont->listar();
include_once(__DIR__ . "/../include/header.php");
include_once(__DIR__ . "/../include/nav.php");
?>
<div class="container my-4">
    <div class="row g-3 align-items-center justify-content-center mb-4">
        <div class="col-auto">
            <a class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;" href="inserir.php">
                <span class="me-2"><i class="bi bi-plus-circle"></i></span>
                ADICIONAR ITEM
            </a>
        </div>
        <!-- Filtros podem ser implementados depois -->
    </div>

    <div class="row justify-content-center">
        <?php if (empty($itens)): ?>
            <div class="col-12 text-center text-muted">Nenhum item cadastrado.</div>
        <?php else: ?>
            <?php foreach ($itens as $item): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm border-0" style="min-width: 220px; max-width: 100%; padding-bottom: 0.5rem;">
                        <?php if ($item->getUrlImagem()): ?>
                            <img src="<?= htmlspecialchars($item->getUrlImagem()) ?>" class="card-img-top" alt="Imagem do item" style="object-fit:cover;max-height:120px;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column p-2" style="font-size:0.97rem;">
                            <h5 class="card-title mb-1" style="color:#4b2673; font-family:'Fredoka One', Arial, sans-serif; font-size:1.08rem;">
                                <?= htmlspecialchars($item->getNome()) ?>
                            </h5>
                            <p class="card-text mb-1 small text-muted" style="min-height:18px;">
                                <?= htmlspecialchars(mb_strimwidth($item->getDescricao(), 0, 60, '...')) ?>
                            </p>
                            <div class="d-flex flex-wrap gap-1 mb-1">
                                <?php if ($item->getCategoria()): ?>
                                    <span class="badge rounded-pill px-3 py-2" style="background:#e0d7fa;color:#4b2673;font-weight:600;">Categoria: <?= htmlspecialchars($item->getCategoria()->getNome()) ?></span>
                                <?php endif; ?>
                                <?php if ($item->getPrioridade()): ?>
                                    <span class="badge rounded-pill px-3 py-2" style="background:#f8d7da;color:#842029;font-weight:600;">Prioridade: <?= htmlspecialchars($item->getPrioridade()->getNivel()) ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="card-text mb-1"><strong>Preço:</strong> R$ <?= number_format($item->getPrecoEstimado(), 2, ',', '.') ?></p>
                            <p class="card-text mb-1"><strong>Data:</strong> <?= $item->getDataDesejo() ? date('d/m/Y', strtotime($item->getDataDesejo())) : '-' ?></p>
                            <?php if ($item->getUrlWeb()): ?>
                                <a href="<?= htmlspecialchars($item->getUrlWeb()) ?>" target="_blank" class="btn btn-outline-primary btn-sm mb-1"><i class="bi bi-link-45deg"></i> Ver na Web</a>
                            <?php endif; ?>
                            <div class="d-flex gap-2 justify-content-center mt-2">
                                <a href="alterar.php?id=<?= $item->getId() ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil mx-1"></i></a>
                                <a href="excluir.php?id=<?= $item->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir <?= htmlspecialchars($item->getNome()) ?>?');"><i class="bi bi-trash mx-1"></i></a>
                                <form method="POST" action="marcar_comprado.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $item->getId() ?>">
                                    <button type="submit" name="comprado" value="<?= $item->isComprado() ? '0' : '1' ?>" class="btn btn-sm <?= $item->isComprado() ? 'btn-success' : 'btn-outline-secondary' ?>" title="<?= $item->isComprado() ? 'Desmarcar como comprado' : 'Marcar como comprado' ?>">
                                        <i class="bi bi-<?= $item->isComprado() ? 'check2-circle' : 'circle' ?> mx-1"></i><?= $item->isComprado() ? 'Comprado' : 'Marcar' ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>