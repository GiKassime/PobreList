<?php

require_once(__DIR__ . '/../dao/CategoriaDAO.php');
require_once(__DIR__ . '/../model/Categoria.php');
require_once(__DIR__ . '/../service/CategoriaService.php');

class CategoriaController {
	private CategoriaDAO $categoriaDAO;
	private CategoriaService $categoriaService;

	public function __construct() {
		$this->categoriaDAO = new CategoriaDAO();
		$this->categoriaService = new CategoriaService();
	}

	public function listar() {
		return $this->categoriaDAO->listar();
	}

	public function inserir(Categoria $categoria) {
		$erros = $this->categoriaService->validarCategoria($categoria);
		if (count($erros) > 0) {
			return $erros;
		}
		return $this->categoriaDAO->inserir($categoria);
	}

	public function alterar(Categoria $categoria) {
		$erros = $this->categoriaService->validarCategoria($categoria);
		if (count($erros) > 0) {
			return $erros;
		}
		return $this->categoriaDAO->alterar($categoria);
	}

	public function buscarPorId(int $id) {
		return $this->categoriaDAO->buscarPorId($id);
	}

	public function excluir(int $id) {
		$erro = [];
		$erro = $this->categoriaService->excluirCategoria($id);
		if (count($erro) > 0) {
			return $erro;
		}else{
			return $this->categoriaDAO->excluir($id);
		}
	}
}
