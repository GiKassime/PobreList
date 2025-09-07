<?php
require_once(__DIR__ . '/../dao/PrioridadeDAO.php');
require_once(__DIR__ . '/../model/Prioridade.php');

class PrioridadeService {
	public function validarPrioridade(Prioridade $prioridade): array {
		$erros = [];
		$nivel = $prioridade->getNivel();
		if (!$nivel || trim($nivel) === '') {
			$erros[] = 'O nível da prioridade é obrigatório.';
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
}
