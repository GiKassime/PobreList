<?php
require_once(__DIR__ . '/../../model/Categoria.php');
require_once(__DIR__ . '/../../controller/CategoriaController.php');
$msgErro = "";
$categoria = null;

if (isset($_POST['nome'])) {
    $nome = trim($_POST['nome']) ?: null;
    $cor = trim($_POST['cor']) ?: null;
    $categoria = new Categoria();
    $categoria->setId(0);
    $categoria->setNome($nome);
    $categoria->setCor($cor);
    $categoriaCont = new CategoriaController();
    $erros = $categoriaCont->inserir($categoria);
    if (!$erros) {
        header('Location: listar.php');
        exit;
    } else {
        $msgErro = is_array($erros) ? implode('<br>', $erros) : $erros;
    }
}

include_once(__DIR__ . '/form.php');
