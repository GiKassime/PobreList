<?php
require_once(__DIR__ . '/../../model/Item.php');
require_once(__DIR__ . '/../../controller/ItemController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['comprado'])) {
    $id = (int)$_POST['id'];
    $comprado = $_POST['comprado'] == '1';
    $itemCont = new ItemController();
    $item = $itemCont->buscarPorId($id);
    if ($item) {
        $item->setComprado($comprado);
        $itemCont->alterar($item);
    }
}
header('Location: listar.php');
exit;
