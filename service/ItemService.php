<?php
require_once(__DIR__ . '/../model/Item.php');

class ItemService {
	public function validarItem(Item $item): array {
		$erros = [];
		$nome = $item->getNome();
		if (!$nome || trim($nome) === '') {
			$erros[] = 'O nome do item é obrigatório.';
		} else {
			// Verificar duplicidade de nome
			require_once(__DIR__ . '/../dao/ItemDAO.php');
			$itemDAO = new ItemDAO();
			$todos = $itemDAO->listar();
			foreach ($todos as $i) {
				if (strtolower(trim($i->getNome())) === strtolower(trim($nome)) && $i->getId() != $item->getId()) {
					$erros[] = 'Já existe um item com esse nome.';
					break;
				}
			}
		}
		if (!$item->getDescricao() || trim($item->getDescricao()) === '') {
			$erros[] = 'A descrição do item é obrigatória.';
		}
		if (!$item->getCategoria() || !$item->getCategoria()->getId()) {
			$erros[] = 'A categoria é obrigatória, caso ainda não tenha uma cadastre!<a href="/PobreList/view/categorias/inserir.php">CADASTRAR</a>.';
		}
		if (!$item->getPrioridade() || !$item->getPrioridade()->getId()) {
			$erros[] = 'A prioridade é obrigatória, caso ainda não tenha uma cadastre! <a href="/PobreList/view/prioridades/inserir.php">CADASTRAR</a>.';
		}
		if ($item->getPrecoEstimado() !== null && (!is_numeric($item->getPrecoEstimado()) || $item->getPrecoEstimado() < 0)) {
			$erros[] = 'O preço estimado deve ser maior que ZERO';
		}
		if (!$item->getDataDesejo() || trim($item->getDataDesejo()) === '') {
			$erros[] = 'A data desejada é obrigatória.';
		} else {
			$dataHoje = date('Y-m-d');
			if ($item->getDataDesejo() < $dataHoje) {
				$erros[] = 'A data desejada não pode ser no passado.';
			}
		}
		if (!$item->getUrlImagem() || trim($item->getUrlImagem()) === '') {
			$erros[] = 'A URL da imagem é obrigatória.';
		}
		if ($item->getUrlImagem() && !filter_var($item->getUrlImagem(), FILTER_VALIDATE_URL)) {
			$erros[] = 'A URL da imagem não é válida.';
		}
		// Validação do link do item (opcional)
		if ($item->getUrlWeb() && !filter_var($item->getUrlWeb(), FILTER_VALIDATE_URL)) {
			$erros[] = 'O link do item não é válido.';
		}
		return $erros;
	}
}
