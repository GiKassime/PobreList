<?php
require_once(__DIR__ . '/../controller/CategoriaController.php');
$cont = new CategoriaController();
$cats = $cont->listar();
$out = [];
foreach ($cats as $c) {
    $out[] = [
        'id' => $c->getId(),
        'nome' => $c->getNome()
    ];
}
echo json_encode($out);
