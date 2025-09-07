<?php
require_once(__DIR__ . '/../model/Categoria.php');
require_once(__DIR__ . '/../util/Connection.php');

class CategoriaDAO {
	private $conn;

	public function __construct() {
		$this->conn = Connection::getConnection();
	}

	public function listar() {
		$sql = "SELECT * FROM categoria";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$categorias = [];
		foreach ($result as $row) {
			$cat = new Categoria();
			$cat->setId($row['id'])
				->setNome($row['nome']);
			$categorias[] = $cat;
		}
		return $categorias;
	}

	public function inserir(Categoria $categoria) {
		try {
			$sql = "INSERT INTO categoria (nome) VALUES (?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([$categoria->getNome()]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function alterar(Categoria $categoria) {
		try {
			$sql = "UPDATE categoria SET nome=? WHERE id=?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([$categoria->getNome(), $categoria->getId()]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function buscarPorId($id) {
		$sql = "SELECT * FROM categoria WHERE id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			$cat = new Categoria();
			$cat->setId($row['id'])
				->setNome($row['nome']);
			return $cat;
		}
		return null;
	}

	public function excluir($id) {
		try {
			$sql = "DELETE FROM categoria WHERE id = ?";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([$id]);
			return null;
		} catch (PDOException $e) {
			return $e;
		}
	}
}
