<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Prioridade.php');

class PrioridadeDAO {
	private $conn;

	public function __construct() {
		$this->conn = Connection::getConnection();
	}

	public function listar() {
		$sql = "SELECT * FROM prioridade";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$prioridades = [];
		foreach ($result as $row) {
			$prioridade = new Prioridade();
			$prioridade->setId($row['id']);
			$prioridade->setNivel($row['nivel']);
			$prioridades[] = $prioridade;
		}
		return $prioridades;
	}

	public function inserir(Prioridade $prioridade) {
		try {
			$sql = "INSERT INTO prioridade (nivel) VALUES (:nivel)";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(':nivel', $prioridade->getNivel());
			$stmt->execute();
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function alterar(Prioridade $prioridade) {
		try {
			$sql = "UPDATE prioridade SET nivel = :nivel WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(':nivel', $prioridade->getNivel());
			$stmt->bindValue(':id', $prioridade->getId(), PDO::PARAM_INT);
			$stmt->execute();
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function buscarPorId($id) {
		$sql = "SELECT * FROM prioridade WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			$prioridade = new Prioridade();
			$prioridade->setId($row['id']);
			$prioridade->setNivel($row['nivel']);
			return $prioridade;
		}
		return null;
	}

	public function excluir($id) {
		try {
			$sql = "DELETE FROM prioridade WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}
}
