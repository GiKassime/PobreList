<?php

require_once(__DIR__ . '/../dao/PrioridadeDAO.php');
require_once(__DIR__ . '/../model/Prioridade.php');
require_once(__DIR__ . '/../service/PrioridadeService.php');

class PrioridadeController {
	private PrioridadeDAO $prioridadeDAO;
	private PrioridadeService $prioridadeService;

	public function __construct() {
		$this->prioridadeDAO = new PrioridadeDAO();
		$this->prioridadeService = new PrioridadeService();
	}

	public function listar() {
		return $this->prioridadeDAO->listar();
	}

	public function inserir(Prioridade $prioridade) {
		$erros = $this->prioridadeService->validarPrioridade($prioridade);
		if (count($erros) > 0) {
			return $erros;
		}
		$erro = $this->prioridadeDAO->inserir($prioridade);
		if ($erro != null) {
			$erros[] = 'Erro ao salvar prioridade.';
			if (defined('AMB_DEV') && AMB_DEV) {
				$erros[] = $erro->getMessage();
			}
		}
		return $erros;
	}

	public function alterar(Prioridade $prioridade) {
		$erros = $this->prioridadeService->validarPrioridade($prioridade);
		if (count($erros) > 0) {
			return $erros;
		}
		$erro = $this->prioridadeDAO->alterar($prioridade);
		if ($erro != null) {
			$erros[] = 'Erro ao alterar prioridade.';
			if (defined('AMB_DEV') && AMB_DEV) {
				$erros[] = $erro->getMessage();
			}
		}
		return $erros;
	}

	public function buscarPorId(int $id) {
		return $this->prioridadeDAO->buscarPorId($id);
	}

	public function excluir(int $id) {
		return $this->prioridadeDAO->excluir($id);
	}
}
