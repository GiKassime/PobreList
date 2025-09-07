<?php
// Listar Prioridades
require_once(__DIR__ . '/../../controller/PrioridadeController.php');
$title = "Listar Prioridades";
$prioridadeCont = new PrioridadeController();
$prioridades = $prioridadeCont->listar();
include_once(__DIR__ . '/../include/header.php');
include_once(__DIR__ . '/../include/nav.php');
?>
<div class="container my-4">
	<div class="row g-3 align-items-center justify-content-center mb-4">
		<div class="col-auto">
			<a href="inserir.php" class="btn btn-success d-flex align-items-center gap-2 px-4 py-2" style="font-size:1.2rem;">
				<span class="me-2"><i class="bi bi-plus-circle"></i></span>
				ADICIONAR PRIORIDADE
			</a>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<div class="table-responsive">
				<table class="table table-bordered table-hover align-middle bg-white">
					<thead class="table-light">
						<tr>
							<th>Nível</th>
							<th class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($prioridades)): ?>
							<tr><td colspan="2" class="text-center">Nenhuma prioridade cadastrada.</td></tr>
						<?php else: ?>
							<?php foreach ($prioridades as $p): ?>
								<tr>
									<td><?= htmlspecialchars($p->getNivel()) ?></td>
									<td class="text-center">
										<a href="alterar.php?id=<?= $p->getId() ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil mx-1"></i>Editar</a>
										<a href="excluir.php?id=<?= $p->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir <?= $p->getNivel()?>?');"><i class="bi bi-trash mx-1"></i>Excluir</a>
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
