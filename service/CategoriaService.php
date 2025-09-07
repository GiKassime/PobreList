<?php
require_once(__DIR__ . '/../dao/CategoriaDAO.php');
require_once(__DIR__ . '/../model/Categoria.php');

class CategoriaService {
    public function validarCategoria(Categoria $categoria): array {
        $erros = [];
        $nome = $categoria->getNome();
        if (!$nome || trim($nome) === '') {
            $erros[] = 'O nome da categoria é obrigatório.';
        } else {
            // Verificar duplicidade de nome
            $categoriaDAO = new CategoriaDAO();
            $todas = $categoriaDAO->listar();
            foreach ($todas as $c) {
                if (strtolower(trim($c->getNome())) === strtolower(trim($nome)) && $c->getId() != $categoria->getId()) {
                    $erros[] = 'Já existe uma categoria com esse nome.';
                    break;
                }
            }
        }
        return $erros;
    }
}
