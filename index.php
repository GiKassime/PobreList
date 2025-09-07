
<?php 
$title = "PobreList - Home";    
include_once(__DIR__ . "/view/include/header.php"); ?>

<main class="flex-grow-1 d-flex flex-column w-100" style="min-height:0;">
    <div class="d-flex justify-content-center align-items-center gap-2 mb-3 w-100">
        <img src="src/img/estrela.png" alt="Estrela esquerda" style="height:48px;width:auto;">
        <h1 class="pobrelist-title display-1 fw-bold text-nowrap text-center m-0" style="font-family:'More Sugar','Fredoka One',cursive; color:#4b2673; text-shadow: 4px 4px 0 #fff, 7px 7px 0 #a084ca; letter-spacing:4px;">
            POBRELIST
        </h1>
        <img src="src/img/estrela.png" alt="Estrela direita" style="height:48px;width:auto;">
    </div>
    <div class="flex-grow-1 d-flex flex-column flex-md-row justify-content-center align-items-center w-100" style="min-height:0;">
        <div class="d-flex justify-content-center align-items-center mb-md-0" style="flex:1;">
            <img src="src/img/indexfoto.png" class="main-img" alt="Mascote PobreList">
        </div>
        <div class="d-flex flex-column align-items-start justify-content-start" style="flex:1;">
            <a href="view/itens/listar.php" class="btn btn-pobrelist btn-itens w-100 mb-3 " style="max-width:500px;">GERENCIAR ITENS</a>
            <a href="view/categorias/listar.php" class="btn btn-pobrelist btn-categorias w-100 mb-3" style="max-width:600px;">GERENCIAR CATEGORIAS</a>
            <a href="view/prioridades/listar.php" class="btn btn-pobrelist btn-prioridades w-100" style="max-width:650px;">GERENCIAR PRIORIDADES</a>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include_once(__DIR__ . "/view/include/footer.php"); ?>