<?php
require_once(__DIR__ . '/../controller/ItemController.php');

$response = ['success' => false, 'message' => 'Erro desconhecido.'];

// pega o id
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$comprado = isset($_POST['comprado']) ? $_POST['comprado'] : null;

if ($id <= 0 || ($comprado !== '0' && $comprado !== '1')) {
    $response['message'] = 'Parâmetros inválidos.';
    echo json_encode($response);
    exit;
}

$comprado = $comprado === '1';
$itemCont = new ItemController();
// ve se esse id existe
$item = $itemCont->buscarPorId($id);
// se n vier nenhum item da erro
if (!$item) {
    $response['message'] = 'Item não encontrado.';
    echo json_encode($response);
    exit;
}

// seta como comprado/desmarcado
$item->setComprado($comprado);
$erros = $itemCont->alterar($item);

if (is_array($erros) && count($erros) > 0) {
    $response['message'] = implode("\n", $erros);
    echo json_encode($response);
    exit;
}

$response['success'] = true;
$response['id'] = $id;
$response['comprado'] = $comprado ? 1 : 0;
$response['message'] = $comprado ? 'Item marcado como comprado.' : 'Item desmarcado como comprado.';

echo json_encode($response);
