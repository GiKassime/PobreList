<div class="item-card card shadow-sm border-0 h-100 d-flex flex-column">
    <?php if ($item->getUrlImagem()): ?>
        <img src="<?= htmlspecialchars($item->getUrlImagem()) ?>" class="card-img-top" alt="Imagem do item"
             style="object-fit:cover;max-height:200px;min-height:200px;">
    <?php endif; ?>
    <div class="card-body pb-2 pt-2 d-flex flex-column justify-content-between" style="flex:1 1 auto;">
        <div class="d-flex flex-column" style="flex:1 1 auto; min-height:170px; max-height:170px; overflow:hidden;">
            <!-- Prioridade -->
            <?php if ($item->getPrioridade()): ?>
                <span class="badge rounded-pill px-2 py-1 mb-1"
                      style="background:<?= $item->getPrioridade()->getCor() ?>; color: #fff; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); font-size: 0.95rem;opacity: 0.9;">
                    Prioridade: <?= htmlspecialchars($item->getPrioridade()->getNivel()) ?>
                </span>
            <?php endif; ?>

            <!-- Categoria -->
            <?php if ($item->getCategoria()): ?>
                <span class="badge rounded-pill px-2 py-1 mb-1 categoria"
                      style="background:<?= $item->getCategoria()->getCor()?>; color: #fff; font-size: 0.95rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                    <?= htmlspecialchars($item->getCategoria()->getNome()) ?>
                </span>
            <?php endif; ?>

            <h6 class="card-title fw-bold " style="font-size:1.1rem;"><?= htmlspecialchars($item->getNome()) ?></h6>
            <p class="card-text text-muted mb-2"
               style="font-size:0.95rem; min-height:40px; max-height:70px; overflow-y:auto;">
                <?= htmlspecialchars(mb_strimwidth($item->getDescricao(), 0, 255, "...")) ?>
            </p>
            <div class="mb-1 d-flex gap-2 flex-wrap">
                <span class="badge bg-light text-dark border " style="font-size:0.92rem;">
                    R$ <?= number_format($item->getPrecoEstimado(), 2, ',', '.') ?>
                </span>
                <span class="badge bg-light text-dark border" style="font-size:0.92rem;">
                    Desejo: <?= date('d/m/Y', strtotime($item->getDataDesejo())) ?>
                </span>
            </div>
        </div>
        <?php if ($item->getUrlWeb()): ?>
            <a href="<?= htmlspecialchars($item->getUrlWeb()) ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100 mb-2 mt-0">
                Ver na Web
            </a>
        <?php endif; ?>
        <div class="d-flex justify-content-between align-items-center gap-1 mt-auto">
            <a href="alterar.php?id=<?= $item->getId() ?>" class="btn btn-sm btn-primary flex-fill"><i class="bi bi-pencil"></i> Editar</a>
            <a href="excluir.php?id=<?= $item->getId() ?>" class="btn btn-sm btn-danger flex-fill"
               onclick="return confirm('Tem certeza que deseja excluir <?= htmlspecialchars($item->getNome()) ?>?');">
                <i class="bi bi-trash"></i> Excluir
            </a>
            <form method="POST" action="marcar_comprado.php" style="display:inline;">
                <input type="hidden" name="id" value="<?= $item->getId() ?>">
                <button type="submit" name="comprado" value="<?= $item->isComprado() ? '0' : '1' ?>"
                        class="btn btn-sm <?= $item->isComprado() ? 'btn-success' : 'btn-outline-secondary' ?> flex-fill"
                        title="<?= $item->isComprado() ? 'Desmarcar como comprado' : 'Marcar como comprado' ?>">
                    <i class="bi bi-<?= $item->isComprado() ? 'check2-circle' : 'circle' ?> mx-1"></i><?= $item->isComprado() ? 'Comprado' : 'Marcar' ?>
                </button>
            </form>
        </div>
    </div>
</div>
