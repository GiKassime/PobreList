<?php
require_once(__DIR__ . '/../controller/CategoriaController.php');
$cont = new CategoriaController();
$cats = $cont->listar();
$saida = [];
foreach ($cats as $c) {
    $saida[] = [
        'id' => $c->getId(),
        'nome' => $c->getNome()
    ];
}
