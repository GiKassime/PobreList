<?php

require_once(__DIR__ . '/../dao/ItemDAO.php');
require_once(__DIR__ . '/../model/Item.php');
require_once(__DIR__ . '/../service/ItemService.php');

class ItemController {

	private ItemDAO $itemDAO;
	private ItemService $itemService;

	public function __construct() {
		$this->itemDAO = new ItemDAO();
		$this->itemService = new ItemService();
	}

	public function listar() {
		return $this->itemDAO->listar();
	}

	public function inserir(Item $item) {
		$erros = $this->itemService->validarItem($item);
		if (count($erros) > 0) {
			return $erros;
		}
		$erro = $this->itemDAO->inserir($item);
		if ($erro != NULL) {
			array_push($erros, "Erro ao salvar o item");
			if (defined('AMB_DEV') && AMB_DEV) {
				array_push($erros, $erro->getMessage());
			}
		}
		return $erros;
	}

	public function alterar(Item $item) {
		$erros = $this->itemService->validarItem($item);
		if (count($erros) > 0) {
			return $erros;
		}
		$erro = $this->itemDAO->alterar($item);
		if ($erro != NULL) {
			array_push($erros, "Erro ao alterar o item");
			if (defined('AMB_DEV') && AMB_DEV) {
				array_push($erros, $erro->getMessage());
			}
		}
		return $erros;
	}

	public function buscarPorId(int $id) {
		return $this->itemDAO->buscarPorId($id);
	}

	public function excluir(int $id) {
		$erros = [];
		$erro = $this->itemDAO->excluir($id);
		if ($erro != NULL) {
			array_push($erros, "Erro ao excluir o item");
			if (defined('AMB_DEV') && AMB_DEV) {
				array_push($erros, $erro->getMessage());
			}
		}
		return $erros;
	}
}
