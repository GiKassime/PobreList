<?php
require_once(__DIR__ . '/../dao/PrioridadeDAO.php');
require_once(__DIR__ . '/../model/Prioridade.php');

class PrioridadeService
{
	public function validarPrioridade(Prioridade $prioridade): array
	{
		$erros = [];
		$nivel = $prioridade->getNivel();
		if (!$nivel || trim($nivel) === '') {
			$erros[] = 'O nível da prioridade é obrigatório.';
		} elseif (!$prioridade->getCor() || !preg_match('/^#[0-9A-Fa-f]{6}$/', $prioridade->getCor())) {
			$erros[] = 'Selecione uma cor válida para a prioridade.';
		} else {
			// Verificar duplicidade
			$prioridadeDAO = new PrioridadeDAO();
			$todas = $prioridadeDAO->listar();
			foreach ($todas as $p) {
				if (strtolower(trim($p->getNivel())) === strtolower(trim($nivel)) && $p->getId() != $prioridade->getId()) {
					$erros[] = 'Já existe uma prioridade com esse nível.';
					break;
				}
			}
		}
		return $erros;
	}

	public function temItensAssociados($idPrioridade)
	{
		$prioridadeDAO = new PrioridadeDAO();
		return $prioridadeDAO->existeComPrioridade($idPrioridade);
	}
	public function excluirPrioridade($id)
	{
		$erros = [];
		if ($this->temItensAssociados($id)) {
			$erros[] = 'Não é possível excluir: existem itens associados a esta prioridade.';
			return $erros;
		}
		return [];
	}
}
