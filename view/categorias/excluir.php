<?php 
require_once(__DIR__ . "/../../controller/CategoriaController.php");
include_once(__DIR__ . '/../include/header.php');
include_once(__DIR__ . '/../include/nav.php');

$id = $_GET['id'] ?? null;
$categoriaCont = new CategoriaController();
if (!$id) {
    ?>
    <div class="container my-5">
        <div class="alert alert-warning text-center">
            <strong>ID não informado.</strong><br>
            <a href="listar.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    </div>
    <?php
    include_once(__DIR__ . '/../include/footer.php');
    exit;
}
if($categoriaCont->buscarPorId($id)){
    $erro = $categoriaCont->excluir($id);
    if(!$erro){
        //Redirecionar para o listar
        header("location: listar.php");
        exit;
    }else{
        ?>
        <div class="container my-5">
            <div class="alert alert-danger text-center">
                <strong>Erro ao excluir a categoria.</strong><br>
                <?= htmlspecialchars($erro->getMessage()) ?><br>
                <a href="listar.php" class="btn btn-secondary mt-2">Voltar</a>
            </div>
        </div>
        <?php
        include_once(__DIR__ . '/../include/footer.php');
        exit;
    }
}else{
    ?>
    <div class="container my-5">
        <div class="alert alert-warning text-center">
            <strong>Categoria não encontrada.</strong><br>
            <a href="listar.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    </div>
    <?php
    include_once(__DIR__ . '/../include/footer.php');
    exit;
}

?>