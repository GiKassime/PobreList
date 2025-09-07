<?php
// Listar Categorias
require_once(__DIR__ . '/../../controller/CategoriaController.php');
$title = "Listar Categorias";
$categoriaCont = new CategoriaController();
$categorias = $categoriaCont->listar();
include_once(__DIR__ . '/../include/header.php');
include_once(__DIR__ . '/../include/nav.php');
?>
<div class="container my-4">
	<div class="row g-3 align-items-center justify-content-center mb-4">
		<div class="col-auto">
			<a href="inserir.php" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;">
				<span class="me-2"><i class="bi bi-plus-circle"></i></span>
				ADICIONAR CATEGORIA
			</a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<div class="table-responsive">
				<table class="table table-bordered table-hover align-middle bg-white">
					<thead class="table-light">
						<tr>
							<th>Nome</th>
                            <th class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($categorias)): ?>
							<tr><td colspan="3" class="text-center">Nenhuma categoria cadastrada.</td></tr>
						<?php else: ?>
							<?php foreach ($categorias as $cat): ?>
								<tr>
									<td><?= htmlspecialchars($cat->getNome()) ?></td>
									<td class="text-center">
										<a href="alterar.php?id=<?= $cat->getId() ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil mx-1"></i>Editar</a>
										<a href="excluir.php?id=<?= $cat->getId() ?>" class="btn btn-sm btn-danger"  onclick="return confirm('Tem certeza que deseja excluir <?= $cat->getNome()?>?');"><i class="bi bi-trash mx-1"></i>Excluir</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include_once(__DIR__ . '/../include/footer.php'); ?>
