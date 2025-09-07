<?php
include_once(__DIR__ . "/view/include/header.php");

?>
	<div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center">
        				<h1 class="pobrelist-title text-center">POBRELIST</h1>

		<div class="row w-100 justify-content-center align-items-center" style="min-height: 100vh;">
			<div class="col-lg-5 d-flex flex-column align-items-center position-relative mb-4 mb-lg-0">
				<img src="src/img/indexfoto.png" alt="Mascote PobreList" class="main-img mb-2">
				<img src="src/img/indexdireito.png" class="star" alt="Sparkles" style="background: #fff0;">
				<img src="src/img/indexesquerdo.png" class="star2" alt="Arco-íris" style="background: #fff0;">
			</div>
			<div class="col-lg-7 d-flex flex-column align-items-center">
				<a href="view/itens/" class="btn btn-pobrelist btn-itens w-75">GERENCIAR ITENS</a>
				<a href="view/categorias/" class="btn btn-pobrelist btn-categorias w-75">GERENCIAR CATEGORIAS</a>
				<a href="view/prioridades/" class="btn btn-pobrelist btn-prioridades w-75">GERENCIAR PRIORIDADES</a>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php
include_once(__DIR__ . "/view/include/footer.php");

?>
</html>
