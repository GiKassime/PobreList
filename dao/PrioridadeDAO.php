<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Prioridade.php');

class PrioridadeDAO
{
	private $conn;

	public function __construct()
	{
		$this->conn = Connection::getConnection();
	}

	public function listar()
	{
		$sql = "SELECT * FROM prioridade";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$prioridades = [];
		foreach ($result as $row) {
			$prioridade = new Prioridade();
			$prioridade->setId($row['id']);
			$prioridade->setNivel($row['nivel']);
			$prioridade->setCor($row['prioridade_cor']);
			$prioridades[] = $prioridade;
		}
		return $prioridades;
	}

	public function inserir(Prioridade $prioridade)
	{
		try {
			$sql = "INSERT INTO prioridade (nivel,prioridade_cor) VALUES (?,?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([
				$prioridade->getNivel(),
				$prioridade->getCor()
			]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function alterar(Prioridade $prioridade)
	{
		try {
			$sql = "UPDATE prioridade SET nivel = ?, prioridade_cor = ? WHERE id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([
				$prioridade->getNivel(),
				$prioridade->getCor(),
				$prioridade->getId()
			]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function buscarPorId($id)
	{
		$sql = "SELECT * FROM prioridade WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			$prioridade = new Prioridade();
			$prioridade->setId($row['id']);
			$prioridade->setNivel($row['nivel'])
				->setCor($row['prioridade_cor']);
			return $prioridade;
		}
		return null;
	}

	public function excluir($id)
	{

		try {
			$sql = "DELETE FROM prioridade WHERE id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([$id]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}
	public function existeComPrioridade($idPrioridade)
	{
		$sql = "SELECT COUNT(*) as total FROM item WHERE prioridade_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$idPrioridade]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row && $row['total'] > 0;
	}
}
