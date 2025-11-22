<?php
require_once(__DIR__ . "/../../controller/ItemController.php");
$title = "Listar Itens a Comprar";
$itemCont = new ItemController();
$itens = $itemCont->listar();
include_once(__DIR__ . "/../include/header.php");
include_once(__DIR__ . "/../include/nav.php");

// Filtra apenas os itens nao_comprados
$nao_comprados = [];
$comprados = [];
foreach ($itens as $item) {
    if (!$item->isComprado()) {
        $nao_comprados[] = $item;
    } else {
        $comprados[] = $item;
    }
}
$totalNaoComprados = 0;
$totalComprados = 0;
foreach ($nao_comprados as $item) {
    $totalNaoComprados += $item->getPrecoEstimado();
}
foreach ($comprados as $item) {
    $totalComprados += $item->getPrecoEstimado();
}
?>
<div class="container my-2">
    <div class="row g-3 align-items-center justify-content-center mb-4">
        <div class="col-12">
            <div class="row justify-content-center mb-2">
                <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <img src="../../src/img/comprar.png" alt="Estrela esquerda" class="d-none d-md-block" style="height:clamp(80px, 12vw, 150px);width:auto;transform: scaleX(-1);">
                    <h1 class="pobrelist-subtitulo fw-bold text-nowrap text-center m-0"
                        style="font-family:'More Sugar','Fredoka One',cursive; color:#4b2673; text-shadow: 4px 4px 0 #fff, 7px 7px 0 #a084ca; letter-spacing:4px; font-size:clamp(2rem, 6vw, 3.5rem);">
                        Itens a Comprar
                    </h1>
                    <img src="../../src/img/comprar.png" alt="Estrela direita" class="d-none d-md-block" style="height:clamp(80px, 12vw, 150px);width:auto;">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                <a class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;" href="inserir.php">
                    <span class="me-2"><i class="bi bi-plus-circle"></i></span>
                    ADICIONAR ITEM
                </a>
                <a class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;" href="#comprados">
                    <i class="bi bi-bag-check"></i>
                    ITENS COMPRADOS
                </a>
                <span id="total-nao-comprados" class="btn btn-dark d-flex align-items-center gap-2 px-4 py-2 disabled" style="font-size:1.2rem; cursor:default;">
                    <i class="bi bi-cash-coin"></i>
                    TOTAL: R$ <?= number_format($totalNaoComprados, 2, ',', '.') ?>
                </span>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 justify-content-start cards-box" id="cards-nao-comprados" style="max-height:68vh; overflow-y:auto;">
        <?php if (empty($nao_comprados)): ?>
            <div class="col-12 text-center text-muted">Nenhum item encontrado.</div>
        <?php else: ?>
            <?php foreach ($nao_comprados as $item): ?>
                <div class="col">
                    <?php include 'card_item.php'; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="container my-4"  id="comprados">
    <div class="row g-3 align-items-center justify-content-center mb-4">
        <div class="col-12">
            <div class="row justify-content-center mb-2">
                <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <img src="../../src/img/comprado.png" alt="Estrela esquerda" style="max-height:150px;width:auto;min-height: auto;">
                    <h1 class="pobrelist-subtitulo fw-bold text-nowrap text-center m-0"
                        style="font-family:'More Sugar','Fredoka One',cursive; color:#4b2673; text-shadow: 4px 4px 0 #fff, 7px 7px 0 #a084ca; letter-spacing:4px; font-size:clamp(2rem, 6vw, 3.5rem);">
                        Itens comprados
                    </h1>
                    <img src="../../src/img/comprado.png" alt="Estrela esquerda" style="max-height:150px;width:auto;min-height: auto;">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-1">

                <span id="total-comprados" class="btn btn-dark d-flex align-items-center gap-2 px-4 py-2 disabled" style="font-size:1.2rem; cursor:default;">
                    <i class="bi bi-cash-coin"></i>
                    TOTAL GASTO: R$ <?= number_format($totalComprados, 2, ',', '.') ?>
                </span>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 justify-content-start cards-box" id="cards-comprados" style="max-height:68vh; overflow-y:auto;">
        <?php if (empty($comprados)): ?>
            <div class="col-12 text-center text-muted">Nenhum item encontrado.</div>
        <?php else: ?>
            <?php foreach ($comprados as $item): ?>
                <div class="col">
                    <?php include 'card_item.php'; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>
<script src="js/marcar_comprado.js"></script>