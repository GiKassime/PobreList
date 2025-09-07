<?php
require_once(__DIR__ . '/../../model/Prioridade.php');
require_once(__DIR__ . '/../../controller/PrioridadeController.php');
$msgErro = "";
$prioridade = null;

if (isset($_POST['nivel'])) {
    $nivel = trim($_POST['nivel']) ?: null;
    $prioridade = new Prioridade();
    $prioridade->setId(0);
    $prioridade->setNivel($nivel);
    $prioridadeCont = new PrioridadeController();
    $erros = $prioridadeCont->inserir($prioridade);
    if (!$erros) {
        header('Location: listar.php');
        exit;
    } else {
        $msgErro = is_array($erros) ? implode('<br>', $erros) : $erros;
    }
}

include_once(__DIR__ . '/form.php');
