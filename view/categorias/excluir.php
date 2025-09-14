<?php 
require_once(__DIR__ . "/../../controller/CategoriaController.php");
$id = $_GET['id'] ?? null;
$categoriaCont = new CategoriaController();
$msgErro = null;

if (!$id) {
    $msgErro = "ID não informado.";
} else {
    $categoria = $categoriaCont->buscarPorId($id);
    if (!$categoria) {
        header('Location: listar.php');
        exit;
    } else {
        $erros = $categoriaCont->excluir($id); 
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