<?php
require_once(__DIR__ . '/../../model/Item.php');
require_once(__DIR__ . '/../../model/Categoria.php');
require_once(__DIR__ . '/../../model/Prioridade.php');
require_once(__DIR__ . '/../../controller/ItemController.php');

$item = null;
$msgErro = "";
$id = null;
if (isset($_POST['nome'])) {
	$id = is_numeric($_POST['id']) ? (int)$_POST['id'] : null;
	$nome = trim($_POST['nome']) ?: null;
	$descricao = trim($_POST['descricao']) ?: null;
	$urlImagem = trim($_POST['url_imagem']) ?: null;
	$urlWeb = trim($_POST['url_web']) ?: null;
	$idCategoria = is_numeric($_POST['categoria']) ? (int)$_POST['categoria'] : null;
	$idPrioridade = is_numeric($_POST['prioridade']) ? (int)$_POST['prioridade'] : null;
	$precoEstimado = isset($_POST['preco_estimado']) && is_numeric($_POST['preco_estimado']) ? (float)$_POST['preco_estimado'] : null;
	$dataDesejo = trim($_POST['data_desejo']) ?: null;
	$comprado = isset($_POST['comprado']) && $_POST['comprado'] == '1';

	$item = new Item();
	$item->setId($id);
	$item->setNome($nome);
	$item->setDescricao($descricao);
	$item->setUrlImagem($urlImagem);
	$item->setUrlWeb($urlWeb);

	$categoria = new Categoria();
	$categoria->setId($idCategoria);
	$item->setCategoria($categoria);

	$prioridade = new Prioridade();
	$prioridade->setId($idPrioridade);
	$item->setPrioridade($prioridade);

	$item->setPrecoEstimado($precoEstimado);
	$item->setDataDesejo($dataDesejo);
	$item->setComprado($comprado);

	$itemCont = new ItemController();
	$erros = $itemCont->alterar($item);
	if (!$erros) {
		header('Location: listar.php');
		exit;
	} else {
		$msgErro = implode('<br>', $erros);
	}
} else {
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	if ($id == null) {
		echo "ID não informado.<br><a href='listar.php'>Voltar</a>";
		exit;
	}
	$itemCont = new ItemController();
	$item = $itemCont->buscarPorId($id);
	if (!$item) {
		echo "Item não encontrado.<br><a href='listar.php'>Voltar</a>";
		exit;
	}
}

include_once(__DIR__ . '/form.php');

