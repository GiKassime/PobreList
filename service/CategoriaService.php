<?php
require_once(__DIR__ . '/../dao/CategoriaDAO.php');
require_once(__DIR__ . '/../model/Categoria.php');

class CategoriaService {
    public function validarCategoria(Categoria $categoria): array {
        $erros = [];
        $nome = $categoria->getNome();
        if (!$nome || trim($nome) === '') {
            $erros[] = 'O nome da categoria é obrigatório.';
        
        }elseif(!$categoria->getCor() || !preg_match('/^#[0-9A-Fa-f]{6}$/', $categoria->getCor())){
   			 $erros[] = 'Selecione uma cor válida para a ca$categoria.';
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
    public function temItensAssociados($idcategoria)
	{
		$categoriaDAO = new categoriaDAO();
		return $categoriaDAO->existeComCategoria($idcategoria);
	}
	public function excluirCategoria($id)
	{
		$erros = [];
		if ($this->temItensAssociados($id)) {
			$erros[] = 'Não é possível excluir: existem itens associados a esta categoria.';
			return $erros;
		}
		return [];
	}
}
