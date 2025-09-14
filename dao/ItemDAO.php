<?php
require_once(__DIR__ . '/../model/Item.php');
require_once(__DIR__ . '/../model/Categoria.php');
require_once(__DIR__ . '/../model/Prioridade.php');
require_once(__DIR__ . '/../util/Connection.php');

class ItemDAO
{
	private $conn;

	public function __construct()
	{
		$this->conn = Connection::getConnection();
	}

	public function listar()
	{
		$sql = "SELECT 
    item.*, 
    categoria.nome AS categoria_nome, 
    categoria.categoria_cor, 
    prioridade.nivel AS prioridade_nivel, 
    prioridade.prioridade_cor
FROM item
JOIN categoria ON item.categoria_id = categoria.id
JOIN prioridade ON item.prioridade_id = prioridade.id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$itens = [];
		foreach ($result as $row) {
			$item = new Item();
			$item->setId($row['id'])
				->setNome($row['nome'])
				->setDescricao($row['descricao'])
				->setPrecoEstimado($row['preco_estimado'])
				->setDataDesejo($row['data_desejo'])
				->setUrlImagem(isset($row['url_imagem']) ? $row['url_imagem'] : null)
				->setUrlWeb(isset($row['url_web']) ? $row['url_web'] : null)
				->setComprado(isset($row['comprado']) ? (bool)$row['comprado'] : false);
			$categoria = new Categoria();
			$categoria->setId($row['categoria_id'])->setNome($row['categoria_nome'])->setCor($row['categoria_cor']);
			$prioridade = new Prioridade();
			$prioridade->setId($row['prioridade_id'])->setNivel($row['prioridade_nivel'])->setCor($row['prioridade_cor']);
			$item->setCategoria($categoria);
			$item->setPrioridade($prioridade);
			$itens[] = $item;
		}
		return $itens;
	}

	public function inserir(Item $item)
	{
		try {
			$sql = "INSERT INTO item (nome, descricao, categoria_id, prioridade_id, preco_estimado, url_imagem, url_web, data_desejo, comprado)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([
				$item->getNome(),
				$item->getDescricao(),
				$item->getCategoria() ? $item->getCategoria()->getId() : null,
				$item->getPrioridade() ? $item->getPrioridade()->getId() : null,
				$item->getPrecoEstimado(),
				$item->getUrlImagem(),
				$item->getUrlWeb(),
				$item->getDataDesejo(),
				$item->isComprado() ? 1 : 0
			]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function alterar(Item $item)
	{
		try {
			$sql = "UPDATE item SET nome=?, descricao=?, categoria_id=?, prioridade_id=?, preco_estimado=?, url_imagem=?, url_web=?, data_desejo=?, comprado=? WHERE id=?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([
				$item->getNome(),
				$item->getDescricao(),
				$item->getCategoria() ? $item->getCategoria()->getId() : null,
				$item->getPrioridade() ? $item->getPrioridade()->getId() : null,
				$item->getPrecoEstimado(),
				$item->getUrlImagem(),
				$item->getUrlWeb(),
				$item->getDataDesejo(),
				$item->isComprado() ? 1 : 0,
				$item->getId()
			]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function buscarPorId($id)
	{
		$sql = "SELECT i.*, 
               c.nome as categoria_nome, 
               c.categoria_cor, 
               p.nivel as prioridade_nivel, 
               p.prioridade_cor
        FROM item i
        JOIN categoria c ON i.categoria_id = c.id
        JOIN prioridade p ON i.prioridade_id = p.id
        WHERE i.id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			$item = new Item();
			$item->setId($row['id'])
				->setNome($row['nome'])
				->setDescricao($row['descricao'])
				->setPrecoEstimado($row['preco_estimado'])
				->setDataDesejo($row['data_desejo'])
				->setUrlImagem(isset($row['url_imagem']) ? $row['url_imagem'] : null)
				->setUrlWeb(isset($row['url_web']) ? $row['url_web'] : null)
				->setComprado(isset($row['comprado']) ? (bool)$row['comprado'] : false);
			$categoria = new Categoria();
			$categoria->setId($row['categoria_id'])
				->setNome($row['categoria_nome'])->setCor($row['categoria_cor']);
			$prioridade = new Prioridade();
			$prioridade->setId($row['prioridade_id'])
				->setNivel($row['prioridade_nivel'])->setCor($row['prioridade_cor']);
			$item->setCategoria($categoria);
			$item->setPrioridade($prioridade);
			return $item;
		}
		return null;
	}

	public function excluir($id)
	{
		try {
			$sql = "DELETE FROM item WHERE id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([$id]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}
}
