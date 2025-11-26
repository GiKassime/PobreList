const selCategoria = document.querySelector('#selCategoria');
const conf = document.querySelector('#confUrlBase');
const URL_BASE = conf ? conf.dataset.urlBase : '';

// carrega categorias ao abrir a página
carregarCategorias();

function carregarCategorias() {
    // Apagar as options já existentes
    selCategoria.innerHTML = '';

    // Criar um option com o valor Selecione
    var selecione = {"id": 0, "nome": "---Selecione---"};
    adicionarOptionCategoria(selecione);
    
    // Enviar a requisição AJAX
    var url = URL_BASE + '/api/categorias_listar.php';
    var xhttp = new XMLHttpRequest();
    xhttp.open('GET', url);

    // Função de callback
    xhttp.onload = function() {
        var json = xhttp.responseText;
        var categorias = JSON.parse(json);
        categorias.forEach(c => {
            adicionarOptionCategoria(c);
        });
    }

    xhttp.send();
}

function adicionarOptionCategoria(cat) {
    var option = document.createElement('option');
    option.value = cat.id;
    option.innerHTML = cat.nome;

    // Marcar o option que já estava selecionado
    const idSelecionado = selCategoria.getAttribute('idSelecionado');
    if(idSelecionado == cat.id)
        option.selected = true;

    selCategoria.appendChild(option);
}

