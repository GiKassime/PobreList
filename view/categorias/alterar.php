<?php
require_once(__DIR__ . '/../../model/Categoria.php');
require_once(__DIR__ . '/../../controller/CategoriaController.php');

$categoria = null;
$msgErro = "";
$id = null;
if (isset($_POST['nome'])) {
    $id = is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
    $nome = trim($_POST['nome']) ?: null;
    $categoria = new Categoria();
    $categoria->setId($id);
    $categoria->setNome($nome);
    $categoriaCont = new CategoriaController();
    $erros = $categoriaCont->alterar($categoria);
    if (!$erros) {
        header('Location: listar.php');
        exit;
    } else {
        $msgErro = is_array($erros) ? implode('<br>', $erros) : $erros;
    }
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id == null) {
        echo "ID não informado.<br><a href='listar.php'>Voltar</a>";
        exit;
    }
    $categoriaCont = new CategoriaController();
    $categoria = $categoriaCont->buscarPorId($id);
    if (!$categoria) {
        echo "Categoria não encontrada.<br><a href='listar.php'>Voltar</a>";
        exit;
    }
}

include_once(__DIR__ . '/form.php');
