<?php 
$title = "PobreList - Home";    
include_once(__DIR__ . "/view/include/header.php"); ?>

<main class="flex-grow-1 d-flex flex-column w-100" style="min-height:0;">
    <div class="container-fluid px-0">
        <div class="row justify-content-center mb-4">
            <div class="col-12 col-md-10 col-lg-8 d-flex justify-content-center align-items-center gap-2 flex-wrap">
                <img src="src/img/estrela.png" alt="Estrela esquerda" style="height:40px;width:auto;">
                <h1 class="pobrelist-title fw-bold text-nowrap text-center m-0"
                    style="font-family:'More Sugar','Fredoka One',cursive; color:#4b2673; text-shadow: 4px 4px 0 #fff, 7px 7px 0 #a084ca; letter-spacing:4px; font-size:clamp(2.2rem, 7vw, 4rem);">
                    POBRELIST
                </h1>
                <img src="src/img/estrela.png" alt="Estrela direita" style="height:40px;width:auto;">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center justify-content-center flex-column-reverse flex-md-row">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-2 mb-md-0">
                <img src="src/img/indexfoto.png" class="main-img img-fluid" alt="Mascote PobreList" style="max-width:550px; width:100%;">
            </div>
            <div class="col-12 col-md-6 d-flex flex-column align-items-center align-items-md-start justify-content-center">
                <a href="view/itens/listar.php" class="btn btn-pobrelist btn-itens w-100 mb-3" style="max-width:500px;">GERENCIAR ITENS</a>
                <a href="view/categorias/listar.php" class="btn btn-pobrelist btn-categorias w-100 mb-3" style="max-width:600px;">GERENCIAR CATEGORIAS</a>
                <a href="view/prioridades/listar.php" class="btn btn-pobrelist btn-prioridades w-100" style="max-width:650px;">GERENCIAR PRIORIDADES</a>
            </div>
        </div>
    </div>
</main>
<?php include_once(__DIR__ . "/view/include/footer.php"); ?>