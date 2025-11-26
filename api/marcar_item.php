<?php
header('Content-Type: application/json; charset=utf-8');
require_once(__DIR__ . '/../controller/ItemController.php');



$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$comprado = isset($_POST['comprado']) ? $_POST['comprado'] : null;


$itemCont = new ItemController();
$item = $itemCont->buscarPorId($id);
if (!$item) {
    $resposta['message'] = 'Item não encontrado.';
    echo json_encode($resposta);
    exit;
}

$item->setComprado($comprado === '1');
$erros = $itemCont->alterar($item);

if (is_array($erros) && count($erros) > 0) {
    $resposta['message'] = implode("\n", $erros);
    echo json_encode($resposta);
    exit;
}

$resposta['success'] = true;
$resposta['id'] = $id;
$resposta['comprado'] = $comprado === '1' ? 1 : 0;
echo json_encode($resposta);


