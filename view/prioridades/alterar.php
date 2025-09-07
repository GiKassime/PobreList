<?php
require_once(__DIR__ . '/../../model/Prioridade.php');
require_once(__DIR__ . '/../../controller/PrioridadeController.php');

$prioridade = null;
$msgErro = "";
$id = null;
if (isset($_POST['nivel'])) {
    $id = is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
    $nivel = trim($_POST['nivel']) ?: null;
    $prioridade = new Prioridade();
    $prioridade->setId($id);
    $prioridade->setNivel($nivel);
    $prioridadeCont = new PrioridadeController();
    $erros = $prioridadeCont->alterar($prioridade);
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
    $prioridadeCont = new PrioridadeController();
    $prioridade = $prioridadeCont->buscarPorId($id);
    if (!$prioridade) {
        echo "Prioridade não encontrada.<br><a href='listar.php'>Voltar</a>";
        exit;
    }
}

include_once(__DIR__ . '/form.php');
