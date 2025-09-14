<?php 
require_once(__DIR__ . "/../../controller/PrioridadeController.php");
$id = $_GET['id'] ?? null;
$prioridadeCont = new PrioridadeController();
$msgErro = null;

if (!$id) {
    $msgErro = "ID não informado.";
} else {
    $prioridade = $prioridadeCont->buscarPorId($id);
    if (!$prioridade) {
        header('Location: listar.php');
        exit;
    } else {
        $erros = $prioridadeCont->excluir($id); 
        if (!$erros) {
            header('Location: listar.php');
            exit;
        } else {
            $msgErro = implode('<br>', $erros);
        }
    }
}

include_once(__DIR__ . '/listar.php');
?>