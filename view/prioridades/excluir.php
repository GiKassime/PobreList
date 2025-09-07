<?php 
require_once(__DIR__ . "/../../controller/PrioridadeController.php");
include_once(__DIR__ . '/../include/header.php');
include_once(__DIR__ . '/../include/nav.php');

$id = $_GET['id'] ?? null;
$prioridadeCont = new PrioridadeController();
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
if($prioridadeCont->buscarPorId($id)){
    $erro = $prioridadeCont->excluir($id);
    if(!$erro){
        //Redirecionar para o listar
        header("location: listar.php");
        exit;
    }else{
        ?>
        <div class="container my-5">
            <div class="alert alert-danger text-center">
                <strong>Erro ao excluir a prioridade.</strong><br>
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
            <strong>Prioridade não encontrada.</strong><br>
            <a href="listar.php" class="btn btn-secondary mt-2">Voltar</a>
        </div>
    </div>
    <?php
    include_once(__DIR__ . '/../include/footer.php');
    exit;
}

?>
