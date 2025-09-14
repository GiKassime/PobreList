<?php
require_once(__DIR__ . "/../../controller/ItemController.php");
$title = "Listar Itens Comprados";
$itemCont = new ItemController();
$itens = $itemCont->listar();
include_once(__DIR__ . "/../include/header.php");
include_once(__DIR__ . "/../include/nav.php");

// Filtra apenas os itens comprados
$comprados = [];
foreach ($itens as $item) {
    if ($item->isComprado()) {
        $comprados[] = $item;
    }
}
$totalComprados = 0;
foreach ($comprados as $item) {
    $totalComprados += $item->getPrecoEstimado();
}
?>
<div class="container my-4">
    <div class="row g-3 align-items-center justify-content-center mb-4">
        <div class="col-12">
            <div class="row justify-content-center mb-5">
                <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <img src="../../src/img/comprado.png" alt="Estrela esquerda" style="max-height:150px;width:auto;min-height: auto;">
                    <h1 class="pobrelist-subtitulo fw-bold text-nowrap text-center m-0"
                        style="font-family:'More Sugar','Fredoka One',cursive; color:#4b2673; text-shadow: 4px 4px 0 #fff, 7px 7px 0 #a084ca; letter-spacing:4px; font-size:clamp(2rem, 6vw, 3.5rem);">
                        Itens comprados
                    </h1>
                    <img src="../../src/img/comprado.png" alt="Estrela esquerda" style="max-height:150px;width:auto;min-height: auto;">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                <a class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;" href="inserir.php">
                    <span class="me-2"><i class="bi bi-plus-circle"></i></span>
                    ADICIONAR ITEM
                </a>
                <a class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;" href="listar.php">
                    <i class="bi bi-bag-check"></i>
                    ITENS A COMPRAR
                </a>
                    <span class="btn btn-dark d-flex align-items-center gap-2 px-4 py-2 disabled" style="font-size:1.2rem; cursor:default;">
                    <i class="bi bi-cash-coin"></i>
                    TOTAL GASTO: R$ <?= number_format($totalComprados, 2, ',', '.') ?>
                </span>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 justify-content-start" id="cards-container">
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